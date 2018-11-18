<div class="col-lg-4 col-md-6">

    <div class="panel panel-default" id="catalog-widget">

        <div id="catalog-widget" class="panel-heading" data-container="body" data-i18n="[title]manifests.catalogs_widget_title">

            <h3 class="panel-title"><i class="fa fa-book"></i> 
                <span data-i18n="manifests.widget.catalog"></span>
                <list-link data-url="/show/listing/manifests/manifests"></list-link>
            </h3>
        </div>

        <div class="list-group scroll-box">
            <span class="list-group-item" data-i18n="loading"></span>
        </div>

    </div><!-- /panel -->

</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

	$.getJSON( appUrl + '/module/manifests/get_catalog_stats', function( data ) {
		
        var list = $('#catalog-widget div.scroll-box').empty();

		if(data.length){

			// Sort on catalog_name
			data.sort(function(a,b){
				return mr.naturalSort(a.catalogs, b.catalogs);
			});

			$.each(data, function(i,d){
				var badge = '<span class="badge pull-right">'+d.count+'</span>';
                list.append('<a href="'+appUrl+'/show/listing/manifests/manifests/#'+d.catalogs+'" class="list-group-item">'+d.catalogs+badge+'</a>')
			});
		}
		else{
			list.append('<span class="list-group-item">'+i18n.t('no_clients')+'</span>');
		}
    });
});
</script>
