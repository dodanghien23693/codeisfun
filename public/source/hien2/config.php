<?php

// filemanager_access_key:"myPrivateKey" ,
// ...


// add access keys eg: array('myPrivateKey', 'someoneElseKey');
// keys should only containt (a-z A-Z 0-9 \ . _ -) characters
// if you are integrating lets say to a cms for admins, i recommend making keys randomized something like this:
// $username = 'Admin';
// $salt = 'dsflFWR9u2xQa' (a hard coded string)
// $akey = md5($username.$salt);
// DO NOT use 'key' as access key!
// Keys are CASE SENSITIVE!
$access_keys = array('hien');
?>