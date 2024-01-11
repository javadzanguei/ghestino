<div class="p-3 col-sm-10 col-md-10 col-lg-7 mx-auto bg-secondary bg-opacity-25" style="border-radius: 5px; ">
    <form onsubmit="return false;" name="calculator">
        <div class="row mb-3">
            <label for="price" class="col-sm-5 col-form-label col-form-label-lg">مبلغ خرید به ریال</label>
            <div class="col-sm-7">
                <input dir="ltr" type="text" maxlength="10" onkeyup="numberToLetter(this.value)"
                       class="form-control form-control-lg" name="price" id="price" autocomplete="off">
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
                <input type="range" id="prepayment" name="prepayment" class="form-range" min="1" max="3" step="1" value="2"
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
                <input type="range" id="installment" name="installment" class="form-range" min="1" max="12" step="1" value="6"
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
            <label for="calculate_loan" class="col-md-6 col-form-label col-form-label-lg">مبلغ وام به ریال</label>
            <div class="col-md-6">
                <input dir="ltr" type="text" readonly class="form-control form-control-lg" name="calculate_loan" id="calculate_loan">
            </div>
        </div>
        <div class="row mb-3">
            <label for="calculate_installment" class="col-md-6 col-form-label col-form-label-lg">مبلغ هر قسط به ریال</label>
            <div class="col-md-6">
                <input dir="ltr" type="text" readonly class="form-control form-control-lg" name="calculate_installment" id="calculate_installment">
            </div>
        </div>
        <div class="row mb-3">
            <label for="calculate_total_installment" class="col-md-6 col-form-label col-form-label-lg">مجموع اقساط به ریال</label>
            <div class="col-md-6">
                <input dir="ltr" type="text" readonly class="form-control form-control-lg" name="calculate_total_installment" id="calculate_total_installment">
            </div>
        </div>
        <div class="row mb-3">
            <label for="calculate_total" class="col-md-6 col-form-label col-form-label-lg">مجموع نقد و بازپرداخت وام به ریال</label>
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
            let calculate_prepayment = 0;
            switch(calcForm.prepayment.value) {
                case '1':
                    calculate_prepayment = price - Math.floor(price / 3) * 2;
                    break;
                case '2':
                    calculate_prepayment = price / 2;
                    break;
                case '3':
                    calculate_prepayment = price - Math.floor(price / 3);
                    break;
            }
            calcForm.calculate_prepayment.value = new Intl.NumberFormat('fa-IR').format(calculate_prepayment);

            let calculate_loan = price - calculate_prepayment;
            calcForm.calculate_loan.value = new Intl.NumberFormat('fa-IR').format(calculate_loan);

            let calculate_installment = Math.floor(calculate_loan / installment / 1000) * 1000 + Math.floor(calculate_loan * 0.04);
            calcForm.calculate_installment.value = new Intl.NumberFormat('fa-IR').format(calculate_installment);

            let calculate_total_installment = calculate_installment * installment ;
            calcForm.calculate_total_installment.value = new Intl.NumberFormat('fa-IR').format(calculate_total_installment);

            let calculate_total = calculate_prepayment + calculate_total_installment;
            calcForm.calculate_total.value = new Intl.NumberFormat('fa-IR').format(calculate_total);
        }
    </script>
@endpush
