<?php


namespace App\services;


use App\repositories\BaseRepository;
use App\repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductService extends BaseService implements ProductServiceInterface
{
    public function __construct(ProductRepository $baseRepository)
    {
        parent::__construct($baseRepository);
    }

    public function create(array $attributes): Model
    {
        $path='';
        if (is_string($attributes['image'])){
            $file=new File($attributes['image']);
            info($file->extension());
            if (in_array($file->extension(),['png','jpg'])){
                $path = Storage::putFile('public/products/images',$file );
            }
        }else{
            $path = $attributes['image']->store('public/products/images');
        }
        $attributes['image']=$path;
        return parent::create($attributes);
    }
}
