<?php
// Simple security check
if (!isAdminLoggedIn()){ exit(); }
if ( !isset( $ping ) || $ping != "pong" ) { exit(); }


if (!isset($_GET['id'])){
	$emptyquestion = new questions();
	$addedid = $emptyquestion->insert();
	header("Location: /index.php?a=administration&b=specialbetekle&id=".$addedid);
}

$editmode = true;
$specialid = sanitize_string($_GET['id']);
$question = new questions($specialid);
$answers = answers::LoadAnswersOfQuestion($question->id);

include_once ACTIONS . "/public/_htmlstart.php";
include_once ACTIONS . "/public/_header.php";
include_once ACTIONS . "/admin/_adminmenu.php";
?>
<!-- Contents -->
<div class="container section" style='color: white;'>

	<form role="form" action="/index.php?a=ajax&b=admin&c=addbet" method="post">
		
		<!-- Special Question ID -->
		<input type="hidden" name="specialid" id="specialid" value="<?php echo $specialid; ?>">

		<!-- Title -->
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1 style='margin-top:0;margin-bottom:0;'>Special Bets</h1>
				<hr style='margin-top:0;margin-bottom: 0;'>
			</div>
		</div>

		<!-- Question -->
		<div class="row">
			<div class="col-xs-12">
				<label for="question">Special Question</label>
				<textarea class="form-control question" name='question' id='question' rows="3" placeholder="Add question here"><?php if ($editmode){ echo $question->question; } ?></textarea>
			</div>
		</div>

		<!-- Answers -->
		<div class="row">
			<div class="col-xs-12">
				<label for="question">Answers</label>
				<div class="added_answers">
					<?php
					if ($editmode){
						foreach($answers as $a){
							$answer = new answers($a['id']);
							$selected = "";
							if ($question->correct_answer_id == $answer->id){
								$selected = "checked";
							}
							?>
							<div class="answergroup" id="<?php echo $answer->id; ?>">
								<input type="text" style="width: 50%; float:left; margin-bottom:10px;" class="form-control answer" name="answer" id="a<?php echo $answer->id; ?>" value="<?php echo $answer->answer; ?>">
								<input type="text" style="width: 10%; float:left; margin-left: 10px; margin-bottom:10px;" class="form-control answer_rate" name="answer_rate" id="a<?php echo $answer->id; ?>" value="<?php echo $answer->rate; ?>">
								<label style='margin-left: 10px;'><input type="radio" <?php echo $selected; ?> name="correctanswer_radio" id="a<?php echo $answer->id; ?>" value="<?php echo $answer->id; ?>"> Correct Answer </label>
								<input type="hidden" class="questionid" id="a<?php echo $answer->id; ?>" value="<?php echo $question->id; ?>">
								<input type="button" style="width: 8%; float:left; margin-left: 10px; margin-bottom:10px;" id="<?php echo $answer->id; ?>" class="form-control btn btn-primary updateanswer" value="Save">
								<input type="button" style="width: 8%; float:left; margin-left: 10px; margin-bottom:10px;" id="<?php echo $answer->id; ?>" class="form-control btn btn-danger deleteanswer" value="Delete">
								<div class="clearfix"></div>
							</div>
							<?php
						}
					}
					?>
				</div>
				<input type="text" style="width: 50%; float:left;" class="form-control answer_add" name="answer_add" id="-1" placeholder="Enter answer for this question">
				<input type="text" style="width: 10%; float:left; margin-left: 10px;" class="form-control answer_rate_add" name="answer_rate_add" id="-1" placeholder="Rate">
				<label style='margin-left: 10px; width: 20%;'><input type="radio" <?php if ($question->correct_answer_id==0){ echo "checked"; } ?> name="correctanswer_radio" value="0"> None </label>
				<input type="button" style="width: 8%; float:left; margin-left: 10px;" class="form-control btn btn-success saveanswer" value="Add">
				<input type="hidden" class="questionid_add" value="<?php echo $question->id; ?>">
				<div class="clearfix"></div>
			</div>
		</div>

		<!-- Other settings-->
		<div class="row">
			<div class="col-xs-1">
				<label for="xp">XP</label>
				<input type="text" style='width: 100%;' class='form-control xp' name='xp' id='xp' value='<?php if ($editmode) { echo $question->xp; } ?>'>
			</div>
			<div class="col-xs-5">
				<label for="matchid">Match</label>
				<select class="form-control" name="matchid" id="matchid">
					<?php
					if ($question->match_id != 0){
						$selectedmatch = new matches($question->match_id);
						if ($selectedmatch->found == 1){
							?><option value="<?php echo $selectedmatch->id; ?>" selected="selected"><?php echo $selectedmatch->matchInfo(); ?></option><?php
						}
					}
					else{
						echo "<option value='-1'>Not selected</option>";
					}
					$upcomingmatches = matches::LoadUpcomingMatches();
					foreach($upcomingmatches as $um){
						$match = new matches($um['id']);
						?><option value="<?php echo $match->id; ?>"><?php echo $match->matchInfo(); ?></option><?php
					}
					?>
				</select>
			</div>
			<div class="col-xs-6">
				<button type="submit" style='margin-top: 24px; width: 100%;' class="btn btn-danger savebet">Kaydet</button>
			</div>
		</div>

	</form>

</div>


<?php
include_once ACTIONS . "/public/_footer.php";
include_once ACTIONS . "/public/_htmlend.php";
?>