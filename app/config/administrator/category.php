<?php

/**
 * Post model config
 */
return array(
	'title' => 'Category',
	'single' => 'category',
	'model' => 'Category',
	
	
    
        'columns' => array(
		'id',
		'name',
                'slug',
                'parent_category_id',
                'order_of_category',
                                
		),
	
    
	/**
	 * The editable fields
	 */
	'edit_fields' => array(
            
            'name' ,
            'slug',
            'description',
            
            'parentCategory' => array(
                'type' => 'relationship',
                'name_field' => 'name',
                'value' => 1
                
            ),
      
	),
    
            'filters' => array(
                'id'=>array(
                    'type'=>'number',    
                ),
            'name', 
            'slug',
        ),
    'form_width' => 800,
    
    'sort' => array(
        'field' => 'id',
        'direction' => 'asc',
    ),
    
    'permission'=> function()
    {
        return Auth::user()->hasRoles(['admin']);
    },
);