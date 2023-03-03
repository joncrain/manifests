<div class="col-lg-4">
    <h4><i class="fa fa-book"></i> <span data-i18n="manifests.detail_widget.title"></span></h4>
    <div id="manifests-data"></div>
</div>

<script>
    $(document).on('appReady', function() {
        mr.mwa2Link = "<?= conf('mwa2_link') ?>";
        $('#manifests-data')
            .append($('<table>')
                .attr('id','manifests-data-table')
                .addClass('table table-striped table-condensed')
                .append($('<tbody>')
                    .append($('<tr>')
                        .append($('<th>')
                            .text(i18n.t("manifests.detail_widget.manifest_item")))
                        .append($('<th>')
                            .text(i18n.t("manifests.detail_widget.catalog_item"))))));

        // Get Manifests data
        $.getJSON(appUrl + '/module/manifests/get_manifests_data/' + serialNumber, function(data) {
            $.each(data, function(index, item) {
                if (mr.mwa2Link !== "") {
                    if (item.manifest_name !== "SelfServeManifest") {
                        link = ' <a href="' + mr.mwa2Link + '/manifests/#' + item.manifest_name + '">' + item.manifest_name + '</a>'
                    } else {
                        link = ' ' + item.manifest_name
                    }
                } else {
                    link = ' <span>' + item.manifest_name + '</span>'
                }

                $('#manifests-data-table')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($(link)))
                        .append($('<td>')
                            .text(item.catalogs)));
            });
        });
    });
</script>