<div id="manifests-tab"></div>
<h2 data-i18n="manifests.client_tab"></h2>

<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/manifests/get_data/' + serialNumber, function(data){
		// Set count of manifests items
		$('#manifests-cnt').text(data.length);
        
		// If there are no date, output message
        if (!data.length) {
            $('#displays-tab')
                .append($('<h4>')
                    .append(i18n.t('manifests.no_data')))
        } else {
            
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
                        
                        
//                        // Else if build out the conditional_items table
//                        } else if(prop == "conditional_items"){
//                            var cond_items_data = JSON.parse(d['conditional_items']);
//                            
//                            // Process each condition
//                            $.each(cond_items_data, function(i,condition){
//                                // Process each action
//                                $.each(condition, function(i,d){
//                                
//                                    
//                                  
//                                    
//                                    
//                                    
//                                
//                                
//                                })
//                            })
//                            
//                            
//                            
//                            
//                            
//                            rows_conditions = '<tr><th>'+i18n.t('manifests.application')+'</th><th>'+i18n.t('manifests.application_id')+'</th><th>'+i18n.t('manifests.title')+'</th><th>'+i18n.t('manifests.versionondisk')+'</th><th>'+i18n.t('manifests.baseline_version')+'</th><th>'+i18n.t('manifests.update_version')+'</th><th>'+i18n.t('manifests.date')+'</th></tr>'
//                            
//                            $.each(cond_items_data, function(i,d){
//                                if (typeof d['application_id'] !== "undefined"){var application_id = d['application_id']}else{var application_id = ""}
//                                if (typeof d['title'] !== "undefined"){var title = d['title']}else{var title = ""}
//                                if (typeof d['versionondisk'] !== "undefined"){var versionondisk = d['versionondisk']}else{var versionondisk = ""}
//                                if (typeof d['baseline_version'] !== "undefined"){var baseline_version = d['baseline_version']}else{var baseline_version = ""}
//                                if (typeof d['update_version'] !== "undefined"){var update_version = d['update_version']}else{var update_version = ""}
//                                if (typeof d['date'] !== "undefined"){var date = d['date']}else{var date = ""}
//                                // Generate rows from data
//                                rows_conditions = rows_conditions + '<tr><td>'+i+'</td><td>'+application_id+'</td><td>'+title+'</td><td>'+versionondisk+'</td><td>'+baseline_version+'</td><td>'+update_version+'</td><td>'+date+'</td></tr>';
//                                
//                            })
//                            rows_conditions = rows_conditions // Close conditional_items table framework
                            
                        else if(prop == 'conditional_items'){
                            
                            rows = rows + '<tr><td colspan="2"><table><tr><th>'+i18n.t('manifests.'+prop)+'</th></tr>';
                            var nested_rows = '';
                            // parse d[prop]
                            conditional_items_json = JSON.parse(d[prop])
                            for (item_i in conditional_items_json){
                                item = conditional_items_json[item_i];
                                condition = item['condition'];
                                nested_rows = nested_rows + '<tr><th colspan="2" style="padding-right: 10px;">'+condition+'</th><td><table class="table-condensed table-striped">';
                                var nested_nested_rows = '';
                                for (item_t in item){
                                    if(item[item_t] == '' || item[item_t] == null || item_t == 'condition'){
                                        // Do nothing
                                    } 
                                    else {
                                        nested_nested_rows = nested_nested_rows + '<tr><th>'+i18n.t('manifests.' + item_t ) + ' </th><td style="text-align: left;">' + String(item[item_t]).split(",").join(", ") + '</td></tr>';
                                    }
                                }
                                nested_rows = nested_rows + nested_nested_rows + '</table></td></tr>';
                            }
                            rows = rows + nested_rows;
                            rows = rows + '</table></td></tr>';
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
