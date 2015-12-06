<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 13/08/15
 * Time: 6:11 PM
 */

namespace Trackyourprice\Product;


class CheckUrl {
    function checkurl($urlname){
        /**
         * Flipkart Logic
         *
         * */
        if(stripos("x".$urlname, "flipkart")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'flipkart';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'flipkart';
            }

        }

        /**
         * Amazon Logic
         *
         * */
        if(stripos("x".$urlname, "amazon")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];
                return 'amazon';

            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'amazon';
            }

        }

        /**
         * Amazon Logic
         *
         * */
        if(stripos("x".$urlname, "trackyourprice")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];
                return 'trackyourprice';

            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'trackyourprice';
            }

        }
        /**
         * Best Buys Logic
         *
         * */
        if(stripos("x".$urlname, "bestbuy")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];
                return 'bestbuy';

            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'bestbuy';
            }

        }

        /**
         * Snapdeal Logic
         *
         * */
        if(stripos("x".$urlname, "snapdeal")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'snapdeal';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'snapdeal';
            }

        }

        /**
         * Shopclues Logic
         *
         * */
        if(stripos("x".$urlname, "shopclues")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'shopclues';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'shopclues';
            }

        }

        /**
         * Ebay Logic
         *
         * */
        if(stripos("x".$urlname, "ebay")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'ebay';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'ebay';
            }

        }

        /**
         * Mobilestore Logic
         *
         * */
        if(stripos("x".$urlname, "mobilestore")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'mobilestore';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'mobilestore';
            }

        }

        /**
         * shopmonk Logic
         *
         * */
        if(stripos("x".$urlname, "shopmonk")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'shopmonk';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'shopmonk';
            }

        }

        /**
         * croma Logic
         *
         * */
        if(stripos("x".$urlname, "cromaretail")>='1'){
            $urlarray = parse_url($urlname);
            if (isset($urlarray['host'])) {
                $cleanurl = "http://".$urlarray['host'].$urlarray['path'];

                return 'croma';
            }else{
                $cleanurl = "http://www.".$urlarray['path'];

                return 'croma';
            }

        }
    }
}