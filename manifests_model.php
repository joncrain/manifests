<?php
use munkireport\models\MRModel as Eloquent;

class Manifests_model extends Eloquent
{
    protected $table = 'manifests';

    protected $fillable = [
        'serial_number',
        'manifest_name',
        'catalogs',
        'included_manifests',
        'managed_installs',
        'managed_uninstalls',
        'optional_installs',
        'managed_updates',
        'featured_items',
        'condition_check',
        'conditional_items',
        'display_name',
    ];

    public $timestamps = false;
}