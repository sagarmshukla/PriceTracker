<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 17/08/15
 * Time: 12:57 PM
 */

namespace Trackyourprice;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = ['name'];

    public function getStore($id)
    {
        $store = Store::select('stores.*')->join('products','products.store_id', '=', 'stores.id')->where('products.id', $id)->first();

        return $store->name;
    }

    public function getCurrentPrice($id)
    {
        $price = Price_History::where('products_id', $id)->first();

        return $price->price;
    }

    public function getTargetPrice($id)
    {
        $targetPrice = UserPrice::select('users_price.*')->where('product_id', $id)->first();

        return $targetPrice->target_price;
    }
}
