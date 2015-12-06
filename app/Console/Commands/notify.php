<?php

namespace Trackyourprice\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Trackyourprice\Price_History;
use Trackyourprice\Product;
use Trackyourprice\Product\CheckUrl;
use Trackyourprice\Product\PriceFinder;
use Trackyourprice\User;
use Trackyourprice\User_Product;
use Trackyourprice\UserPrice;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will notify the price to the user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Product::all();

        $userProducts = User_Product::all();
        foreach($userProducts as $up)
        {
            $userPrice = UserPrice::where('product_id', $up->products_id)->first();

            $user = User::where('id', '=', $userPrice->user_id)->first();
            $product = Product::where('id', '=', $up->products_id)->first();
            $targetPrice = $userPrice->target_price;

            $checkUrl = new CheckUrl;
            $provider = $checkUrl->checkurl($product->url);

            $priceFinder = new PriceFinder();
            $productInfo = $priceFinder->$provider($product->url);

            if($productInfo['price']<=$targetPrice){
                $data = array('price' => 'The price is now lower check it please'.' '.'The link of this product is'.' '. $product->url);

                if($user){
                $subject = 'Track Your Price';
                    Mail::send('mail.price-notification', $data, function($message) use ($subject, $user) {
                        $message->to($user->email, $user->name)
                            ->subject($subject);
                    });
                }
            }
        }
    }
}
