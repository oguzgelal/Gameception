<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}

if (isset($_GET['b'])){
	$matchid = sanitize_string($_GET['b']);
}
else{
	header("Location: /index.php?a=main");
}

include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";

$match = new matches($matchid);

$gamer1 = new gamers($match->gamer1_id);
$gamer2 = new gamers($match->gamer2_id);
$gamer1_rate = $match->gamer1_rate;
$gamer2_rate = $match->gamer2_rate;
$gamer1_name = $gamer1->name;
$gamer2_name = $gamer2->name;


$questions = array();
$answers = array();

if ($match->questionNum() > 0){
	$questions = questions::LoadQuestionsOfMatch($match->id);
	foreach($questions as $q){
		$answers[$q['id']] = answers::LoadAnswersOfQuestion($q['id']);
	}
}

?>

<section class="container section">
	<div class="row">
		<!-- Stream -->
		<div class="col-xs-8">
			<div class="stream">
				<?php echo $match->stream; ?>
			</div>
		</div>
		<!-- Chat -->
		<div class="col-xs-4 pl0">
			<div class="chatcontainer">
				<div class="simplelist" id="chat">
					<div class="simplelist_content">
						<ul class="list-unstyled simplelist_ul">
							<!--
							<li class="simplelist_element">
								<span class="username">Oguz</span><span class="msg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, aspernatur, vitae, pariatur, praesentium ex quasi quam eos facilis ipsam eveniet ad ut suscipit minima sunt libero deserunt voluptate vel neque!</span>
							</li>
						-->
					</ul>
				</div>
			</div>
			<div class="infobox"> <div class="onlineicon" style="background-color: green;"></div> Sohbet </div>
			<div class="chatbox">
				<textarea name="msgtosend" id="msgtosend" disabled>       Çok yakında...</textarea>
				<input type="button" name="sendchat" id="sendchat" value="Gönder">
			</div>
		</div>
	</div>
</div>

<div class="row">
	<!-- Special -->
	<div class="col-xs-8">
		<div class="simplelist" id="special">
			<div class="simplelist_tabs">
				<div class="simplelist_tab active"> <div class="simplelist_title">Özel Bahisler</div> </div>
				<div class="clearfix"></div>
			</div>
			<div class="simplelist_content">
				<ul class="list-unstyled simplelist_ul">

					<li class="simplelist_element question_li" style="text-align: center;">
						<div class="question">Varsayılan Bahis ?</div>
						<ul class="answer_ul">
							<li class="list-unstyled answer_li">
								<div class="answer_rate"><?php echo $gamer1_rate; ?></div>
								<div class="answer defaultanswer"><?php echo $gamer1_name; ?> <div class="selectedmark"></div></div>
								<input type="hidden" id="matchid" value="<?php echo $match->id; ?>">
								<input type="hidden" id="selection" value="1">
								<div class="clearfix"></div>
							</li>
							<li class="list-unstyled answer_li">
								<div class="answer_rate"><?php echo $gamer2_rate; ?></div>
								<div class="answer defaultanswer"><?php echo $gamer2_name; ?> <div class="selectedmark"></div></div>
								<input type="hidden" id="matchid" value="<?php echo $match->id; ?>">
								<input type="hidden" id="selection" value="2">
								<div class="clearfix"></div>
							</li>
						</ul>
					</li>

					<?php 
					foreach($questions as $q){
						$question = new questions($q['id']); 
						?>
						<li class="simplelist_element question_li" style="text-align: center;">
							<div class="question"><?php echo $question->question; ?></div>
							<ul class="answer_ul">
								<?php
								foreach($answers[$q['id']] as $answer_id){
									$answer = new answers($answer_id['id']);
									?>
									<li class="list-unstyled answer_li">
										<div class="answer_rate"><?php echo $answer->rate; ?></div>
										<div class="answer specialanswer"><?php echo $answer->answer; ?> <div class="selectedmark"></div></div>
										<input type="hidden" id="matchid" value="<?php echo $match->id; ?>">
										<input type="hidden" id="answerid" value="<?php echo $answer->id; ?>">
										<input type="hidden" id="questionid" value="<?php echo $answer->question_id; ?>">
										<div class="clearfix"></div>
									</li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<!-- Kupon -->
			<div class="col-xs-4 pl0">

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

	<script>
	var connection=new WebSocket("ws://nodechatog.nodejitsu.com:80");
	connection.onopen = function () {
		console.log('message|connection established|');
	};
	connection.onerror = function (error) {
		console.log('message|error|'+error.data);
	};
	connection.onmessage = function (e) {
		//console.log('Received From Server: ' + e.data);
		var message = e.data;
		console.log(message);
	};
	</script>

	<?php
	include_once dirname(__FILE__) . "/_footer.php";
	include_once dirname(__FILE__) . "/_htmlend.php";
	?>