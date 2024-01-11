<div class="offcanvas offcanvas-end px-2 rounded-start-3" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="offcanvasNavbar"
     aria-labelledby="offcanvasNavbarLabel" style="background-color: var(--bs-yellow);">
    <div class="offcanvas-header border-bottom pb-1 mb-3">
        <h5 class="offcanvas-titlee" id="offcanvasNavbarLabel">امکانات</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column align-items-center">
        <img class="w-50 my-3" alt="سرویس قسطی" src="{{asset('images/logo.png')}}">
        <img src="https://picsum.photos/50" alt="" width="100" height="100"
             class="rounded-circle me-2 border border-2 border-primary p-1">
        <strong class="mt-2">{{auth('customer')->user()->fullname}}</strong>
        <span class="text-muted small">{{verta()->enToFaNumbers(auth('customer')->user()->mobile)}}</span>
        <div class="w-100 vh-55 vh-xl-50 d-flex flex-column flex-shrink-0 overflow-y-scroll menu mt-3 pt-2 border-top border-secondary">
            @include('layout.menu_customer')
        </div>
        <a href="{{ route('auth.logout') }}" class="border border-2 rounded-4 border-primary my-1 px-3 py-1" aria-current="page">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0d6efd" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
            خروج
        </a>
    </div>
</div>
