<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        $validated = Validator::make(request()->all(), [
            'fullname' => 'required|string',
            'mobile' => 'required|ir_mobile|unique:users,mobile',
            'password' => 'required|string',
            'access' => 'required|in:1,2',
            'active' => 'nullable|int|in:1',
            'superadmin' => 'nullable|int|in:1',
        ], [
            'mobile.unique' => 'کاربری با این شماره وجود دارد.'
        ])->validate();
        if (User::create([
            'fullname' => $validated['fullname'],
            'mobile' => $validated['mobile'],
            'password' => Hash::make($validated['password']),
            'access' => $validated['access'],
            'active' => $validated['active'] ?? 0,
            'superadmin' => $validated['superadmin'] ?? 0,
        ]))
            toastr()->addSuccess('کاربر جدید ثبت شد.')->setTitle('موفق');
        else
            toastr()->addError('خطا در ثبت کاربر! لطفا با مدیر سیستم تماس بگیرید.')->setTitle('خطا');

        return redirect()->route('admin.user.index');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update()
    {
        $validated = Validator::make(request()->all(), [
            'id' => 'required|int|exists:users,id',
            'fullname' => 'required|string',
            'mobile' => 'required|ir_mobile',
            'password' => 'nullable|string',
            'access' => 'required|in:1,2',
            'active' => 'nullable|boolean',
            'superadmin' => 'nullable|boolean',
        ])->validate();

        $user = User::find($validated['id']);
        if ($validated['password']) {
            if ($user->update([
                'fullname' => $validated['fullname'],
                'mobile' => $validated['mobile'],
                'password' => Hash::make($validated['password']),
                'access' => $validated['access'],
                'active' => $validated['active'] ?? 0,
                'superadmin' => $validated['superadmin'] ?? 0,
            ]))
                toastr()->addSuccess('کاربر با موفقیت ویرایش شد.')->setTitle('موفق');
            else
                toastr()->addError('خطا در ویرایش کاربر! لطفا با مدیر سیستم تماس بگیرید.')->setTitle('خطا');
        } else {
            if ($user->update([
                'fullname' => $validated['fullname'],
                'mobile' => $validated['mobile'],
                'access' => $validated['access'],
                'active' => $validated['active'] ?? 0,
                'superadmin' => $validated['superadmin'] ?? 0,
            ]))
                toastr()->addSuccess('کاربر با موفقیت ویرایش شد.')->setTitle('موفق');
            else
                toastr()->addError('خطا در ویرایش کاربر! لطفا با مدیر سیستم تماس بگیرید.')->setTitle('خطا');
        }

        return redirect()->route('admin.user.index');
    }
}
