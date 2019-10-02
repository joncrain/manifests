<?php

return array(
    'client_tabs' => array(
        'manifests-tab' => array('view' => 'manifests_tab', 'i18n' => 'manifests.listing.title'),
    ),
    'detail_widgets' => [
        'manifests_detail' => ['view' => 'manifests_detail_widget'],
    ],
    'widgets' => array(
        'manifests-included' => array('view' => 'included_manifests_widget'),
        'manifests-catalog' => array('view' => 'catalog_widget'),
        'manifests-catalog-graph' => array('view' => 'catalog_graph_widget'),
        'manifests_managed_installs' => array('view' => 'manifests_managed_installs_widget'),
        'manifests_managed_uninstalls' => array('view' => 'manifests_managed_uninstalls_widget'),
        'manifests_optional_installs' => array('view' => 'manifests_optional_installs_widget'),
        'manifests_managed_updates' => array('view' => 'manifests_managed_updates_widget'),
        'manifests_featured_items' => array('view' => 'manifests_featured_items_widget'),
        'manifests_manifest_count' => array('view' => 'manifests_manifest_count_widget'),
        'manifests_self_service' => array('view' => 'manifests_self_service_widget'),
    ),
    'listings' => array(
        'manifests' => array('view' => 'manifests_listing', 'i18n' => 'manifests.listing.title'),
    ),
    'reports' => array(
        'manifests' => array('view' => 'manifests_report', 'i18n' => 'manifests.report.title'),
    ),
);
