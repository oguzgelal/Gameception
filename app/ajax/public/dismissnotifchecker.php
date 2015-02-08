<?php
if(isLoggedIn()){
	$userid_dnc = $_SESSION['userid'];
	$user_dnc = new profile($userid_dnc);

	$pdo = newPDO();
	$query = $pdo->prepare("SELECT * FROM ".DISMISSNOTIF." WHERE profile_id=:profile_id");
	$query->execute(array(":profile_id"=>$user_dnc->id));
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $r){ 
		?>
		<div class="dismissnotif">
			<span class="dismissicon glyphicon glyphicon-remove-circle"></span>
			<?php echo $r['body']; ?>
		</div>
		<?php 
	}
	$query2 = $pdo->prepare("DELETE FROM ".DISMISSNOTIF." WHERE profile_id=:profile_id");
	$query2->execute(array("profile_id"=>$user_dnc->id));
}
?>