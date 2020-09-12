<?php

use App\Models\DynamicPage;
use App\Models\FeaturedProduct;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function can_view_page()
    {
        $page = $this->createPage(['intro' => 'Test intro']);

        $this->visit($page->slug)
            ->see('Test intro');
    }

    /**
     * @test
     */
    public function can_view_static_page()
    {
        $this->visit('faq')
            ->see('FAQ - How it works');
    }

    /**
     * @test
     */
    public function can_view_static_page_with_page_specific_method()
    {
        $this->visit('join')
            ->see('Join our team of great designers');
    }

    /**
     * @test
     */
    public function can_view_frontpage()
    {
        $start_date = \Carbon\Carbon::yesterday();
        $end_date = $start_date->copy()->addDays(14);
        $designer = $this->createDesigner();
        $page = $this->createProduct([
            'title' => 'Test Product',
            'start_date' => $start_date,
            'end_date' => $end_date,
        ], $designer);
        factory(FeaturedProduct::class)->create(['product_id' => $page->id, 'priority' => 0]);

        $this->visit('/')
            ->see($page->title);
    }

    /**
     * @test
     */
    public function can_view_page_create()
    {
        $user = $this->createAdmin();
        $this->actingAs($user)
            ->visit('admin/pages/create')
            ->assertResponseOk();
    }

    /**
     * @test
     */
    public function can_not_view_page_create()
    {
        $user = $this->createUser();
        $this->actingAs($user)
            ->get('admin/pages/create')
            ->seeStatusCode(403);
    }

    /**
     * @test
     */
    public function can_create_page()
    {
        $user = $this->createAdmin();
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);

        $this->actingAs($user)
            ->visit('admin/pages/create')
            ->attach($file, 'image')
            ->type('Page title', 'title')
            ->type('Page into', 'intro')
            ->type('Page body', 'body')
            ->type('top', 'menu_place')
            ->type('Menu title', 'menu_title')
            ->press('Opret side')
            ->seePageIs('admin/pages');

        $page = DynamicPage::first();

        if (Storage::disk('upload')->exists('page/' . $page->image1)) {
            Storage::disk('upload')->delete('page/' . $page->image1);
        }

        $this->seeInDatabase('dynamic_pages', ['title' => 'Page title']);
    }

    /**
     * @test
     */
    public function can_view_edit_page()
    {
        $user = $this->createAdmin();
        $page = $this->createPage();

        $this->actingAs($user)
            ->visit('admin/pages/'.$page->id.'/edit')
            ->assertResponseOk();
    }

    /**
     * @test
     */
    public function can_edit_page()
    {
        $user = $this->createAdmin();
        $page = $this->createPage();
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);

        $this->actingAs($user)
            ->visit('admin/pages/'.$page->id.'/edit')
            ->type('New page title', 'title')
            ->attach($file, 'image')
            ->press('Opdater side')
            ->seePageIs('admin/pages');

        $page = DynamicPage::first();

        if (Storage::disk('upload')->exists('page/' . $page->image1)) {
            Storage::disk('upload')->delete('page/' . $page->image1);
        }

        $this->notSeeInDatabase('dynamic_pages', ['title' => 'new page title']);
    }

    /**
     * @test
     */
    public function can_delete_page()
    {
        $user = $this->createAdmin();
        $page = $this->createPage();

        $this->actingAs($user)
            ->visit('admin/pages/'.$page->id.'/delete')
            ->seePageIs('admin/pages');

        $this->notSeeInDatabase('dynamic_pages', ['title' => $page->title]);
    }

    /**
     * @param array $data
     * @return DynamicPage
     */
    private function createPage($data = [])
    {
        return factory(DynamicPage::class)->create($data);
    }
}
