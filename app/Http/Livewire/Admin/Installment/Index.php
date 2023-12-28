<?php

namespace App\Http\Livewire\Admin\Installment;

use App\Models\InstallmentRequest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $fullname, $mobile, $national_code;
    public $status, $result, $description;
    public $openId;

    public function openRequest($id)
    {
        $this->openId = $id;
    }

    public function closeRequest()
    {
        $this->openId = null;
    }

    public function save()
    {
        $request = InstallmentRequest::find($this->openId);
        if($request->update([
            'result' => $this->result,
            'result_description' => $this->description,
        ]))
            toastr()->addSuccess('نتیجه با موفقیت ثبت شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در ثبت اطلاعات')->setTitle('خطا');

        $this->render();
    }

    public function delete($id)
    {
        if(InstallmentRequest::destroy($id))
            toastr()->addSuccess('رکورد با موفقیت حذف شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در حذف رکورد')->setTitle('خطا');

        $this->render();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $not_checked_count = InstallmentRequest::whereNull('result')->count();
        $installment_requests = InstallmentRequest::where(function ($query) {
            if ($this->fullname)
                $query->whereRaw("CONCAT(name, ' ', family) LIKE '%" . $this->fullname . "%'");
            if ($this->mobile)
                $query->where('mobile', 'LIKE', $this->mobile);
            if ($this->national_code)
                $query->where('national_code', 'LIKE', $this->national_code);
            if ($this->status == 1)
                $query->whereResult(null);
            if ($this->status == 2)
                $query->whereResult(1);
            if ($this->status == 3)
                $query->whereResult(0);
        })->orderByDesc('created_at', 'desc')->paginate();
        return view('livewire.admin.installment.index', compact('installment_requests', 'not_checked_count'));
    }
}
