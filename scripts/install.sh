#!/bin/bash

# manifests controller
CTL="${BASEURL}index.php?/module/manifests/"

# Get the scripts in the proper directories
${CURL} "${CTL}get_script/manifests.sh" -o "${MUNKIPATH}preflight.d/manifests.sh"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/manifests.sh"

	# Set preference to include this file in the preflight check
	setreportpref "manifests" "${CACHEPATH}manifests.txt"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/manifests.sh"

	# Signal that we had an error
	ERR=1
fi
