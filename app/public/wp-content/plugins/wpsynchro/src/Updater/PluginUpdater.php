<?php

/**
 *  Plugin updater
 *  @since 1.6.0
 */

namespace WPSynchro\Updater;

class PluginUpdater
{

    /**
     *  Check for updates
     */
    public function checkForUpdate()
    {
        if (!class_exists('WPSynchroPuc_v4p9_Factory')) {
            require dirname(__FILE__) . '/Puc/v4p9/Autoloader.php';
        }
        new \WPSynchroPuc_v4p9_Autoloader();
        if (!class_exists('WPSynchroPuc_v4p9_Factory')) {
            require dirname(__FILE__) . '/Puc/v4p9/Factory.php';
        }

        if (!class_exists('WPSynchroPuc_v4_Factory')) {
            require dirname(__FILE__) . '/Puc/v4/Factory.php';
        }

        \WPSynchroPuc_v4_Factory::addVersion('Plugin_UpdateChecker', 'WPSynchroPuc_v4p9_Plugin_UpdateChecker', '4.9');
        \WPSynchroPuc_v4p9_Factory::addVersion('Plugin_UpdateChecker', 'WPSynchroPuc_v4p9_Plugin_UpdateChecker', '4.9');

        $updatechecker = \WPSynchroPuc_v4p9_Factory::buildUpdateChecker(
            'https://wpsynchro.com/update/?action=get_metadata&slug=wpsynchro',
            WPSYNCHRO_PLUGIN_DIR . 'wpsynchro.php',
            'wpsynchro'
        );

        return $updatechecker;
    }
}
