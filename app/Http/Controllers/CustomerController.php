<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use App\Models\ServiceCase;
use App\Models\ServiceCaseLevel;
use App\Models\User;
use App\Notifications\ApprovalServiceLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $search = $this->validate(request(), [
            'search' => 'nullable',
        ]);
        $search = $search['search'] ?? false;

        if (empty($search)) {
            $search_response = false;
            $customer_id = auth('customer')->id();
            $groups = ProductGroup::with(['serviceCases' => function ($query) use ($customer_id) {
                $query->where('customer_id', $customer_id)->whereNull('delivery_date');
            }])->has('serviceCases')->get();
            return view('customer.index', compact('search_response','groups'));
        } else {
            $search_response = true;
            $service_case = auth('customer')->user()->serviceCases()->where('admission_code', $search)
                ->whereNull('delivery_date')->first();
            return view('customer.index', compact('search_response','service_case', 'search'));
        }
    }

    public function show(ServiceCase $service_case)
    {
        if ($service_case->customer_id != auth('customer')->id())
            abort(403);

        foreach ($service_case->levels as $level) {
            if ($level->customer_view_date === null) {
                $level->customer_view_date = date('Y-m-d H:i:s', time());
                $level->customer_ip = request()->getClientIp();
                $level->customer_user_agent = request()->userAgent();;
                $level->save();
            }
        }
        if ($service_case->service_result && $service_case->result_customer_viewed_date === null) {
            $service_case->result_customer_viewed_date = date('Y-m-d H:i:s', time());
            $service_case->save();
        }

        return view('customer.show', compact('service_case'));
    }

    public function level_approval()
    {
        $validated = $this->validate(request(), [
            'id' => ['required', 'int', 'exists:service_levels,id'],
            'customer_approval_description' => 'nullable|string',
            'approval' => 'required|bool'
        ]);

        $level = ServiceCaseLevel::find($validated['id']);
        $level->customer_approval_state = $validated['approval'];
        $level->customer_approval_description = $validated['customer_approval_description'];
        $level->customer_approval_date = date('Y-m-d H:i:s', time());
        $level->customer_ip = request()->getClientIp();
        $level->customer_user_agent = request()->userAgent();
        $level->save();
        Notification::send(User::whereAccess('admin')->get(), new ApprovalServiceLevel($level->serviceCase->id, $level->serviceCase->productGroup->name . ' ' . $level->serviceCase->model));

        return redirect()->back();
    }
}
