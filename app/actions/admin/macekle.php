<?php
// Simple security check
if (!isAdminLoggedIn()){ exit(); }
if ( !isset( $ping ) || $ping != "pong" ) { exit(); }

$editmode = false;
if (isset($_GET['id'])){
	$editmode = true;
	$matchid = sanitize_string($_GET['id']);
	$match = new matches($matchid);
}

include_once ACTIONS . "/public/_htmlstart.php";
include_once ACTIONS . "/public/_header.php";
include_once ACTIONS . "/admin/_adminmenu.php";
?>

<!-- Contents -->
<div class="container section" style='color: white;'>

	<form role="form" action="/index.php?a=ajax&b=admin&c=addmatch" method="post">
		
		<?php
		if ($editmode){ echo "<input type='hidden' class='editmode' name='editmode' id='editmode' value='".$match->id."'>"; }
		else { echo "<input type='hidden' class='editmode' name='editmode' id='editmode' value='-1'>"; }
		?>

		<!-- Title -->
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1 style='margin-top:0;margin-bottom:0;'><?php $write = ($editmode) ? "Düzenle" : "Maç Ekle"; echo $write; unset($write); ?></h1>
				<hr style='margin-top:0;margin-bottom: 0;'>
			</div>
		</div>

		<!-- Gamers & Rates -->
		<div class="row">
			<div class="col-xs-3">
				<select class="form-control gamer1_id" name='gamer1_id' id='gamer1_id'>
					<?php
					$gamers = gamers::LoadAll();
					foreach($gamers as $g){
						$gamer = new gamers($g['id']);
						$selected = "";
						if ($editmode && $match->gamer1_id==$gamer->id){ $selected = "selected='selected'";	}
						echo "<option ".$selected." value='".$gamer->id."'>".$gamer->name."</option>";
					}
					?>
				</select>
			</div>
			<div class="col-xs-2">
				<input type="text" class='form-control gamer1_rate' name='gamer1_rate' id='gamer1_rate' placeholder='Gamer 1 Rate' value='<?php if($editmode){ echo $match->gamer1_rate; } ?>'>
			</div>
			<div class="col-xs-2 text-center">
				<h2 style='margin:0; padding:0;'>vs</h2>
			</div>
			<div class="col-xs-3">
				<select class="form-control gamer2_id" name='gamer2_id' id='gamer2_id'>
					<?php
					$gamers = gamers::LoadAll();
					foreach($gamers as $g){
						$gamer = new gamers($g['id']);
						$selected = "";
						if ($editmode && $match->gamer2_id==$gamer->id){ $selected = "selected='selected'";	}
						echo "<option ".$selected." value='".$gamer->id."'>".$gamer->name."</option>";
					}
					?>
				</select>
			</div>
			<div class="col-xs-2">
				<input type="text" class='form-control gamer2_rate' name='gamer2_rate' id='gamer2_rate' placeholder='Gamer 2 Rate' value='<?php if($editmode){ echo $match->gamer2_rate; } ?>'>
			</div>
		</div>

		<!-- Stream Link -->
		<div class="row">
			<div class="col-xs-12">
				<label for="stream">Stream Embedd Code</label>
				<textarea class="form-control stream" name='stream' id='stream' rows="3"><?php if ($editmode){ echo $match->stream; } ?></textarea>
			</div>
		</div>

		<!-- Dates -->
		<div class="row">

			<?php 
			if ($editmode){ 
				$end_t = $match->end_t;
				$date_t = $match->date_t; 
				
				$writehour_end = simpleHour($end_t);
				$writedate_end = simpleDay($end_t);

				$writehour_day = simpleHour($date_t);
				$writedate_day = simpleDay($date_t);
			} 
			?>

			<div class="col-xs-2 text-left">
				<label for="end_t_hour">Betting Close <br> (hh:mm)</label>
				<input type="text" style='width: 100%;' class='form-control end_t_hour' name='end_t_hour' id='end_t_hour' placeholder='<?php echo simpleHour(time()); ?>' value="<?php if($editmode){ echo $writehour_end; } ?>">
			</div>
			<div class="col-xs-2 text-left">
				<label for="end_t_hour">Betting Close <br> (dd/mm/yyyy)</label>
				<input type="text" style='width: 100%;' class='form-control end_t_day' name='end_t_day' id='end_t_day' placeholder='<?php echo simpleDay(time()); ?>' value="<?php if($editmode){ echo $writedate_end; } ?>">
			</div>
			<div class="col-xs-2 text-left">
				<label for="date_t_hour">Match <br> (hh:mm)</label>
				<input type="text" style='width: 100%;' class='form-control date_t_hour' name='date_t_hour' id='date_t_hour' placeholder='<?php echo simpleHour(time()); ?>' value="<?php if($editmode){ echo $writehour_day; } ?>">
			</div>
			<div class="col-xs-2 text-left">
				<label for="date_t_hour">Match <br> (dd/mm/yyyy)</label>
				<input type="text" style='width: 100%;' class='form-control date_t_day' name='date_t_day' id='date_t_day' placeholder='<?php echo simpleDay(time()); ?>' value="<?php if($editmode){ echo $writedate_day; } ?>">
			</div>
			<div class="col-xs-4 text-left">
				<label for="timezone">Entering time according to <br> which timezone ? 
					<a href="#" class="infopopover" data-toggle="popover" data-placement="right" data-content="Soldaki kutucuklara girdiğiniz zaman, bu listedeki seçeceğiniz zaman dilimine göre kaydedilecektir. Örneğin Amerika'da Denver şehrinde oranın saatine göre 21:00 02/03/2014 tarihinde oynanacak bir maçı eklerken saati ve tarihi 21:00 02/03/2014 olarak girip zaman dilimini 'America/Denver' olarak seçmelisiniz."><span class="glyphicon glyphicon-question-sign"></span></a>
					<?php if ($editmode){ ?><a href="#" class="infopopover" data-toggle="popover" data-placement="right" data-content="Maç eklerken seçtiğiniz zaman dilimi ne olursa olsun, soldaki kutucuklar anlık zaman diliminiz (<?php echo date_default_timezone_get(); ?>)'e göre doldurulmaktadır. Farklı bir zaman dilimine göre ayarlamak isterseniz, istediğiniz zaman dilimini listeden seçip kutucukları seçtiğiniz zaman dilimine göre doldurabilirsiniz."><span class="glyphicon glyphicon-info-sign"></span></a><?php } ?> 
				</label>
				<select type="text" style='width: 100%;' class='form-control timezone' name='timezone' id='timezone'>
					<option value="Europe/Istanbul" selected='selected'>Europe/Istanbul</option>
					<option value="<?php echo date_default_timezone_get(); ?>">Server Timezone (<?php echo date_default_timezone_get(); ?>)</option>
					<option value="UTC">UTC</option>
					<?php
					$zones = timezone_identifiers_list();
					foreach($zones as $zone){
						$dtz = new DateTimeZone($zone);
						$timeinzone = new DateTime('now', $dtz);
						$offset = $dtz->getOffset($timeinzone) / 3600;
						echo "<option value='".$zone."'>".$zone."  |  GMT".( ($offset<0) ? $offset : "+".$offset)."</option>";
					}
					?>
				</select>
			</div>
		</div>

		<!-- XP and Winner -->
		<div class="row">
			<div class="col-xs-1">
				<label for="xp">XP</label>
				<input type="text" style='width: 100%;' class='form-control xp' name='xp' id='xp' value='<?php if ($editmode) { echo $match->xp; } ?>'>
			</div>
			<div class="col-xs-3">
				<?php
				$winner0 = "";
				$winner1 = "";
				$winner2 = "";
				if ($editmode){
					$winnderid = $match->winner_gamer_id;
					if ($winnderid==0){ $winner0 = "selected='selected'"; }
					else if ($winnderid==1){ $winner1 = "selected='selected'"; }
					else if ($winnderid==2){ $winner2 = "selected='selected'"; }
				}
				?>
				<label for="winner_gamer_id">Winner</label>
				<select class="form-control winner_gamer_id" name='winner_gamer_id' id='winner_gamer_id'>
					<option <?php echo $winner0; ?> value="0">Not Finished</option>
					<option <?php echo $winner1; ?> value="1">Gamer 1</option>
					<option <?php echo $winner2; ?> value="2">Gamer 2</option>
				</select>
			</div>
			<div class="col-xs-3">
				<label for="game_id">Game</label>
				<select class="form-control game_id" name='game_id' id='game_id'>
					<?php
					$games = games::LoadAll();
					foreach($games as $g){
						$game = new games($g['id']);
						$selected = "";
						if ($editmode && $match->game_id==$game->id){
							$selected="selected='selected'";
						}
						echo "<option ".$selected." value='".$game->id."'>".$game->name."</option>";
					}
					?>
				</select>
			</div>
			<div class="col-xs-5">
				<button type="submit" style='margin-top: 24px; width: 100%;' class="btn btn-danger savematch">Kaydet</button>
			</div>
		</div>

	</form>

</div>


<?php
include_once ACTIONS . "/public/_footer.php";
include_once ACTIONS . "/public/_htmlend.php";
?>