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
			<hr style="border-color:black;">
			<?php
			
			$pdo = newPDO();
			$query = $pdo->prepare("SELECT * FROM ".TABLE_GAMERS);
			$query->execute();
			$result_gamers = $query->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_gamers as $rg){
				$gamer = new gamers($rg['id']);
				$teamselect = "";
				$personselect = "";
				if ($gamer->type == 1){ $teamselect = "selected='selected'"; }
				else if ($gamer->type == 2){ $personselect = "selected='selected'"; }
				?>
				<form name="gamersform" enctype="multipart/form-data" action="/index.php?a=ajax&b=admin&c=updateteam" method="post">
					<input type="hidden" name="teamid" id="teamid" value="<?php echo $gamer->id; ?>">
					<input type="hidden" name="teamimg" id="teamimg" value="<?php echo $gamer->image; ?>">
					<input type="hidden" name="action" id="action" value="update">
					<div class="gamergroup" style="width:100%;display:inline;">
						<div class="gamergroup1" style="width:10%;float:left;">
							<img src="<?php echo TEAMPHOTOS_DIS.$gamer->image; ?>" style="float:left;margin-bottom:10px;margin-right:10px;width:100px;height:100px;">	
						</div>
						<div class="gamergroup2" style="width:80%;height:50px;float:left;margin-left:2%;">
							<input type="text" class="form-control" name="teamname" id="teamname" style="width:50%;float:left;margin-bottom:10px;" value="<?php echo $gamer->name; ?>">
							<select class="form-control" name="teamtype" id="teamtype" style="width:100px;float:left;margin-left:10px;" id="type">
								<option value="1" <?php echo $teamselect; ?>>Team</option>
								<option value="2" <?php echo $personselect; ?>>Person</option>
							</select>
							<div class="clearfix"></div>
						</div>
						<div class="gamergroup3" style="width:80%;height:50px;float:left;margin-left:2%;">
							<input type="file" class="btn btn-default" name="teamphoto" id="teamphoto" style="width:200px;float:left;">
							<input type="submit" class="btn btn-primary updateteambutton" id="<?php echo $gamer->id; ?>" style="margin-left:10px;float:left;" value="Save">
							<input type="button" class="btn btn-danger" style="margin-left:10px;float:left;" value="Delete">
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
				<hr style="border-color:black;">
				<?php
			}
			?>
			<form name="gamersform" enctype="multipart/form-data" action="/index.php?a=ajax&b=admin&c=updateteam" method="post">
					<input type="hidden" name="action" id="action" value="insert">
					<div class="gamergroup" style="width:100%;display:inline;">
						<div class="gamergroup2" style="width:80%;height:50px;float:left;margin-left:2%;">
							<input type="text" class="form-control" name="teamname" id="teamname" style="width:50%;float:left;margin-bottom:10px;">
							<select class="form-control" name="teamtype" id="teamtype" style="width:100px;float:left;margin-left:10px;" id="type">
								<option value="1">Team</option>
								<option value="2">Person</option>
							</select>
							<div class="clearfix"></div>
						</div>
						<div class="gamergroup3" style="width:80%;height:50px;float:left;margin-left:2%;">
							<input type="file" class="btn btn-default" name="teamphoto" id="teamphoto" style="width:200px;float:left;">
							<input type="submit" class="btn btn-success updateteambutton" style="margin-left:10px;float:left;" value="Add">
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>

		</div>
	</div>
</div>


<?php
include_once ACTIONS . "/public/_footer.php";
include_once ACTIONS . "/public/_htmlend.php";
?>