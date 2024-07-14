<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Admin_panel_setting extends Model
{
    use HasFactory;

    protected $table = "admin_panel_settings";
    public $timestamps = false;
    
    protected $fillable = [
        'company_name', 'saysem_status', 'image',
        'phones', 'address', 'email', 'added_by',
        'updated_by', 'com_code', 'after_miniute_calculate_delay',
        'after_miniute_calculate_early_departure', 'after_miniute_quarterday',
        'after_time_half_daycut', 'after_time_allday_daycut',
        'monthly_vacation_balance', 'after_days_begin_vacation',
        'first_balance_begin_vacation', 'sanctions_value_first_abcence',
        'sanctions_value_second_abcence', 'sanctions_value_thaird_abcence',
        'sanctions_value_forth_abcence', 'created_at', 'updated_at'
    ];

    public static function rules()
    {
        return [
            'company_name'=>'required',
            'phones'=>'required',
            'address'=>'required',
            'after_miniute_calculate_delay'=>'required',
            'after_miniute_calculate_early_departure'=>'required',
            'after_miniute_quarterday'=>'required',
            'after_time_half_daycut'=>'required',
            'after_time_allday_daycut'=>'required',
            'monthly_vacation_balance'=>'required',
            'after_days_begin_vacation'=>'required',
            'first_balance_begin_vacation'=>'required',
            'sanctions_value_first_abcence'=>'required',
            'sanctions_value_second_abcence'=>'required',
            'sanctions_value_thaird_abcence'=>'required',
            'sanctions_value_forth_abcence'=>'required',
        ];
    }

    public static function updateSettings($com_code, $data)
    {
        return static::where('com_code', $com_code)->update($data);
    }
}