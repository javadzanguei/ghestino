<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\EmployeeLeave;
use App\Models\User;
use Livewire\Component;

class LeaveEdit extends Component
{
    public EmployeeLeave $leave;
    public $employee, $type, $edit_date_from, $edit_date_to, $edit_time_from, $edit_time_to;
    public $listeners = ['updateRecordId'];

    public function save()
    {
        if(!$this->employee) {
            toastr()->addError('کارمند را انتخاب کنید.')->setTitle('خطا');
            return;
        }
        if($this->type == 1) $this->edit_time_from = $this->edit_time_to = null;
        if($this->type == 1 && $this->edit_date_from == $this->edit_date_to) {
            toastr()->addError('تاریخ پایان نباید با تاریخ شروع یکی باشد.')->setTitle('خطا');
            return;
        }
        if($this->type == 2) $this->edit_date_to = null;
        if($this->type == 2 && ($this->edit_time_from >= $this->edit_time_to || $this->edit_time_from == '' || $this->edit_time_to == '')) {
            toastr()->addError('ساعت پایان نباید از ساعت شروع عقب تر باشد.')->setTitle('خطا');
            return;
        }
        if($this->leave->update([
            'type' => $this->type,
            'date_from' => $this->edit_date_from,
            'date_to' => $this->edit_date_to,
            'time_from' => $this->edit_time_from,
            'time_to' => $this->edit_time_to,
        ])) {
            toastr()->addSuccess('درخواست با موفقیت ویرایش شد.')->setTitle('موفق');
            $this->emitTo('admin.employee.leaves', 'refreshContentsList');
        }
        else
            toastr()->addError('خطا در ثبت درخواست.')->setTitle('خطا');
    }

    public function updated()
    {
        $this->dispatchBrowserEvent('type-edited', ['type' => $this->type]);
    }

    public function updateRecordId($id)
    {
        $this->leave = EmployeeLeave::find($id);
        $this->employee = $this->leave->requested_by;
        $this->type = $this->leave->type === 'daily' ? 1 : 2;
        $this->edit_date_from = $this->leave->date_from;
        $this->edit_date_to = $this->leave->date_to;
        $this->edit_time_from = $this->leave->time_from;
        $this->edit_time_to = $this->leave->time_to;
        $this->updated();
    }

    public function render()
    {
        return view('livewire.admin.employee.leave-edit');
    }
}
