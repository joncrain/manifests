<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Manifests_model::class, function (Faker\Generator $faker) {
    return [
        'manifest_name' => json_encode(['office' => 1, 'lab' => 1, 'department' =>1]),
        'catalogs' => json_encode(['production' => 1, 'staging' => 1, 'testing' =>1]),
        'included_manifests' => json_encode(['office' => 1, 'lab' => 1, 'department' =>1]),
        'managed_installs' => json_encode(['Microsoft Office' => 1, 'Garageband' => 1]),
        'managed_uninstalls' => json_encode(['iMovie' => 1, 'Pages' => 1]),
        'optional_installs' => json_encode(['Cisco Jabber' => 1, 'Zoom' => 1]),
        'managed_updates' => json_encode(['Dropbox' => 1, 'Google Chrome' => 1]),
        'featured_items' => json_encode(['Adobe Creative Cloud' => 1, 'MunkiReport' => 1]),
        'condition_check' => json_encode(['os_vers_minor >= 13 AND os_vers_patch >= 4' => 1, 'os_vers_minor < 15' => 1]),
        'conditional_items' => json_encode(['Final Cut Pro' => 1, 'FileMaker' => 1]),
        'display_name' => json_encode(['Office Manifest' => 1, 'Lab Manifest' => 1, 'Department Manifest' =>1]),
    ];
});
