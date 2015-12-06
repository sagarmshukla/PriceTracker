<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 17/08/15
 * Time: 12:06 PM
 */

namespace Trackyourprice;

use Illuminate\Database\Eloquent\Model;


class Store extends Model
{

    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];




}
