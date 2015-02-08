<?php
// Simple security check
if (!isAdminLoggedIn()){ exit(); }
if ( !isset( $ping ) || $ping != "pong" ) { exit(); }

$pdo = newPDO();
if (isset($_GET['id'])){
	$matchid = sanitize_string($_GET['id']);
	$matchofq = new matches($matchid);
	$sql = "SELECT * FROM ".TABLE_MATCHSPECIAL_QUESTIONS." WHERE match_id=:matchid";
	$query = $pdo->prepare($sql);
	$query->execute(array(':matchid'=>$matchid));
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
}
else{
	header("Location: /index.php?a=administration&b=maclar");
}

include_once ACTIONS . "/public/_htmlstart.php";
include_once ACTIONS . "/public/_header.php";
include_once ACTIONS . "/admin/_adminmenu.php";
?>

<!-- Contents -->
<div class="container section">
	<div class="row">
		<div class="col-xs-12">


			<div class="simplelist" id="adminspecials">
				<div class="simplelist_tabs">
					<div class="simplelist_tab active"><div class="simplelist_title"><?php echo $matchofq->matchInfo(); ?></div></div>
					<div class="clearfix"></div>
				</div>
				<div class="simplelist_content">
					<ul class="list-unstyled simplelist_ul">
						<?php
						foreach($results as $r){
							$questionid = $r['id'];
							$question = new questions($questionid);
							?>

							<li class="simplelist_element">
								<?php echo "&nbsp;&nbsp;"; ?>
								<?php echo "<span style='color:white;'>".$question->question."</span>"; ?>
								
								<?php echo "<span style='float:right;margin-right:20px;' class='glyphicon glyphicon-trash deletespecial' id='".$question->id."'></span>"; ?>
								<?php echo "&nbsp;"; ?>
								<?php echo "<a href='/index.php?a=administration&b=specialbetekle&id=".$question->id."'><span style='float:right;margin-right:5px;' class='glyphicon glyphicon-pencil editspecial'></span></a>"; ?>

								<?php echo "<div class='clearfix'></div>"; ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>


			</div>
		</div>
	</div>


	<?php
	include_once ACTIONS . "/public/_footer.php";
	include_once ACTIONS . "/public/_htmlend.php";
	?>