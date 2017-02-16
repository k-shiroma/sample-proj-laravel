<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品モデル.
 */
class Product extends Model
{
	/**
	 * このモデルを所有する会社モデルを取得.
	 */
    public function corporation()
    {
    	return $this->belongsTo('App\Models\Corporation');
    }

    /**
     * 販売履歴を取得.
     */
    public function salesHistories()
    {
    	return $this->hasMany('App\Models\SalesHistory');
    }
}
