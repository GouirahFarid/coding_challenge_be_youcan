<?php

namespace App\Console\Commands;

use App\services\CategoryServiceInterface;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete category';


    public function handle(CategoryServiceInterface $categoryService)
    {
        $categories = $categoryService->getCategoriesNames();
        if (count($categories)>0){
            array_unshift($categories, 'no one(default)');
            $choice = $this->choice(
                'who is the parent of this category',
                $categories,
                0,
                $maxAttempts = null,
                $allowMultipleSelections = false
            );
            $category = $categoryService->getByName($choice);
            if ($category)
                $category->delete();
        }else{
            $this->info('there is no category right now');
        }

    }
}
