<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\repositories\CategoryRepository;
use App\repositories\CategoryRepositoryInterface;
use App\services\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService=$categoryService;
    }
    public  function create(CreateCategoryRequest $request){
        return $this->categoryService->create($request->all());
    }
    public function all(){
        return CategoryResource::collection($this->categoryService->all());
    }
    public  function delete(Request $request){
        return $this->categoryService->delete($request->categoryId);
    }

}
