<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\GlobalScope;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'count',
        'image',
        'useyn',
    ];

    public static function booted()
    {
        static::addGlobalScope(new GlobalScope);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function scopeGetItemById($query, $item_id)
    {
        $query->where('id', $item_id);
    }

    public function scopeJoinWithCategoriesAndBrands($query)
    {
        $query->leftJoin('categories', 'categories.id', '=', 'items.category_id')->leftjoin('brands', 'brands.id', '=', 'categories.brand_id')->select('items.*', 'categories.id as category_id', 'categories.name as category_name', 'brands.id as brand_id', 'brands.name as brand_name');
    }
}
