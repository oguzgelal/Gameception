<?php
require 'src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '210205559160899',
  'secret' => 'db3eb1d154dce528b4bbbe2bac1e24e3',
));

$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} 
else {
  $loginUrl = $facebook->getLoginUrl();
}

$naitik = $facebook->api('/naitik');


/* make the API call 
$response = $facebook->api(
    "/{user-id}/likes/{page-id}"
);
handle the result 

If the person represented by user-id likes the page represented by page-id in the above request, the response will contain the Page object. If they do not like the page, there will be an empty dataset returned.
*/

$likes = $facebook->api("/me/likes/273129442854340");
echo "<hr>likes:<br>";
var_dump($likes);
echo "<hr>";

?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>php-sdk</h1>

    <?php if ($user){ ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php } else{ ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php } ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user){ ?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); ?></pre>
    <?php } else { ?>
      <strong><em>You are not Connected.</em></strong>
    <?php } ?>

    <h3>Public profile of Naitik</h3>
    <img src="https://graph.facebook.com/naitik/picture">
    <?php echo $naitik['name']; ?>
  </body>
</html>
