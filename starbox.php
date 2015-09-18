<?php

/*
  Copyright (c) 2012, Squirrly Limited.
  The copyrights to the software code in this file are licensed under the (revised) BSD open source license.

  Plugin Name: StarBox
  Plugin URI:
  Author: Squirrly UK
  Description: Starbox is the Author Box for Humans. Professional Themes to choose from, HTML5, Social Media Profiles, Google Authorship
  Version: 3.0.4
  Author URI: https://www.squirrly.co/wordpress-seo-by-squirrly
 */
/* SET THE CURRENT VERSION ABOVE AND BELOW */
define('ABH_VERSION', '3.0.4');
/* Call config files */
require(dirname(__FILE__) . '/config/config.php');

/* important to check the PHP version */
if (PHP_VERSION_ID >= 5100) {
    /* inport main classes */
    require_once(_ABH_CLASSES_DIR_ . 'ObjController.php');
    require_once(_ABH_CLASSES_DIR_ . 'BlockController.php');

    /* Main class call */
    ABH_Classes_ObjController::getController('ABH_Classes_FrontController')->run();

    if (!is_admin())
        ABH_Classes_ObjController::getController('ABH_Controllers_Frontend');
} else {
    /* Main class call */
    add_action('admin_notices', array(ABH_Classes_ObjController::getController('ABH_Classes_FrontController'), 'phpVersionError'));
}

// --
// Upgrade StarBox call.
register_activation_hook(__FILE__, 'abh_upgrade');

function abh_upgrade() {
    set_transient('abh_upgrade', true, 30);
}
