<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <title>قسطی‌نو سرویس - فروش اقساطی</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="apple-touch-icon" href="{{asset('ghestino_icon_x192.png')}}"/>
    <meta name="msapplication-TileImage" content="{{asset('ghestino_icon.png')}}"/>
    <link rel="icon" href="{{asset('ghestino_icon_x192.png')}}" sizes="192x192"/>
    <link rel="icon" href="{{asset('ghestino_icon_x128.png')}}" sizes="128x128"/>
    <link rel="icon" href="{{asset('ghestino_icon_x96.png')}}" sizes="96x96"/>
    <link rel="icon" href="{{asset('ghestino_icon_x72.png')}}" sizes="72x72"/>
    <link rel="icon" href="{{asset('ghestino_icon_x48.png')}}" sizes="48x48"/>
    <link rel="icon" href="https://ghestino-group.com/wp-content/uploads/2021/11/cropped-ghestino-logo-1-32x32.jpg"
          sizes="32x32"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/installment.css')}}">
    <link rel="stylesheet" href="{{asset('css/mds.bs.datetimepicker.style.css')}}">
    @livewireStyles
</head>
<body class="container-fluid p-0">
    <header class="d-flex align-items-center">
        <h3 class="text-white">قسطی‌نو</h3>
    </header>
    <main>
        <a name="calculator"></a>
        <div class="accordion mb-3" id="accordionCalculator">
            <div class="accordion-item">
                <h2 class="accordion-header" id="calculator">
                    <button class="accordion-button">
                        محاسبه‌گر اقساط
                    </button>
                </h2>
                <div id="collapseCalculator" class="accordion-collapse collapse show" aria-labelledby="calculator" data-bs-parent="#accordionCalculator">
                    <div class="accordion-body">
                        <livewire:installment.calculator/>
                    </div>
                </div>
            </div>
        </div>
        <a name="conditions"></a>
        <div class="accordion mb-3" id="accordionTerm">
            <div class="accordion-item">
                <h2 class="accordion-header" id="terms">
                    <button class="accordion-button">
                        شرایط خرید اقساطی
                    </button>
                </h2>
                <div id="collapseTerm" class="accordion-collapse collapse show" aria-labelledby="terms" data-bs-parent="#accordionTerm">
                    <div class="accordion-body">
                        <ul style="list-style: none;">
                            <li>هر شخص از طریق اعتبارسنجی سایت (قدرت قسط‌دهی و گردش حساب) تا سقف سیصد میلیون ریال (سی میلیون تومان) می‌تواند خرید اقساطی انجام دهد.</li>
                            <li>خرید اقساطی صرفا با چک صیادی و بنفش تا سقف شش فقره چک ماهیانه امکان‌پذیر است.</li>
                            <li>شماره همراه حتما باید به نام شخص صاحب دسته چک باشد.</li>
                            <li>صاحب دسته چک نباید سوء سابقه بانکی و اعتباری (شامل چک برگشتی، اقساط معوق، حساب مسدودی) داشته باشد.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mb-3" id="accordionProcess">
            <div class="accordion-item">
                <h2 class="accordion-header" id="process">
                    <button class="accordion-button">
                        <a name="process"></a>
                        فرآیند خرید اقساطی
                    </button>
                </h2>
                <div id="collapseProcess" class="accordion-collapse collapse show" aria-labelledby="process" data-bs-parent="#accordionProcess">
                    <div class="accordion-body">
                        <ol>
                            <li class="mb-2">استفاده از <a class="link-primary text-decoration-none" href="#calculator">محاسبه‌گر اقساط</a> و انتخاب شرایط مطلوب</li>
                            <li class="mb-2"><a class="link-primary text-decoration-none" href="#request">ثبت درخواست اعتبارسنجی</a></li>
                            <li class="mb-2">ظرف مدت 24 تا 48 ساعت کاری، اعتبارسنجی از طریق پیامک یا تماس تلفنی به مشتری اعلام می‌شود.</li>
                            <li class="mb-2">در صورت تایید اعتبار، ابتدا مبلغ پیش‌پرداخت کالا پرداخت می‌شود و سپس چک‌های اقساط، کپی مدارک مورد نیاز (<a href="#" class="link-primary text-decoration-none">مشاهده لیست مدارک</a>)  به همراه قرارداد تکمیل شده (<a href="#" class="link-primary text-decoration-none">مشاهده و دانلود قرارداد</a>) به آدرس اعلامی ارسال گردد.</li>
                            <li class="mb-2">بعد از پرداخت مبلغ پیش‌پرداخت، دریافت چک‌ها، مدارک و قرارداد، کالا حداکثر ظرف سه روز کاری برای متقاضی ارسال خواهد شد.</li>
                        </ol>
                        <ul style="list-style: none;">
                            <li class="mb-2"><b>نکته1:</b> قبل از ارسال چک‌ها تصویر چک‌ها و تصویر ثبت شده در سامانه صیادی باید مورد تایید قرار گیرد. </li>
                            <li class="mb-2"><b>نکته2:</b> قیمت کالا به روز محاسبه می‌شود و ممکن است در لحظه درخواست اعتبارسنجی تا زمان تایید مبلغ کالا متغیر باشد. </li>
                            <li class="mb-2"><b>نکته3:</b> کرایه حمل کالا و مراحل بعد از ارسال با متقاضی است و با بخش اعتبارات مرتبط نمی‌شود. </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion" id="accordionRequest">
            <div class="accordion-item">
                <h2 class="accordion-header" id="request">
                    <button class="accordion-button">
                        <a name="request"></a>
                        ثبت درخواست اعتبارسنجی (اطلاعات صاحب دسته چک)
                    </button>
                </h2>
                <div id="collapseRequest" class="accordion-collapse collapse show" aria-labelledby="calculator" data-bs-parent="#accordionRequest">
                    <div class="accordion-body">
                        <livewire:installment.request/>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="d-flex justify-content-around">
        <div id="copyright">
            این سرویس متعلق به
            <a class="text-decoration-none" target="_blank" href="/">گروه قسطی‌نو</a>
            است.
        </div>
    </footer>
    <script src="{{asset('js/app.js')}}"></script>
    @livewireScripts
    @stack('scripts')
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();
    </script>
</body>
</html>
