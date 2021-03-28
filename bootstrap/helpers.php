<?php

//https://chasingcode.dev/blog/laravel-global-url-helpers/

/**
 * URL before:
 * https://example.com/orders/123?order=ABC009
 *
 * 1. add_query_params(['status' => 'shipped'])
 * 2. add_query_params(['status' => 'shipped', 'coupon' => 'CCC2019'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009&status=shipped
 * 2. https://example.com/orders/123?order=ABC009&status=shipped&coupon=CCC2019
 * @param array $params
 * @return string
 */
function add_query_params(array $params = [])
{
  $query = array_merge(
    request()->query(),
    $params
  ); // merge the existing query parameters with the ones we want to add

  return url()->current() . '?' . http_build_query($query); // rebuild the URL with the new parameters array
}

function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function generateEAN13Checksum($barcode)
{
  $result = $barcode;
  // Checksum
  $sum = 0;
  $weightflag = true;
  for ($i = strlen($result) - 1; $i >= 0; $i--) {
    $sum += (int)$result[$i] * ($weightflag ? 3 : 1);
    $weightflag = !$weightflag;
  }
  $result .= (10 - ($sum % 10)) % 10;
  return $result;
}

function generateEAN13($start)
{
  $digits = '0123456789';
  $digitsLength = strlen($digits);
  $result = $start;
  while (strlen($result) < 12) {
    $result .= $digits[rand(0, $digitsLength - 1)];
  }

  $result = generateEAN13Checksum($result);

  return $result;
}

function generateBarcodeImage($barcode)
{
  $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
  return base64_encode($generator->getBarcode($barcode, $generator::TYPE_EAN_13, 2, 75));
}

function sanitize_file_name(string $filename)
{
  // Remove anything which isn't a word, whitespace, number
  // or any of the following caracters -_~,;[]().
  // If you don't need to handle multi-byte characters
  // you can use preg_replace rather than mb_ereg_replace
  // Thanks @Łukasz Rysiak!
  $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
  // Remove any runs of periods (thanks falstro!)
  $filename = mb_ereg_replace("([\.]{2,})", '', $filename);

  return $filename;
}

function generate_normalization_pattern($search_string) {
  $patterns     = array( "/(ا|إ|أ|آ)/", "/(ه|ة)/" );
  // $replacements = array( "[ا|إ|أ|آ]", "[ه|ة]" );
  $replacements = array( "_", "_" );
  return preg_replace($patterns, $replacements, $search_string);
}
