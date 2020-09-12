<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Calculation
|--------------------------------------------------------------------------
*/

/**
 * Calc continious percentage based on order quantity and vars set by the designer
 * @param  integer  $orderQuantity
 * @param  integer $productQuantity     defaults to 10
 * @param  integer $pctBase             defaults to 15
 * @param  integer $pctFinal            defaults to 35
 * @return float $pct                   returns the current percentage
 */
function currentPct($orderQuantity, $productQuantity = 10, $pctBase = 15, $pctFinal = 35)
{

  $pct = $pctBase;
  $prevPct = $pctBase;
  $pctDiff = $pctFinal - $pctBase;

  if (!empty($orderQuantity)) {
    if ($orderQuantity == 0) {
      $pct = $pctBase;
    } elseif ($orderQuantity != 0 && ($orderQuantity <= $productQuantity - 1)) {
      for ($i=0; $i < $orderQuantity; $i++) {
        $pct = $prevPct + ($pctDiff / ($productQuantity - 1));
        $prevPct = $pct;
      }
    } else {
      $pct = $pctFinal; //pct can't be greater than the final pct
    }
  }

  return $pct;
}

/**
 * Calc commission
 * @param  float $initialPrice
 * @param  float $commission
 * @return float               returns the commission
 */
function commission($initialPrice, $commission = 0.07)
{
  return $initialPrice * $commission;
}

/**
 * Calc price with discount
 * @param  float $initialPrice
 * @param  float $pct
 * @return float               returns the price
 */
function price($initialPrice, $pct)
{
  return $initialPrice * (1 - ($pct / 100));
}

/**
 * Calc price inc. commission
 * @param  float $initialPrice
 * @param  float $pct
 * @return float               return price with commission
 */
function priceIncCommision($initialPrice, $pct)
{
  return price($initialPrice, $pct) + commission($initialPrice);
}

/**
 * Calc discount
 * @param  float $initialPrice
 * @param  float $currentPrice
 * @return float               return amount saved
 */
function discount($initialPrice, $currentPrice)
{
  return $initialPrice - $currentPrice;
}

/**
 * Calculate VAT
 * @param  float $value
 * @param  float $vat   use constant
 * @return float        calculated vat
 */
function calcVat($value, $vat) {
    return $value-($value*(1-$vat));
}

/*
|--------------------------------------------------------------------------
| Logic
|--------------------------------------------------------------------------
*/

/**
 * [buyable description]
 * @param  [type] $startDate [description]
 * @return [type]            [description]
 */
function ProductState($today, $start_date, $end_date, $orders, $maxOrders = 10) {
  $startDate = date('Y-m-d H:i', strtotime($start_date));
  $endDate = date('Y-m-d H:i', strtotime($end_date));


  $state['buyable'] = true;
  $state['active'] = false;

  if ($today > $startDate && $today > $endDate) {
    $state['buyable'] = false;
  }

  if (($today > $startDate) && ($today < $endDate) && $orders < $maxOrders) {
      $state['active'] = true;
  }

  return $state;
}

/*
|--------------------------------------------------------------------------
| Image
|--------------------------------------------------------------------------
*/

/**
 * Make Image vatiants
 * @param  string $filename
 * @param  int $width
 * @param  int $height
 * @return new image path
 */
