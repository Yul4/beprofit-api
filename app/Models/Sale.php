<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = ['id'];

    public function saveInstance($values)
    {
        $this->fill($values);
        $this->save();
    }
}
