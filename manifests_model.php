<?php
class Manifests_model extends \Model {

    protected $restricted;

    function __construct($serial='')
    {
        parent::__construct('id', 'manifests'); //primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial;
        $this->rs['manifest_name'] = '';
        $this->rs['catalogs'] = '';
        $this->rs['included_manifests'] = '';
        $this->rs['managed_installs'] = '';
        $this->rs['managed_uninstalls'] = '';
        $this->rs['optional_installs'] = '';
        $this->rs['managed_updates'] = '';
        $this->rs['featured_items'] = '';
        $this->rs['condition_check'] = '';
        $this->rs['conditional_items'] = '';
        $this->rs['display_name'] = '';

        $this->serial_number = $serial;
    }

    // ------------------------------------------------------------------------

    /**
     * Get manifests statistics
     * @author joncrain
     *
     **/
    public function get_manifest_stats()
    {
        $out = array();
        $filter = get_machine_group_filter();
        $sql = "SELECT COUNT(1) AS count, manifest_name
            FROM manifests
            LEFT JOIN reportdata USING (serial_number)
            $filter AND manifest_name <> 'SelfServeManifest'
            GROUP BY manifest_name
            ORDER BY count DESC";

        foreach ($this->query($sql) as $obj) {
            $obj->manifest_name = $obj->manifest_name ? $obj->manifest_name : 'Unknown';
            $out[] = $obj;
        }

        return $out;
    }

    /**
     * Get catalog statistics
     * @author joncrain
     *
     **/
    public function get_catalog_stats()
    {
        $out = array();
        $filter = get_machine_group_filter();
        $sql = "SELECT COUNT(1) AS count, catalogs
            FROM manifests
            LEFT JOIN reportdata USING (serial_number)
            $filter AND catalogs <> '' AND manifest_name <> 'SelfServeManifest'
            GROUP BY catalogs
            ORDER BY count DESC";

        foreach ($this->query($sql) as $obj) {
            $obj->catalogs = $obj->catalogs ? $obj->catalogs : '0';
            $out[] = $obj;
        }

        return $out;
    }

    
    /**
    * Process data sent by postflight
    *
    * @param string data
    * @author joncrain
    * based on homebrew by tuxudo
    **/
    function process($json)
    {
        // Check if data was uploaded
        if (! $json ) {
            print_r("Error processing manifests module: No JSON file found");
        } else {
                    
            // Delete previous set        
            $this->deleteWhere('serial_number=?', $this->serial_number);

            // Process json into object thingy
            $data = json_decode($json, true);
            
            // Copy default values
            $empty = $this->rs;
            
            foreach ($data as $manifest_name => $manifest_array) {
                                
                // Reset values
                $this->rs = $empty;
                
                // traversing the manifests!
                $this->manifest_name = $manifest_name;

                foreach($manifest_array as $key => $value) {
                    // conditional items need more processing
                    if ($key == 'conditional_items'){
                        // encode as JSON for processing later
                        $this->$key = json_encode($value);
                    } else if ($key == 'condition'){
                        $this->condition_check = $value;
                    } else if ($key == 'display_name'){
                        $this->$key = $value;
                    } else {
                        $this->$key = implode(", ", $value);
                    }
                }

                // save the data
                $this->id = '';
                $this->save();  
            }
        }
    }
}
