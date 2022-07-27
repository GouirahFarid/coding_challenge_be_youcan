<?php

namespace App\Console\Commands;

use App\services\CategoryService;
use App\services\CategoryServiceInterface;
use Illuminate\Console\Command;

class CreateCategory extends Command
{

    protected $signature = 'create:category';

    protected $description = 'create new category';

    public function handle(CategoryServiceInterface $categoryService)
    {
        $name = $this->ask('What is  the category name?');
        $categories=$categoryService->getNames();
        $category=null;
        if (count($categories)>0){
            array_unshift($categories,'no parent(default)');
            $choice = $this->choice(
                'who is the parent of this category',
                $categories,
                0,
                $maxAttempts = null,
                $allowMultipleSelections = false
            );
            $category=$categoryService->getByName($choice);
        }
        if ($category)
            $categoryService->create(['name'=>$name,'parent'=>$category->id]);
        else
            $categoryService->create(['name'=>$name]);
    }
}
