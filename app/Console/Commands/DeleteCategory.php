<?php

namespace App\Console\Commands;

use App\services\CategoryServiceInterface;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{

    protected $signature = 'delete:category';

    protected $description = 'Delete category';


    public function handle(CategoryServiceInterface $categoryService)
    {
        $categories = $categoryService->getCategoriesNames();
        if (count($categories)>0){
            array_unshift($categories, 'no one(default)');
            $choice = $this->choice(
                'Witch Category you wanna delete?',
                $categories,
                0,
                $maxAttempts = null,
                $allowMultipleSelections = false
            );
            $category = $categoryService->getByName($choice);
            if ($category)
                $categoryService->delete($category->id);
        }else{
            $this->info('there is no category right now');
        }

    }
}
