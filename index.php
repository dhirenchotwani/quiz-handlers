<?php
include_once('classes/Functions.php');
include_once('classes/User.php');
$obj=new User();
if($obj->isCookieSet()){
	Functions::redirect('dashboard.php');
}
else{
Functions::redirect('includes/login.php');
}
?>
