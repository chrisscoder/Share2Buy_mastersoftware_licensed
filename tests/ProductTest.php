<?php

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function can_view_products_index()
    {
        $this->visit('products')
            ->assertResponseOk();
    }

    /**
     * @test
     */
    public function can_view_product()
    {
        $product = $this->createProduct(['title' => 'Test product']);

        $this->visit('products/'.$product->slug)
            ->see($product->title);
    }

    /**
     * @test
     */
    public function can_create_product()
    {
        $designer = $this->createDesigner();
        $user = $this->createAdmin(['designer_id' => $designer->id]);
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);

        $this->actingAs($user)->visit('admin/products')
            ->click('Create product')
            ->type('Test product', 'title')
            ->type('300', 'price')
            ->type(Carbon::yesterday()->format('d/m/Y H:i'), 'start_date')
            ->type('intro text', 'intro')
            ->type('body text', 'body')
            ->select('14', 'periode')
            ->select('home', 'category')
            ->select('other', 'type')
            ->type('size', 'type_value')
            ->attach($file, 'headerImage')
            ->attach($file, 'sectionTopImage')
            ->press('Publish Product')
            ->seePageIs('admin/dashboard');

        $product = Product::first();

        if (Storage::disk('upload')->exists('product/' . $product->headerImage)) {
            Storage::disk('upload')->delete('product/' . $product->headerImage);
        }

        if (Storage::disk('upload')->exists('product/' . $product->sectionTopImage)) {
            Storage::disk('upload')->delete('product/' . $product->sectionTopImage);
        }

        $this->seeInDatabase('products', ['title' => 'Test product']);
    }

    /**
     * @test
     */
    public function can_edit_product()
    {
        $user = $this->createAdmin();
        $product = $this->createProduct(['title' => 'Test product']);
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);

        $this->actingAs($user)
            ->visit('admin/products/' . $product->id . '/edit')
            ->type('Edited test product', 'title')
            ->type(Carbon::tomorrow()->format('d/m/Y H:i'), 'start_date')
            ->attach($file, 'headerImage')
            ->press('Update Product')
            ->seePageIs('admin/dashboard');

        $product = Product::first();

        if (Storage::disk('upload')->exists('product/' . $product->headerImage)) {
            Storage::disk('upload')->delete('product/' . $product->headerImage);
        }

        $this->seeInDatabase('products', ['title' => 'Edited test product']);
    }

    /**
     * @test
     */
    public function can_edit_campaign_product()
    {
        $user = $this->createAdmin();
        $date = Carbon::yesterday();
        $product = $this->createProduct([
            'title' => 'Test product',
            'start_date' => $date,
            'end_date' => $date->copy()->addDays(14),
        ]);

        $this->actingAs($user)
            ->visit('admin/products/' . $product->id . '/edit')
            ->type('Edited test product', 'title')
            ->press('Update Product')
            ->seePageIs('admin/dashboard');

        $this->seeInDatabase('products', ['title' => 'Edited test product']);
    }

    /**
     * @test
     */
    public function can_delete_product()
    {
        $user = $this->createAdmin();
        $product = $this->createProduct(['title' => 'Test product']);

        $this->actingAs($user)
            ->visit('admin/products/' . $product->id . '/delete')
            ->seePageIs('admin/dashboard')
            ->see('The product was deleted');

        $this->notSeeInDatabase('products', ['title' => 'Test product']);
    }
}
