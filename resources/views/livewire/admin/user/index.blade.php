<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">-</th>
            <th scope="col">نام</th>
            <th scope="col">موبایل</th>
            <th scope="col">دپارتمان</th>
            <th scope="col">دسترسی</th>
            <th scope="col">وضعیت</th>
            <th scope="col">مشاهده پیام‌ها</th>
            <th scope="col">مشاهده همه سرویس‌ها</th>
            <th scope="col">مشاهده همه فاکتورها</th>
            <th scope="col">مشاهده آمار</th>
            <th scope="col">مرخصی کارکنان</th>
            <th scope="col">مدیر کل</th>
            <th scope="col">آخرین ورود</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $us)
            <tr>
                <td>
                    <a href="{{ route('admin.user.edit', ['user' => $us->id]) }}" title="ویرایش"
                       class="d-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             aria-hidden="true" role="img" width="20" height="20"
                             preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path d="M18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"
                                  fill="#e4a951"/>
                            <path
                                d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"
                                fill="#e4a951"/>
                        </svg>
                    </a>
                    <button wire:click="toggleActive({{$us->id}})" class="btn btn-link text-decoration-none p-0"
                            title="تغییر وضعیت کاربر"
                            onclick="confirm('از تغییر وضعیت کاربر مطمئن هستید؟') || event.stopImmediatePropagation()">
                        @if($us->active)
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-toggle-on" viewBox="0 0 16 16">
                                <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-toggle-off" viewBox="0 0 16 16">
                                <path
                                    d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z"/>
                            </svg>
                        @endif
                    </button>
                    @php
                        $deletable = false;
                        if(
                               $us->registered_cases->count() === 0
                            && $us->delivered_cases->count() === 0
                            && $us->resulted_cases->count() === 0
                            && $us->received_cases->count() === 0
                        ) $deletable = true;
                    @endphp
                    @if($deletable && auth('user')->user()->superadmin)
                        <button wire:click="delete({{$us->id}})" class="btn btn-link text-decoration-none p-0"
                                title="حذف کاربر"
                                onclick="confirm('از حذف کاربر مطمئن هستید؟') || event.stopImmediatePropagation()">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 aria-hidden="true" role="img" width="20" height="20"
                                 preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                                <g fill="none">
                                    <path
                                        d="M10 4h3a.5.5 0 0 1 0 1h-.553l-.752 6.776A2.5 2.5 0 0 1 9.21 14H6.79a2.5 2.5 0 0 1-2.485-2.224L3.552 5H3a.5.5 0 0 1 0-1h3a2 2 0 1 1 4 0zM8 3a1 1 0 0 0-1 1h2a1 1 0 0 0-1-1zM6.5 7v4a.5.5 0 0 0 1 0V7a.5.5 0 0 0-1 0zM9 6.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V7a.5.5 0 0 0-.5-.5z"
                                        fill="#d63384"/>
                                </g>
                            </svg>
                        </button>
                    @endif
                </td>
                <td>
                    @if($us->photo)
                        <img src="data:image/jpeg;base64,{{base64_encode($us->photo)}}" alt="{{$us->fullname}}" width="20" height="20"
                             class="rounded-circle me-1 border border-1 border-secondary">
                    @endif
                    {{ $us->fullname }}
                </td>
                <td><a href="tel:{{$us->mobile}}" class="link-primary"
                       title="تماس">{{verta()->enToFaNumbers($us->mobile)}}</a></td>
                <td>{{ $us->department->name}} ({{(verta()->enToFaNumbers($us->department->code))}})</td>
                <td>{{ $us->access === 'admin' ? 'مدیر' : 'کاربر' }}</td>
                <td>{{ $us->active ? 'فعال' : 'غیرفعال' }}</td>
                <td>{{ $us->view_service_messages ? 'مجاز' : 'غیرمجاز' }}</td>
                <td>{{ $us->view_all_services ? 'مجاز' : 'غیرمجاز' }}</td>
                <td>{{ $us->view_all_invoices ? 'مجاز' : 'غیرمجاز' }}</td>
                <td>{{ $us->view_stats ? 'مجاز' : 'غیرمجاز' }}</td>
                <td>{{ $us->review_employees_leave ? 'مجاز' : 'غیرمجاز' }}</td>
                <td>{{ $us->superadmin ? 'بلی' : '-' }}</td>
                <td data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="auto"
                    title="IP:{{$us->ip}}<br>{{$us->user_agent}}">
                    {{verta()->enToFaNumbers(verta($us->last_login)->format('H:i - Y/m/d'))}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>
