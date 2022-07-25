<?php


namespace App\services;


use App\repositories\BaseRepository;
use App\repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class ProductService extends BaseService implements ProductServiceInterface
{
    public function __construct(ProductRepository $baseRepository)
    {
        parent::__construct($baseRepository);
    }

    public function create(array $attributes): Model
    {
        $file = $attributes['image']->store('public/documents');
        info($file);
        $attributes['image']=$file;
        return parent::create($attributes); // TODO: Change the autogenerated stub
    }
}
