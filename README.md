# Munki Manifests Module for Munkireport

This module gives extended info on the Munki manifests for a given machine. The data comes from the `/Library/Managed Installs/manifests` directory.

Included are widgets for all included manifests:
![Manifest Widget](https://raw.githubusercontent.com/joncrain/mr-manifests/master/images/manifest_widget.png)
and for catalog counts:
![Catalog Widget](https://raw.githubusercontent.com/joncrain/mr-manifests/master/images/catalog_widget.png)

Table Schema
------
* manifest_name - VARCHAR(255) - Name of manifest
* catalogs - TEXT - List of catalogs
* included_manifests - TEXT - Manifests that are included
* managed_installs - TEXT - Installs that are managed
* managed_uninstalls - TEXT - Uninstalls that are managed
* optional_installs - TEXT - List of optional installs
* managed_updates - TEXT - List of managed updates
* featured_items - TEXT - Featured items
* condition_check - TEXT - Conditions
* conditional_items - TEXT - JSON of conditional items
* display_name - VARCHAR(255) - Display name of manifest