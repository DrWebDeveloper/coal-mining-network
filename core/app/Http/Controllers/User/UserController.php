<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\Form;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $pageTitle     = 'Dashboard';
        $user          = Auth::user();
        $totalDeposit  = Deposit::where('user_id', $user->id)->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id', $user->id)->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
        $latestTrx     = Transaction::where('user_id', $user->id)->latest()->limit(10)->get();
        $totalInvest   = Investment::where('user_id', $user->id)->sum('amount');
        $plans         = Plan::where('status', 1)->get();

        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle','user', 'totalDeposit','totalWithdraw','latestTrx','totalInvest','plans'));
    }

    public function depositHistory(Request $request)
    {
        $pageTitle = 'Deposit History';
        $deposits = auth()->user()->deposits()->searchable(['trx'])->with(['gateway'])->orderBy('id','desc')->paginate(getPaginate());
        return view($this->activeTemplate.'user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function show2faForm()
    {
        $general = gs();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->site_name, $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate.'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code,$request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function kycForm()
    {
        if (auth()->user()->kv == Status::KYC_PENDING) {
            $notify[] = ['error','Your KYC is under review'];
            return to_route('user.home')->withNotify($notify);
        }
        if (auth()->user()->kv == Status::KYC_VERIFIED) {
            $notify[] = ['error','You are already KYC verified'];
            return to_route('user.home')->withNotify($notify);
        }
        $pageTitle = 'KYC Form';
        $form = Form::where('act','kyc')->first();
        return view($this->activeTemplate.'user.kyc.form', compact('pageTitle','form'));
    }

    public function kycData()
    {
        $user = auth()->user();
        $pageTitle = 'KYC Data';
        return view($this->activeTemplate.'user.kyc.info', compact('pageTitle','user'));
    }

    public function kycSubmit(Request $request)
    {
        $form = Form::where('act','kyc')->first();
        $formData = $form->form_data;
        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);
        $user = auth()->user();
        $user->kyc_data = $userData;
        $user->kv = 2;
        $user->save();

        $notify[] = ['success','KYC data submitted successfully'];
        return to_route('user.home')->withNotify($notify);

    }

    public function attachmentDownload($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general = gs();
        $title = slug($general->site_name).'- attachments.'.$extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData()
    {
        $user = auth()->user();
        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }
        $pageTitle = 'User Data';
        return view($this->activeTemplate.'user.user_data', compact('pageTitle','user'));
    }

    public function userDataSubmit(Request $request)
    {
        $user = auth()->user();
        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
        ]);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = [
            'country'=>@$user->address->country,
            'address'=>$request->address,
            'state'=>$request->state,
            'zip'=>$request->zip,
            'city'=>$request->city,
        ];
        $user->profile_complete = 1;
        $user->save();

        $notify[] = ['success','Registration process completed successfully'];
        return to_route('user.home')->withNotify($notify);

    }

    public function transactions(Request $request)
    {
        $pageTitle = 'Transactions';

        $remarks = Transaction::distinct('remark')->orderBy('remark')->get('remark');

        $transactions = Transaction::where('user_id',auth()->id())->searchable(['trx'])->filter(['trx_type','remark'])->orderBy('id','desc')->paginate(getPaginate());

        return view($this->activeTemplate.'user.transactions', compact('pageTitle','transactions','remarks'));
    }

    public function plans(){
        $pageTitle = "All Plans";
        $plans     = Plan::where('status', Status::ENABLE)->paginate(getPaginate());
        return view($this->activeTemplate.'user.plans', compact('pageTitle','plans','pageTitle'));
    }

    public function investment(Request $request){


        $request->validate([
            'amount'=> 'required|numeric|gt:0',
            'id'=> 'required|integer',
        ]);

        $plan = Plan::where('id', $request->id)->where('status', Status::ENABLE)->firstOrFail();

        if($plan->min_amount > $request->amount || $plan->max_amount < $request->amount){
            $notify[] = ['error', 'Please follow the investment limit'];
            return back()->withNotify($notify);
        }

        $user = Auth::user();
        if($user->balance < $request->amount){
            $notify[] = ['error', 'Sorry, You have not sufficient balance'];
            return to_route('user.deposit')->withNotify($notify);
        }

        $interest = 0;
        $nextReturn = Carbon::now()->addDay(1);

        if($plan->interest_type == Status::FIXED){
            $interest = $plan->interest;
        }else{
            $interest = ($request->amount * $plan->interest) / 100;
        }

        $user->balance -= $request->amount;
        $user->save();


        $newInvest                   = new Investment();
        $newInvest->trx              = getTrx();
        $newInvest->plan_id          = $plan->id;
        $newInvest->user_id          = $user->id;
        $newInvest->amount           = $request->amount;
        $newInvest->interest_type    = $plan->interest_type;
        $newInvest->interest_amount  = $interest;
        $newInvest->total_return     = $plan->total_return;
        $newInvest->next_return_date = $nextReturn;
        $newInvest->status           = Status::RUNNING;
        $newInvest->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $request->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->remark       = 'invest';
        $transaction->details      = 'Invest on '.$plan->name;
        $transaction->trx          = $newInvest->trx;
        $transaction->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New Investment In '.$plan->name.' from '.$user->username;
        $adminNotification->click_url = urlPath('admin.users.investment',$user->id);
        $adminNotification->save();

        $general = gs();

        notify($user, 'INVESTMENT', [
            'currency'     => $general->cur_text,
            'trx'          => $transaction->trx,
            'plan'         => $plan->name,
            'amount'       => $request->amount,
            'details'      => $transaction->details,
            'post_balance' => $user->balance,
            'interest'     => $interest,
            'total_return' => $newInvest->total_return
        ]);

        $notify[] = ['success', 'Invested successfully'];
        return redirect()->route('user.investment.log')->withNotify($notify);

    }

    public function investmentLog(){
        $pageTitle = 'Investments';
        $user      = Auth::user();

        $investments = Investment::where('user_id',auth()->id())->searchable(['trx'])->filter(['interest_type','status'])->orderBy('id','desc')->paginate(getPaginate());

        return view($this->activeTemplate.'user.investment_log', compact('pageTitle','investments'));
    }

    public function referrals(){
        $referrals = User::where('ref_by',auth()->user()->id)->with('deposits')->paginate(getPaginate());
        $pageTitle = 'My Referrals';
        return view($this->activeTemplate.'user.referrals',compact('pageTitle','referrals'));
    }

}
