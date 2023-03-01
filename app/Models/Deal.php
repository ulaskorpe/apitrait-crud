<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "core_deals";

    protected $fillable = [
        'name',
        'value',
        'orders',
        'sales',
        'valid'
    ];
    protected $appends = ['initials'];
}
