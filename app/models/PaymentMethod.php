<?php
use LaravelBook\Ardent\Ardent;

class PaymentMethod extends Ardent{
    
    protected $table = "payment_method";
    
    protected $fillable = array('name','description','value');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      'name'        => 'required',
        'description'   => 'required',
        'value'         => 'required'
    );
    
    /* subscriptions
     * 
     */
    public function subscriptions(){
        return $this->hasMany("Subscription", "method_id");
    }

}