#!/bin/bash

# Remove manifests script
rm -f "${MUNKIPATH}preflight.d/manifests.py"

# Remove manifests.json file
rm -f "${MUNKIPATH}preflight.d/cache/manifests.json"
