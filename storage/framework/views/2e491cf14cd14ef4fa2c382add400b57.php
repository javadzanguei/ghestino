    <select wire:model="county_id" class="form-select" id="county" name="county" aria-label="شهرستان" required>
        <option value="" selected>شهرستان</option>
    <?php $__currentLoopData = \App\Models\Country\County::whereProvinceId($province)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $county): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($county->id); ?>"><?php echo e($county->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><?php /**PATH C:\laragon\www\ghestino\storage\framework\views/50f0a78bb3edb2744a9db1210ac43858.blade.php ENDPATH**/ ?>