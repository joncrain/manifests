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
     * Get manifests information for serial_number
     *
     * @param string $serial serial number
     **/
    public function get_data($serial_number = '')
    {
        $obj = new View();
        if( ! $this->authorized())
        {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        // $manifests = new manifests_model($serial_number);
        // $obj->view('json', array('msg' => $manifests->rs));
        $queryobj = new Manifests_model;
        $manifests_tab = array();
        foreach($queryobj->retrieve_records($serial_number) as $manifestEntry) {
            $manifests_tab[] = $manifestEntry->rs;
        }

        $obj->view('json', array('msg' => $manifests_tab));
    }

    /**
     * Get manifests statistics
     *
     *
     **/
    public function get_manifest_stats()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authorized')));
        } else {
            $mrm = new Manifests_model();
            $obj->view('json', array('msg' => $mrm->get_manifest_stats()));
        }
    }

    /**
     * Get catalogs statistics
     *
     *
     **/
    public function get_catalog_stats()
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authorized')));
        } else {
            $mrm = new Manifests_model();
            $obj->view('json', array('msg' => $mrm->get_catalog_stats()));
        }
    }

} // END class default_module
