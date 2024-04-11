    <select wire:model="province_id" class="form-select" name="province" id="province" aria-label="استان" required>
        <option value="" selected>استان</option>
        <?php $__currentLoopData = \App\Models\Country\Province::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($province->id); ?>"><?php echo e($province->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><?php /**PATH D:\dev\workspace\laragon\htdocs\ghestino\storage\framework\views/9771d4bc3750b800c1b303d13fd59c10.blade.php ENDPATH**/ ?>