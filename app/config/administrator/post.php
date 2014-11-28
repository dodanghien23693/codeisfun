<?php

/**
 * Post model config
 */

return array(
	'title' => 'Post',
	'single' => 'post',
	'model' => 'Post',
	
	
        
    
        'columns' => array(
		'id',
		'title',
                'user_id' => array(
                   
                    'title' => 'User_id',
                    'output' =>  $id = '(:value)',
                    
                 
                    
                ),         
		),
	
    
	/**
	 * The editable fields
	 */
	'edit_fields' => array(
            
            'title' ,
            'slug',
            'cover_image_url',
            'content' => array(
                'type' => 'wysiwyg',
                
            ),
            'description',
            'user'=> array(
                'title' => 'user',
                'type' => 'relationship',
                'name_field' => 'username',
                
            ),
           
            'public_time' => array(
                'title'=>'Public time',
                'type'=>'datetime',
                'date_format' => 'yy-mm-dd', 
                'time_format' => 'HH:mm:ss', 
                         
            ),
            'categories' => array(
                'type' => 'relationship',
                'name_field' => 'name',
                
            ),
            
            'tags' => array(
                'type' => 'relationship',
                'name_field' => 'name',   
            ),
            
            'visibility' => array( 
                'type'=>'relationship',
                'name_field'=>'name',
                'value' => 1
            ),
            'status' => array(
              'type'=>'relationship',
                'name_field'=>'name',
                'value' => 1
            ),
            
	),
    
   'filters' => array(
            'id'=>array(
                'type'=>'number',

            ),
        'title', 
        'slug',
        'content'
    ),
    
    'rules' => array(
        'title'       => 'required',
        'slug'        => 'required|unique:posts,slug',  
        'cover_image_url'   => 'url',
        'description'       => 'required|min:100',
        'content'           => 'required|min:200',
    ),
    
    'form_width' => 800,
    
    'sort' => array(
        'field' => 'id',
        'direction' => 'asc',
    ),
);