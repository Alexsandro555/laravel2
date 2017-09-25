<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Image;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     *
     * Add Category
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $parentCategory = Category::all()->pluck('title','id');
        return view('category.add', compact('parentCategory','parentCat'));
    }

    /**
     *
     * Get All Categories
     *
     * @return json
     */
    public function getAllCategories()
    {
        $categories = Category::all();
        return $categories->toJson();
    }

    /**
     *
     * Add Category Handler
     * @param Request $request
     * @return \Illuminate\Http\Redirect
     */
    public function addHandler(StoreCategoryRequest $categoryRequest)
    {
        $request = $categoryRequest->except(['_token','image']);
        $category = Category::create($request);
        $id = $category->id;
        $file = $categoryRequest->file('image');
        $image = new Image();
        $filename = $image->uploadImage($file);
        if($filename)
        {
            Category::where('id', $id)->update(['image' => $filename]);
        }
        return redirect()->route('update-category',['id' => $id]);
    }


/**
     *  Update Category
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $id = (int)$id;
        $parentCategory = Category::all()->pluck('title','id');
        $category = Category::where('id',$id)->firstOrFail();
        return view('category.add', compact('category','parentCategory'));
    }


    /**
     *
     * Update Category Handl
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Redirect
     */
    public function updateHandler($id, UpdateCategoryRequest $request)
    {
        $id = (int)$id;
        $categoryRequest = $request->except(['_token','image']);
        Category::where('id', $id)->update($categoryRequest);
        $file = $request->file('image');
        $image = new Image();
        $filename = $image->uploadImage($file);
        if($filename)
        {
            $oldImage = Category::where('id', $id)->firstOrFail();
            if(file_exists("../public/images/upload/".$oldImage->image))
            {
                unlink("../public/images/upload/".$oldImage->image);
            }
            Category::where('id', $id)->update(['image' => $filename]);
        }
        return redirect()->route('wacker');
    }


    /**
     *
     * Show List Category
     *
     * @return \Illuminate\Http\Response
     */
    public function showList($id=0)
    {
        $id = (int)$id;
        if($id == 0)
        {
            $categories = Category::whereNull('parent')->get();
        }
        else
        {
            $categories = Category::where('parent',$id)->get();
        }
        $products = Product::where('category_id',$id)->paginate(10);
        return view('category.list', compact('categories','products'));
    }

    /**
     *
     * Delete Category
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::find($id);
        //$childrenCategories = Category::where('parent',$id);
        $category->delete();
        return redirect()->back();
    }

    /*private function findChildrenCategories($id) {
        $categories= Category::where('parent',$id)->get();
        if(!$category) {
            return true;
        }
        foreach ($categories as $category)
        {
            $this->deleteChildrenProducts($category->id);
            findChildrenCategories($category->$id);
            $category->delete();
        }
    }*/

    /*private function deleteChildrenProducts($id)
    {
        $products = Product::where('category_id',$id);
        foreach ($products as $product) {
            $product->delete();
        }
    }*/
}
