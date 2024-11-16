<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shiftes_type extends Model {
    use HasFactory;
    protected $table = 'shifts_types';
    protected $fillable = [
        'type', 'from_time', 'to_time', 'total_hours', 'added_by', 'updated_by', 'created_at', 'updated_at', 'com_code', 'active'
    ];

    public function added() {
        return $this->belongsTo( Admin::class, 'added_by' );
    }

    public function updatedBy() {
        return $this->belongsTo( Admin::class, 'updated_by' );
    }
}
