<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会社モデル.
 */
class Corporation extends Model
{
	/**
	 * 商品モデルを取得.
	 */
    public function products()
    {
    	return $this->hasMany('App\Models\Product');
    }
}
