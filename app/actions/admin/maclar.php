<?php
// Simple security check
if (!isAdminLoggedIn()){ exit(); }
if ( !isset( $ping ) || $ping != "pong" ) { exit(); }

include_once ACTIONS . "/public/_htmlstart.php";
include_once ACTIONS . "/public/_header.php";
include_once ACTIONS . "/admin/_adminmenu.php";
?>

<!-- Contents -->
<div class="container section">
	<div class="row">
		<div class="col-xs-12">

			<div class="tablist" id="adminmatch">
				<div class="tablist_tabs">
					
					<?php
					$pdo = newPDO();
					$query = $pdo->prepare("SELECT * FROM ".TABLE_GAMES." ORDER BY id ASC");
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_ASSOC);
					
					foreach($results as $r){
						$gameid = sanitize_string($r['id']);
						$gameabbr = sanitize_string($r['abbr']);

						$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHES." WHERE winner_gamer_id = 0 AND game_id = :game_id");
						$query->execute(array(':game_id'=>$gameid));
						$matchesres = $query->fetchAll(PDO::FETCH_ASSOC);
						?>

						<div class="tablist_tab">
							<div class="tablist_title"><?php echo $gameabbr; ?></div>
							<div class="tablist_hiddencontent">
								<ul class="list-unstyled tablist_ul">
									<?php
									foreach($matchesres as $mr){
										$matchid = sanitize_string($mr['id']);
										$match = new matches($matchid);
										$gamer1id = $match->gamer1_id;
										$gamer2id = $match->gamer2_id;

										$gamer1 = new gamers($gamer1id);
										$gamer2 = new gamers($gamer2id);
										?>
										<li style='position:relative;' class="tablist_element adminmatchelements">
											<?php echo "&nbsp;&nbsp;" ?>
											<?php echo "<span style='color:red;'>".$gamer1->name."</span> vs <span style='color:red;'>".$gamer2->name."</span>"; ?>
											<?php echo "&nbsp;&nbsp;" ?>
											<?php echo "<span style='font-size:10px;'>End Time</span>&nbsp;<span style='color:gray;font-size:12px;'>".simpleDate($match->end_t)."</span>"; ?>
											<?php echo "&nbsp;&nbsp;" ?>
											<?php echo "<span style='font-size:10px;'>Match Time</span>&nbsp;<span style='color:gray;font-size:12px;'>".simpleDate($match->date_t)."</span>"; ?>

											
											<?php echo "<span style='float:right;margin-right:20px;' class='glyphicon glyphicon-trash deletematch' id='".$match->id."'></span>"; ?>
											<?php echo "&nbsp;" ?>
											<?php echo "<a href='/index.php?a=administration&b=macekle&id=".$match->id."'><span style='float:right;margin-right:5px;' class='glyphicon glyphicon-pencil editmatch' id='".$match->id."'></span></a>"; ?>
											<?php echo "&nbsp;" ?>
											<?php echo "<a href='/index.php?a=administration&b=specialbets&id=".$match->id."'><span style='float:right;margin-right:5px;' class='glyphicon glyphicon-star gotospecial'></span></a>"; ?>
											
											<?php echo "<div class='clearfix'></div>"; ?>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>

							<?php } ?>

							<div class="clearfix"></div>
						</div>
						<div class="tablist_content"></div>	
					</div>

				</div>
			</div>
		</div>


		<?php
		include_once ACTIONS . "/public/_footer.php";
		include_once ACTIONS . "/public/_htmlend.php";
		?>