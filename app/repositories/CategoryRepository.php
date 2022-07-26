<?php


namespace App\repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        return DB::transaction(function () use ($attributes) {
            $category=$this->model->create([
                'name'=>$attributes['name']
            ]);
            if (isset($attributes['parent'])){
                info('parent Exist');
                info($attributes['parent']);
                $parentCategory=Category::find($attributes['parent']);
                info('$parentCategory');
                info($parentCategory);
                if ($parentCategory){
                    $category->parent()->associate($parentCategory);
                    $category->save();
                }
            }

            return $category;
        });

    }

    public function getByName($name)
    {
        return  Category::where('name',$name)->first();
    }

    public function getCategoriesNames()
    {
        return Category::all(['name'])->map(function ($category){
            return $category->name;
        })->toArray();
    }

    public function getIdsByNames($names)
    {
        return Category::query()->whereIn('name',$names)->get('id')
            ->map(function ($category){return $category->id;})->toArray();
    }
}
