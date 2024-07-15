<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance_cln_period extends Model
{
    use HasFactory;
    protected $table = 'finance_cln_periods';
    protected $guarded = [];

    public function added()
    {
        return $this->belongsTo('\App\Models\Admin', 'added_by');
    }
    public function updatedby()
    {
        return $this->belongsTo('\App\Models\Admin', 'updated_by');
    }
    public function Month()
    {
        return $this->belongsTo('\App\Models\Month', 'MONTH_ID');
    }
}