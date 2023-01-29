<?php
namespace App\Models;

class Log extends Model {
    protected $fillable = [
        'message',
        'item_id',
        'user_id',
    ];

    public function item(){
        return $this->belongTo(Item::class);
    }

    public function user(){
        return $this->belongTo(User::class);
    }
}