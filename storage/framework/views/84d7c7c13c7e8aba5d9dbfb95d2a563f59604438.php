<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(trans('/oraclepopupsignin/main.edit')); ?> <?php echo e(trans('oraclepopupsignin/main.user')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/"><?php echo e(trans('oraclepopupsignin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/users"><?php echo e(trans('oraclepopupsignin/main.users')); ?></a>
                </div>
                <div class="breadcrumb-item"><?php echo e(trans('/oraclepopupsignin/main.edit')); ?></div>
            </div>
        </div>

        <?php if(!empty(session()->has('msg'))): ?>
            <div class="alert alert-success my-25">
                <?php echo e(session()->get('msg')); ?>

            </div>
        <?php endif; ?>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?php if(empty($becomeInstructor)): ?> active <?php endif; ?>" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><?php echo e(trans('oraclepopupsignin/main.main_general')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true"><?php echo e(trans('auth.images')); ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="financial-tab" data-toggle="tab" href="#financial" role="tab" aria-controls="financial" aria-selected="true"><?php echo e(trans('oraclepopupsignin/main.financial')); ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="occupations-tab" data-toggle="tab" href="#occupations" role="tab" aria-controls="occupations" aria-selected="true"><?php echo e(trans('site.occupations')); ?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="true"><?php echo e(trans('oraclepopupsignin/main.badges')); ?></a>
                                </li>

                                <?php if(!empty($user) and ($user->isOrganization() or $user->isTeacher())): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_update_user_registration_package')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="registrationPackage-tab" data-toggle="tab" href="#registrationPackage" role="tab" aria-controls="registrationPackage" aria-selected="true"><?php echo e(trans('update.registration_package')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if(!empty($user) and ($user->isOrganization() or $user->isTeacher())): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_update_user_meeting_settings')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" id="meetingSettings-tab" data-toggle="tab" href="#meetingSettings" role="tab" aria-controls="meetingSettings" aria-selected="true"><?php echo e(trans('update.meeting_settings')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if(!empty($becomeInstructor)): ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if(!empty($becomeInstructor)): ?> active <?php endif; ?>" id="become_instructor-tab" data-toggle="tab" href="#become_instructor" role="tab" aria-controls="become_instructor" aria-selected="true"><?php echo e(trans('oraclepopupsignin/main.become_instructor_info')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <div class="tab-content" id="myTabContent2">

                                <?php echo $__env->make('admin.users.editTabs.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.images', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.financial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.occupations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('admin.users.editTabs.badges', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php if(!empty($user) and ($user->isOrganization() or $user->isTeacher())): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_update_user_registration_package')): ?>
                                        <?php echo $__env->make('admin.users.editTabs.registration_package', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if(!empty($user) and ($user->isOrganization() or $user->isTeacher())): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_update_user_meeting_settings')): ?>
                                        <?php echo $__env->make('admin.users.editTabs.meeting_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if(!empty($becomeInstructor)): ?>
                                    <?php echo $__env->make('admin.users.editTabs.become_instructor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/admin/user_edit.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/yeslearn.in/public_html/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>