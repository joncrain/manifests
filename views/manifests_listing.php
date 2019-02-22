<?php $this->view('partials/head'); ?>

<?php //Initialize models needed for the table
new Machine_model;
new Reportdata_model;
new Manifests_model;
?>

<div class="container">
  <div class="row">
  	<div class="col-lg-12">
		  <h3><span data-i18n="manifests.listing.title"></span> <span id="total-count" class='label label-primary'>…</span></h3>
		  <table class="table table-striped table-condensed table-bordered">
		    <thead>
		      <tr>
		      	<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
		        <th data-i18n="serial" data-colname='reportdata.serial_number'></th>
		        <th data-i18n="username" data-colname='reportdata.long_username'></th>
		        <th data-i18n="manifests.manifest_name" data-colname='manifests.manifest_name'></th>
		        <th data-i18n="manifests.catalogs" data-colname='manifests.catalogs'></th>
		        <th data-i18n="manifests.managed_installs" data-colname='manifests.managed_installs'></th>
		        <th data-i18n="manifests.managed_uninstalls" data-colname='manifests.managed_uninstalls'></th>
		        <th data-i18n="manifests.optional_installs" data-colname='manifests.optional_installs'></th>
		        <th data-i18n="manifests.managed_updates" data-colname='manifests.managed_updates'></th>
		        <th data-i18n="manifests.featured_items" data-colname='manifests.featured_items'></th>
		        <th data-i18n="manifests.conditional_items" data-colname='manifests.conditional_items'></th>
		        <th data-i18n="manifests.condition_check" data-colname='manifests.condition_check'></th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td data-i18n="listing.loading" colspan="6" class="dataTables_empty"></td>
		      </tr>
		    </tbody>
		  </table>
    </div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

	    var oTable = $('.table').DataTable();
	    oTable.ajax.reload();
	    return;
	});

	$(document).on('appReady', function(e, lang) {
	    // Get column names from data attribute
	    var columnDefs = [],
            col = 0; // Column counter
	    $('.table th').map(function(){
	        columnDefs.push({name: $(this).data('colname'), targets: col});
	        col++;
	    });
	    oTable = $('.table').dataTable( {
	        columnDefs: columnDefs,
	        ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                     d.mrColNotEmpty = "manifest_name";
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
	        createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_manifests-tab');
	        	$('td:eq(0)', nRow).html(link);
	        }
	    });
	});
</script>

<?php $this->view('partials/foot'); ?>
