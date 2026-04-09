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
        'ccss_employeeR_percentage',
        'ccss_employeeP_percentage',
        'ccss_employer_percentage',
        'ccss_domestic_percentage',
    ];
}
