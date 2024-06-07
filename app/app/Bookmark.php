<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['review_id', 'user_id'];
    public function review()
    {
        return $this->belongsTo('App\Review');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
