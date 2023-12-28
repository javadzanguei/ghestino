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
            <div class="col">
                <label for="prepayment-50" class="col-12 col-sm-4 col-form-label col-form-label-lg">میزان پیش پرداخت</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="prepayment" id="prepayment-1-3" value="13">
                    <label class="form-check-label" for="prepayment-1-3">یک سوم مبلغ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="prepayment" id="prepayment-1-2" value="12" checked>
                    <label class="form-check-label" for="prepayment-1-2">نصف مبلغ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="prepayment" id="prepayment-2-3" value="23">
                    <label class="form-check-label" for="prepayment-2-3">دو سوم مبلغ</label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">تعداد اقساط (با چک صیادی به صورت ماه به ماه)</label>
            <div class="row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="installment" id="installment-1" value="1">
                        <label class="form-check-label" for="installment-1">1 ماه</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="installment" id="installment-2" value="2">
                        <label class="form-check-label" for="installment-2">2 ماه</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="installment" id="installment-3" value="3">
                        <label class="form-check-label" for="installment-3">3 ماه</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="installment" id="installment-4" value="4" checked>
                        <label class="form-check-label" for="installment-4">4 ماه</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="installment" id="installment-5" value="5">
                        <label class="form-check-label" for="installment-5">5 ماه</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="installment" id="installment-6" value="6">
                        <label class="form-check-label" for="installment-6">6 ماه</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <button onclick="calculate()" type="button" class="btn btn-lg btn-success col-10 col-6 mx-auto px-5">محاسبه اقساط</button>
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
                return false;
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
