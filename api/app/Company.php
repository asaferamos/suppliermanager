<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $hidden = ["created_at", "updated_at"];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
