<?php

/**
 * Post model config
 */
return array(
	'title' => 'User',
	'single' => 'user',
	'model' => 'User',
	
	
    
        'columns' => array(
		'id',
		'username',
            'password',
            'email',
            'first_name',
            'last_name'
                
		),
	
    
	/**
	 * The editable fields
	 */
	'edit_fields' => array(
            'username' ,
            'password'=>array(
                    'type' => 'password',
                    'output' => function($value){
                        return Hash::make($value);
                    },
                ),
            'email',
            'first_name',
            'last_name',
            'role' => array(
                'type'=>'relationship',
                'field_name'=>'name'
            ),
             'user_type' => array(
                'type'=>'enum',
                'title' => 'User type',
                'options' => array(
                    'codeisfun',
                    'facebook',
                    'google',
                ),
                'value' => 'codeisfun'
            ),
	),
    
            'filters' => array(
                'id'=>array(
                    'type'=>'number',
                    
                ),
            'username', 

            'email',
            'first_name',
                'last_name'
        ),
    'form_width' => 700,
    
    'sort' => array(
        'field' => 'id',
        'direction' => 'asc',
    ),
                            
    'permission'=> function()
    {
        return Auth::user()->hasRoles(['admin','manager']);
    },
);