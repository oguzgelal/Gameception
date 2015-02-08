<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";

$charlimit = 15;
$games = games::LoadListedIn("bahis");
if (isLoggedIn()){ 
	$user = new profile($_SESSION['userid']);

	$pdo = newPDO();
	$query = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_PROFILE);
	$query->execute();
	$total = $query->fetchColumn();
	$query = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_PROFILE." WHERE money>:money");
	$query->execute(array(':money'=>$user->money));
	$index = $query->fetchColumn() + 1;
	
}

?>

<!-- Contents -->
<section class="container section">

	<?php if(isLoggedIn()){ ?>
	<div class="row">
		<div class="col-xs-12">
			<!-- Kredi Siralama -->
			<div class="siralama">
				<div class="col-xs-6 siralamatxt">Kredi : <span id="usermoney"><?php if (isLoggedIn()){ echo round($user->money); } ?></span></div>
				<div class="col-xs-6 siralamatxt">Sıralama : <?php echo $index."/".$total; ?></div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<div class="row">
		<div class="col-xs-8">

			<!-- Betlist -->
			<div class="tablist" id="bets">
				<div class="tablist_tabs">
					<?php
					foreach($games as $g){
						$game = new games($g['game_id']);
						$matches = matches::LoadMatchesOfGame($game->id);
						?>
						<div class="tablist_tab betlist">
							<div class="tablist_title gamename"><?php echo $game->abbr; ?></div>
							<div class="tablist_hiddencontent">
								<ul class="list-unstyled tablist_ul">
									<?php
									if (count($matches) == 0){
										?> <li class="tablist_element text-center" style="height:100px;">Maç bulunmamaktadır.</li> <?php
									}
									foreach($matches as $m){
										$match = new matches($m['id']);
										$gamer1 = new gamers($match->gamer1_id);
										$gamer2 = new gamers($match->gamer2_id);
										$gamer1name = trimchars($gamer1->name, $charlimit);
										$gamer2name = trimchars($gamer2->name, $charlimit);
										$gamer1image = $gamer1->image;
										$gamer2image = $gamer2->image;

										$nowtime = time(); // UTC
										$matchtime = $match->date_t; // Time of match
										$endtime = $match->end_t; // Bets close time
										
										//if ($endtime > $nowtime){
										if ($match->notPassed()){

											$echodate = "";
											if (getDay(strtotime('now')) == getDay($matchtime)){
												$echodate = "<div class='today'>Bugün</div> ".getHour($matchtime).":".getMinute($matchtime);
											}
											else if (getDay(strtotime('+1 day')) == getDay($matchtime)){
												$echodate = "<div class='tomorrow'>Yarın</div> ".getHour($matchtime).":".getMinute($matchtime);
											}
											else {
												$echodate = "<div class='anydate'>".getDay($matchtime)."/".getMonth($matchtime)."/".getYear($matchtime)."</div> ".getHour($matchtime).":".getMinute($matchtime);
											}
											?>
											<li class="tablist_element">
												<div class="betlistdata teams">
													<div class="team team1"><img src="<?php echo TEAMPHOTOS_DIS.$gamer1image; ?>"><span class="gamer1"><?php echo $gamer1name; ?></span><div class="teamrate"><?php echo $match->gamer1_rate; ?></div></div>
													<div class="vs"><a href="index.php?a=stream&b=<?php echo $match->id; ?>" class="nostyle_white">vs</a></div>
													<div class="team team2"><div class="teamrate"><?php echo $match->gamer2_rate; ?></div><span class="gamer2"><?php echo $gamer2name; ?></span><img src="<?php echo TEAMPHOTOS_DIS.$gamer2image; ?>"></div>
													<?php if ($match->questionNum() > 0){ ?> <span class="hasquestions glyphicon glyphicon-star"></span> <?php } ?>
													<input type="hidden" id="matchid" value="<?php echo $match->id; ?>">
												</div>
												<div class="betlistdata time">
													<div class="state"><?php echo $echodate; ?></div>
												</div>
												<div class="clearfix"></div>
											</li>
											<?php 
										}
									}
									?>
								</ul>
							</div>
						</div>
						<?php
					}
					?>

					<div class="clearfix"></div>
				</div>
				<div class="tablist_content"></div>	
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-xs-4 pl0">
			

			<!-- Kupon -->
			<div class="simplelist" id="kuponplay">
				<div class="simplelist_tabs">
					<div class="simplelist_tab active">
						<div class="simplelist_title">Kupon</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="simplelist_content">
					<ul class="list-unstyled simplelist_ul selectedmatches">
					</ul>
					<!-- DESIGN -->
					<!-- keep deposit input(text) as input#totalbar_money_input -->
					<!-- keep play button as #playthis -->
					<!-- keep share button as #sharethis -->
					<div class="totalbar">
						<div class="totalbar_column" id="left">
							<div class="totalbar_element totalbar_rate">
								<div class="totalbar_element_child totalbar_rate_txt">Oran</div>
								<div class="totalbar_element_child totalbar_rate_rate">: <span class="ratetxt">1.00</span></div>
								<div class="clearfix"></div>
							</div>
							<div class="totalbar_element totalbar_money">
								<div class="totalbar_element_child totalbar_money_txt">Yatırım</div>
								<div class="totalbar_element_child totalbar_money_money">: <input type="text" name="totalbar_money_input" id="totalbar_money_input" class="totalbar_money_input"></div>
								<div class="clearfix"></div>
							</div>
							<div class="totalbar_element totalbar_earning">
								<div class="totalbar_element_child totalbar_earning_txt">Kazanç</div>
								<div class="totalbar_element_child totalbar_earning_earning">: <span class="earningtxt">0.00</span></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="totalbar_column" id="right">
							<input type="button" class="btn btn-xs btn-default totalbar_button" id="playthis" value="Oyna">
							<input type="button" class="btn btn-xs btn-default totalbar_button" id="clearcoupon" value="Temizle">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<?php
include_once dirname(__FILE__) . "/_footer.php";
include_once dirname(__FILE__) . "/_htmlend.php";
?>