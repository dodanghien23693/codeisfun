<?php

use LaravelBook\Ardent\Ardent;
class Subscription extends Ardent{
    
    protected $table = "subscriptions";
    
    protected $guarded = array('*');
    
    /**
    * Ardent validation rules
    */
    public static $rules = array(
      
    );
    
    /* user
     * 
     */
    public function user(){
        return $this->belongsTo("User");
    }
    
    /* paymentMethod
     * 
     */
    public function paymentMethod(){
        return $this->belongsTo("PaymentMethod", "method_id");
    }
    



}