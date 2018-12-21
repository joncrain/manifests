<div class="col-lg-6">

<div class="panel panel-default" id="catalog_graph-widget">

    <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-globe"></i>
            <span data-i18n="manifests.widget.catalog_graph"></span>
            <list-link data-url="/show/listing/manifests/manifests"></list-link>
        </h3>

    </div>

    <div class="panel-body">

<svg style="width:100%"></svg>

</div>

</div><!-- /panel -->

</div><!-- /col-lg-4 -->

<script>
$(document).on('appReady', function(e, lang) {



    var conf = {
        url: appUrl + '/module/manifests/get_catalog_stats', // Url for json
        widget: 'catalog_graph-widget', // Widget id
        elementClickCallback: function(e){
            var label = e.data.catalogs;
            window.location.href = appUrl + '/show/listing/reportdata/clients#' + label;
        },
        labelModifier: function(label){
            return label
        }
    };

    mr.addGraph(conf);

});

</script>
