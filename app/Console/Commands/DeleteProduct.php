<?php

namespace App\Console\Commands;

use App\services\ProductServiceInterface;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{

    protected $signature = 'delete:product';

    protected $description = 'Delete Product';

    public function handle(ProductServiceInterface  $productService)
    {
        $products = $productService->getNames();
        if (count($products)>0){
            array_unshift($products, 'no one(default)');
            $choice = $this->choice(
                'Witch product you wanna delete?',
                $products,
                0,
                $maxAttempts = null,
                $allowMultipleSelections = false
            );
            $product = $productService->getByName($choice);
            if ($product)
                $productService->delete($product->id);
        }else{
            $this->info('there is no product right now');
        }
    }
}
