<?php
// TODO : implement 'remember me'
if ( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rememberme'])){
	$logged = login($_POST['username'] , $_POST['password'], $_POST['rememberme']);
	echo getMessage($logged);	
}	
else{ 
	echo getMessage("E5");
}
?>