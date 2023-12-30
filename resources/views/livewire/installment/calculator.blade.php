<div class="p-3 col-sm-10 col-md-10 col-lg-7 mx-auto bg-secondary bg-opacity-25" style="border-radius: 5px; ">
    <form onsubmit="return false;" name="calculator">
        <div class="row mb-3">
            <label for="price" class="col-sm-5 col-form-label col-form-label-lg">مبلغ خرید به ریال</label>
            <div class="col-sm-7">
                <input dir="ltr" type="text" maxlength="10" onkeyup="numberToLetter(this.value)"
                       class="form-control form-control-lg" name="price" id="price">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <span id="num2persian" class="text-danger fs-5"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-sm-5">
                <label for="prepayment" class="">
                    میزان پیش پرداخت
                    (<span id="prepayment-value">نصف مبلغ</span>)
                </label>
            </div>
            <div class="col-12 col-sm-7">
                <input type="range" id="prepayment" class="form-range" min="1" max="3" step="1" value="2"
                onchange="document.getElementById('prepayment-value').innerText=
                (this.value==1)?'یک سوم مبلغ':(this.value==2)?'نصف مبلغ':'دو سوم مبلغ'">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-sm-5">
                <label for="installment" class="form-label">تعداد اقساط
                    (<span id="installment-value">شش</span>  ماهه)
                </label>
            </div>
            <div class="col-12 col-sm-7">
                <input type="range" id="installment" class="form-range" min="1" max="12" step="1" value="6"
                       onchange="document.getElementById('installment-value').innerText=numberToLetter(this.value)">
            </div>
        </div>
        <div class="row mb-3">
            <button onclick="calculate()" type="button" class="btn btn-lg btn-primary col-10 col-6 mx-auto px-5">محاسبه اقساط</button>
        </div>
        <div class="row mb-3">
            <label for="calculate_prepayment" class="col-md-6 col-form-label col-form-label-lg">مبلغ نقدی به ریال</label>
            <div class="col-md-6">
                <input dir="ltr" type="text" readonly class="form-control form-control-lg" name="calculate_prepayment" id="calculate_prepayment">
            </div>
        </div>
        <div class="row mb-3">
            <label for="calculate_installment" class="col-md-6 col-form-label col-form-label-lg">مبلغ هر قسط به ریال</label>
            <div class="col-md-6">
                <input dir="ltr" type="text" readonly class="form-control form-control-lg" name="calculate_installment" id="calculate_installment">
            </div>
        </div>
        <div class="row mb-3">
            <label for="calculate_total" class="col-md-6 col-form-label col-form-label-lg">مجموع (نقدواقساط) به ریال</label>
            <div class="col-md-6">
                <input dir="ltr" type="text" readonly class="form-control form-control-lg" name="calculate_total" id="calculate_total">
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script src="{{asset('js/num2persian.min.js')}}"></script>
    <script>
        function numberToLetter(number) {
            if(number < 1000) {
                document.getElementById('num2persian').innerText = '';
                return number.num2persian();
            }
            let letter = number.num2persian() + ' ریال' + ' (' + (number / 10).num2persian() + ' تومان)'
            document.getElementById('num2persian').innerText = letter;
        }
        function calculate() {
            let calcForm = document.forms.calculator;
            let price = calcForm.price.value;
            if(price > 1250000000) {
                alert('حداکثر مبلغ مجاز 125 میلیون تومان است');
                return false;
            }
            let installment = calcForm.installment.value;
            let wage = 0;
            switch(installment) {
                case '1':
                    wage = 6;
                    break;
                case '2':
                    wage = 9.5;
                    break;
                case '3':
                    wage = 13;
                    break;
                case '4':
                    wage = 16.5;
                    break;
                case '5':
                    wage = 21;
                    break;
                case '6':
                    wage = 24.5;
                    break;
            }
            let calculate_prepayment = 0;
            let wage2 = 0;
            switch(calcForm.prepayment.value) {
                case '13':
                    calculate_prepayment = (price * 25 / 100) + (price * 75 / 100) * wage / 100;
                    wage2 = 75;
                    break;
                case '12':
                    calculate_prepayment = (price * 45 / 100) + (price * 55 / 100) * wage / 100;
                    wage2 = 55;
                    break;
                case '23':
                    calculate_prepayment = (price * 65 / 100) + (price * 35 / 100) * wage / 100;
                    wage2 = 35;
                    break;
            }
            calcForm.calculate_prepayment.value = new Intl.NumberFormat('fa-IR').format(calculate_prepayment);;

            let calculate_installment = Math.floor(price * wage2 / 100 / installment);
            calcForm.calculate_installment.value = new Intl.NumberFormat('fa-IR').format(calculate_installment);

            let calculate_total = calculate_prepayment + ( Math.round(calculate_installment * installment / 1000) * 1000 );
            calcForm.calculate_total.value = new Intl.NumberFormat('fa-IR').format(calculate_total);
        }
    </script>
@endpush
