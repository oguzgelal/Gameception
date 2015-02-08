<?php
session_start();

//if (isset($_SESSION['pblock'])){
	include_once dirname(__FILE__)."/app/app.php";
//}
/*
else{
	if (!isset($_POST['pblock'])){
		?>
		<form action="/" method="post">
			<label for="pblock">Private Beta Lock</label>
			<input type="text" name="pblock" id="pblock">
			<input type="submit">
		</form>
		<?php
	}
	else{
		$pblock = $_POST['pblock'];
		if ($pblock == "ggc_private_beta123"){
			$_SESSION['pblock']="1";
			header("Location: /");
		}
	}
}
?>
*/