<?php

define('CLEANCODED_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CLEANCODED_PLUGIN_URL', plugin_dir_url(__FILE__));

//Include plugin required classes
require_once(CLEANCODED_PLUGIN_PATH . 'classes/CleancodedSSSetup.php');
require_once(CLEANCODED_PLUGIN_PATH . 'classes/CleancodedSSBase.php');
require_once(CLEANCODED_PLUGIN_PATH . 'classes/CleancodedSSAdmin.php');
require_once(CLEANCODED_PLUGIN_PATH . 'classes/CleancodedSSFrontend.php');