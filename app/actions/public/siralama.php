<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}

if (!isLoggedIn()){	header('Location: /index.php?a=register'); exit(); }

include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";
?>

<!-- Contents -->
<section class="container section">
	<div class="row">
		<!-- Column 1 -->
		<div class="col-xs-4">	
			<div class="tablist" id="statlist">
				<div class="tablist_tabs">
					<div class="tablist_tab">
						<div class="tablist_title">Aylık</div>
						<div class="tablist_hiddencontent">
							<ul class="list-unstyled tablist_ul">
								<?php
								$pdo = newPDO();
								$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY money DESC LIMIT 10");
								$query->execute();
								$result = $query->fetchAll(PDO::FETCH_ASSOC);
								foreach($result as $r){
									$profile = new profile($r['id']);
									?>
									<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"><img src="<?php echo AVATAR_DIS.$profile->image; ?>"> <?php echo $profile->getDisplayName(); ?></a> </li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<div class="tablist_tab">
							<div class="tablist_title">Toplam</div>
							<div class="tablist_hiddencontent">
								<ul class="list-unstyled tablist_ul">
									<?php
									$pdo = newPDO();
									$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY total_money DESC LIMIT 10");
									$query->execute();
									$result = $query->fetchAll(PDO::FETCH_ASSOC);
									foreach($result as $r){
										$profile = new profile($r['id']);
										?>
										<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"><img src="<?php echo AVATAR_DIS.$profile->image; ?>"> <?php echo $profile->getDisplayName(); ?></a> </li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="tablist_content"></div>	
					</div>
				</div>
				<!-- Column 2 -->
				<div class="col-xs-4 pl0">	

					<div class="tablist" id="statlist">
						<div class="tablist_tabs">
							<div class="tablist_tab">
								<div class="tablist_title">Yapılan</div>
								<div class="tablist_hiddencontent">
									<ul class="list-unstyled tablist_ul">
										<?php
										$pdo = newPDO();
										$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY money DESC LIMIT 10");
										$query->execute();
										$result = $query->fetchAll(PDO::FETCH_ASSOC);
										foreach($result as $r){
											$profile = new profile($r['id']);
											?>
											<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"><img src="<?php echo AVATAR_DIS.$profile->image; ?>"> <?php echo $profile->getDisplayName(); ?></a> </li>
											<?php } ?>
										</ul>
									</div>
								</div>
								<div class="tablist_tab">
									<div class="tablist_title">Tutar</div>
									<div class="tablist_hiddencontent">
										<ul class="list-unstyled tablist_ul">
											<?php
											$pdo = newPDO();
											$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY total_money DESC LIMIT 10");
											$query->execute();
											$result = $query->fetchAll(PDO::FETCH_ASSOC);
											foreach($result as $r){
												$profile = new profile($r['id']);
												?>
												<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"><img src="<?php echo AVATAR_DIS.$profile->image; ?>"> <?php echo $profile->getDisplayName(); ?></a> </li>
												<?php } ?>
											</ul>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="tablist_content"></div>	
							</div>

						</div>
						<!-- Column 3 -->
						<div class="col-xs-4 pl0">	

							<div class="tablist" id="statlist">
								<div class="tablist_tabs">
									<div class="tablist_tab">
										<div class="tablist_title">Seviye</div>
										<div class="tablist_hiddencontent">
											<ul class="list-unstyled tablist_ul">
												<?php
												$pdo = newPDO();
												$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY level DESC LIMIT 10");
												$query->execute();
												$result = $query->fetchAll(PDO::FETCH_ASSOC);
												foreach($result as $r){
													$profile = new profile($r['id']);
													?>
													<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"><img src="<?php echo AVATAR_DIS.$profile->image; ?>"> <?php echo $profile->getDisplayName(); ?></a> </li>
													<?php } ?>
												</ul>
											</div>
										</div>
										<!--
										<div class="tablist_tab">
											<div class="tablist_title">Refer</div>
											<div class="tablist_hiddencontent">
												<ul class="list-unstyled tablist_ul">
													<?php
													$pdo = newPDO();
													$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY xp DESC LIMIT 10");
													$query->execute();
													$result = $query->fetchAll(PDO::FETCH_ASSOC);
													foreach($result as $r){
														$profile = new profile($r['id']);
														?>
														<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"><img src="<?php echo AVATAR_DIS.$profile->image; ?>"> <?php echo $profile->getDisplayName(); ?></a> </li>
														<?php } ?>
													</ul>
												</div>
											</div>
										-->
										<div class="clearfix"></div>
									</div>
									<div class="tablist_content"></div>	
								</div>

							</div>
						</div>
					</section>

					<?php
					include_once dirname(__FILE__) . "/_footer.php";
					include_once dirname(__FILE__) . "/_htmlend.php";
					?>