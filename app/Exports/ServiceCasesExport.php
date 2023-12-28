<?php

namespace App\Exports;

use App\Models\ServiceCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ServiceCasesExport implements  FromQuery, WithMapping, WithHeadings,
    WithColumnFormatting, WithStyles, WithEvents, ShouldQueue
{
    use Exportable;
    public $department, $status, $group, $returned, $replacement, $customer_name,
            $current_month, $service_date_start, $service_date_end;

    public function __construct($department, $status, $group, $returned, $replacement, $customer_name,
                                $current_month, $service_date_start, $service_date_end)
    {
        $this->department = $department;
        $this->status = $status;
        $this->group = $group;
        $this->returned = $returned;
        $this->replacement = $replacement;
        $this->current_month = $current_month;
        $this->service_date_start = $service_date_start;
        $this->service_date_end = $service_date_end;
        $this->customer_name = $customer_name;
    }

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $cases = ServiceCase::query()->with('customer');
        if ($this->department > 0)
            $cases->where('receive_department_id', $this->department);
        switch ($this->status) {
            case 1:
                $cases->whereNull('service_result');
                break;
            case 2:
                $cases->where('service_result', 1);
                break;
            case 3:
                $cases->where('service_result', 1)->whereNotNull('delivery_date');
                break;
            case 4:
                $cases->where('service_result', 1)->whereNull('delivery_date');
                break;
            case 5:
                $cases->where('service_result', 0);
                break;
            case 6:
                $cases->where('service_result', 0)->whereNotNull('delivery_date');
                break;
            case 7:
                $cases->where('service_result', 0)->whereNull('delivery_date');
                break;
            case 8:
                $cases->whereNotNull('delivery_date');
                break;
            case 9:
                $cases->whereNotNull('service_result')->whereNull('delivery_date');
                break;
            default;
        }
        if ($this->group > 0)
            $cases->where('product_group_id', $this->group);
        if ($this->returned)
            $cases->where('returned', 1);
        if ($this->replacement)
            $cases->where('replacement', 1);
        if($this->current_month) {
            $datetime = verta();
            $datetime->day = 1;
            $cases->where('receive_date', '>=', $datetime->toCarbon());
        }
        if(!$this->current_month && $this->service_date_start)
            $cases->where('receive_date', '>=', $this->service_date_start);
        if(!$this->current_month && $this->service_date_end)
            $cases->where('receive_date', '<=', $this->service_date_end);
        if( auth('user')->user()->access !== 'admin'
            && !auth('user')->user()->view_all_services )
            $cases->where('receive_department_id', auth('user')->user()->department_id);
        if($this->customer_name) {
            $cases->whereHas('customer', function($q) {
                if($this->customer_name)
                    $q->where('fullname', 'LIKE', '%' . $this->customer_name . '%');
            });
        }
        return $cases;
    }

    public function map($case): array
    {
        return [
            $case->admission_code,
            verta($case->created_at)->format('Y/m/d'),
            $case->receiveDepartment->name,
            $case->productGroup->name,
            $case->model,
            $case->description,
            $case->customer->fullname,
            $case->customer->mobile,
            $case->returned ? 'بلی' : 'خیر',
            $case->service_result === null ? 'ثبت نشده' : ($case->service_result ? 'مثبت' : 'منفی'),
            $case->service_cost,
            $case->service_description,
            $case->replacement ? 'بلی' : 'خیر',
            $case->replacement_components,
            $case->delivery_date ? 'تحویل شده' : 'تحویل نشده',
            verta($case->delivery_date)->format('Y/m/d'),
        ];
    }

    public function headings(): array
    {
        return [
            'کد پذیرش',
            'تاریخ دریافت',
            'شعبه',
            'نوع کالا',
            'مدل',
            'توضیحات',
            'نام مشتری',
            'همراه مشتری',
            'وضعیت برگشتی',
            'نتیجه سرویس',
            'هزینه سرویس',
            'توضیحات سرویس',
            'وضعیت تعویض قطعه',
            'قطعه تعویضی',
            'وضعیت تحویل',
            'تاریخ تحویل',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()
                    ->setRightToLeft(true)
                    ->setAutoFilter('A1:' . $event->sheet->getDelegate()->getHighestColumn() . '1');
            },
        ];
    }
}
