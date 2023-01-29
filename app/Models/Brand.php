<?php
namespace App\Models;

class Brand extends Model {
    protected $fillable = [
        'name',
    ];

    // 폰 모델에 연관관계를 정의하여, user에 접근할 수도 있다.
    public function categories(){
        return $this->hasMany(Category::class);
    }
    // 카테그리 메서드가 호출될 떄, 엘로퀀트는 브랜드 모델의 카테고리 아이디 컬럼이 카테고리 모델의 아이디와 매칭되는지 확인한다.
}
   