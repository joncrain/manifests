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
    
    /**
     * Get product version for managed_installs manifest widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_managed_installs()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, managed_installs,
                ROUND(
                        ( CHAR_LENGTH(managed_installs)
                            - CHAR_LENGTH( REPLACE ( managed_installs, ',', '') )
                        ) / CHAR_LENGTH(',')
                ) + 1 AS count
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE managed_installs <> '' AND managed_installs IS NOT NULL
                ".get_machine_group_filter('AND')."
                ORDER BY count DESC";

        foreach ($queryobj->query($sql) as $item) {
            if ("$item->count" !== "0") {
                $item->managed_installs = $item->managed_installs ? $item->managed_installs : 'Unknown';
                $out[] = $item;
            }
        }

        $obj_view->view('json', array('msg' => $out));
    }
    
    /**
     * Get managed_uninstalls manifest widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_managed_uninstalls()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, managed_uninstalls,
                ROUND(
                        ( CHAR_LENGTH(managed_uninstalls)
                            - CHAR_LENGTH( REPLACE ( managed_uninstalls, ',', '') )
                        ) / CHAR_LENGTH(',')
                ) + 1 AS count
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE managed_uninstalls <> '' AND managed_uninstalls IS NOT NULL
                ".get_machine_group_filter('AND')."
                ORDER BY count DESC";

        foreach ($queryobj->query($sql) as $item) {
            if ("$item->count" !== "0") {
                $item->managed_uninstalls = $item->managed_uninstalls ? $item->managed_uninstalls : 'Unknown';
                $out[] = $item;
            }
        }

        $obj_view->view('json', array('msg' => $out));
    }
    
    /**
     * Get optional_installs manifest widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_optional_installs()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, optional_installs,
                ROUND(
                        ( CHAR_LENGTH(optional_installs)
                            - CHAR_LENGTH( REPLACE ( optional_installs, ',', '') )
                        ) / CHAR_LENGTH(',')
                ) + 1 AS count
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE optional_installs <> '' AND optional_installs IS NOT NULL
                ".get_machine_group_filter('AND')."
                ORDER BY count DESC";

        foreach ($queryobj->query($sql) as $item) {
            if ("$item->count" !== "0") {
                $item->optional_installs = $item->optional_installs ? $item->optional_installs : 'Unknown';
                $out[] = $item;
            }
        }

        $obj_view->view('json', array('msg' => $out));
    }
    
    /**
     * Get managed_updates manifest widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_managed_updates()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, managed_updates,
                ROUND(
                        ( CHAR_LENGTH(managed_updates)
                            - CHAR_LENGTH( REPLACE ( managed_updates, ',', '') )
                        ) / CHAR_LENGTH(',')
                ) + 1 AS count
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE managed_updates <> '' AND managed_updates IS NOT NULL
                ".get_machine_group_filter('AND')."
                ORDER BY count DESC";

        foreach ($queryobj->query($sql) as $item) {
            if ("$item->count" !== "0") {
                $item->managed_updates = $item->managed_updates ? $item->managed_updates : 'Unknown';
                $out[] = $item;
            }
        }

        $obj_view->view('json', array('msg' => $out));
    }
    
    /**
     * Get featured_items manifest widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_featured_items()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, featured_items,
                ROUND(
                        ( CHAR_LENGTH(featured_items)
                            - CHAR_LENGTH( REPLACE ( featured_items, ',', '') )
                        ) / CHAR_LENGTH(',')
                ) + 1 AS count
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE featured_items <> '' AND featured_items IS NOT NULL
                ".get_machine_group_filter('AND')."
                ORDER BY count DESC";

        foreach ($queryobj->query($sql) as $item) {
            if ("$item->count" !== "0") {
                $item->featured_items = $item->featured_items ? $item->featured_items : 'Unknown';
                $out[] = $item;
            }
        }

        $obj_view->view('json', array('msg' => $out));
    }
    
    /**
     * Get manifest_count manifest widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_manifest_count()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, included_manifests,
                ROUND(
                        ( CHAR_LENGTH(included_manifests)
                            - CHAR_LENGTH( REPLACE ( included_manifests, ',', '') )
                        ) / CHAR_LENGTH(',')
                ) + 1 AS count
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE included_manifests <> '' AND included_manifests IS NOT NULL
                ".get_machine_group_filter('AND')."
                ORDER BY count DESC";

        foreach ($queryobj->query($sql) as $item) {
            if ("$item->count" !== "0") {
                $item->included_manifests = $item->included_manifests ? $item->included_manifests : 'Unknown';
                $out[] = $item;
            }
        }

        $obj_view->view('json', array('msg' => $out));
    }

    /**
     * Get self service manifest count widget
     *
     * @return void
     * @author tuxudo
     *
     **/
    public function get_self_service()
    {
        $obj_view = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }

        $queryobj = new Manifests_model;
        $out = array();

        $sql = "SELECT DISTINCT machine.computer_name, serial_number, included_manifests
                FROM manifests
                LEFT JOIN machine USING(serial_number)
                LEFT JOIN reportdata USING (serial_number)
                WHERE included_manifests <> '' AND included_manifests IS NOT NULL AND included_manifests LIKE '%SelfServe%' 
                ".get_machine_group_filter('AND');

        $obj_view->view('json', array('msg' => $queryobj->query($sql)));
    }

} // END class Manifests_module
