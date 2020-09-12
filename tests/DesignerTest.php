<?php

use App\Models\Designer;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DesignerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function can_view_designers_index()
    {
        $designer = $this->createDesigner();
        $this->visit('designers')
            ->see($designer->title);
    }

    /**
     * @test
     */
    public function can_view_designer()
    {
        $designer = $this->createDesigner(['title' => 'Test designer']);

        $this->visit('designers/'.$designer->slug)
            ->see('Test designer');
    }

    /**
     * @test
     */
    public function can_create_designer()
    {
        $user = $this->createAdmin();
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);

        $this->actingAs($user)->visit('admin/designers')
            ->click('Create designer')
            ->type('email@example.com', 'email')
            ->type('password', 'password')
            ->type('Test designer', 'title')
            ->type('intro', 'intro')
            ->type('body', 'body')
            ->attach($file, 'image')
            ->press('Add Brand')
            ->see('Brand added')
            ->seePageIs('admin/designers');

        $designer = Designer::first();

        if (Storage::disk('upload')->exists('designer/' . $designer->image1)) {
            Storage::disk('upload')->delete('designer/' . $designer->image1);
        }

        $this->seeInDatabase('designers', ['title' => 'Test designer']);
    }

    /**
     * @test
     */
    public function can_create_designer_with_existing_user()
    {
        $user = $this->createAdmin();
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);

        $this->actingAs($user)->visit('admin/designers/add')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->type('Test designer', 'title')
            ->type('intro', 'intro')
            ->type('body', 'body')
            ->attach($file, 'image')
            ->press('Add Brand')
            ->see('Brand added')
            ->seePageIs('admin/designers');

        $designer = Designer::first();

        if (Storage::disk('upload')->exists('designer/' . $designer->image1)) {
            Storage::disk('upload')->delete('designer/' . $designer->image1);
        }

        $this->seeInDatabase('designers', ['title' => 'Test designer']);
    }

    /**
     * @test
     */
    public function can_delete_designer()
    {
        $user = $this->createAdmin();
        $designer = $this->createDesigner();
        $this->actingAs($user)
            ->visit('admin/designers/' . $designer->id . '/delete')
            ->seePageIs('admin/designers')
            ->see('Brand deleted');

        $this->notSeeInDatabase('designers', ['title' => $designer->title, 'deleted_at' => null]);
    }

    /**
     * @test
     */
    public function can_edit_designer()
    {
        $user = $this->createAdmin();
        $designer = $this->createDesigner();
        $file = new UploadedFile(resource_path('tests/designer.jpg'), 'designer.jpg', 'image/jpg', null, null, true);
        $this->actingAs($user)
            ->visit('admin/designers/'.$designer->id.'/edit')
            ->type('Updated designer', 'title')
            ->attach($file, 'image')
            ->press('Update Brand')
            ->seePageIs('admin/designers')
            ->see('Brand updated');

        $designer = Designer::first();

        if (Storage::disk('upload')->exists('designer/' . $designer->image1)) {
            Storage::disk('upload')->delete('designer/' . $designer->image1);
        }

        $this->seeInDatabase('designers', ['title' => 'Updated designer']);
    }
}
