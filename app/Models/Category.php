<?php
namespace App\Models;

class Category extends Model
{
    protected $fillable = [
        'name',
        'brand_id',
    ];

    // 하나의 카테고리에는 아이템이 무제한으로 있을 수 있다.
    public function items()
    {
        // 카테고리가 가지는 아이템은 1개
        return $this->hasMany(Item::class);
    }
    // item모델에 적절한 외래 키를 자동으로 결정한다.

    // 하나의 카테고리에는 아이템이 무제한으로 있을 수 있다.
    public function products()
    {
        // 카테고리가 가지는 아이템은 1개
        return $this->hasMany(Product::class);
    }
    // item모델에 적절한 외래 키를 자동으로 결정한다.

    // 하나의 카테고리 모델은 하나의 브랜드 모델과 연관되어 있다.
    public function brand()
    {
        // hasOne 메서드에 전달되는 첫번째 인자는 관련 모델 클래스의 이름
        // 카테고리가 속해있는 브랜드는 1개
        return $this->belongsTo(Brand::class);
    }
    // 이로써 user 모델에서 Phone 모델로 접근이 가능하다.
}
