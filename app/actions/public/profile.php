<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}

// TODO : gamer (team) page - to view statistics

if (isset($_GET['id'])){ $profileid = sanitize_string($_GET['id']); }
else{
	if (!isLoggedIn()){	header('Location: /index.php?a=register'); exit(); }
	//else{ $profileid = $_SESSION['userid']; }
	else { header('Location: /index.php?a=profile&id='.$_SESSION['userid']); exit(); }
}

include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";

$profile = new profile($profileid);

$pdo = newPDO();
$query = $pdo->prepare("SELECT last FROM ".TABLE_MONTHLY_EXECUTION." LIMIT 1");
$query->execute();
$fetched = $query->fetch();
$last = $fetched['last'];
$secsUntilLastReset = time() - $last;
$timeRemaining = MONTHINSECS - $secsUntilLastReset;
if ($timeRemaining <= 0){ $timeRemaining = 0; }
$timeRemainingStr = secsToTime($timeRemaining);
?>

<section class="container section">
	<div class="row">
		<!-- Avatar -->
		<div class="col-xs-3">
			<div class="avatar_container" style="background: url(<?php echo AVATAR_DIS.$profile->image; ?>) no-repeat; background-size: cover; background-position: center;">
				<?php if (isLoggedIn() && $profileid == $_SESSION['userid']){ ?>
				<form id="profileimageform" enctype="multipart/form-data" action="/index.php?a=ajax&b=public&c=profileimage" method="post">
					<div class="changeimage"><a href="#" class="changeimagelink">Change</a></div>
					<input type="file" name="profileimage" id="profileimage">
				</form>
				<?php } ?>
			</div>
		</div>
		<!-- Details -->
		<div class="col-xs-9 pl0">
			<div class="division details">
				<div class="col-xs-2-offset col-xs-8-offset"><div class="profilename"><?php echo $profile->getDisplayName(); ?></div></div>
				<div class="col-xs-2"></div>
				<div class="col-xs-12 gap"></div>
				<div class="col-xs-12 profiledetails">
					<ul class="list-unstyled list-inline">
						<li class="monthlycredit" data-toggle="popover" data-placement="top" data-content="<?php echo "Sıfırlanmaya kalan süre ".$timeRemainingStr; ?>">
							<div class="profiledetail profiledetail_title">Aylık Kredi</div>
							<div class="profiledetail profiledetail_text"><?php echo round($profile->money); ?></div>
						</li>
						<li>
							<div class="profiledetail profiledetail_title">Toplam Kredi</div>
							<div class="profiledetail profiledetail_text"><?php echo round($profile->total_money); ?></div>
						</li>
						<li>
							<div class="profiledetail profiledetail_title">Seviye</div>
							<div class="profiledetail profiledetail_text"><?php echo $profile->level; ?></div>
						</li>
						<li>
							<div class="profiledetail profiledetail_title">XP</div>
							<div class="profiledetail profiledetail_text"><?php echo round($profile->xp); ?></div>
						</li>
						<li class="profiledetail_won">
							<div class="profiledetail profiledetail_title">Tutan Kuponlar</div>
							<div class="profiledetail profiledetail_text"><?php echo $profile->kupon_won; ?></div>
						</li>
						<li class="profiledetail_lost">
							<div class="profiledetail profiledetail_title">Yatan Kuponlar</div>
							<div class="profiledetail profiledetail_text"><?php echo $profile->kupon_lost; ?></div>
						</li>
						<li class="profiledetail_won">
							<div class="profiledetail profiledetail_title">Tutan Bahisler</div>
							<div class="profiledetail profiledetail_text"><?php echo ($profile->matches_won + $profile->questions_won); ?></div>
						</li>
						<li class="profiledetail_lost">
							<div class="profiledetail profiledetail_title">Yatan Bahisler</div>
							<div class="profiledetail profiledetail_text"><?php echo ($profile->matches_lost + $profile->questions_lost); ?></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Badges -->
	<div class="row">
		<div class="col-xs-12">
			<div class="badgesection division">
				<?php
				$badges = $profile->getBadges();
				if (count($badges) == 0){ echo "<div class='noelement'>No Badges</div>"; }
				foreach($badges as $b){
					$badge = new badges($b['badge_id']);
					$badgeimg = $badge->image;
					$badgename = $badge->name;
					$badgedesc = $badge->desc;
					?>
					<div class="badge_li">
						<div class="badgeicon" data-toggle="popover" data-placement="top" data-content="<?php echo $badgedesc; ?>">
							<img src="<?php echo BADGEICON . $badgeimg; ?>">
						</div>
						<div class="badgetext"><?php echo $badgename; ?></div>
					</div>
					<?php } ?>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Sonuclanmis Kuponlar -->
			<div class="col-xs-6">
				<div class="simplelist" id="sonkuponlar">
					<div class="simplelist_tabs">
						<div class="simplelist_tab active">
							<div class="simplelist_title">Sonuçlanmış Kuponlar</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="simplelist_content">
						<ul class="list-unstyled simplelist_ul selectedmatches">
							<?php
							$lastresulted = $profile->loadLastResulted();
							if (count($lastresulted) == 0){
								?>
								<li class="simplelist_element">
									<div class="none">None</div>
								</li>
								<?php
							}
							else{
								foreach($lastresulted as $lr){
									$kupon = new kupon($lr['id']);
									//$check = $kupon->check();
									$check = $kupon->checked;
									?>
									<li class="simplelist_element">
										<a href="/index.php?a=kupon&id=<?php echo $kupon->id; ?>">
											<div class="last_element last_icon">
												<?php
												if ($check == 1){ echo "<span class='glyphicon glyphicon-ok won'></span>"; }
												else if ( $check == 2 ) { echo "<span class='glyphicon glyphicon-remove lost'></span>"; }
												?>

											</div>
											<div class="last_element last_date">
												<span class="last_date_hour"><?php echo getHour($kupon->date).":".getMinute($kupon->date); ?></span>
												<span class="last_date_day"><?php echo getDay($kupon->date)."/".getMonth($kupon->date)."/".getYear($kupon->date); ?></span>
											</div>
											<div class="last_element last_totalrate">
												<span class="last_totalrate_txt">Toplam Oran</span>
												<span class="last_totalrate_val"><?php echo round($kupon->getTotalRate(),2); ?></span>
											</div>
											<div class="last_element last_result">
												<?php
												if ($check == 1){ 
													echo "<span class='last_result_val'>".round($kupon->spent*$kupon->getTotalRate(), 2)."</span>";
													echo "<span class='last_result_txt won'> kazandı</span>";
												}
												else if ($check == 2) { 
													echo "<span class='last_result_val'>".$kupon->spent."</span>";
													echo "<span class='last_result_txt lost'> kaybetti</span>"; 
												}
												?>
											</div>
											<div class="clearfix"></div>
										</a>
									</li>
									<?php } }	?>
								</ul>
							</div>
						</div>
					</div>
					<!-- Serbest Alan -->
					<div class="col-xs-6 pl0">
						<?php if (isLoggedIn() && $profileid == $_SESSION['userid']){ ?>
						<style>.shortbio:hover { cursor: pointer; }</style>
						<a class="updatebiolink">
							<?php } ?>
							<div class="division shortbio">
								<div class="shortbio_text">
									<?php 
									$stripbio = strip_tags($profile->bio, '<a>');
									echo $stripbio;
									?>
								</div>
								<?php if (isLoggedIn() && $profileid == $_SESSION['userid']){ ?>
								<form id="biotextform" action="/index.php?a=ajax&b=public&c=changebio" method="post">
									<textarea name="biotextarea" id="biotextarea" onKeyDown="limitText(this.form.biotextarea,140);" onKeyUp="limitText(this.form.limitedtextarea,140);"><?php echo $profile->bio; ?></textarea>
								</form>
								<?php } ?>
							</div>
							<?php if (isLoggedIn() && $profileid == $_SESSION['userid']){ ?></a><?php } ?>
						</div>
					</div>
					
					<?php if (isLoggedIn() && $profileid == $_SESSION['userid']){ ?>
					<!-- Son Oynanan Kuponlar -->
					<div class="row">
						<div class="col-xs-6">
							<div class="simplelist" id="sonkuponlar">
								<div class="simplelist_tabs">
									<div class="simplelist_tab active">
										<div class="simplelist_title">Son Oynanan Kuponlar</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="simplelist_content">
									<ul class="list-unstyled simplelist_ul selectedmatches">
										<?php
										$lastresulted = $profile->loadLastPlayed();
										if (count($lastresulted) == 0){
											?>
											<li class="simplelist_element">
												<div class="none">None</div>
											</li>
											<?php
										}
										else{
											foreach($lastresulted as $lr){
												$kupon = new kupon($lr['id']);
												//$check = $kupon->check();
												$check = $kupon->checked;
												?>
												<li class="simplelist_element">
													<a href="/index.php?a=kupon&id=<?php echo $kupon->id; ?>">
														<div class="last_element last_icon">
															<?php
															if ($check == 1){ echo "<span class='glyphicon glyphicon-ok won'></span>"; }
															else if ( $check == 2 ) { echo "<span class='glyphicon glyphicon-remove lost'></span>"; }
															else if ( $check == 0 ) { echo "<span class='glyphicon glyphicon-time pending'></span>"; }
															?>

														</div>
														<div class="last_element last_date">
															<span class="last_date_hour"><?php echo getHour($kupon->date).":".getMinute($kupon->date); ?></span>
															<span class="last_date_day"><?php echo getDay($kupon->date)."/".getMonth($kupon->date)."/".getYear($kupon->date); ?></span>
														</div>
														<div class="last_element last_totalrate">
															<span class="last_totalrate_txt">Toplam Oran</span>
															<span class="last_totalrate_val"><?php echo round($kupon->getTotalRate(),2); ?></span>
														</div>
														<div class="last_element last_result">
															<?php
															if ($check == 1){ 
																echo "<span class='last_result_val'>".round($kupon->spent*$kupon->getTotalRate(), 2)."</span>";
																echo "<span class='last_result_txt won'> kazandı</span>";
															}
															else if ($check == 2) { 
																echo "<span class='last_result_val'>".$kupon->spent."</span>";
																echo "<span class='last_result_txt lost'> kaybetti</span>"; 
															}
															?>
														</div>
														<div class="clearfix"></div>
													</a>
												</li>
												<?php } }	?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>

						</section>

						<?php
						include_once dirname(__FILE__) . "/_footer.php";
						include_once dirname(__FILE__) . "/_htmlend.php";
						?>