<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'week_id';
    public function weekDetails()
    {
        return $this->hasMany(Week_details::class, 'week_id');
    }

    public function creditDetails()
    {
        return $this->hasMany(CreditDetail::class, 'week_id');
    }
}
