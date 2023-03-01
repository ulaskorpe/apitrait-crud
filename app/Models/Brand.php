<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'core_brands';
    protected  $fillable = ['name','manufacturer_id'];

    public function manufacturer(){
        return $this->hasOne(Manufacturer::class,'id','manufacturer_id');
    }

}
