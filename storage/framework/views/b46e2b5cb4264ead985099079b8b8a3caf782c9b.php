<form id="allExchangeLevelForm" class="ui mini form" action="<?php echo e(url('/action/admin/allExchangeLevel')); ?>">
<?php if($countUser == 0): ?>
    <div>
        当前层级下无用户，无需转移！
    </div>
    <script>
        $('.jconfirm-buttons').html('');
    </script>
<?php else: ?>
    <div>
        当前层级有【<?php echo e($countUser); ?>】个用户，如果确定转移，请选择需要接收的层级
    </div>
    <hr style="background: #ddd;color: #ddd;height: 1px;border: none;">
    <div class="field">
        <label>迁移至</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="level">
                <option value="">请选择</option>
                <?php $__currentLoopData = $allLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->value); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo e($id); ?>">
<?php endif; ?>
</form>
<script>
    $('#allExchangeLevelForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            level:{
                validators: {
                    notEmpty: {
                        message: '请选择迁移层级'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
                if(result.status == true){
                    jc.close();
                    $('#levelTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                }
            }
        });
    });
</script>