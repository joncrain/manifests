<div class="col-lg-4 col-md-6">

    <div class="panel panel-default" id="manifests-included-widget">

        <div id="manifests-included-widget" class="panel-heading" data-container="body" data-i18n="[title]manifests.manifests_widget_title">

            <h3 class="panel-title"><i class="fa fa-book"></i> 
                <span data-i18n="manifests.widget.title"></span>
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

	$.getJSON( appUrl + '/module/manifests/get_manifest_stats', function( data ) {
		
        var list = $('#manifests-included-widget div.scroll-box').empty();

		if(data.length){

			// Sort on manifest_name
			// data.sort(function(a,b){
			// 	return mr.naturalSort(a.manifest_name, b.manifest_name);
			// });

			$.each(data, function(i,d){
				var badge = '<span class="badge pull-right">'+d.count+'</span>';
                list.append('<a href="'+appUrl+'/show/listing/manifests/manifests/#'+d.manifest_name+'" class="list-group-item">'+d.manifest_name+badge+'</a>')
			});
		}
		else{
			list.append('<span class="list-group-item">'+i18n.t('no_clients')+'</span>');
		}
    });
});
</script>
