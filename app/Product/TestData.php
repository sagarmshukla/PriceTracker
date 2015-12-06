<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 17/08/15
 * Time: 3:24 PM
 */

namespace Trackyourprice\Product;


class TestData {

    public function information($url)
    {


        $productInformation = [
            'price' => '50,000',
            'image' => 'http://www.planwallpaper.com/static/images/Seamless-Polygon-Backgrounds-Vol2-full_Kfb2t3Q.jpg',
            'name' => 'iphone'
        ];

        return $productInformation;

    }

}