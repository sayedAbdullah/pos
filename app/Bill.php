<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = ['attachment', 'amount_without_tax', 'discount', 'paid', 'status_label'];

    protected $dates = ['deleted_at', 'billd_at', 'due_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_id', 'bill_number', 'order_number', 'status', 'billed_at', 'due_at', 'amount', 'user_id', 'contact_tax_number', 'contact_phone', 'contact_address', 'notes', 'category_id', 'parent_id', 'footer'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['bill_number', 'contact_name', 'amount', 'status' , 'billd_at', 'due_at'];

    // protected $guarded = [];




    public function contact()
    {
        return $this->belongsTo('App\Models\Common\Contact')->withDefault(['name' => trans('general.na')]);
    }


    public function items()
    {
        return $this->hasMany(BillItem::class);
    }

    public function histories()
    {                                                                                                              
        return $this->hasMany('App\BillHistory');
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);

    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'document_id')->where('type', 'expense');

    }
    public function paid()
    {
        return $this->transactions->sum('amount');

    }
    public function count()
    {
        return $this->transactions->count();

    }
    public function remaining()
    {
        return ($this->amount - $this->paid());

    }

    // public function total()
    // {
    //     return '100';


    // }


    public function get_bill_number()
    {
        // return $this::all();

        $lastId = $this->latest()->first()->id;
        // $lastId = 1;
        $newId = 1 + $lastId;
        if($newId < 10){
            return 'Bill-0000'.$newId;
        }
        if($newId < 100){
            return 'Bill-000'.$newId ;
        }
        if($newId < 1000){
            return 'Bill-00'.$newId ;
        }
        if($newId < 100){
            return 'Bill-00'.$newId ;
        }
        if($newId < 100){
            return 'Bill-0'.$newId ;
        }
        
        return 'Bill'.$newId ;



    }
}
