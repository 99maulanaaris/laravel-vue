<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
