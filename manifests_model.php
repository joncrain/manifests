<?php
class Manifests_model extends \Model {

    protected $restricted;

	function __construct($serial='')
	{
		parent::__construct('id', 'manifests'); //primary key, tablename
		$this->rs['id'] = '';
		$this->rs['serial_number'] = $serial; $this->rt['serial_number'] = 'VARCHAR(255) UNIQUE';
        $this->rs['manifest_name'] = '';
        $this->rs['manifest_catalogs'] = '';
        $this->rs['manifest_included_manifests'] = '';
        $this->rs['manifest_managed_installs'] = '';
        $this->rs['manifest_managed_uninstalls'] = '';
        $this->rs['manifest_optional_installs'] = '';
        $this->rs['manifest_managed_updates'] = '';
        $this->rs['manifest_featured_items'] = '';
        $this->rs['manifest_conditional_items'] = '';

        // Array with fields that can't be set by process
        $this->restricted = array('id', 'serial_number');

		// Schema version, increment when creating a db migration
		$this->schema_version = 0;

		// Create table if it does not exist
		//$this->create_table();

		if ($serial)
			$this->retrieveOne('serial_number=?', $serial);

		$this->serial = $serial;

	}

	// ------------------------------------------------------------------------

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
            throw new Exception("Error Processing Request: No JSON file found", 1);
		}
        // Process json into object thingy
		$data = json_decode($json, true);
		foreach ($data as $single_manifest) {
			// Traverse the manifest
			foreach($single_manifest as $key => $field) {
				$this->manifest_name = $key;
				$this->manifest_catalog = $key['catalogs'];
			}
		}
		$this->save();
	}
}