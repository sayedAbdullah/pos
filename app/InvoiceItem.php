<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
        protected $guarded = [];


    // function trans($key = null, $replace = [], $locale = null)
    // {
    //     if (is_null($key)) {
    //         return app('translator');
    //     }

    //     return app('translator')->get($key, $replace, $locale);
    // }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function item()
    {
        return $this->belongsTo('App\product');
    }

}
