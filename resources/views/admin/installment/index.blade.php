@extends('master')
@section('content')
    <div class="row my-2 border-bottom border-1">
        <div class="col"><h3 class="fw-bold">درخواست های پرداخت اقساطی</h3></div>
    </div>
    <livewire:admin.installment.index/>
@endsection
@push('scripts')
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
@endpush
