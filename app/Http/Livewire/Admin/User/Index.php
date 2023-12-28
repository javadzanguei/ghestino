<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function toggleActive($id)
    {
        $user = User::find($id);
        $user->active = !$user->active;
        if ($user->save())
            toastr()->addSuccess('وضعیت کاربر تغییر کرد')->setTitle('موفق');
        else
            toastr()->addError('خطا در تغییر وضعیت کاربر')->setTitle('خطا');

        $this->render();
    }

    public function delete($id)
    {
        if (User::destroy($id))
            toastr()->addSuccess('کاربر با موفقیت حذف شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در حذف کاربر')->setTitle('خطا');

        $this->render();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.index', [
            'users' => User::orderByDesc('active')->orderBy('fullname')->paginate()
        ]);
    }
}
