<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::where("status", true)->get();
        return CategoryResource::collection($categories);
    }

    public function category($slug)
    {
        $category = Category::where("status", true)->where('slug', $slug)->first();
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories,title|max:255',
            'slug' => 'required|unique:categories,slug|max:255',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $category =  new Category();
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();
        return response()->json([
            "success" => true,
            "message" => "Category created successfully"
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => "required|unique:categories,title,$id|max:255",
            'slug' => "required|unique:categories,slug,$id|max:255",
            'meta_title' => 'required|max:255',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $category =  Category::find($id);
        if (!$category) {
            return response()->json([
                "success" => false,
                "message" => "Category not found"
            ]);
        }
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();
        return response()->json([
            "success" => true,
            "message" => "Category updated successfully"
        ]);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                "success" => false,
                "message" => "Category not found"
            ]);
        }
        $category->delete();
        return response()->json([
            "success" => true,
            "message" => "Category deleted successfully"
        ]);
    }
}
