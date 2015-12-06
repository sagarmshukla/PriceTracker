<?php

namespace Trackyourprice\Product;

use Illuminate\Support\Facades\Config;
use Sunra\PhpSimple\HtmlDomParser;

class PriceFinder
{
    public function flipkart($url)
    {
        $htmlOutput = $this->curl_download($url);
        $html  = HtmlDomParser::str_get_html($htmlOutput);

//        dd($html->find(config('store-mappings.flipkart.price'), 0));

        if($html->find('.selling-price', 0)){
            $price = trim(str_replace("Rs. ", "", $html->find('.selling-price', 0)->plaintext));
        }

        if($html->find('.productImage')){
            $element = $html->find('.productImage', 0);
            $imageUrl = $element->attr['data-src'];
        }

        if($html->find('.title-wrap', 0)){
            $name = trim(str_replace("", "", $html->find('.title-wrap', 0)->plaintext));
        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl,
            'name' => $name
        ];

        return $productInformation;

    }

    public function amazon($url)
    {
        $htmlOutput = $this->curl_download($url);
        $html  = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('.a-size-medium', 0)){
            $price = trim(str_replace("CDN$ ", "", $html->find('.a-size-medium', 0)->plaintext));
        }

        if($html->find('.a-size-large', 0)){
            $name = trim(str_replace("", "", $html->find('.a-size-large', 0)->plaintext));
        }

        if($html->find('#landingImage', 0)->getAttribute('data-old-hires')){
            $imageUrl = $html->find('#landingImage', 0)->getAttribute('data-old-hires');
        }


        $productInformation = [
            'price' => $price,
            'image' => $imageUrl,
            'name' => $name
        ];

        return $productInformation;
    }

    public function trackyourprice($url)
    {
        $htmlOutput = $this->curl_download($url);
        $html  = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('b', 0)){
            $price = trim(str_replace("CDN$ ", "", $html->find('b', 0)->plaintext));
        }

        if($html->find('h1', 0)){
            $name = trim(str_replace("", "", $html->find('h1', 0)->plaintext));
        }

        if($html->find('img', 0)->src){
            $imageUrl = $html->find('img', 0)->src;
        }


        $productInformation = [
            'price' => $price,
            'image' => $imageUrl,
            'name' => $name
        ];

        return $productInformation;
    }

    public function bestbuy($url)
    {
        $htmlOutput = $this->curl_download($url);
        $html  = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('#ctl00_CP_ctl00_PD_lblProductTitle', 0)){
            $name = trim($html->find('#ctl00_CP_ctl00_PD_lblProductTitle', 0)->plaintext);
        }

        if($html->find('.amount', 0)){
            $price = trim(str_replace("$", "", $html->find('.amount', 0)->plaintext));
        }

        $imageUrl = 'http://www.bestbuy.ca/'.$html->find('.product-image', 0)->src;

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl,
            'name' => $name
        ];

        return $productInformation;

    }

    public function snapdeal($url)
    {
        $htmlOutput = $this->curl_download($url);
        $html  = HtmlDomParser::str_get_html($htmlOutput);


        if($html->find('.payBlkBig', 0)){
            $price = trim(str_replace("", "", $html->find('.payBlkBig', 0)->plaintext));

        }

        if($html->find('.pdp-e-i-head', 0)){
            $name = trim(str_replace("", "", $html->find('.pdp-e-i-head', 0)->plaintext));

        }


        if($html->find('.jqzoom')){
            $element = $html->find('.jqzoom', 0);
            $imageUrl = $element->attr['src'];

        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl,
            'name' => $name
        ];

        return $productInformation;

    }

    public function printvenue($url)
    {
        $htmlOutput = $this->curl_download($url);
        $html  = HtmlDomParser::str_get_html($htmlOutput);


        if($html->find('#upsell-price', 0)){
            $price = trim(str_replace("", "", $html->find('#upsell-price', 0)->plaintext));
        }


        if($html->find('#overlay_mobile-skin-moto-g-2nd-gen img')){
            $element = $html->find('#overlay_mobile-skin-moto-g-2nd-gen img', 0);
            $imageUrl = $element->attr['src'];
        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl
        ];

        return $productInformation;

    }

