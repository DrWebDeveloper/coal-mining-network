<?php
    $latestTrx = getContent('latest_trx.content', true);
    $deposits = App\Models\Deposit::where('status', 1)->with('gateway')->latest()->limit(10)->get();
    $withdraws = App\Models\Withdrawal::where('status', 1)->with('method')->latest()->limit(10)->get();
?>

  <!-- statistics section start -->
    <section class="pt-100 pb-100 border-top">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="section-header text-center">
                <h2 class="section-title"><?php echo e(__(@$latestTrx->data_values->heading)); ?></h2>
              </div>
            </div>
          </div><!-- row end -->
          <div class="row gy-4 justify-content-center">
            <div class="col-lg-10">
              <ul class="nav nav-tabs custom--nav-tabs statistics--nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="deposit-tab" data-bs-toggle="tab" data-bs-target="#deposit" type="button" role="tab" aria-controls="deposit" aria-selected="true"><?php echo app('translator')->get('Latest Deposit'); ?></button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="withdraw-tab" data-bs-toggle="tab" data-bs-target="#withdraw" type="button" role="tab" aria-controls="withdraw" aria-selected="false"><?php echo app('translator')->get('Latest Withdraw'); ?></button>
                </li>
              </ul>
              <div class="tab-content mt-4" id="statisticsContent">
                <div class="tab-pane fade show active" id="deposit" role="tabpanel" aria-labelledby="deposit-tab">
                 
                <div class="table-responsive--md">
                  <table class="table custom--table">
                      <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Trx'); ?></th>
                            <th><?php echo app('translator')->get('Gateway'); ?></th>
                            <th><?php echo app('translator')->get('Amount'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                            <th><?php echo app('translator')->get('Time'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($deposit->trx); ?></td>
                                <td><?php echo e(__(@$deposit->gateway->name)); ?></td>
                                <td>
                               <?php echo e(showAmount($deposit->amount)); ?> <?php echo e(__($general->cur_text)); ?>

                                </td>
                                <td>
                                  <?php
                                      echo $deposit->statusBadge;
                                  ?>
                                </td>
                                <td>
                                   <?php echo e(showDateTime($deposit->created_at)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                            </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
                  <div class="table-responsive--md">
                    <table class="table custom--table">
                      <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Trx'); ?></th>
                            <th><?php echo app('translator')->get('Gateway'); ?></th>
                            <th><?php echo app('translator')->get('Amount'); ?></th>
                            <th><?php echo app('translator')->get('Status'); ?></th>
                            <th><?php echo app('translator')->get('Time'); ?></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($withdraw->trx); ?></td>
                            <td><?php echo e(__($withdraw->method->name)); ?></td>
                            <td>
                                <strong><?php echo e(showAmount($withdraw->amount)); ?> <?php echo e(__($general->cur_text)); ?></strong>
                            </td>
                            <td>
                              <?php
                              echo $deposit->statusBadge;
                          ?>
                            </td>
                            <td>
                                <?php echo e(showDateTime($withdraw->created_at)); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                            </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- statistics section end -->
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/sections/latest_trx.blade.php ENDPATH**/ ?>