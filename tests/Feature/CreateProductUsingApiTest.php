<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateProductUsingApiTest extends TestCase
{
    public  function test_create_product_using_api_request(){
        $file = UploadedFile::fake()->image('avatar.jpg');
        $response=$this->postJson('api/products',
            [
                'name'=>'new product',
                'description'=>'new product description',
                'price'=>15.2,
                'image'=>$file
            ]
        );
        $response
            ->assertStatus(201);
        Storage::assertExists('public/products/images/'.$file->hashName());
    }
}
