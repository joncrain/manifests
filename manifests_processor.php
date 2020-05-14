<?php

use munkireport\processors\Processor;

class Manifests_processor extends Processor
{

    /**
     * Process data sent by postflight
     *
     * @param string data
     * @author joncrain
     **/
    function run($json)
    {
        // Check if data was uploaded
        if (!$json) {
            throw new Exception("Error Processing Request: No json data found", 1);
        }

        // Delete previous set        
        Manifests_model::where('serial_number', $this->serial_number)->delete();

        // Process json into object thingy
        $data = json_decode($json, true);

        // Get fillable items
        $fillable = [
            'serial_number' => $this->serial_number,
            'manifest_name' => '',
            'catalogs' => '',
            'included_manifests' => '',
            'managed_installs' => '',
            'managed_uninstalls' => '',
            'optional_installs' => '',
            'managed_updates' => '',
            'featured_items' => '',
            'condition_check' => '',
            'conditional_items' => '',
            'display_name' => '',
        ];

        $save_array = [];

        foreach ($data as $manifest_name => $manifest_array) {
            // Get an instance of the fillable array
            $temp = $fillable;

            // Add name to temp
            $temp['manifest_name'] = $manifest_name;

            foreach ($manifest_array as $key => $value) {
                // conditional items need more processing
                if ($key == 'conditional_items') {
                    // encode as JSON for processing later
                    $temp[$key] = json_encode($value);
                } else if ($key == 'display_name' || $key == 'condition_check') {
                    $temp[$key] = $value;
                } else if (array_key_exists($key, $temp)) {
                    $temp[$key] = implode(", ", $value);
                }
            }
            $save_array[] = $temp;
        }

        Manifests_model::insertChunked(
            $save_array
        );
    }
}
