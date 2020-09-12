<?php

use App\Models\Designer;
use App\Models\Product;
use App\Models\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'https://modsvar.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * @return User
     */
    public function createUser($data = [])
    {
        return factory(User::class)->create($data);
    }

    /**
     * @return User
     */
    public function createAdmin($data = [])
    {
        $data['role'] = 'admin';

        return factory(User::class)->create($data);
    }

    /**
     * @param array $data
     * @return Designer
     */
    public function createDesigner($data = [])
    {
        return factory(Designer::class)->create($data);
    }

    public function createProduct($data = [], $designer = null)
    {
        if (is_null($designer)) {
            $designer = $this->createDesigner();
        }
        $data['designer_id'] = $designer->id;
        return factory(Product::class)->create($data);
    }
}
