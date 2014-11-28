<?php

/**
 * Post model config
 */
return array(
	'title' => 'Tag',
	'single' => 'tag',
	'model' => 'Tag',
	
	
    
        'columns' => array(
		'id',
		'name',                   
		),
	
    
	/**
	 * The editable fields
	 */
	'edit_fields' => array(
            
            'name' ,
  
	),
    
            'filters' => array(
                'id'=>array(
                    'type'=>'number',    
                ),
            'name', 
        ),
    'form_width' => 800,
    
    'sort' => array(
        'field' => 'id',
        'direction' => 'asc',
    ),
);