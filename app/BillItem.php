<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $table = 'bill_items';
        protected $guarded = [];


    // function trans($key = null, $replace = [], $locale = null)
    // {
    //     if (is_null($key)) {
    //         return app('translator');
    //     }

    //     return app('translator')->get($key, $replace, $locale);
    // }

    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }

    public function item()
    {
        return $this->belongsTo('App\product');
    }

}
