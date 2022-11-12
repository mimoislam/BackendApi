<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'addresses';


    public function country(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
