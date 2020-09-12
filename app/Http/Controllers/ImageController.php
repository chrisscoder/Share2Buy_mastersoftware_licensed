<?php

namespace App\Http\Controllers;

use App\Core\Image\Templates\Blog\CoverLarge;
use App\Core\Image\Templates\Blog\CoverMedium;
use App\Core\Image\Templates\Blog\CoverSmall;
use App\Core\Image\Templates\Blog\HeroLarge;
use App\Core\Image\Templates\Blog\HeroMedium;
use App\Core\Image\Templates\Blog\HeroSmall;
use App\Core\Image\Templates\Designer\Original as DesignerOriginal;
use App\Core\Image\Templates\Designer\Large as DesignerLarge;
use App\Core\Image\Templates\Designer\LargeCropped as DesignerLargeCropped;
use App\Core\Image\Templates\Designer\Medium as DesignerMedium;
use App\Core\Image\Templates\Designer\MediumCropped as DesignerMediumCropped;
use App\Core\Image\Templates\Designer\Small as DesignerSmall;
use App\Core\Image\Templates\Designer\SmallCropped as DesignerSmallCropped;
use App\Core\Image\Templates\Page\Large as PageLarge;
use App\Core\Image\Templates\Page\Medium as PageMedium;
use App\Core\Image\Templates\Page\Original as PageOriginal;
use App\Core\Image\Templates\Product\Original as ProductOriginal;
use App\Core\Image\Templates\Product\Large as ProductLarge;
use App\Core\Image\Templates\Product\Medium as ProductMedium;
use App\Core\Image\Templates\Product\Small as ProductSmall;
use App\Core\Image\Templates\Product\LargeSquare as ProductLargeSquare;
use App\Core\Image\Templates\Product\MediumSquare as ProductMediumSquare;
use App\Core\Image\Templates\Product\SmallSquare as ProductSmallSquare;
use App\Core\Image\Templates\Product\Thumb as ProductThumb;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * @var mixed
     */
    private $lifetime;

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->lifetime = config('imagecache.lifetime');
    }

    /**
     * @param $file
     * @param $filter
     * @return Image
     */
    public function cache($file, $filter)
    {
        $image = Image::cache(function ($image) use ($file, $filter) {
            $image->make($file)->filter(new $filter())->encode('',75);
        }, $this->lifetime);

        return $image;
    }

    /**
     * @return array
     */
    public function filters()
    {
        return [
            'designer.original' => DesignerOriginal::class,
            'designer.small.1:1' => DesignerSmallCropped::class,
            'designer.medium.1:1' => DesignerMediumCropped::class,
            'designer.large.1:1' => DesignerLargeCropped::class,
            'page.large' => PageLarge::class,
            'page.medium' => PageMedium::class,
            'page.original' => PageOriginal::class,
            'product.original' => ProductOriginal::class,
            'product.small.16:9' => ProductSmall::class,
            'product.medium.16:9' => ProductMedium::class,
            'product.large.16:9' => ProductLarge::class,
            'product.thumb' => ProductThumb::class,
            'product.small.1:1' => ProductSmallSquare::class,
            'product.medium.1:1' => ProductMediumSquare::class,
            'product.large.1:1' => ProductLargeSquare::class,
            'blog.large.1:1' => CoverLarge::class,
            'blog.medium.1:1' => CoverMedium::class,
            'blog.small.1:1' => CoverSmall::class,
            'blog.large.16:9' => HeroLarge::class,
            'blog.medium.16:9' => HeroMedium::class,
            'blog.small.16:9' => HeroSmall::class,
        ];
    }

    /**
     * @param $type
     * @param $size
     * @param $file
     * @return Response
     */
    public function image($type, $size, $file)
    {
        $filterExists = array_key_exists($type.'.'.$size, $this->filters());
        if (!Storage::disk('upload')->exists($type. '/' . $file) || !$filterExists) {
            abort(404);
        }

        // Get the requested template size for filter
        $filter = $this->filters()[$type.'.'.$size];

        $file = public_path('upload/' . $type . '/' . $file);
        $image = $this->cache($file, $filter);

        return $this->response($image);
    }

    /**
     * @param $image
     * @return Response
     */
    public function response($image)
    {
        return new Response($image, 200, [
            'Content-Type' => 'image/jpeg',
            'Cache-Control' => 'max-age='.$this->lifetime.', public',
            'Etag' => md5($image)
        ]);
    }
}
