<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'legal_id',
        'address',
        'phone',
        'logo_path',
        'ccss_employee_percentage',
        'ccss_employer_percentage',
    ];
}
