<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}

// receive gamer data
$gamer1_id = sanitize_string($_POST['gamer1_id']);
$gamer2_id = sanitize_string($_POST['gamer2_id']);
$gamer1_rate = sanitize_string($_POST['gamer1_rate']);
$gamer2_rate = sanitize_string($_POST['gamer2_rate']);

// receive stream embedd code
$stream = stripslashes(sanitize_string($_POST['stream']));

// receive time data
$end_t_hour = sanitize_string($_POST['end_t_hour']);
$end_t_day = sanitize_string($_POST['end_t_day']);
$date_t_hour = sanitize_string($_POST['date_t_hour']);
$date_t_day = sanitize_string($_POST['date_t_day']);

// extract proper time data
$end_t_hour_hour = explode(':', $end_t_hour)[0];
$end_t_hour_minute = explode(':', $end_t_hour)[1];
$end_t_day_day = explode('/', $end_t_day)[0];
$end_t_day_month = explode('/', $end_t_day)[1];
$end_t_day_year = explode('/', $end_t_day)[2];
$date_t_hour_hour = explode(':', $date_t_hour)[0];
$date_t_hour_minute = explode(':', $date_t_hour)[1];
$date_t_day_day = explode('/', $date_t_day)[0];
$date_t_day_month = explode('/', $date_t_day)[1];
$date_t_day_year = explode('/', $date_t_day)[2];

// set timezone and generate unix timestamp
$timezone = sanitize_string($_POST['timezone']);
date_default_timezone_set($timezone);
$end_t = mktime($end_t_hour_hour, $end_t_hour_minute, 0, $end_t_day_month, $end_t_day_day, $end_t_day_year);
$date_t = mktime($date_t_hour_hour, $date_t_hour_minute, 0, $date_t_day_month, $date_t_day_day, $date_t_day_year);
date_default_timezone_set(date_default_timezone_get());

// receive other data
$xp = sanitize_string($_POST['xp']);
$winner_gamer_id = sanitize_string($_POST['winner_gamer_id']);
$game_id = sanitize_string($_POST['game_id']);
$editmode = sanitize_string($_POST['editmode']);

// create new match object - load edited match if necessary
if ($editmode == -1){ $match = new matches(); }
else{ $match = new matches($editmode); }

// set necessary data of the object
$match->setGamer1ID($gamer1_id);
$match->setGamer2ID($gamer2_id);
$match->setGamer1Rate($gamer1_rate);
$match->setGamer2Rate($gamer2_rate);
$match->setGameID($game_id);
$match->setStream($stream);
$match->setDateT($date_t);
$match->setEndT($end_t);
$match->setDesc("");
$match->setXP($xp);
$match->setActive(1);
$match->setWinnerID($winner_gamer_id);

// insert or update the edited object to the database
if ($editmode == -1){ $match->insert(); }
else{ $match->update(); }

// test
/*
echo "gamer1_id: ".$gamer1_id."<br>";
echo "gamer2_id: ".$gamer2_id."<br>";
echo "gamer1_rate: ".$gamer1_rate."<br>";
echo "gamer2_rate: ".$gamer2_rate."<br>";
echo "<textarea>".$stream."</textarea><br>";
echo "end_t: ".$end_t."<br>";
echo "date_t: ".$date_t."<br>";
echo "xp: ".$xp."<br>";
echo "winner_game_id: ".$winner_gamer_id."<br>";
echo "game_id: ".$game_id."<br>";
*/

header("Location: /index.php?a=administration&b=maclar");

?>