<div class="p-3 py-5 col-lg-10 mx-auto bg-light bg-opacity-25" style="border-radius: 5px; ">
    <form wire:submit.prevent="save" name="request" class="needs-validation">
        <div class="row g-2">
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="national_code" dir="ltr" type="text" class="form-control form-control-lg @error('national_code') is-invalid @enderror"
                           placeholder="کد ملی" id="national_code" maxlength="10" autocomplete="off" required>
                    <label for="national_code">کد ملی</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.debounce.1000ms="mobile" dir="ltr" type="text" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                        placeholder="شماره همراه به همراه صفر" id="mobile" maxlength="11" autocomplete="off" required
                        onkeyup="document.getElementById('notify_mobile').value = this.value;">
                    <label for="mobile">شماره همراه با صفر</label>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                           placeholder="نام" id="name" autocomplete="off" required>
                    <label for="name">نام</label>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="family" type="text" class="form-control form-control-lg @error('family') is-invalid @enderror"
                           placeholder="نام خانوادگی" id="family" autocomplete="off" required>
                    <label for="family">نام خانوادگی</label>
                </div>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="birth_date" type="hidden" id="birth_date" name="birth_date" data-name="birth_date-date">
                    <input type="text" class="form-control date-picker-input @error('birth_date') is-invalid @enderror" id="birth_date_text"
                           data-name="birth_date-text" readonly maxlength="10"
                           autocomplete="off" placeholder="تاریخ تولد" required>
                    <label for="birth_date_text">
                        تاریخ تولد
                    </label>
                    <span id="birth_date_icon" class="date-picker-icon" wire:ignore>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                          <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                          <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <livewire:cities.province/>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <livewire:cities.county/>
            </div>
            <div class="col-12 col-sm-6 mb-3 form-floating">
                <select wire:model.defer="job_type" class="pt-3 form-select form-select-lg @error('job_type') is-invalid @enderror"
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
                    <input wire:model.defer="job_location" type="text" class="form-control form-control-lg @error('job_location') is-invalid @enderror"
                           id="job_location" autocomplete="off" required @if(!$job_type) disabled @endif>
                    <label for="job_location">محل اشتغال</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="job_title" type="text" class="form-control form-control-lg @error('job_title') is-invalid @enderror"
                           placeholder="سمت شغلی" id="job_title" autocomplete="off" required>
                    <label for="job_title">سمت شغلی</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-floating">
                    <input wire:model.defer="monthly_income" type="text" class="form-control form-control-lg @error('monthly_income') is-invalid @enderror"
                           placeholder="درآمد ماهیانه" id="monthly_income" autocomplete="off" onkeyup="formatCurrency(this)" required>
                    <label for="monthly_income">حداقل درآمد ماهیانه به میلیون تومان</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <label for="cheque_photo" class="form-label @error('cheque_photo') text-danger @enderror">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                    </svg>
                    تصویر یک برگ چک خام متقاضی را بارگذاری نمایید
                </label>
                <input wire:model.defer="cheque_photo" id="cheque_photo" name="cheque_photo" type="file" accept="image/*"
                       capture="environment"
                       style="display: none;">
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <label for="id_card_photo" class="form-label @error('id_card_photo') text-danger @enderror">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
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
            <div class="col-12 col-sm-6 mb-3 d-flex justify-content-center">
                <input type="submit" id="submit" class="btn btn-lg btn-primary px-5" value="ثبت درخواست" @if(!$confirm) disabled @endif>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script src="{{asset('js/mds.bs.datetimepicker.js')}}"></script>
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
@endpush
