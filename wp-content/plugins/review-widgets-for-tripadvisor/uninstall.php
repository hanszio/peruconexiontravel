<?php
require_once plugin_dir_path( __FILE__ ) . 'trustindex-plugin.class.php';
$trustindex_pm_tripadvisor = new TrustindexPlugin_tripadvisor("tripadvisor", __FILE__, "11.0", "WP Tripadvisor Review Widgets", "Tripadvisor");
$trustindex_pm_tripadvisor->uninstall();
?>