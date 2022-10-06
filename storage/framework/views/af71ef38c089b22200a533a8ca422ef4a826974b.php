<button class="<?php if(empty($hideDefaultClass) or !$hideDefaultClass): ?> btn-transparent text-primary <?php endif; ?> <?php echo e($btnClass ?? ''); ?>"
        data-confirm="<?php echo e(trans('oraclepopupsignin/main.delete_confirm_msg')); ?>"
        data-confirm-href="<?php echo e($url); ?>"
        data-confirm-text-yes="<?php echo e(trans('oraclepopupsignin/main.yes')); ?>"
        data-confirm-text-cancel="<?php echo e(trans('oraclepopupsignin/main.cancel')); ?>"
        <?php if(empty($btnText)): ?>
        data-toggle="tooltip" data-placement="top" title="<?php echo e(!empty($tooltip) ? $tooltip : trans('oraclepopupsignin/main.delete')); ?>"
    <?php endif; ?>
>
    <?php if(!empty($btnText)): ?>
        <?php echo e($btnText); ?>

    <?php else: ?>
        <i class="fa <?php echo e(!empty($btnIcon) ? $btnIcon : 'fa-times'); ?>" aria-hidden="true"></i>
    <?php endif; ?>
</button>
<?php /**PATH /home/yeslearn.in/public_html/resources/views/admin/includes/delete_button.blade.php ENDPATH**/ ?>