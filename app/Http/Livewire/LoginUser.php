<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoginUser extends Component
{
    public $mobile, $password, $captcha;
    public function loginUser()
    {
        $validated = $this->validate([
            'mobile' => 'required|numeric|exists:users,mobile',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], ['captcha.captcha' => 'کد امنیتی را صحیح وارد کنید']
        );
        if (
            auth('user')->attempt(['mobile' => $this->mobile, 'password' => $this->password])
            && auth('user')->user()->active
        ) {
            request()->session()->regenerate();
            $user = auth('user')->user();
            $user->ip = request()->getClientIp();
            $user->user_agent = request()->userAgent();
            $user->last_login = date("Y-m-d H:i:s", time());
            $user->save();
            return redirect()->route('case.index');
        } else {
            $this->emitTo( 'captcha','refresh');
            toastr()->addError('شماره همراه یا کلمه عبور شما اشتباه است.')->setTitle('خطا');
        }
    }
    public function render()
    {
        return view('livewire.login-user');
    }
}
