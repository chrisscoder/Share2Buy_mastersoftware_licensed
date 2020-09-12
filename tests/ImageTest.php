<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;

class ImageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function can_see_image()
    {
        $product = $this->createProduct(['headerImage' => 'product.jpg']);
        $url = str_replace($this->baseUrl, '', $product->image('headerImage'));
        $file = resource_path('tests/product.jpg');
        $destination = public_path('upload/product/product.jpg');
        copy($file, $destination);

        $this->visit($url)
            ->assertResponseOk();

        if (Storage::disk('upload')->exists('product/product.jpg')) {
            Storage::disk('upload')->delete('product/product.jpg');
        }
    }

    /**
     * @test
     */
    public function can_not_see_image()
    {
        $product = $this->createProduct(['headerImage' => 'product.jpg']);
        $url = str_replace($this->baseUrl, '', $product->image('headerImage'));

        $this->get($url)
            ->assertResponseStatus(404);
    }
}
