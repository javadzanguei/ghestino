<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\EmployeeLeave;
use Livewire\Component;

class Leaves extends Component
{
    public $employee, $current_month, $leave_date_start, $leave_date_end;

    protected $listeners = ['refreshContentsList'];

    public function refreshContentsList()
    {
        $this->render();
    }

    public function approve($id)
    {
        $request = EmployeeLeave::find($id);
        if($request->update([
            'approve_status' => 1,
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]))
            toastr()->addSuccess('درخواست با موفقیت پذیرفته شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در پذیرش درخواست.')->setTitle('خطا');
    }

    public function delete($id)
    {
        if(EmployeeLeave::destroy($id))
            toastr()->addSuccess('درخواست با موفقیت حذف شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در حذف درخواست.')->setTitle('خطا');
    }

    public function opposition($id)
    {
        $request = EmployeeLeave::find($id);
        if($request->update([
            'approve_status' => 0,
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]))
            toastr()->addSuccess('درخواست با موفقیت رد شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در رد درخواست.')->setTitle('خطا');
    }

    public function render()
    {
        $leaves = EmployeeLeave::where(function($query) {
            if($this->employee)
                $query->where('requested_by', $this->employee);
            if($this->current_month) {
                $datetime = verta();
                $datetime->day = 1;
                $query->where('date_from', '>=', $datetime->toCarbon()->format('Y-m-d'));
            }
            if(!$this->current_month && $this->leave_date_start)
                $query->where('date_from', '>=', $this->leave_date_start);
            if(!$this->current_month && $this->leave_date_end)
                $query->where('date_from', '<=', $this->leave_date_end);
        })->orderByDesc('created_at')->paginate(25);
        return view('livewire.admin.employee.leaves', compact('leaves'));
    }
}
