<?php

/**
 * manifests class
 *
 * @package munkireport
 * @author 
 **/
class Manifests_controller extends Module_controller
{

    /*** Protect methods with auth! ****/
    function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
     * Default method
     *
     * @author avb
     **/
    function index()
    {
        echo "You've loaded the Manifests module!";
    }



    /**
     * Get manifests statistics
     *
     *
     **/
    public function get_manifest_stats()
    {
        jsonView(
            Manifests_model::selectRaw('manifest_name, COUNT(manifest_name) AS count')
                ->filter()
                ->groupBy('manifest_name')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray()
        );
    }

    /**
     * Get catalogs statistics
     *
     *
     **/
    public function get_catalog_stats()
    {
        jsonView(
            Manifests_model::selectRaw('catalogs, COUNT(catalogs) AS count')
                ->where('catalogs', '<>', '')
                ->filter()
                ->groupBy('catalogs')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray()
        );
    }

    /**
     * Get self service manifest count widget
     *
     * @return void
     * @author joncrain
     *
     **/
    public function get_self_service()
    {
        jsonView(
            Manifests_model::selectRAW('DISTINCT machine.computer_name, manifests.serial_number, manifest_name')
                ->join('machine', 'machine.serial_number', '=', 'manifests.serial_number')
                //    ->join('reportdata', 'reportdata.serial_number', '=', 'manifests.serial_number')
                ->where('manifest_name', 'LIKE', '%SelfServe%')
                ->filter()
                ->get()
                ->toArray()
        );
    }

    /**
     * Get manifests information for serial_number
     *
     * @param string $serial serial number
     **/
    public function get_manifests_data($serial_number = '')
    {
        jsonView(
            Manifests_model::selectRaw('manifests.serial_number, manifest_name, catalogs, included_manifests, managed_installs, managed_uninstalls, optional_installs, managed_updates, featured_items, condition_check, conditional_items, display_name')
                ->where('manifests.serial_number', $serial_number)
                ->filter()
                ->get()
                ->toArray()
        );
    }
} // END class Manifests_controller
