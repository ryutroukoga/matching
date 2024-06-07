<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['shop_id', 'title', 'comment', 'score', 'image', 'del_flg', 'user_id'];
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function violations()
    {
        return $this->hasMany('App\Violation');
    }
    public function books()
    {
        return $this->hasMany('App\Bookmark');
    }
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Review' => 'App\Policies\ReviewPolicy',
    ];
}
