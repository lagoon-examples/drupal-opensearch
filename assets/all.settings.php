<?php
/**
 * @file
 * amazee.io Drupal all environment configuration file.
 *
 * This file should contain all settings.php configurations that are needed by all environments.
 *
 * It contains some defaults that the amazee.io team suggests, please edit them as required.
 */

// Defines where the sync folder of your configuration lives. In this case it's inside
// the Drupal root, which is protected by amazee.io Nginx configs, so it cannot be read
// via the browser. If your Drupal root is inside a subfolder (like 'web') you can put the config
// folder outside this subfolder for an advanced security measure: '../config/sync'.
$settings['config_sync_directory'] = '../config/sync';

if (getenv('LAGOON_ENVIRONMENT_TYPE') !== 'production') {
    /**
     * Skip file system permissions hardening.
     *
     * The system module will periodically check the permissions of your site's
     * site directory to ensure that it is not writable by the website user. For
     * sites that are managed with a version control system, this can cause problems
     * when files in that directory such as settings.php are updated, because the
     * user pulling in the changes won't have permissions to modify files in the
     * directory.
     */
    $settings['skip_permissions_hardening'] = TRUE;
}

### Lagoon Elasticsearch connection.
// WARNING: you have to create an elasticsearch cluster called "elastic" at
// /admin/config/search/elasticsearch-connector and a search_api server called 
// "elastic" at /admin/config/search/search-api/add-server to make this work.
if (getenv('LAGOON')) {
    $config['elasticsearch_connector.cluster.elastic']['cluster_id'] = 'elastic';
    $config['elasticsearch_connector.cluster.elastic']['name'] = 'elastic';
    $config['elasticsearch_connector.cluster.elastic']['status'] = '1';
    $config['elasticsearch_connector.cluster.elastic']['url'] = 'http://elasticsearch:9200';    
    $config['search_api.server.elastic']['backend_config']['cluster_settings']['cluster'] = 'elastic';
    $config['search_api.server.elastic']['name'] = 'Lagoon Elastic - Environment: ' . getenv('LAGOON_PROJECT');
  }
