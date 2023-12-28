<div>
    <div class="row row-cols-md-auto g-3 align-items-center mb-2">
        <div class="col-12">
            <input wire:model.debounce.1000ms="fullname" type="text" placeholder="نام"
                   class="form-control d-inline w-auto my-2">
            <input wire:model.debounce.1000ms="mobile" type="text" placeholder="شماره همراه"
                   class="form-control d-inline w-auto my-2">
            <input wire:model.debounce.1000ms="national_code" type="text" placeholder="کد ملی"
                   class="form-control d-inline w-auto my-2">
            <select wire:model="status" class="form-select d-inline w-auto my-2" name="s" id="status">
                <option value="0" selected>همه</option>
                <option value="1">بررسی نشده</option>
                <option value="2">موافقت شده</option>
                <option value="3">مخالفت شده</option>
            </select>
            <strong>
                بررسی نشده: {{verta()->enToFaNumbers($not_checked_count)}}
            </strong>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام و نام خانوادگی</th>
                <th scope="col">کد ملی</th>
                <th scope="col">شماره تماس</th>
                <th scope="col">استان</th>
                <th scope="col">شهرستان</th>
                <th scope="col">زمال ثبت نام</th>
            </tr>
            @foreach($installment_requests as $request)
                <tr class="bg-opacity-25 @if($request->result)bg-success @elseif($request->result === 0)bg-danger @endif">
                    <td>
                        <button wire:click="delete({{$request->id}})" class="btn btn-link text-decoration-none p-0"
                                type="button" title="حذف درخواست مشتری"
                                onclick="confirm('آیا از حذف درخواست مشتری اطمینان دارید؟') || event.stopImmediatePropagation()">
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
                        <button class="btn btn-link text-decoration-none p-0" type="button" title="مشاهده سایر اطلاعات" onfocus="this.blur()"
                                wire:click="@if($openId === $request->id)closeRequest @else openRequest({{$request->id}})@endif">
                            @if($openId !== $request->id)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            @endif
                            @if($openId === $request->id)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                </svg>
                            @endif
                        </button>
                        <div class="spinner-border spinner-border-sm text-primary" role="status"
                             wire:loading wire:target=" openRequest({{$request->id}})">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                    <td>{{$request->fullname()}}</td>
                    <td>{{verta()->enToFaNumbers($request->national_code)}}</td>
                    <td>
                        <a href="tel:{{$request->notify_mobile}}" class="link-dark"
                           title="تماس">{{verta()->enToFaNumbers($request->notify_mobile)}}</a>
                    </td>
                    <td>{{$request->province}}</td>
                    <td>{{$request->county}}</td>
                    <td>{{verta()->enToFaNumbers(verta($request->created_at)->format('H:i - Y/n/j'))}}</td>
                </tr>
                @if($openId === $request->id)
                    <tr>
                        <th scope="col" colspan="2">نوع شغل</th>
                        <th scope="col">محل شغل</th>
                        <th scope="col">عنوان شغل</th>
                        <th scope="col">درآمد</th>
                        <th scope="col">تاریخ تولد</th>
                        <th scope="col">شماره همراه</th>
                    </tr>
                    <tr>
                        <td colspan="2">{{$request->job_type}}</td>
                        <td>{{$request->job_location}}</td>
                        <td>{{$request->job_title}}</td>
                        <td>{{$request->monthly_income}}</td>
                        <td>{{verta()->enToFaNumbers(verta($request->birth_date)->format('Y/m/d'))}}</td>
                        <td>
                            <a href="tel:{{$request->mobile}}" class="link-dark"
                               title="تماس">{{verta()->enToFaNumbers($request->mobile)}}</a>
                        </td>
                    </tr>
                    @if($request->result === null)
                        <tr>
                            <td colspan="7">
                                <form wire:submit.prevent="save" class="row g-3 px-3 pb-5 needs-validation">
                                    <div class="col-auto mb-3 form-check">
                                        <legend class="pt-0 fs-6">نتیجه اعتبارسنجی</legend>
                                    </div>
                                    <div class="col-auto mb-3 form-check">
                                        <fieldset class="d-inline-block">
                                            <input wire:model.defer="result" type="radio" class="btn-check" value="1" name="result"
                                                   id="positive" required autocomplete="off">
                                            <label class="btn btn-success px-4" for="positive">مثبت</label>
                                            <input wire:model.defer="result" type="radio" class="btn-check" value="0" name="result"
                                                   id="negative" required autocomplete="off">
                                            <label class="btn btn-danger px-4" for="negative">منفی</label>
                                            <div class="invalid-feedback">نتیجه سرویس لطفا!</div>
                                        </fieldset>
                                    </div>
                                    <div class="col-auto col-md-4 mb-3 form-floating">
                                        <input wire:model.defer="description" type="text" class="form-control" id="description"
                                               name="description" autocomplete="off" placeholder="توضیحات">
                                        <label for="description" class="form-label">توضیحات</label>
                                    </div>
                                    <div class="col-auto mb-3">
                                        <button type="submit" class="px-5 btn btn-lg btn-primary">ثبت</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th scope="col" colspan="2">نتیجه اعتبارسنجی</th>
                            <th scope="col" colspan="5">توضیحات</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="{{$request->result ? 'text-success' : 'text-danger'}}">
                                {{$request->result ? 'موافقت شد' : 'موافقت نشد'}}
                            </td>
                            <td colspan="5">{{$request->result_description ?? '-'}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="7" class="text-center">
                            @php
                                $cheque_mime_type = Storage::mimeType('public/installment/images/' . $request->cheque_photo);
                                $cheque_content = base64_encode(Storage::get('public/installment/images/' . $request->cheque_photo));
                                $id_card_mime_type = Storage::mimeType('public/installment/images/' . $request->id_card_photo);
                                $id_card_content = base64_encode(Storage::get('public/installment/images/' . $request->id_card_photo));
                            @endphp
                            <img class="img-fluid border border-dark mb-3 w-50 float-start" src="data:{{$cheque_mime_type}};base64,{{$cheque_content}}" alt="تصویر برگ چک">
                            <img class="img-fluid border border-dark mb-3 w-50 float-end" src="data:{{$id_card_mime_type}};base64,{{$id_card_content}}" alt="تصویر کارت ملی">
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
        {{$installment_requests->links()}}
    </div>
</div>
