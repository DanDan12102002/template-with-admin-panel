<?php
ini_set('display_errors',0);
/**
 * Constant to prevent direct access to files, only paste
 */
define('_JEXEC', 1);

# Connect the main functionality
require_once "./assets/library/app.php";
$app = new LandingPageAPP();

# META
$app->meta = new stdClass();
# Sitename
$app->meta->sitename = 'Restaurant';
# Title
$app->meta->title = 'Restaurant';
# Description
$app->meta->desc = 'Ресторан Dan\'s Food';
# Image for social, size: 1200x630px
$app->meta->image = $app->baseurl.'/assets/images/social.jpg';

# ----------------------- WARNING ----------------------- #
/*
 * There is a function on the page that generates CSS from Less
 * To edit styles, you need to edit the Less file, NOT CSS (!!!)
 * The less file is here: assets/less/style.less
 * If you do not update the styles on the new host, you need
 * delete cache file: assets/less/style.less.cache (!!!)
 * Questions, complaints, wishes write on this email: colin990@gmail.com
*/

# Load the page template
/*
 * The page files are in the tmpl directory
 * the name of the files by analogy with the link:
 * If the link is http://site.com/page-1/, then the template file "page-1.php"
 * The template connects Css and Js files. To be able to
 * Activate the cache and optimize styles and scripts (included in the config: assets/config.php)
 * You need to connect them through the file assets/includes.xml
*/
$app->loadTemplate();
?>