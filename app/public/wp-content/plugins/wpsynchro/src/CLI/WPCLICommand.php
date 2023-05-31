<?php

namespace WPSynchro\CLI;

/**
 * WP Synchro plugin commands, such as run migration
 * @since 1.3.0
 */
class WPCLICommand
{

    /**
     * Run migration
     *
     * ## OPTIONS
     *
     * <migration_id>
     * : The id of the migration - Can be found in the overview for a specific setup
     *
     * ---
     * default: success
     * options:
     *   - success
     *   - error
     * ---
     *
     * ## EXAMPLES
     *
     * wp wpsynchro run <migration_id>
     *
     */
    public function run($args, $assoc_args)
    {
        list($migration_id) = $args;
        $job_id = uniqid();

        // Check that migrations id exists
        global $wpsynchro_container;
        $migrationFactory = $wpsynchro_container->get('class.MigrationFactory');

        $migration = $migrationFactory->retrieveMigration($migration_id);
        if (!$migration) {
            \WP_CLI::error(sprintf(__('Migration id "%s" could not be found. Make sure it is identical to the one found on the overview page in WP Synchro.', 'wpsynchro'), $migration_id));
        }

        /**
         *  Running
         */
        \WP_CLI::log(__('Starting migration...', 'wpsynchro'));

        while (true) {
            $sync = $wpsynchro_container->get('class.MigrationController');
            $sync->setup($migration_id, $job_id);
            $sync->timer->overall_sync_timer = null;
            $result = $sync->runMigration();

            if ($result->is_completed) {
                break;
            }

            if (count($result->errors) > 0) {
                foreach ($result->errors as $error) {
                    \WP_CLI::error($error, false);
                }
                \WP_CLI::halt(1);
            }
        }

        \WP_CLI::success(__('Migration completed with 0 errors', 'wpsynchro'));
    }
}
