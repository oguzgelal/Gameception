<?php
$userid_getmoney = $_SESSION['userid'];
$user_getmoney = new profile($userid_getmoney);
echo $user_getmoney->money;