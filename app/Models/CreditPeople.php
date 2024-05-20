<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPeople extends Model
{
    use HasFactory;
    protected $table = 'credits_people';
    protected $primaryKey = 'credit_people_id';
    public $timestamps = false;

    public function CreditDetail()
    {
        return $this->hasMany(CreditDetail::class, 'credit_people_id');
    }

}
