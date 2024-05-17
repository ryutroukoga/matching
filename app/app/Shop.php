<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['comment', 'address', 'name', 'image', 'avarage_score'];
    // public function type()
    // {
    //     return $this->belongsTo('App\Type', 'type_id', 'id');
    // }
}
