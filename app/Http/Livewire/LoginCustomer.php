<?php

namespace App\Http\Livewire;

use App\Http\Controllers\SMSController;
use App\Jobs\SendSMS;
use App\Models\Customer;
use App\Models\ServiceCase;
use Exception;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Component;

class LoginCustomer extends Component
{
    public $mobile, $login_code, $verify_code, $customer, $sent_sms;

    public function loginCustomer()
    {
        $validated = $this->validate([
            'mobile' => 'required|numeric',
        ]);
        $this->customer = Customer::whereMobile($this->mobile)->first();
        if( !$this->customer ) {
            toastr()->addError('متأسفانه شماره همراه شما در سامانه مشتریان بارسلون تعریف نشده است.')->setTitle('خطا');
            return false;
        }
        $service_cases = ServiceCase::where('customer_mobile', $this->mobile)
            ->whereNull('delivery_date')->count();
        if( !$service_cases ) {
            toastr()->addError('متأسفانه رسید فعالی برای شما پیدا نشد.')->setTitle('خطا');
            return false;
        }
        try {
            $this->verify_code = rand(1001, 9999);
            $sms = new SMSController('LoginCode', $this->mobile, [
                $this->customer->fullname, $this->verify_code
            ]);
            SendSMS::dispatchAfterResponse($sms);
            $this->sent_sms = true;
        } catch (Exception $e) {
            $this->sent_sms = false;
            toastr()->addError( 'خطا در ارسال پیامک کد ورود! لطفا در زمان دیگری مجدد سعی نمایید.')->setTitle('خطا');
        }
    }

    public function reSendSMS()
    {
        $executed = RateLimiter::attempt(
            'store-service:' . auth('user')->id(),
            $perMinute = 2,
            function() {
                try {
                    $sms = new SMSController('LoginCode', $this->mobile, [
                        $this->customer->fullname, $this->verify_code
                    ]);
                    SendSMS::dispatchAfterResponse($sms);
                } catch (Exception $e) {
                    toastr()->addError( 'خطا در ارسال پیامک کد ورود! لطفا در زمان دیگری مجدد سعی نمایید.')->setTitle('خطا');
                }
        },
            $decayRate = 60,
        );
        if (! $executed) {
            toastr()->addError('لطفا کمی صبر کنید. در هر دقیقه دو مرتبه امکان ارسال پیامک وجود دارد.')->setTitle('خطا');
        }
    }

    public function loginCustomerVerification()
    {
        if($this->login_code == $this->verify_code) {
            $this->customer->user_agent = request()->userAgent();
            $this->customer->ip = request()->getClientIp();
            $this->customer->last_login = date("Y-m-d H:i:s", time());
            $this->customer->save();
            auth('customer')->loginUsingId($this->customer->id);
            return redirect()->route('customer.index');
        } else {
            toastr()->addError( 'کد ارسالی صحیح نمی باشد.')->setTitle('خطا');
        }
    }

    public function render()
    {
        return view('livewire.login-customer');
    }
}
