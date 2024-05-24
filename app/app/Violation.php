<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = ['shop_id', 'comment','user_id'];
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
