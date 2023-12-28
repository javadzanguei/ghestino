@extends('master')
@section('content')
    <div class="row my-2 border-bottom border-1">
        <div class="col"><h3 class="fw-bold">کاربران</h3></div>
        <div class="col-auto">
            <a href="{{route('admin.user.create')}}" title="اضافه کردن کاربر">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                     role="img" width="48" height="48" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32">
                    <path
                        d="M16 4c6.6 0 12 5.4 12 12s-5.4 12-12 12S4 22.6 4 16S9.4 4 16 4m0-2C8.3 2 2 8.3 2 16s6.3 14 14 14s14-6.3 14-14S23.7 2 16 2z"
                        fill="#d63384"/>
                    <path d="M24 15h-7V8h-2v7H8v2h7v7h2v-7h7z" fill="#d63384"/>
                </svg>
            </a>
        </div>
    </div>
    <livewire:admin.user.index/>
@endsection
@push('styles')
    <style>
        table.table td {
            font-size: small;
        }
    </style>
@endpush
@push('scripts')
    <script>
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })
    </script>
@endpush
