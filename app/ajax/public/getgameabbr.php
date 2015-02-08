<?php
$gameid = sanitize_string($_POST['gameid']);
$game = new games($gameid);
echo $game->abbr;