//    public function paytm($url)
//    {
//        $htmlOutput = $this->curl_download($url);
//        $html  = HtmlDomParser::str_get_html($htmlOutput);
//
//
//        if($html->find('.text', 0)){
//            $price = trim(str_replace("", "", $html->find('.text', 0)->plaintext));
//            dd($price);
//        }
//
//
////        if($html->find('#overlay_mobile-skin-moto-g-2nd-gen img')){
////            $element = $html->find('#overlay_mobile-skin-moto-g-2nd-gen img', 0);
////            $imageUrl = $element->attr['src'];
////            dd($imageUrl);
////        }
//
//    }

    public function shopclues($url){
        $htmlOutput = $this->curl_download($url);
        $html = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('.price')){
            $price = trim(str_replace("Deal Price:Rs.","", $html->find('.price', 0)->plaintext));
        }

        if($html->find('.img')){
            $element = $html->find('.img', 0);
            $imageUrl = $element->attr['src2'];
        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl
        ];

        return $productInformation;
    }

    public function ebay($url){
        $htmlOutput = $this->curl_download($url);
        $html = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('.notranslate')){
            $price = trim(str_replace("Rs. ","", $html->find('.notranslate', 0)->plaintext));
        }

        if($html->find('#itemTitle')){
            $name = trim(str_replace("", "", $html->find('#itemTitle', 0)->plaintext));
        }

        if($html->find('#icImg')){
            $element = $html->find('#icImg', 0);
            $imageUrl = $element->attr['src'];
        }

        $productInformation = [
            'price' => $price,
            'name' => $name,
            'image' => $imageUrl
        ];

        return $productInformation;
    }

    public function mobilestore($url){
        $htmlOutput = $this->curl_download($url);
        $html = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('.price')){
            $price = trim(str_replace("Rs.","", $html->find('.price', 0)->plaintext));
        }

        if($html->find('#image')){
            $element = $html->find('#image', 0);
            $imageUrl = $element->attr['src'];
        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl
        ];

        return $productInformation;
    }

    public function shopmonk($url){
        $htmlOutput = $this->curl_download($url);
        $html = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('.price_now')){
            $price = trim(str_replace("&#8377; ","", $html->find('.price_now', 0)->plaintext));
        }

        if($html->find('.product_main_img')){
            $element = $html->find('.product_main_img', 0);
            $imageUrl = 'https://www.shopmonk.com'.$element->attr['src'];
        }

        if($html->find('.product_name_head')){
            $name = trim(str_replace("","", $html->find('.product_name_head', 0)->plaintext));
        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl,
            'name' => $name
        ];

        return $productInformation;
    }

    public function croma($url){
        $htmlOutput = $this->curl_download($url);
        $html = HtmlDomParser::str_get_html($htmlOutput);

        if($html->find('h2')){
            $price = trim(str_replace("Rs. ","", $html->find('h2', 0)->plaintext));
        }

        if($html->find('.productImage img')){
            $element = $html->find('.productImage img ', 0);
            $imageUrl = 'http://www.cromaretail.com/'.$element->attr['src'];
        }

        $productInformation = [
            'price' => $price,
            'image' => $imageUrl
        ];

        return $productInformation;
    }



    function curl_download($Url){

        // is cURL installed yet?
        if (!function_exists('curl_init')){
            die('Sorry cURL is not installed!');
        }

        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();

        // Now set some options (most are optional)

        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $Url);

        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com");

        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.152 Safari/537.22");

        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Follows the location the site redirects you to
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // SSL certificate info
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        // Download the given URL, and return output
        $output = curl_exec($ch);

        // Close the cURL resource, and free system resources
        curl_close($ch);

        return $output;
    }

}