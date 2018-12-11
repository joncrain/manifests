<div id="manifests-tab"></div>
<h2 data-i18n="manifests.client_tab"></h2>


<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/manifests/get_data/' + serialNumber, function(data){
		// Set count of manifests items
		$('#manifests-cnt').text(data.length);
		var skipThese = ['id','name','serial_number'];
		$.each(data, function(i,d){
			
			// Generate rows from data
            var rows = ''
			for (var prop in d){
				// Skip skipThese
				if(skipThese.indexOf(prop) == -1){
					if(d[prop] == '' || d[prop] == null || prop == 'manifest_name'){
					   // Do nothing for a blank entry
                    } 
                    else {
                        rows = rows + '<tr><th>'+i18n.t('manifests.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
					}
				}
			}
			$('#manifests-tab')
				.append($('<h4>')
					.append($('<i>')
						.addClass('fa fa-book'))
					.append(' '+d.manifest_name))
				.append($('<div style="max-width:1600px;">')
					.addClass('table-responsive')
					.append($('<table>')
						.addClass('table table-striped table-condensed')
						.append($('<tbody>')
							.append(rows))))
		})
	});
});
</script>