#!/bin/bash

# manifests controller
CTL="${BASEURL}index.php?/module/manifests/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/manifests.py" -o "${MUNKIPATH}preflight.d/manifests.py"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/manifests.py"

	# Set preference to include this file in the preflight check
	setreportpref "manifests" "${CACHEPATH}manifests.json"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/manifests.py"

	# Signal that we had an error
	ERR=1
fi
