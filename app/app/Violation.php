<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = ['review_id', 'comment','user_id'];
    public function shop()
    {
        return $this->belongsTo('App\Review');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
