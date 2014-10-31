<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '325636144287712',
            'client_secret' => '13e0c429187faab0c5f9d9660b9c4a2a',
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),		

         /**
         * Google
         */
        'Google' => array(
            'client_id'     => '564058808839-0gqjn29gmibpouu3edl720o5mvne6ht7.apps.googleusercontent.com',
            'client_secret' => 'fyaq4ryjKMawTCJSI-D9AGdw',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),
 
 
            
	)

);