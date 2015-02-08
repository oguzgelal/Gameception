<?php
$answerid = sanitize_string($_POST['answerid']);
$answer = new answers($answerid);
echo $answer->rate;