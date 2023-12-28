<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\EmployeeLeave;
use App\Models\User;
use Livewire\Component;

class LeaveRegister extends Component
{
    public $employee, $type, $register_date_from, $register_date_to, $register_time_from, $register_time_to;

    public function save()
    {
        if(!$this->employee) {
            toastr()->addError('کارمند را انتخاب کنید.')->setTitle('خطا');
            return;
        }
        if($this->type == 1) $this->register_time_from = $this->register_time_to = null;
//        if($this->type == 1 && $this->register_date_from == $this->register_date_to) {
//            toastr()->addError('تاریخ پایان نباید با تاریخ شروع یکی باشد.')->setTitle('خطا');
//            return;
//        }
        if($this->type == 2) $this->register_date_to = null;
        if($this->type == 2 && ($this->register_time_from >= $this->register_time_to || $this->register_time_from == '' || $this->register_time_to == '')) {
            toastr()->addError('ساعت پایان نباید از ساعت شروع عقب تر باشد.')->setTitle('خطا');
            return;
        }
        if(User::find($this->employee)->leaves()->create([
            'type' => $this->type,
            'date_from' => $this->register_date_from,
            'date_to' => $this->register_date_to,
            'time_from' => $this->register_time_from,
            'time_to' => $this->register_time_to,
        ])) {
            toastr()->addSuccess('درخواست با موفقیت ثبت شد.')->setTitle('موفق');
            $this->emitTo('admin.employee.leaves', 'refreshContentsList');
        }
        else
            toastr()->addError('خطا در ثبت درخواست.')->setTitle('خطا');
    }

    public function updated()
    {
        $this->dispatchBrowserEvent('type-updated', ['type' => $this->type]);
    }

    public function mount()
    {
        $this->type = 1;
    }

    public function render()
    {
        return view('livewire.admin.employee.leave-register');
    }
}
