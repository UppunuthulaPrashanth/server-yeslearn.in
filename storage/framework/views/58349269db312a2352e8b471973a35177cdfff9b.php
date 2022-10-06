<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="">
        <h2 class="section-title"><?php echo e(trans('panel.select_promotion_plan')); ?></h2>

        <div class="row mt-20">

            <?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-lg-3 mt-15">
                    <div class="subscribe-plan position-relative bg-white d-flex flex-column align-items-center rounded-sm shadow pt-50 pb-20 px-20">
                        <?php if($promotion->is_popular): ?>
                            <span class="badge badge-primary badge-popular px-15 py-5"><?php echo e(trans('panel.popular')); ?></span>
                        <?php endif; ?>

                        <div class="plan-icon">
                            <img src="<?php echo e($promotion->icon); ?>" class="img-cover" alt="">
                        </div>

                        <h3 class="mt-20 font-30 text-secondary subscribe-plan-title"><?php echo e($promotion->title); ?></h3>
                        <p class="font-weight-500 text-gray mt-10"><?php echo e(trans('panel.promotion_days',['day' => $promotion->days])); ?></p>

                        <div class="d-flex align-items-start text-primary mt-30">
                            <span class="font-36 line-height-1 subscribe-plan-price"><?php echo e(addCurrencyToPrice($promotion->price)); ?></span>
                        </div>

                        <p class="text-dark-blue font-14 mt-25"><?php echo nl2br($promotion->description); ?></p>

                        <button type="button" data-promotion-id="<?php echo e($promotion->id); ?>"
                                class="js-pay-promotion btn btn-primary btn-block mt-50"><?php echo e(trans('financial.purchase')); ?></button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <?php if($promotionSales->count() > 0): ?>
        <section class="mt-35">
            <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                <h2 class="section-title"><?php echo e(trans('panel.promotions_history')); ?></h2>

                <div
                    class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="mb-0 mr-10 text-gray font-14 font-weight-500"
                           for="activePromotionSwitch"><?php echo e(trans('panel.show_only_active_promotions')); ?></label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="active_promotions" class="custom-control-input"
                               id="activePromotionSwitch">
                        <label class="custom-control-label" for="activePromotionSwitch"></label>
                    </div>
                </div>
            </div>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table text-center ">
                                <thead>
                                <tr>
                                    <th class="text-left text-gray"><?php echo e(trans('panel.webinar')); ?></th>
                                    <th class="text-center text-gray"><?php echo e(trans('panel.plan')); ?></th>
                                    <th class="text-center text-gray"><?php echo e(trans('public.price')); ?></th>
                                    <th class="text-center text-gray"><?php echo e(trans('public.date')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $promotionSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotionSale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left text-dark-blue font-weight-500 align-middle"><?php echo e($promotionSale->webinar->title); ?></td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500"><?php echo e($promotionSale->promotion->title); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500"><?php echo e(addCurrencyToPrice($promotionSale->promotion->price)); ?></span>
                                        </td>
                                        <td class="text-dark-blue font-weight-500 align-middle"><?php echo e(dateTimeFormat($promotionSale->created_at, 'j M Y | H:i')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    <?php else: ?>
        <?php echo $__env->make(getTemplate() . '.includes.no-result',[
            'file_name' => 'promotion.png',
            'title' => trans('panel.promotion_no_result'),
            'hint' =>  nl2br(trans('panel.promotion_no_result_hint')) ,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>

    <div class="my-30">
        <?php echo e($promotionSales->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>

    <div id="promotionModal" class="d-none">
        <form action="/panel/marketing/pay-promotion" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="promotion_id" value="">


            <h3 class="section-title after-line"><?php echo e(trans('panel.promote_the_webinar')); ?></h3>
            <div class="mt-25 d-flex flex-column align-items-center">
                <img src="/assets/default/img/check.png" alt="" width="120" height="117">
                <p class="mt-10"><?php echo e(trans('panel.select_webinar_for_promotion')); ?></p>
                <div class="w-75">

                    <div class="mt-15 d-flex justify-content-between">
                        <span class="text-gray font-weight-bold"><?php echo e(trans('panel.plan')); ?>:</span>
                        <span class="text-gray modal-title"></span>
                    </div>

                    <div class="mt-10 d-flex justify-content-between">
                        <span class="text-gray font-weight-bold"><?php echo e(trans('public.price')); ?>:</span>
                        <span class="text-gray">$<span class="modal-price"></span></span>
                    </div>

                    <div class="form-group mt-15">
                        <select name="webinar_id" class="form-control custom-select">
                            <option selected disabled><?php echo e(trans('panel.select_course')); ?></option>

                            <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($webinar->id); ?>"><?php echo e($webinar->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php echo e(trans('panel.select_course')); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button"
                        class="btn btn-sm btn-primary js-submit-promotion"><?php echo e(trans('panel.pay')); ?></button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl"><?php echo e(trans('public.close')); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>

    <script src="/assets/default/js/panel/marketing/promotions.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yeslearn.in/public_html/resources/views/web/default/panel/marketing/promotions.blade.php ENDPATH**/ ?>