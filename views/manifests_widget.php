<div class="col-lg-4 col-md-6">

    <div class="panel panel-default" id="manifests-widget">

        <div id="manifests-widget" class="panel-heading" data-container="body" data-i18n="[title]manifests.manifests_widget_title">

            <h3 class="panel-title"><i class="fa fa-book"></i> 
            <span data-i18n="manifests.widget.title"></span></h3>

        </div>

        <div class="list-group scroll-box">
            <span class="list-group-item" data-i18n="loading"></span>
        </div>

    </div><!-- /panel -->

</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    var box = $('#manifests-widget div.scroll-box');

    $.getJSON( appUrl + '/module/manifests/get_data', function( data ) {
		var skipThese = ['id','name','serial_number'];
        box.empty();
        if(data.length){
            $.each(data, function(i,d){
                var badge = '<span class="badge pull-right">'+d.count+'</span>';
                box.append('<a href="'+appUrl+'/show/listing/manifests/manifests/#'+d.name+'" class="list-group-item">'+d.name+badge+'</a>')
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        if(prop == 'manifest_name'){
                            var url = appUrl+'/show/listing/manifests/manifests#'+prop;
                            box.append('<a href="'+url+'" class="list-group-item">'+d[manifest_name]+'</a>');                        }
                        } 
                        else {
                            // Do nothing
                    }
                }
            });
        }
        else{
            box.append('<span class="list-group-item">'+i18n.t('no_data')+'</span>');
        }
    });
});
</script>
