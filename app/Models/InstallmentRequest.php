<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'family', 'national_code', 'mobile', 'birth_date',
        'province', 'county', 'job_type', 'job_location', 'job_title',
        'monthly_income', 'notify_mobile', 'cheque_photo', 'id_card_photo',
        'result', 'result_description'
    ];

    public function fullname(): string
    {
        return $this->name . ' ' . $this->family;
    }

}
