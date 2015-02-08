<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}
$answerid = sanitize_string($_POST['answerid']);
$answer = new answers($answerid);
$answer->delete();
echo getMessage("S28");
?>