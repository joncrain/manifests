<div id="manifests-tab"></div>
<h2 data-i18n="manifests.client_tab"></h2>

<script>
    $(document).on('appReady', function() {
        mr.mwa2Link = "<?= conf('mwa2_link') ?>";

        $.getJSON(appUrl + '/module/manifests/get_manifests_data/' + serialNumber, function(data) {
            // Set count of manifests items
            $('#manifests-cnt').text(data.length);

            // If there are no date, output message
            if (!data.length) {
                $('#manifests-tab')
                    .append($('<h4>')
                        .append(i18n.t('manifests.no_data')))
            } else {

                var skipThese = ['id', 'name', 'serial_number'];
                $.each(data, function(i, d) {
                    // Generate rows from data
                    var rows = ''
                    for (var prop in d) {
                        // Skip skipThese
                        if (skipThese.indexOf(prop) == -1) {
                            if (d[prop] == '' || d[prop] == null || prop == 'manifest_name') {
                                // Do nothing for a blank entry
                            } else if (prop == 'conditional_items') {

                                rows = rows + '<tr><td colspan="2"><table><tr><th>' + i18n.t('manifests.' + prop) + '</th></tr>';
                                var nested_rows = '';
                                // parse d[prop]
                                conditional_items_json = JSON.parse(d[prop])
                                for (item_i in conditional_items_json) {
                                    item = conditional_items_json[item_i];
                                    condition = item['condition'];
                                    nested_rows = nested_rows + '<tr><th colspan="2" style="padding-right: 10px;">' + condition + '</th><td><table class="table-condensed table-striped">';
                                    var nested_nested_rows = '';
                                    for (item_t in item) {
                                        if (item[item_t] == '' || item[item_t] == null || item_t == 'condition') {
                                            // Do nothing
                                        } else {
                                            nested_nested_rows = nested_nested_rows + '<tr><th>' + i18n.t('manifests.' + item_t) + ' </th><td style="text-align: left;">' + String(item[item_t]).split(",").join(", ") + '</td></tr>';
                                        }
                                    }
                                    nested_rows = nested_rows + nested_nested_rows + '</table></td></tr>';
                                }
                                rows = rows + nested_rows;
                                rows = rows + '</table></td></tr>';
                            } else {
                                rows = rows + '<tr><th>' + i18n.t('manifests.' + prop) + '</th><td>' + d[prop] + '</td></tr>';
                            }
                        }
                    }

                    if (mr.mwa2Link !== "") {
                        if (d.manifest_name !== "SelfServeManifest") {
                            link = ' <a href="' + mr.mwa2Link + '/manifests/#' + d.manifest_name + '">' + d.manifest_name + '</a>'
                        } else {
                            link = ' ' + d.manifest_name
                        }
                    } else {
                        link = ' ' + d.manifest_name
                    }

                    $('#manifests-tab')
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-book'))
                            .append(link))
                        .append($('<div style="max-width:1600px;">')
                            //                        .addClass('table-responsive')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows))))
                })
            }
        });
    });
</script>