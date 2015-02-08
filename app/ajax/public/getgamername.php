<?php
$gamerid = sanitize_string($_POST['gamerid']);
$gamer = new gamers($gamerid);
echo $gamer->name;