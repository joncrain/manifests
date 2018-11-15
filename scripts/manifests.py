#!/usr/bin/python
import plistlib
import os
import sys
import json
import CoreFoundation

DEBUG = False

# Path to the default munki install dir
default_install_dir = '/Library/Managed Installs'

# Checks munki preferences to see where the install directory is set to.
managed_install_dir = CoreFoundation.CFPreferencesCopyAppValue(
    "ManagedInstallDir", "ManagedInstalls")

# set the paths based on munki's configuration.
if managed_install_dir:
    MANAGED_INSTALL_MANIFESTS = os.path.join(
        managed_install_dir, 'manifests')
else:
    MANAGED_INSTALL_MANIFESTS = os.path.join(
        default_install_dir, 'manifests')

# Don't skip manual check
if len(sys.argv) > 1:
    if sys.argv[1] == 'debug':
        print '**** DEBUGGING ENABLED ****'
        DEBUG = True
        import pprint
        PP = pprint.PrettyPrinter(indent=4)

def dict_from_plist(path):
    """Returns a dict based on plist found in path"""
    try:
        return plistlib.readPlist(path)
    except Exception, message:
        raise Exception("Error creating plist from output: %s" % message)

def main():
    """Main"""
    # Create cache dir if it does not exist
    cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
    if not os.path.exists(cachedir):
        os.makedirs(cachedir)

    # Check if MANAGED_INSTALL_MANIFESTS exists
    if not os.path.exists(MANAGED_INSTALL_MANIFESTS):
        print '%s is missing.' % MANAGED_INSTALL_MANIFESTS
        manifests = {}
    else:
        manifests = {}
        for path, subdirs, files in os.walk(MANAGED_INSTALL_MANIFESTS):
            for name in files:
                manifest_path = os.path.join(path, name)
                manifests[name] = dict_from_plist(manifest_path)

    manifest_cache = os.path.join(cachedir, 'manifests.json')

    with open(manifest_cache, 'w') as fp:
        json.dump(manifests, fp, indent=4)

if __name__ == "__main__":
    main()
