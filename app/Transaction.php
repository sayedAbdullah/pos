<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $dates = ['deleted_at', 'paid_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    // protected $fillable = ['company_id', 'type', 'account_id', 'paid_at', 'amount', 'currency_code', 'currency_rate', 'document_id', 'contact_id', 'description', 'category_id', 'payment_method', 'reference', 'parent_id'];
    protected $guarded=[];
    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['paid_at', 'amount','category.name', 'account.name'];

    /**
     * Clonable relationships.
     *
     * @var array
     */
    public $cloneable_relations = ['recurring'];

    // public function account()
    // {
    //     return $this->belongsTo('App\Models\Banking\Account')->withDefault(['name' => trans('general.na')]);
    // }

    public function bill()
    {
        return $this->belongsTo('App\Bill', 'document_id');
    }


    // public function category()
    // {
    //     return $this->belongsTo('App\Models\Setting\Category')->withDefault(['name' => trans('general.na')]);
    // }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'document_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    // public function user()
    // {
    //     return $this->belongsTo('App\Models\Auth\User', 'contact_id', 'id');
    // }
}
