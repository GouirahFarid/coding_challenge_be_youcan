<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\services\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService=$productService;
    }
    public  function create(CreateProductRequest $request){
        return new ProductResource($this->productService->create($request->validated()));
    }

    public  function delete(Request $request){
        return $this->productService->delete($request->productId);
    }
    public  function all(){
        return ProductResource::collection($this->productService->all());
    }

}
