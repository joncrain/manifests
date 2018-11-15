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
		$this->rs['condition'] = '';
		$this->rs['conditional_items'] = '';

		$this->serial_number = $serial;
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

		foreach ($data as $manifest_name => $manifest_array) {
			// traversing the manifests!
			$this->manifest_name = $manifest_name;
			foreach($manifest_array as $key => $value) {
				//conditional items need more processing
				if ($key == 'conditional_items'){
					// figure out this process
                } else if ($key == 'display_name'){
					// maybe don't need this
				} else {
					$this->$key = implode(", ", $value);
				}
			}
		}
		$this->id = '';
		$this->save();
	}
}
