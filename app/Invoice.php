<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = ['attachment', 'amount_without_tax', 'discount', 'paid', 'status_label'];

    protected $dates = ['deleted_at', 'invoiced_at', 'due_at'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'invoice_number', 'order_number', 'status', 'invoiced_at', 'due_at', 'amount', 'user_id', 'contact_tax_number', 'contact_phone', 'contact_address', 'notes', 'category_id', 'parent_id', 'footer'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['invoice_number', 'contact_name', 'amount', 'status' , 'invoiced_at', 'due_at'];

    // protected $guarded = [];




    // public function contact()
    // {
    //     return $this->belongsTo('App\Models\Common\Contact')->withDefault(['name' => trans('general.na')]);
    // }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function histories()
    {                                                                                                              
        return $this->hasMany('App\InvoiceHistory');
    }


    public function client()
    {
        return $this->belongsTo(Client::class);

    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'document_id')->where('type', 'income');;

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


    public function get_invoice_number()
    {
        // return $this::all();
        $lastId = $this->latest()->first()->id;
        $newId = $lastId +1 ;
        if($newId < 10){
            return 'فاتورة-0000'+$newId;
        }
        if($newId < 100){
            return 'فاتورة-000'.$newId ;
        }
        if($newId < 1000){
            return 'فاتورة-00'.$newId ;
        }
        if($newId < 100){
            return 'فاتورة-00'.$newId ;
        }
        if($newId < 100){
            return 'فاتورة-0'.$newId ;
        }
        
        return 'فاتورة'.$newId ;



    }
}
