<?php
$matchid = sanitize_string($_POST['matchid']);
$match = new matches($matchid);
echo json_encode($match);