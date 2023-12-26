<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week_details extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'week_detail_id';
    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }
}
