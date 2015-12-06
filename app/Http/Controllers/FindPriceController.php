<?php

namespace Trackyourprice\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Trackyourprice\Http\Controllers\Controller;
use Trackyourprice\Price_History;
use Trackyourprice\Product\CheckUrl;
use Trackyourprice\Product\PriceFinder;
use Trackyourprice\Product;
use Trackyourprice\Product\TestData;
use Trackyourprice\Store;
use Trackyourprice\User;
use Trackyourprice\User_Product;
use Trackyourprice\UserPrice;
use Trackyourprice\UserProfile;

class FindPriceController extends Controller
{

    public function getDashboard()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        return view('dashboard.dashboard', compact('userProfile'));
    }

    public function flipkart()
    {
        $url = "http://www.flipkart.com/asus-zenfone-5/p/itme3wqubzywj3fh?pid=MOBE3HYEBFRKHRGG&al=JguGl%2FCvNkiDpf0I9z6Ad8ldugMWZuE7Qdj0IGOOVqveej0WZEny6Z7qpNxXgCbMnEFzz%2BNIw%2Bk%3D&ref=L%3A-910021456736924691&srno=b_2";

        $priceFinder = new PriceFinder;
        $result = $priceFinder->flipkart($url);



        dd($result);



    }

    /**
     *
     */
    public function amazon(){

        $url = "http://www.amazon.in/Mi-Redmi-2-White/dp/B00VEB055E/ref=sr_1_1?ie=UTF8&qid=1439465530&sr=8-1&keywords=mobile";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->amazon($url);


        dd($result);

    }

    public function snapdeal(){
        $url = "http://www.snapdeal.com/product/lenovo-a536-black/736652345";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->snapdeal($url);

        dd($result);
    }

    public function printvenue(){
        $url = "http://www.printvenue.com/customize/mobile-skin-moto-g-2nd-gen/pr-gen-y36-skmotog2ndgen-psd";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->printvenue($url);

        dd($result);

    }

    public function paytm(){
        $url = "https://paytm.com/shop/p/apple-iphone-5c-8-gb-white-MOBAPPLE-IPHONEDEAL47236E3F072DD";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->paytm($url);

        dd($result);
    }

    public function shopclues(){
        $url = "http://www.shopclues.com/htc-desire-526g-glossy-blue-1.html";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->shopclues($url);

        dd($result);
    }

    public function ebay(){
        $url = "http://www.ebay.in/itm/281760745064?_trkparms=clkid%3D8244965418629441354&_qi=RTM2158816";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->ebay($url);

        dd($result);
    }

    public function mobilestore(){
        $url = "http://www.themobilestore.in/htc-desire-326g-black.html";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->mobilestore($url);

        dd($result);
    }

    public function shopmonk(){
        $url = "https://www.shopmonk.com/nokia-x2-dual-p.php";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->shopmonk($url);

        dd($result);
    }

    public function croma(){
        $url = "http://www.cromaretail.com/Apple-iPhone-5c-32-GB-GSM-Mobile-Phone-(White)-pc-20258-97.aspx";
        $priceFinder = new PriceFinder;
        $result = $priceFinder->croma($url);

        dd($result);
    }

    public function index(){
        if (!Auth::check()) {
            return Redirect::route('login');
        }
        return view('Home.Index');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function findprice(Request $request){


        $inputUrl = $request->get('url');

        $checkUrl = new CheckUrl;
        $provider = $checkUrl->checkurl($inputUrl);

        $priceFinder = new PriceFinder();
        $productInfo = $priceFinder->$provider($inputUrl);

        //insert Data into stores table
        $store = new Store();
        $store->name = $provider;
        $store->save();

        $storeGet = Store::orderBy('id', 'desc')->first()->toArray(); //gets last inserted row


        $storeId = $storeGet['id']; //gets store id of last inserted row

        //insert Data into products table

//        $alreadyProduct = Product::select('products.*')
//                                ->join('user_product', 'user_product.products_id', '=', 'products.id')
//                                ->join('users', 'users.id', '=', 'user_product.user_id')
//                                ->where('user_product.user_id', Auth::user()->id)
//                                ->where('url', $inputUrl)
//                                ->first();

        $alreadyProduct = Product::where('url', $inputUrl)->first();

        if($alreadyProduct)
        {
            $alreadyProduct->name = $productInfo['name'];
            $alreadyProduct->image = $productInfo['image'];
            $alreadyProduct->save();
        }
        else
        {
            $product = new Product();
            $product->store_id = $storeId;
            $product->name = $productInfo['name'];
            $product->url = $inputUrl;
            $product->image = $productInfo['image'];
            $product->save();
        }

        //insert data into price_history table

        if($alreadyProduct)
        {
            $alreadyPriceHistory = Price_History::where('products_id', $alreadyProduct->id)->first();
            $alreadyPriceHistory->price = $productInfo['price'];
            $alreadyPriceHistory->save();
        }
        else
        {
            $price_history = new Price_History();
            $price_history->products_id = $product->id;
            $price_history->price = $productInfo['price'];
            $price_history->save();
        }


        $userId = Auth::user()->id;


            $user_product = new User_Product();
            $user_product->user_id = $userId;
            $user_product->products_id = ($alreadyProduct)? $alreadyProduct->id : $product->id;
            $user_product->save();


        if($alreadyProduct)
        {
            return Redirect::route('target-price', $alreadyProduct->id);
        }
        return Redirect::route('target-price', $product->id);

    }

    public function getTargetPricePage($id)
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $product = Product::where('id',$id)->first();
        if($product) {
            return view('dashboard.target-price', compact('product', 'userProfile'));
        }
        return view('errors.503');
    }

    public function postTargetPricePage($id, Request $request)
    {

        $alreadyUserPrice = UserPrice::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
        if($alreadyUserPrice)
        {
            $alreadyUserPrice->target_price = $request->get('target_price');
            $alreadyUserPrice->save();
        }
        else
        {
            $userPrice = new UserPrice();
            $userPrice->user_id = Auth::user()->id;
            $userPrice->product_id = $id;
            $userPrice->target_price = $request->get('target_price');
            $userPrice->save();
        }


        Session::flash('notify', 'We will notify you as soon as the product drops its reach up to your target price');
        return Redirect::route('dashboard');
    }

    public function getYourProducts()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $products = Product::select('products.*', 'users_price.target_price')->join('user_product', 'user_product.products_id', '=', 'products.id')
            ->join('users_price', 'users_price.product_id', '=', 'products.id')
            ->where('user_product.user_id', Auth::user()->id)->get();
        return view('dashboard.your-products', compact('products', 'userProfile'));
    }

    public function getDashboardNew()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $totalProducts = User_Product::where('user_id', '=', Auth::user()->id)->count();
        $graphDate = DB::select('SELECT DATE(created_at) as day,count(*) as v FROM user_product WHERE user_id='.Auth::user()->id.' GROUP BY DATE(created_at)');
        return view('dashboard.dashboard-new', compact('totalProducts','graphDate', 'userProfile'));
    }

    public function getUserProfile()
    {
//        $userProduct = User_Product::select('products_id')->join('products', 'products.id', '=', 'user_product.products_id')->where('user_product.user_id', Auth::user()->id)->get();
        $userProfile = UserProfile::select('*')->where('user_id', Auth::user()->id)->first();

        return view('dashboard.user-profile', compact('userProfile', 'userProduct'));
    }

    public function postUserProfileUpdate(Request $request)
    {
        $user = Auth::user();

        $rules = array(

            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = $validator->messages();
            return Redirect::route('user-profile')->withErrors($message);
        }
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->get('password')){
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $userProfile->birth_date = $request->get('birth-date');
        $userProfile->gender = $request->get('gender');
        $userProfile->save();

        Session::flash('profileUpdate', 'Your Profile is Updated Successfully..!!');
        return Redirect::route('user-profile');
    }

    public function getUpdateYourProducts()
    {
        $userProfile = UserProfile::select('*')->where('user_id', Auth::user()->id)->first();
        $products = Product::select('products.*', 'users_price.target_price')->join('user_product', 'user_product.products_id', '=', 'products.id')
            ->join('users_price', 'users_price.product_id', '=', 'products.id')
            ->where('user_product.user_id', Auth::user()->id)->get();
        return view('dashboard.update-your-products', compact('products', 'userProfile'));
    }

    public function editTargetPrice($id)
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $product = Product::where('id',$id)->first();
        $editTargetPrice = UserPrice::where('product_id','=',$id)->where('user_id', Auth::user()->id)->first();
        return view('dashboard.target-price', compact('editTargetPrice', 'product', 'userProfile'));
    }

    public function postUpdateTargetPrice($id, Request $request)
    {
        $rules = array(

            'target_price' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            $message = $validator->messages();
            return Redirect::route('edit-target-price', $id)->withErrors($message);
        }
        $userPrice = UserPrice::where('product_id', '=', $id)->first();
        $userPrice->target_price = $request->get('target_price');
        $userPrice->save();

        Session::flash('update-product-price', 'Product Price Updated Successfully..!!');
        return Redirect::route('update-your-products');
    }

    public function deleteYourProducts($id)
    {
        $deleteProductPrice = UserPrice::where('product_id', $id)->delete();
        $deletePriceHistory = Price_History::where('products_id', $id)->delete();
        $deleteUserProduct = User_Product::where('products_id', $id)->delete();
        $deleteProduct = Product::find($id)->delete();

        Session::flash('delete-product', 'Product Deleted Successfully..!!');
        return Redirect::route('update-your-products');

    }

    public function addYourProfile()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        return view('dashboard.add-user-profile', compact('userProfile'));
    }

    public function getAddYourImage()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
       return view('dashboard.user-profile-image', compact('userProfile'));
    }

    public function postAddYourProfile(Request $request)
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
//        $userProfile->user_id = Auth::user()->id;
//        $userProfile->birth_date = $request->get('birth-date');
//        $userProfile->contact = $request->get('contact');

        $destinationPath = public_path().'/img/'; // upload path
        $filename = Input::file('image')->getClientOriginalName();
        $extension = Input::file('image')->getClientOriginalExtension(); // getting file extension
        $fileName = time() . '.'.'jpg'; // renameing image
        $upload_success = Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

        if($upload_success) {
            $userProfile->image = $fileName;
        }

        $userProfile->save();
        Session::flash('profile-added', 'Your Profile Has been Added Successfully...!!');
        return Redirect::route('add-your-profile');
    }

    public function getEditYourImage()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        return view('dashboard.user-profile-image', compact('userProfile'));
    }

    public function postEditYourImage()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $destinationPath = public_path().'/img/'; // upload path
        $filename = Input::file('image')->getClientOriginalName();
        $extension = Input::file('image')->getClientOriginalExtension(); // getting file extension
        $fileName = time() . '.'.'jpg'; // renameing image
        $upload_success = Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

        if($upload_success) {
            $userProfile->image = $fileName;
        }

        $userProfile->save();
        return Redirect::route('user-profile');
    }

    public function deactivateAccount()
    {
        $userProduct = User_Product::select('products_id')->join('products', 'products.id', '=', 'user_product.products_id')->where('user_product.user_id', Auth::user()->id)->get()->count();
        if($userProduct > 0)
        {
            $message = 'If You Want to deactivate Your Account Please Delete All Products First...!!';
            return Redirect::route('user-profile')->withErrors($message);
        }
        else
        {
            $user = User::where('id', Auth::user()->id)->delete();
            $userProfile = UserProfile::where('user_id', Auth::user()->id)->delete();
            return Redirect::route('register');
        }
    }
}
