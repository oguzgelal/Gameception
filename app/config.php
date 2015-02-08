<?php

session_name( 'gameception' );
if(session_id() == '') {
    session_start();
}


define( "DB_NAME", "Gameception" );
define( "DB_USER", "root" );
define( "DB_PASSWORD", "root" );
define( "DB_HOST", "localhost" );

define( "TABLE_MATCHES", "obj_matches" );
define( "TABLE_MATCHSPECIAL_QUESTIONS", "obj_match_special_questions" );
define( "TABLE_MATCHSPECIAL_ANSWERS", "obj_match_special_answers" );
define( "TABLE_KUPON_MATCHES", "kupon_matches" );
define( "TABLE_KUPON_QUESTIONS", "kupon_questions" );

define( "TABLE_GAMERS", "obj_gamers" );
define( "TABLE_GAMES", "obj_games" );
define( "TABLE_KUPON", "obj_kupon" );
define( "TABLE_PROFILE", "obj_profile" );
define( "TABLE_BADGES", "obj_badges" );
define( "TABLE_TURNUVA", "obj_turnuva" );

define( "TABLE_BADGES_PROFILE", "badges_profile" );
define( "TABLE_GAMES_LISTED", "games_listed" );
define( "TABLE_GAMERS_GAME", "gamers_game" );
define( "TABLE_PROFILE_FOLLOW", "profile_follow" );
define( "TABLE_PROFILE_MESSAGE", "profile_message" );
define( "TABLE_TURNUVA_GAMERS", "turnuva_gamers" );

define( "TABLE_MONTHLY_EXECUTION", "monthly_execution" );
define( "TABLE_DAILY_EXECUTION", "daily_execution" );
define( "DISMISSNOTIF", "notifications" );
define( "REGCODES", "regcodes" );
define( "MAINPAGE_ITEM", "mainpage_item" );

define ( "USER", "1" );
define ( "ADMIN", "2" );

/* BADGES */

define( "BADGEICON", "/app/photos/badges/" );

define( "MEMBERBADGE1", "1" );
define( "MEMBERBADGE2", "2" );
define( "MEMBERBADGE3", "3" );
define( "MEMBERBADGE4", "4" );
define( "MEMBERBADGE5", "5" );

define( "RANKBADGE1", "6" );
define( "RANKBADGE2", "7" );
define( "RANKBADGE3", "8" );
define( "RANKBADGE4", "9" );
define( "RANKBADGE5", "10" );

define( "LEVELBADGE1", "11" );
define( "LEVELBADGE2", "12" );
define( "LEVELBADGE3", "13" );
define( "LEVELBADGE4", "14" );
define( "LEVELBADGE5", "15" );

define( "CLOSEDBETABADGE", "16" );

define( "COOKIE_EXPIRE" , 2592000 );
define( "COUPON_INTERVAL", 600 );
define( "NOTIF_INTERVAL", 360 );
define( "LONGTIME_INTERVAL", 3600 );

/* TODO : implement turnuva */

define( "ROOT", dirname(__FILE__) );
define( "ACTIONS", ROOT . "/actions" );
define( "AJAX", ROOT . "/ajax" );

define( "AVATAR", ROOT."/photos/profile_photos/" );
define( "AVATAR_DIS", "/app/photos/profile_photos/" );

define( "BADGEIMAGES", ROOT."/photos/badges/" );
define( "BADGEIMAGES_DIS", "/app/photos/badges/" );

define( "TEAMPHOTOS", ROOT."/photos/team_photos/" );
define( "TEAMPHOTOS_DIS", "/app/photos/team_photos/" );

define( "NEWSPHOTOS", ROOT."/photos/news/" );
define( "NEWSPHOTOS_DIS", "/app/photos/news/" );

// mothly refresh interval
define( "DEFAULTIMG", "default.png" );
define( "MONTHINSECS", 2592000 );
define( "DAYSINSECS", 86400 );
define( "DEFAULTMONEY", 500 );

// Load required php classes
$classes = glob( ROOT . "/classes/*.php" );
if ( $classes && is_array( $classes ) ) {
	foreach ( $classes as $file ) {
		include_once $file;
	}
}
unset( $classes );

// Load required php functions
$functions = glob( ROOT . "/functions/*.php" );
if ( $functions && is_array( $functions ) ) {
	foreach ( $functions as $file ) {
		include_once $file;
	}
}
unset( $functions );

