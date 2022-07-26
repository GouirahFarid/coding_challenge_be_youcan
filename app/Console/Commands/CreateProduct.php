<?php

namespace App\Console\Commands;

use App\services\CategoryServiceInterface;
use App\services\ProductServiceInterface;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(CategoryServiceInterface $categoryService,ProductServiceInterface $productService)
    {
        $name = $this->ask('What is  the product name?');
        $description = $this->ask('What is  the product description?');
        $price = $this->ask('What is  the product price?');
        $image = $this->ask('Add product image url');
        $categories=$categoryService->getCategoriesNames();
        $SelectedCategories=[];
        if (count($categories)>0){
            array_unshift($categories,'no category(default)');
            $choices = $this->choice(
                'witch categories will contain this product (multi choices seperated with comma (,)',
                $categories,
                0,
                $maxAttempts = null,
                $allowMultipleSelections = true
            );
            $SelectedCategories=$categoryService->getIdsByNames($choices);
        }
        if (count($SelectedCategories)>0)
            $productService->create(
                [
                    'name'=>$name,
                    'description'=>$description,
                    'price'=>doubleval($price),
                    'image'=>$image,
                    'categories'=>$SelectedCategories
                ]);
        else
            $productService->create(
                [
                    'name'=>$name,
                    'description'=>$name,
                    'price'=>doubleval($name),
                    'image'=>$image
                ]);
    }
}
