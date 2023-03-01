<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $table = "core_roles";

    protected $appends = ['initials', "type"];

    public function getTypeAttribute()
    {
        return "scopes";
    }

    /**
     * Scope Relation
     */
    public function scopes()
    {
      //  return $this->belongsToMany(Scope::class, "core_role_scope");
    }

    public function getInitialsAttribute()
    {
        return $this->attributes['initials'] = mb_strtoupper(mb_substr($this->attributes['name'], 0, 2));
    }
}
