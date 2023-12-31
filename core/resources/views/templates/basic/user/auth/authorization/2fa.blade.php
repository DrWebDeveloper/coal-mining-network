@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card custom--card">
                    <div class="verification-code-wrapper">
                        <div class="verification-area">
                            <h5 class="pb-3 text-center border-bottom">@lang('2FA Verification')</h5>
                            <form action="{{ route('user.go2fa.verify') }}" method="POST" class="submit-form">
                                @csrf
                                
                                @include($activeTemplate . 'partials.verification_code')
                                
                                <div class="form--group">
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
