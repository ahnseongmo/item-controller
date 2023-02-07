<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::join('brands', 'categories.brand_id', '=', 'brands.id')->select('categories.*', 'brands.id as brand_id', 'brands.name as brand_name')->get();
        $brands = Brand::get();
        return view('categories.index', ['categories' => $categories, 'brands' => $brands]);
    }

    // 생성하기 페이지 보여주기
    public function create()
    {
        $brands = Brand::get();
        return view('categories.create', ['brands' => $brands]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        // 해당 카테고리 아이디가 없을 떄
        if($category===null){
            return response()->json([
                'result'=>false
            ], 404);
        }
        // 기존과 동일한 카테고리일 때
        if($category->name==request()->name && $category->brand_id == request()->brand_id){
            return response()->json([
                'result'=>false
            ], 409);
        }
        // 기존과 존재하는 카테고리일 때
        $exist_category = Category::where('name', request()->name)->where('brand_id', request()->brand_id)->get();
        if(count($exist_category)>0){
            return response()->json([
                'result'=>false,
            ], 409);
        }
        $category->name = request()->name;
        $category->brand_id = request()->brand_id;
        $category->save();
        return response()->json([
            'result'=>true,
            'data'=>$category], 200);
    }

    // 새 카테고리 저장하기
    public function store()
    {
        $categories = Category::where('name', request()->name)->where('brand_id', request()->brand_id)->get();
        if (count($categories) > 0) {
            return response()->json([
                'result'=>false,], 409);
        } else {
            $category = new Category([
                'name' => request()->name,
                'brand_id' => request()->brand_id,
            ]);
            $category->save();
            return response()->json([
                'result'=>true,
                'data'=>$category], 200);
        }
    }

    public function getBrandNameFromCategory($category_name)
    {
        $available_brand = Category::join('brands', 'categories.brand_id', '=', 'brands.id')
            ->where('categories.name', '=', $category_name)
            ->select('brands.id as brand_id', 'brands.name as brand_name')
            ->distinct()->get();
        $result = ["data" => $available_brand];
        return response()->json($result);
    }

    public function getBrandNameFromCategoryId($category_id)
    {
        $available_brand = Category::join('brands', 'categories.brand_id', '=', 'brands.id')
            ->where('categories.id', '=', $category_id)
            ->select('categories.*', 'brands.id as brand_id', 'brands.name as brand_name')
            ->distinct()->get();
        $result = ["data" => $available_brand];
        return response()->json($result);
    }

    // 삭제하기
    public function delete($id)
    {
        // 해당 카테고리를 가진 아이템을 검색한다.
        $items = Item::where('category_id', '=', $id)->get();
        if (count($items) > 0) {
            return back()->withErrors(['exist' => '삭제하려는 카테고리를 가진 아이템이 존재합니다.']);
        } 
        else {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect('/category');
        }
    }
}
