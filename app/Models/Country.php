<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static select(string $string)
 * @method static findOrFail($id)
 * @method static where(string $string, string $string1, mixed $search)
 */
class Country extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $table = 'core_countries';

    protected $appends = ["type"];

    public function getTypeAttribute()
    {
        return "nationalities";
    }
}
