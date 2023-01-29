<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{

    public function practice()
    {
        // dd(now()->subDays(30));
        Item::withTrashed()->restore();
        $categories = Category::distinct()->get('name');
        $items = Item::with('category.brand')->get();
        // dd($items);
        return view('items.index', ['items' => $items, 'categories' => $categories, 'count'=>$items->count()]);
    }

    public function index()
    {
        $categories = Category::distinct()->get('name');
        $items = Item::get();
        $count = Item::get()->count();
        return view('items.index', ['items' => $items, 'categories' => $categories, 'count'=>$count]);
    }

    public function create()
    {
        $categories = Category::distinct()->get('name');
        return view('items.create', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $categories = Category::distinct()->get('name');
        $item = Item::getItemById($id)->first();
        return view('items.edit')->with(['item' => $item, 'categories' => $categories]);
    }

    public function show($id)
    {
        // 없는 인덱스를 조회했을 때, 위처럼 하면 HTML 페이지를 만드는 과정에서 오류가 발생한다.
        // $item = Item::getItemById($id)->first();
        // 없는 인덱스를 조회했을 때, 아래 처럼 하면 404 페이지가 나온다.
        $item = Item::findOrFail($id);
        return view('items.show')->with(['item' => $item]);
    }

    // 새 프로덕트 저장하기
    public function store()
    {
        $category = Category::where('name', request('category_name'))->where('brand_id', request('brand_id'))->get()->first();
        $item = $category->items()->create([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'count' => request('count'),
            'image' => request('image'),
        ]);
        $item->logs()->create([
            "message" => "created",
            "user_id" => Auth::user()->id,
        ]);
        return redirect('/item');
    }

    // 아이템 수정하기
    public function update($id)
    {
        $category_id = Category::where('name', request('category_name'))->where('brand_id', request('brand_id'))->get()->first();
        $item = Item::find($id)->update([
            "name" => request('name'),
            "category_id" => $category_id->id,
            "description" => request('description'),
            "price" => request('price'),
            "count" => request('count'),
            "image" => request('image'),
        ]);
        Log::create([
            'item_id' => $id,
            "user_id" => Auth::user()->id,
            'message' => 'updated',
        ]);

        return redirect('/item');
    }

    // 삭제하기
    public function delete($id)
    {
        // findOrFail -> 쿼리의 첫번째 결과를 검색한 후, 결과가 없다면 예외 발생
        $item = Item::findOrFail($id);
        $item->delete();
        Log::create([
            'item_id' => $id,
            "user_id" => Auth::user()->id,
            'message' => 'deleted',
        ]);
        return redirect('/item');
    }

    public function search()
    {
        $searched_category_name = request()->query('category_name');
        $searched_brand_id = request()->query('brand_id');
        if (!$searched_category_name && !$searched_brand_id) {
            $categories = Category::distinct()->get('name');
            $items = Item::get();
            return view('items.index')->with(['items' => $items, 'categories' => $categories, 'count'=>$items->count()]);
        } elseif (!$searched_brand_id) {
            $categories = Category::distinct()->get('name');
            $items = Item::joinWithCategoriesAndBrands()->where('categories.name', '=', $searched_category_name)->get();
            return view('items.index')->with(['items' => $items, 'categories' => $categories, 'count'=>$items->count()]);
        } else {
            $categories = Category::distinct()->get('name');
            $items = Item::joinWithCategoriesAndBrands()->where('categories.name', '=', $searched_category_name)->where('brands.id', '=', $searched_brand_id)->get();
            return view('items.index')->with(['items' => $items, 'categories' => $categories, 'count'=>$items->count()]);
        }
    }
}
