<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'amount', 'detail', 'image', 'status', 'del_flg'];

    public function getStatusAttribute($value)
    {
        $statusMap = [
            'uplode' => '掲載中',
            'move' => '進行中',
            'done' => '完了',
        ];
        return $statusMap[$value] ?? '不明';
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function dangers()
    {
        return $this->hasMany('App\Danger', 'post_id', 'id');
    }
    public function applications()
    {
        return $this->hasMany('App\Danger', 'post_id', 'id');
    }
}
