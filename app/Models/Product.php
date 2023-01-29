<?php
namespace App\Models;

class Product extends Model {
    // TODO: protected가 무슨 옵션? public은?
    protected $fillable = [
        'name',
        'type',
        'type_num',       
        'description',    
        'price',
        'count',
        'image',
        'useyn',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
        