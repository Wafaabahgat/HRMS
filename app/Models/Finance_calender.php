<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Finance_calender extends Model
{
    use HasFactory;
    protected $guarded = [];


    public static function finance_calender_Req()
    {
        return [
            'FINANCE_YR' => [
                'required',
                Rule::unique('finance_calenders')
            ],
            'FINANCE_YR_DESC' => 'required',
            'end_date' => 'required',
            'start_date' => 'required',
        ];
    }

    public function added()
    {
        return $this->belongsTo(Admin::class, 'added_by');
    }
    public function updated_by()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}