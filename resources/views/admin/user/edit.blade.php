@extends('master')
@section('content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 fw-bold text-center">ویرایش کاربر</h1>
    </div>
    <form class="row g-3 px-3 needs-validation" method="post" action="{{ route('admin.user.update') }}">
        @csrf
        @method('patch')

        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="col-12 col-md-6 mb-3 form-floating">
            <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                   name="fullname" required
                   placeholder="نام کاربر" value="{{$user->fullname}}">
            <label for="fullname" class="form-label">نام کاربر</label>
            <div class="invalid-feedback">نام کاربر لطفا!</div>
        </div>
        <div class="col-12 col-md-6 mb-3 form-floating">
            <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                   required
                   placeholder="تلفن کاربر" dir="ltr" value="{{$user->mobile}}">
            <label for="mobile" class="form-label">تلفن کاربر</label>
            <div class="invalid-feedback">تلفن کاربر لطفا!</div>
        </div>
        <div class="col-12 col-md-6 mb-3 form-floating">
            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password"
                   placeholder="کلمه عبور (عدم تغییر = کلمه عبور قبلی)" dir="ltr">
            <label for="password" class="form-label">کلمه عبور (عدم تغییر = کلمه عبور قبلی)</label>
        </div>
        <div class="col-12 col-md-6 mb-3 form-floating">
            <fieldset>
                <input type="radio" class="btn-check" value="2" name="access" id="user" required
                       autocomplete="off"{{'user' === $user->access ? ' checked':''}}>
                <label class="btn btn-success px-4" for="user">کاربر</label>
                <input type="radio" class="btn-check" value="1" name="access" id="admin" required
                       autocomplete="off"{{'admin' === $user->access ? ' checked':''}}>
                <label class="btn btn-danger px-4" for="admin">مدیر</label>
                <div class="invalid-feedback">سطح دسترسی کاربر لطفا!</div>
            </fieldset>
        </div>
        <div class="col-12 col-md-6 mb-3 form-floating">
            <select class="form-select" id="department" name="department_id" required>
                @foreach(\App\Models\Department::all() as $department)
                    <option
                        value="{{$department->id}}"{{$user->department_id === $department->id ? ' selected':''}}>{{$department->name}}</option>
                @endforeach
            </select>
            <label for="department" class="form-label">دپارتمان کاربر</label>
        </div>
        <div class="col-12 col-md-6 mb-3 form-check">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="active" id="active"
                       value="1"{{$user->active ? ' checked':''}}>
                <label class="form-check-label" for="active">کاربر فعال باشد</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="view_service_messages" id="view_service_messages"
                       value="1"{{$user->view_service_messages ? ' checked':''}}>
                <label class="form-check-label" for="view_service_messages">مجوز مشاهده پیام سرویس‌ها را داشته باشد</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="view_all_services" id="view_all_services"
                       value="1"{{$user->view_all_services ? ' checked':''}}>
                <label class="form-check-label" for="view_all_services">مجوز مشاهده همه سرویس‌ها را داشته باشد</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="view_all_invoices" id="view_all_invoices"
                       value="1"{{$user->view_all_invoices ? ' checked':''}}>
                <label class="form-check-label" for="view_all_invoices">مجوز مشاهده همه فاکتورها را داشته باشد</label>
            </div>
            @if(auth('user')->user()->superadmin)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="review_employees_leave" id="review_employees_leave"
                           value="1"{{$user->review_employees_leave ? ' checked':''}}>
                    <label class="form-check-label" for="review_employees_leave">مجوز بررسی مرخصی کارکنان را داشته باشد</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="view_stats" id="view_stats"
                           value="1"{{$user->view_stats ? ' checked':''}}>
                    <label class="form-check-label" for="view_stats">مجوز مشاهده آمار سامانه را داشته باشد</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="superadmin" id="superadmin"
                           value="1"{{$user->superadmin ? ' checked':''}}>
                    <label class="form-check-label px-2 text-white text-bg-danger" for="superadmin">کاربر مجوز مدیر کل داشته باشد</label>
                </div>
            @endif
        </div>
        <div class="col-12 mb-3">
            <button type="submit" class="btn btn-lg btn-primary px-5">ثبت</button>
            <button type="button" onclick="location = '{{route('admin.user.index')}}'"
                    class="btn btn-lg btn-secondary px-5">انصراف
            </button>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
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
        })()
    </script>
@endpush
