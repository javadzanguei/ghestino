<?php
namespace App\Enums;

enum ServiceCaseResult: string
{
    case Unregistered = 'ثبت نشده';
    case Positive = 'مثبت';
    case Negative = 'منفی';
    case Cancel = 'انصراف مشتری';
    case Unrepairable = 'غیرقابل تعمیر';
}
