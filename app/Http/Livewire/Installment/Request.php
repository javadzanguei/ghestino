<?php

namespace App\Http\Livewire\Installment;

use App\Http\Controllers\SMSController;
use App\Jobs\SendSMS;
use App\Models\Country\County;
use App\Models\InstallmentRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

class Request extends Component
{
    use WithFileUploads;
    public $confirm, $national_code, $mobile, $name, $family, $birth_date, $county_id;
    public $job_type, $job_location, $job_title, $monthly_income, $notify_mobile;
    public $cheque_photo, $id_card_photo;

    protected $listeners = ['updateCounty'];

    public function updateCounty($county_id) {
        $this->county_id = $county_id;
    }

    public function updatedMobile()
    {
        $this->notify_mobile = $this->mobile;
    }

    public function save() {
        $this->validate([
            'national_code' => 'required|ir_national_code',
            'mobile' => 'required|ir_mobile',
            'name' => 'required|persian_alpha',
            'family' => 'required|persian_alpha',
            'birth_date' => 'required|date',
            'county_id' => 'required|exists:counties,id',
            'job_type' => 'required',
            'job_location' => 'required|persian_alpha_eng_num',
            'monthly_income' => 'required|persian_alpha_eng_num',
            'notify_mobile' => 'nullable|ir_mobile',
            'cheque_photo' => 'required|image',
            'id_card_photo' => 'required|image',
        ], [
            'family.persian_alpha' => 'نام خانوادگی را صحیح وارد نمایید.',
            'birth_date.required' => 'ورود تاریخ تولد الزامی است.',
            'job_location.persian_alpha_eng_num' => 'محل اشتغال را صحیح وارد نمایید.',
            'monthly_income.persian_alpha_eng_num' => 'درآمد ماهیانه را صحیح وارد نمایید.',
            'notify_mobile.ir_mobile' => 'شماره همراه اطلاع رسانی را صحیح وارد کنید.',
            'cheque_photo.required' => 'بارگذاری تصویر برگ چک الزامی است.',
            'id_card_photo.required' => 'بارگذاری تصویر کارت ملی الزامی است.'
        ]);

        $cheque_photo_name = $id_card_photo_name = '';
        if ($this->cheque_photo) {
            $cheque_photo_name = hash_file('sha256', $this->cheque_photo->getRealPath()) . substr($this->cheque_photo->getClientOriginalName(), strrpos($this->cheque_photo->getClientOriginalName(), '.'));
            $this->cheque_photo->storeAs('public/installment/images', $cheque_photo_name);
        }
        if ($this->id_card_photo) {
            $id_card_photo_name = hash_file('sha256', $this->id_card_photo->getRealPath()) . substr($this->id_card_photo->getClientOriginalName(), strrpos($this->id_card_photo->getClientOriginalName(), '.'));
            $this->id_card_photo->storeAs('public/installment/images', $id_card_photo_name);
        }
        $county = County::find($this->county_id);
        if(InstallmentRequest::create([
            'name' => $this->name,
            'family' => $this->family,
            'national_code' => $this->national_code,
            'birth_date' => $this->birth_date,
            'mobile' => $this->mobile,
            'province' => $county->province->name,
            'county' => $county->name,
            'job_type' => $this->job_type,
            'job_location' => $this->job_location,
            'job_title' => $this->job_title,
            'monthly_income' => $this->monthly_income,
            'notify_mobile' => $this->notify_mobile ?? $this->mobile,
            'cheque_photo' => $cheque_photo_name,
            'id_card_photo' => $id_card_photo_name,
        ])) {
            $sms = new SMSController('InstallmentRequestRegister', $this->notify_mobile ?? $this->mobile, [$this->name . ' ' . $this->family]);
            SendSMS::dispatchAfterResponse($sms);
            $sms1 = new SMSController('InstallmentRequestAlert', '09153075256', ['']);
            SendSMS::dispatchAfterResponse($sms1);
            $sms2 = new SMSController('InstallmentRequestAlert', '09022231205', ['']);
            SendSMS::dispatchAfterResponse($sms2);
            toastr()->addSuccess('درخواست شما با موفقیت ثبت شد.')->setTitle('موفق');
            $this->reset();
            return redirect()->route('installment.index');
        }
        else
            toastr()->addError('خطا در ثبت اطلاعات. لطفا با شرکت تماس بگیرید.')->setTitle('خطا');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.installment.request');
    }
}
