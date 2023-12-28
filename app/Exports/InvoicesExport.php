<?php

namespace App\Exports;

use App\Models\Invoice;
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

class InvoicesExport implements FromQuery, WithMapping, WithHeadings,
    WithColumnFormatting, WithStyles, WithEvents, ShouldQueue
{
    use Exportable;
    public $search, $register_user_id, $invoice_date_start, $invoice_date_end;

    public function __construct($search, $register_user_id, $invoice_date_start, $invoice_date_end)
    {
        $this->search = $search;
        $this->register_user_id = $register_user_id;
        $this->invoice_date_start = $invoice_date_start;
        $this->invoice_date_end = $invoice_date_end;
    }

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
//        return Invoice::query()->whereNotNull('number');
        $invoices = Invoice::query();
            if ( !empty($this->search)) {
                $invoices->where('number', $this->search)
                    ->orWhere('customer_name', 'LIKE', '%' . $this->search . '%');
            }
            if($this->invoice_date_start)
                $invoices->where('date', '>=', $this->invoice_date_start);
            if($this->invoice_date_end)
                $invoices->where('date', '<=', $this->invoice_date_end);

            if ($this->register_user_id > 0 && $this->user->access === 'admin')
                $invoices->where('user_id', $this->register_user_id);
            if (auth('user')->user()->access !== 'admin' && !auth('user')->user()->view_all_invoices)
                $invoices->where('department_id', auth('user')->user()->department_id);
            return $invoices;
    }

    public function map($invoice): array
    {
        return [
            verta($invoice->date)->format('Y/m/d'),
            $invoice->number,
            $invoice->customer_name,
            $invoice->customer_phone,
            $invoice->note,
            $invoice->quantity_rows,
            $invoice->sub_total,
            $invoice->discount_val,
            $invoice->total,
            $invoice->department->name,
            $invoice->user->fullname,
            verta($invoice->created_at)->format('Y/m/d H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'تاریخ فاکتور',
            'شماره فاکتور',
            'نام مشتری',
            'شماره همراه مشتری',
            'توضیحات',
            'تعداد اقلام',
            'جمع اقلام',
            'مقدار تخفیف',
            'مبلغ پرداختی',
            'شعبه',
            'کاربر',
            'زمان ثبت',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
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
