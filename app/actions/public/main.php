<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";
?>

<!-- Contents -->
<section class="container section">

	<div class="row">
		<!-- Slider News -->
		<div class="col-xs-8">
			<div class="slidernews">
				<div class="slidernewslinks">
					<ul class="list-unstyled">

						<li class="slidernewslink">
							<div class="txt title"><b>Bayramımız kutlu olsun</b></div>
							<div class="txt text">Atatürk’ü Anma, Gençlik ve Spor Bayramınızı en içten dileklerimizle kutlarız.</div>
							<div class="hidden hiddenimg"><img src="<?php echo NEWSPHOTOS_DIS."haber3.png"; ?>"></div>
							<div class="hidden hiddentext">
								<div class="title">Bayramımız Kutlu Olsun!</div>
								<div class="text">Atatürk’ü Anma, Gençlik ve Spor Bayramınızı en içten dileklerimizle kutlarız. Yaşanan Soma faciası sebebi ile biraz buruk olsa da…</div>
							</div>
						</li>

						<li class="slidernewslink">
							<div class="txt title"><b>Başımız Sağolsun</b></div>
							<div class="txt text">İhmalsizliklerden dolayı SOMA’da hayatını kaybeden bütün işçilerimize...</div>
							<div class="hidden hiddenimg"><img src="<?php echo NEWSPHOTOS_DIS."haber4.png"; ?>"></div>
							<div class="hidden hiddentext">
								<div class="title">Başımız Sağolsun</div>
								<div class="text">İhmalsizliklerden dolayı SOMA’da hayatını kaybeden bütün işçilerimize Allah’tan rahmet, yakınlarına başsağlığı diliyoruz. Umarız böyle bir olay bir kez daha yaşanmaz, umarız gerekenler yapılır.</div>
							</div>
						</li>

						<li class="slidernewslink active">
							<div class="txt title"><b>GAMECEPTION KAPILARINI AÇIYOR!</b></div>
							<div class="txt text">Gelişmekte olan elektronik sporlar ile birlikte...</div>
							<div class="hidden hiddenimg"><img src="<?php echo NEWSPHOTOS_DIS."haber1.png"; ?>"></div>
							<div class="hidden hiddentext">
								<div class="title">GAMECEPTION KAPILARINI AÇIYOR!</div>
								<div class="text">Gelişmekte olan elektronik sporlar ile birlikte takım takiplerinde ve yapılan yayınlara ilgi oldukça arttı. Bunlara ek olarak rekabet duygusu oyuncular ve izleyiciler arasında da artış gösterdi. Bu rekabet duygusunu daha yüksek seviyelere ulaştırma zamanı!</div>
							</div>
						</li>

						<li class="slidernewslink">
							<div class="txt title"><b>Nasıl Oynanır ?</b></div>
							<div class="txt text">gception.com’a üyelik işleminiz tamamlandıktan sonra...</div>
							<div class="hidden hiddenimg"><img src="<?php echo NEWSPHOTOS_DIS."haber2.png"; ?>"></div>
							<div class="hidden hiddentext">
								<div class="title">Nasıl Oynanır ?</div>
								<div class="text">gception.com’a üyelik işleminiz tamamlandıktan sonra, sistem üzerinden istediğiniz herhangi bir karşılaşmayı oynayabilirsiniz. Başlangıçta verilen kredinizi en iyi şekilde kullanmak sizin elinizde. Yapmanız gereken sadece hangi takımı destekliyorsanız veya hangi takımın kazanacağını hissediyorsanız, belirlenen takıma ait olan oranın üstüne gelip, tıklamanız yeterli olacak. “Kupon” bölümünde ise yapmış olduğunuz kuponu ve kazanacağınız kredi’yi görebileceksiniz. Kazandığınızı ise sistem otomatik olarak belirleyecektir. Sadece kredi kazanmıyorsunuz. Her oynadığınız kupon sonucunda tecrübe puanı da kazanarak diğer rakiplerinizden daha üst sıralarda yer almaya çalışıyorsunuz. Her ay ilk 3’e giren kullanıcılarımıza sürpriz ödüller.</div>
							</div>
						</li>
						
						

					</ul>
				</div>
				<div class="slidernewsimgs">
					<div class="slidernewsimgcont"></div>
					<div class="slidernewstextcont"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Match List -->
		<div class="col-xs-4 pl0">
			<div class="tablist" id="matchlist">
				<div class="tablist_tabs">
					<?php
					$pdo = newPDO();
					$query = $pdo->prepare("SELECT game_id FROM ".TABLE_GAMES_LISTED." WHERE page='main'");
					$query->execute();
					$result_games = $query->fetchAll(PDO::FETCH_ASSOC);

					foreach($result_games as $rg){
						$game = new games($rg['game_id']);
						?>
						<div class="tablist_tab">
							<div class="tablist_title gamename"><?php echo $game->abbr; ?></div>
							<div class="tablist_hiddencontent">
								<ul class="list-unstyled tablist_ul">
									<?php
									$matches = matches::LoadMatchesOfGame($game->id, 8);
									if (count($matches) == 0){
										?> <li class="tablist_element text-center" style="color:white;">Maç bulunmamaktadır.</li> <?php
									}
									foreach($matches as $m){
										$match = new matches($m['id']);
										$gamer1_id = $match->gamer1_id;
										$gamer2_id = $match->gamer2_id;
										$gamer1 = new gamers($gamer1_id);
										$gamer2 = new gamers($gamer2_id);
										?>
										<li class="tablist_element">
											<a href="/index.php?a=stream&b=<?php echo $match->id; ?>">
												<div class="matchlistdata teams">
													<div class="team1"><img src="<?php echo TEAMPHOTOS_DIS.$gamer1->image; ?>"><?php echo trimchars($gamer1->name, 8); ?></div>
													<div class="vs">vs</div>
													<div class="team2"><?php echo trimchars($gamer2->name, 8); ?><img src="<?php echo TEAMPHOTOS_DIS.$gamer2->image; ?>"></div>
												</div>
												<div class="matchlistdata time"><div class="state">
													<?php
													$nowtime = time();
													$matchtime = $match->end_t;
													if ($matchtime < $nowtime){
														echo "<span class='glyphicon glyphicon-time' style='color:red; margin-right: 3px;'></span>";
													}
													else{
														echo "<span class='glyphicon glyphicon-time' style='color:green; margin-right: 3px;'></span>";
													}
													echo "<span style='color:white;'>".simpleHour($match->date_t)."</span> ".simpleDay($match->date_t); 
													?>
												</div></div>
												<div class="clearfix"></div>
											</a>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<?php } ?>

							<div class="clearfix"></div>
						</div>
						<div class="tablist_content"></div>	
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- MAIN PAGE ITEM -->
				<div class="col-xs-8" style="height:400px;">
					<?php
					$pdo = newPDO();
					$query = $pdo->prepare("SELECT item FROM ".MAINPAGE_ITEM." LIMIT 1");
					$query->execute();
					$results = $query->fetch();
					echo $results['item'];
					?>
					<!-- <object type="application/x-shockwave-flash" style="width:100%; height:100%;" id="live_embed_player_flash" data="http://tr.twitch.tv/widgets/live_embed_player.swf?channel=riotgames" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://tr.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=tr.twitch.tv&channel=riotgames&auto_play=true&start_volume=25" /></object> -->
				</div>
				<!-- Stat List -->
				<div class="col-xs-4 pl0">
					<div class="tablist" id="statlist">
						<div class="tablist_tabs">
							<div class="tablist_tab">
								<div class="tablist_title">Aylık Sıralama</div>
								<div class="tablist_hiddencontent">
									<ul class="list-unstyled tablist_ul">
										<?php
										$pdo = newPDO();
										$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY money DESC LIMIT 10");
										$query->execute();
										$result = $query->fetchAll(PDO::FETCH_ASSOC);
										$rankingindex = 1;
										foreach($result as $r){
											$profile = new profile($r['id']);
											?>
											<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"> <?php echo $rankingindex." - ".$profile->nick." <span class='winnersmoney'>".round($profile->money)."</span>"; ?></a> </li>
											<?php
											$rankingindex++;
										} 
										?>
									</ul>
								</div>
							</div>
							<div class="tablist_tab">
								<div class="tablist_title">Genel Sıralama</div>
								<div class="tablist_hiddencontent">
									<ul class="list-unstyled tablist_ul">
										<?php
										$pdo = newPDO();
										$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." ORDER BY total_money DESC LIMIT 10");
										$query->execute();
										$result = $query->fetchAll(PDO::FETCH_ASSOC);
										$rankingindex = 1;
										foreach($result as $r){
											$profile = new profile($r['id']);
											?>
											<li class="tablist_element"> <a href="/index.php?a=profile&id=<?php echo $profile->id; ?>"> <?php echo $rankingindex." - ".$profile->nick." <span class='winnersmoney'>".round($profile->total_money)."</span>"; ?></a> </li>
											<?php
											$rankingindex++;
										}
										?>
									</ul>
								</div>
							</div>
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