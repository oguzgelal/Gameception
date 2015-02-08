<?php
$questionid = sanitize_string($_POST['questionid']);
$question = new questions($questionid);
echo $question->match_id;