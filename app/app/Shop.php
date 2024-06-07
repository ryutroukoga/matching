<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['comment', 'address', 'name', 'image','user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function review()
    {
        return $this->hasOne('App\Review');
    }
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Shop' => 'App\Policies\ShopPolicy',
    ];
}
