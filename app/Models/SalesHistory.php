<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 販売履歴モデル.
 */
class SalesHistory extends Model
{
    public function product()
    {
    	$this->belongsTo('App\Models\Product');
    }
}
