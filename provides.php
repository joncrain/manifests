<?php

return array(
    'client_tabs' => array(
        'manifests-tab' => array('view' => 'manifests_tab', 'i18n' => 'manifests.listing.title'),
    ),
    'widgets' => array(
        'manifests-included' => array('view' => 'included_manifests_widget'),
        'manifests-catalog' => array('view' => 'catalog_widget'),
        'manifests-catalog-graph' => array('view' => 'catalog_graph_widget'),
    ),
    'listings' => array(
        'manifests' => array('view' => 'manifests_listing', 'i18n' => 'manifests.listing.title'),
    ),
    'reports' => array(
        'manifests' => array('view' => 'manifests_report', 'i18n' => 'manifests.report.title'),
    ),
);
