<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;

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
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if($category)
            return response()->json($category);
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->createCategory($data);
        return response()->json($category, 201);
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
