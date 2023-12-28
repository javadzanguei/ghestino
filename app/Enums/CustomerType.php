<?php
namespace App\Enums;

enum CustomerType: string
{
    case Normal = 'عادی';
    case Colleague = 'همکار';
    case VIP = 'ویژه';
    case Warning = 'اخطار';
}