function makeImageVariant($filename, $width, $height=null) {

  if (substr($filename, 0, 1) === '/') {
    $filename = substr($filename, 1);
  }

  $newPath = generateImageName($filename,$width,$height);

  $img = Image::make(public_path() . '/' . $filename);

  if($height) {
    $img->resize($width, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->crop($width,$height)->save($newPath);
  } else {
    $img->resize($width, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($newPath);
  }
  return $newPath;
}
/**
 * Generate image name
 * Explode filename and extension based on the period and concatenate with width and height
 * @param  string $path
 * @param  int $width
 * @param  int $height
 * @return new path
 */
function generateImageName($path, $width, $height=null) {

  $pathArr = explode(".",$path);

  if(count($pathArr)>1) {
    if($height) {
      $returnPath = $pathArr[0] . '_w_'. $width .'_h_' . $height.'.'.$pathArr[1];
    } else {
      $returnPath = $pathArr[0] . '_w_'. $width .'.'.$pathArr[1];
    }
  } else {
    $returnPath = $path;
  }

  return $returnPath;

}

/**
 * Generate international and SEO friendly filenames
 * @param  string $path to file
 * @return string       seo friendly path to file
 */
function generateFileSlug($path) {

  $path = str_replace(' ', '-', strtolower($path)); // Replace spaces with hyphens
  $path = preg_replace('/-+/', '-', $path); // Replaces multiple hyphens with single one.

  return $path;
}

/**
 * Generate unique file name
 * @param  file $image [description]
 * @return string        seo friendly filename
 */
function generateUniqueFileName($image) {
  // Get Image name and format it
  $fileExtension = $image->getClientOriginalExtension();
  $filename = str_replace('.'.$fileExtension, '' , $image->getClientOriginalName());
  $filename = URLify::filter ($filename, 60, "", true); // Transliterate symbols for file name
  $filename = str_replace(' ', '-', strtolower($filename)); // Replace spaces with hyphens
  $filename = preg_replace('/-+/', '-', $filename); // Replaces multiple hyphens with single one.

  // Create filename from formated original filename, time and file extension
  $filename = $filename . '-'. time() . '.' . strtolower($fileExtension);

  return $filename;
}

/**
 * Generate alt description based on image name.
 * @param  string $filename
 * @return string
 */
function generateAlt($filename) {

  $alt = preg_replace('/.[A-Za-z]{3,4}$/','',$filename); // Remove filename
  $alt = preg_replace('/[0-9]+/','',$alt); // Remove time
  $alt = str_replace('-', ' ', $alt); // Replace spaces with hyphens
  $alt = preg_replace('/[ \t]+$/','',$alt); // Remove trailing spaces

  return $alt;
}

/**
 * @param UploadedFile $file
 * @return string
 */
function generateFilename(UploadedFile $file)
{
    $extension = $file->getClientOriginalExtension();
    $filename = $file->getClientOriginalName();
    $filename = str_replace('.' . $extension, '', $filename);
    $time = microtime(true)*1000;
    $filename = Slugify::slugify($filename);

    return sprintf('%s-%d.%s', $filename, $time, $extension);
}

/**
 * @param UploadedFile $file
 * @return string
 */
function generateFilenameFromField($file)
{
    $name = pathinfo($file, PATHINFO_FILENAME);
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $name = preg_replace('/[0-9]{10}/','',$name); // Remove time
    $name = Slugify::slugify($name);
    $time = microtime(true)*1000;


    return sprintf('%s-%d.%s', $name, $time, $extension);
}

/*
|--------------------------------------------------------------------------
| FORMATING
|--------------------------------------------------------------------------
*/

function custom_truncate($text, $length) {
  if(strlen($text) > $length) {
      $text = substr($text, 0, strrpos($text,' ', $length - strlen($text)-3)) . '...';
  }
  return $text;
}

/*
|--------------------------------------------------------------------------
| DIVERSE
|--------------------------------------------------------------------------
*/
function aasort(&$array, $key)
{
    $sorter = [];
    $ret = [];
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii] = $va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii] = $array[$ii];
    }
    $array = $ret;
}

/**
 * @param $message
 */
function flash_message($message)
{
    Session::flash('message', $message);
}

/**
 * @param $date
 * @param string $format
 * @return string
 */
function format_date($date, $format = 'd/m/Y H:i')
{
    $date = \Carbon\Carbon::parse($date);

    return $date->format($format);
}

/**
 * @param $route
 * @param $sort
 * @param string $order
 * @return string
 */
function sortedRoute($route, $sort, $order = 'asc')
{
    $orders = ['asc', 'desc'];

    if ($sort == request('sort') && request('order')) {
        $order = array_diff($orders, [request('order')]);
        $order = current($order);
    }

    return route($route, compact('sort', 'order'));
}
