<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['shop_id'];
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }
}
