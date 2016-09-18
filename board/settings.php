<?php
// >>> SETUP YOUR MESSAGE BOARD <<< //
// Detailed information found in the readme.htm file
// Settings file version: 1.3

// Password for admin area
$settings['apass']='SivaD';

// Website title
$settings['website_title']="CR_IFAD";

// Website URL
$settings['website_url']='http://cr-ifad.net/index.php/';

// Message board title
$settings['mboard_title']="CR-IFAD - message board";

// URL to folder where message board is installed
// DO NOT a trailing "/" !
$settings['mboard_url']='http://cr-ifad.net/board';

/* Prevent automated submissions (recommended YES)? 0 = NO, 1 = YES, GRAPHICAL, 2 = YES, TEXT */  
$settings['autosubmit']=1;

/* Checksum - just type some digits and chars. Used to help prevent SPAM */
$settings['filter_sum']='d83hfdwg34';

/* Use JunkMark(tm) SPAM filter (recommended YES)? 1 = YES, 0 = NO */
$settings['junkmark_use']=1;

/* JunkMark(tm) score limit after which messages are marked as SPAM */
$settings['junkmark_limit']=60;

// Allow smileys? 1 = YES, 0 = NO
$settings['smileys']=1;

// Send you an e-mail when a new entry is added? 1 = YES, 0 = NO
$settings['notify']=1;

// Your e-mail. Only required if $settings['notify'] is set to 1.
$settings['admin_email']='ifad.golfer@gmail.com';

// Display IP number of members posting? 1 = YES, 0 = NO
$settings['display_IP']=0;

// Maximum number of posts displayed on the first page
$settings['maxposts']=20;

// Keep or delete old posts? 1 = KEEP, 0 = DELETE
$settings['keepoldmsg']=1;

// File exstention for message files
$settings['extension']='html';

/* Filter bad words? 1 = YES, 0 = NO */
$settings['filter']=0;

/* Filter language. Please refer to readme for info on how to add more bad words
to the list! */
$settings['filter_lang']='en';

/* DO NOT EDIT BELOW */
if (!defined('IN_SCRIPT')) {die('Invalid attempt!');}
?>
