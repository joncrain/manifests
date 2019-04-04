<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="manifests-optional-installs-widget">
        <div id="manifests-optional-installs-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-check-square"></i> 
                <span data-i18n="manifests.optional_installs"></span>
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

	$.getJSON( appUrl + '/module/manifests/get_optional_installs', function( data ) {
		
        var list = $('#manifests-optional-installs-widget div.scroll-box').empty();
		if(data.length){

			$.each(data, function(i,d){
				var badge = '<span class="badge pull-right">'+d.count+'</span>';
                list.append('<a href="'+appUrl+'/show/listing/manifests/manifests/#'+d.serial_number+'" class="list-group-item">'+d.computer_name+badge+'</a>')
			});
		}
		else{
			list.append('<span class="list-group-item">'+i18n.t('manifests.no_optional_installs')+'</span>');
		}
    });
});
</script>



