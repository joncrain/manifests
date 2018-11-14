#!/usr/bin/python
"""
Filter the results of munki's MANAGED_INSTALL_REPORT.plist
'ManifestName'
"""
import plistlib
import sys
import os
import CoreFoundation

DEBUG = False

# Path to the default munki install dir
default_install_dir = '/Library/Managed Installs'

# Checks munki preferences to see where the install directory is set to.
managed_install_dir = CoreFoundation.CFPreferencesCopyAppValue(
    "ManagedInstallDir", "ManagedInstalls")

# set the paths based on munki's configuration.
if managed_install_dir:
    MANAGED_INSTALL_REPORT = os.path.join(
        managed_install_dir, 'ManagedInstallReport.plist')
else:
    MANAGED_INSTALL_REPORT = os.path.join(
        default_install_dir, 'ManagedInstallReport.plist')

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

def manifest_recurser(manifest):
    child_dict = {}
    '''Recursive expansion of included manifests'''
    manifest_dict = dict_from_plist('/Library/Managed Installs/manifests/%s' % manifest)
    # No infinite loop checking! Be wary!
    for k,v in manifest_dict.iteritems():
        child_dict[k] = v
        if k is 'included_manifests':
            for item in manifest_dict['included_manifests']:
                if item:
                    child_dict[item] = manifest_recurser(item)
    if 'included_manifests' in manifest_dict: 
        for item in manifest_dict['included_manifests']:
            if item:
                child_dict[item] = manifest_recurser(item)
    return child_dict

def main():
    """Main"""
    # Create cache dir if it does not exist
    cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
    if not os.path.exists(cachedir):
        os.makedirs(cachedir)

    # Check if MANAGED_INSTALL_REPORT exists
    if not os.path.exists(MANAGED_INSTALL_REPORT):
        print '%s is missing.' % MANAGED_INSTALL_REPORT
        install_report = {}
    else:
        install_report = dict_from_plist(MANAGED_INSTALL_REPORT)


    # pylint: disable=E1103
    report_list = {}
    report_list['MainManifest'] = install_report['ManifestName']
    manifest = manifest_recurser(install_report['ManifestName'])
    report_list[install_report['ManifestName']] = manifest
    # pylint: enable=E1103

    if DEBUG:
        PP.pprint(report_list)

    # Write report to cache
    plistlib.writePlist(report_list, "%s/manifest.plist" % cachedir)

if __name__ == "__main__":
    main()
