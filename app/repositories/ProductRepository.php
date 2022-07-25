<?php


namespace App\repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        return DB::transaction(function () use ($attributes) {
            $product=$this->model->create([
                'name'=>$attributes['name'],
                'description'=>$attributes['description'],
                'price'=>$attributes['price'],
                'image'=>$attributes['image'],
            ]);
            if (isset($attributes['categories'])&&count($attributes['categories'])>0)
                $product->categories()->sync($attributes['categories']);
            return $product;
        });
    }
}
