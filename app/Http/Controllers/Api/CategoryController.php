<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if($category)
            return new CategoryResource($category);
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->createCategory($data);
        return eturn (new CategoryResource($category))->response()->setStatusCode(201);;
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->validated();
        $updated = $this->categoryService->updateCategory($id, $data);

        if ($updated) {
            return response()->json(['message' => 'Category updated successfully']);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->categoryService->deleteCategory($id);

        if ($deleted) {
            return response()->json(['message' => 'Category deleted successfully']);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }
}
