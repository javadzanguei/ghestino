<div class="p-3 py-5 col-lg-10 mx-auto bg-secondary bg-opacity-25" style="border-radius: 5px; ">
    <form wire:submit.prevent="save" name="request" class="needs-validation">
        <div class="row g-2">
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="national_code" dir="ltr" type="text" class="form-control form-control-lg <?php $__errorArgs = ['national_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="کد ملی" id="national_code" maxlength="10" autocomplete="off" required>
                    <label for="national_code">کد ملی</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.debounce.1000ms="mobile" dir="ltr" type="text" class="form-control form-control-lg <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="شماره همراه به همراه صفر" id="mobile" maxlength="11" autocomplete="off" required
                        onkeyup="document.getElementById('notify_mobile').value = this.value;">
                    <label for="mobile">شماره همراه با صفر</label>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="name" type="text" class="form-control form-control-lg <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="نام" id="name" autocomplete="off" required>
                    <label for="name">نام</label>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="family" type="text" class="form-control form-control-lg <?php $__errorArgs = ['family'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="نام خانوادگی" id="family" autocomplete="off" required>
                    <label for="family">نام خانوادگی</label>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="birth_date" type="hidden" id="birth_date" name="birth_date" data-name="birth_date-date">
                    <input type="text" class="form-control date-picker-input <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="birth_date_text"
                           data-name="birth_date-text" readonly maxlength="10"
                           autocomplete="off" placeholder="تاریخ تولد" required>
                    <label for="birth_date_text">
                        تاریخ تولد
                    </label>
                    <span id="birth_date_icon" class="date-picker-icon" wire:ignore>📅</span>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('cities.province', [])->html();
} elseif ($_instance->childHasBeenRendered('l3647335028-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3647335028-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3647335028-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3647335028-0');
} else {
    $response = \Livewire\Livewire::mount('cities.province', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3647335028-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('cities.county', [])->html();
} elseif ($_instance->childHasBeenRendered('l3647335028-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l3647335028-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3647335028-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3647335028-1');
} else {
    $response = \Livewire\Livewire::mount('cities.county', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3647335028-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="col-12 col-sm-6 mb-3 form-floating">
                <select wire:model.defer="job_type" class="pt-3 form-select form-select-lg <?php $__errorArgs = ['job_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required onchange="enableJobLocation(this.selectedIndex)" id="job_type">
                    <option value="">نوع شغل</option>
                    <option>کارمند دستگاه دولتی یا ارگان عمومی</option>
                    <option>کارمند بخشی خصوصی</option>
                    <option>کارمند بازنشسته</option>
                    <option>کاسب دارای جواز کسب </option>
                    <option>کاسب بدون جواز کسب</option>
                    <option>سایر مشاغل</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="job_location" type="text" class="form-control form-control-lg <?php $__errorArgs = ['job_location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           id="job_location" autocomplete="off" required <?php if(!$job_type): ?> disabled <?php endif; ?>>
                    <label for="job_location">محل اشتغال</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="job_title" type="text" class="form-control form-control-lg <?php $__errorArgs = ['job_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="سمت شغلی" id="job_title" autocomplete="off" required>
                    <label for="job_title">سمت شغلی</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="monthly_income" type="text" class="form-control form-control-lg <?php $__errorArgs = ['monthly_income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="درآمد ماهیانه" id="monthly_income" autocomplete="off" onkeyup="formatCurrency(this)" required>
                    <label for="monthly_income">حداقل درآمد ماهیانه به میلیون تومان</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <label for="cheque_photo" class="form-label <?php $__errorArgs = ['cheque_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         aria-hidden="true"
                         role="img" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                        <path fill="#d63384"
                              d="M864 260H728l-32.4-90.8a32.07 32.07 0 0 0-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 260H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V340c0-44.2-35.8-80-80-80zM512 716c-88.4 0-160-71.6-160-160s71.6-160 160-160s160 71.6 160 160s-71.6 160-160 160zm-96-160a96 96 0 1 0 192 0a96 96 0 1 0-192 0z"/>
                    </svg>
                    تصویر یک برگ چک خام متقاضی را بارگذاری نمایید
                </label>
                <input wire:model.defer="cheque_photo" id="cheque_photo" name="cheque_photo" type="file" accept="image/*"
                       capture="environment"
                       style="display: none;">
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <label for="id_card_photo" class="form-label <?php $__errorArgs = ['id_card_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         aria-hidden="true"
                         role="img" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                        <path fill="#d63384"
                              d="M864 260H728l-32.4-90.8a32.07 32.07 0 0 0-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 260H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V340c0-44.2-35.8-80-80-80zM512 716c-88.4 0-160-71.6-160-160s71.6-160 160-160s160 71.6 160 160s-71.6 160-160 160zm-96-160a96 96 0 1 0 192 0a96 96 0 1 0-192 0z"/>
                    </svg>
                    تصویر کارت ملی متقاضی را بارگذاری نمایید
                </label>
                <input wire:model.defer="id_card_photo" id="id_card_photo" name="id_card_photo" type="file" accept="image/*"
                       capture="environment"
                       style="display: none;">
            </div>
            <div class="col-12 col-sm-6 mb-3 d-flex justify-content-center align-items-center flex-column" wire:ignore>
                <div wire:loading wire:target="cheque_photo" class="mb-2">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">بارگذاری...</span>
                    </div>
                </div>
                <img id="output_cheque" style="width: 80%;">
            </div>
            <div class="col-12 col-sm-6 mb-3 d-flex justify-content-center align-items-center flex-column" wire:ignore>
                <div wire:loading wire:target="id_card_photo" class="mb-2">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">بارگذاری...</span>
                    </div>
                </div>
                <img id="output_id_card" style="width: 80%;">
            </div>
            <div class="col-12 mb-3 d-flex">
                <div class="form-check">
                    <input wire:model="confirm" class="form-check-input" type="checkbox" value="1" id="confirm" required onclick="document.getElementById('submit').disabled = !this.checked">
                    <label class="form-check-label" for="confirm">
                        تأیید می‌نمایم دارای چک برگشتی یا اقساط معوق نبوده و
                        <a href="#conditions" class="link-primary text-decoration-none">شرایط خرید اقساطی</a> را می‌پذیرم.
                    </label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3 d-flex">
                <div class="form-floating">
                    <input wire:model.defer="notify_mobile" dir="ltr" type="text" class="form-control form-control-lg" placeholder="شماره همراه به همراه صفر" id="notify_mobile" maxlength="11" autocomplete="off" required>
                    <label for="notify_mobile">شماره همراه جهت اطلاع‌رسانی</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3 d-flex">
                <input type="submit" id="submit" class="btn btn-lg btn-primary px-5" value="ثبت درخواست" <?php if(!$confirm): ?> disabled <?php endif; ?>>
            </div>
        </div>
    </form>
</div>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/mds.bs.datetimepicker.js')); ?>"></script>
    <script>
        const fromDate = new Date();
        fromDate.setFullYear(fromDate.getFullYear() - 100);
        const toDate = new Date();
        toDate.setFullYear(toDate.getFullYear() - 18);
        const curDate = new Date();
        curDate.setFullYear(curDate.getFullYear() - 25);
        const dtp1Instance = new mds.MdsPersianDateTimePicker(document.getElementById('birth_date_icon'), {
            targetTextSelector: '[data-name="birth_date-text"]',
            targetDateSelector: '[data-name="birth_date-date"]',
            persianNumber: true,
            disableBeforeDate: fromDate,
            disableAfterDate : toDate,
            selectedDateToShow: curDate,
        });

        const formatCurrency = (field) => {
            if(parseInt(field.value) <= 0) return false;
            const [label] = field.labels;
            label.textContent = 'درآمد ماهیانه: ' + new Intl.NumberFormat('fa-IR').format(field.value) + ' میلیون تومان';
        }

        birth_date = document.getElementById('birth_date');
        birth_date.addEventListener('change', function () {
            birth_date.dispatchEvent(new Event('input'));
        });

        notify_mobile = document.getElementById('notify_mobile');
        notify_mobile.addEventListener('change', function () {
            notify_mobile.dispatchEvent(new Event('input'));
        });

        const enableJobLocation = (jobType) => {
            if(jobType <= 0) return false;
            const jobLocationList = ['نام دستگاه', 'نام شرکت', 'نام محل کار سابق', 'نوع کسب', 'نوع کسب', 'نام شغل'];
            const jobLocationInput = document.getElementById('job_location');
            const [jobLocationLabel] = document.getElementById('job_location').labels;
            jobLocationInput.disabled = false;
            jobLocationInput.placeholder = jobLocationList[jobType - 1];
            jobLocationLabel.textContent = jobLocationList[jobType - 1];
        }

        const fileInput_cheque = document.getElementById('cheque_photo');
        fileInput_cheque.addEventListener('change', (e) => displayCapturedImage(e.target.files, 'cheque'));
        const output_cheque = document.getElementById('output_cheque');

        const fileInput_id_card = document.getElementById('id_card_photo');
        fileInput_id_card.addEventListener('change', (e) => displayCapturedImage(e.target.files, 'id_card'));
        const output_id_card = document.getElementById('output_id_card');

        function displayCapturedImage(fileList, photo) {
            let file = null;
            for (let i = 0; i < fileList.length; i++) {
                if (fileList[i].type.match(/^image\//)) {
                    file = fileList[i];
                    break;
                }
            }
            if (file !== null) {
                if(photo === 'cheque')
                    output_cheque.src = URL.createObjectURL(file);
                else
                    output_id_card.src = URL.createObjectURL(file);
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\dev\workspace\laragon\htdocs\ghestino\resources\views/livewire/installment/request.blade.php ENDPATH**/ ?>