<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Subcategory\StoreSubcategoryRequest;
use App\Http\Requests\Subcategory\UpdateSubcategoryRequest;
use App\Services\SubcategoryService;
use App\Http\Resources\Category\SubCategoryResource;

class SubcategoryController extends Controller
{
    private $subcategoryService;

    public function __construct(SubcategoryService $subcategoryService)
    {
        $this->subcategoryService = $subcategoryService;
    }

    public function index()
    {
        return SubcategoryResource::collection($this->subcategoryService->getAll());
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $subcategory = $this->subcategoryService->create($request->validated());
        return (new SubcategoryResource($subcategory))->response()->setStatusCode(201);;
    }

    public function show($id)
    {
        $subcategory = $this->subcategoryService->getById($id);
        if($subcategory)
            return new SubcategoryResource($subcategory);
        return response()->json(['message' => 'Subcategory not found']);
    }

    public function update(UpdateSubcategoryRequest $request, $id)
    {
        $this->subcategoryService->update($id, $request->validated());
        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $this->subcategoryService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
