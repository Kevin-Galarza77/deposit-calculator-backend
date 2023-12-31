<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditDetail extends Model
{
    use HasFactory;
    protected $table = 'credits_details';
    protected $primaryKey = 'credit_detail_id';
    public $timestamps = false;
    public function CreditPeople()
    {
        return $this->belongsTo(CreditPeople::class, 'credit_people_id');
    }

    public function Week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }

}
