<div class="col-lg-4 col-md-6">
	<div class="panel panel-default" id="manifests-self-service-widget">
		<div id="manifests-self-service-widget" class="panel-heading" data-container="body">
			<h3 class="panel-title"><i class="fa fa-user"></i>
				<span data-i18n="manifests.self_service"></span>
				<span class="counter badge"></span>
				<list-link data-url="/show/listing/manifests/manifests"></list-link>
			</h3>
		</div>
		<div class="list-group scroll-box">
			<span class="list-group-item" data-i18n="loading"></span>
		</div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
	$(document).on('appUpdate', function() {

		$.getJSON(appUrl + '/module/manifests/get_self_service', function(data) {

			var scrollBox = $('#manifests-self-service-widget .scroll-box').empty();
			$.each(data, function(index, obj) {

				scrollBox
					.append($('<a>')
						.addClass('list-group-item')
						.attr('href', appUrl + '/show/listing/manifests/manifests/#' + obj.serial_number)
						.append(obj.computer_name))

			});

			$('#manifests-self-service-widget .counter').html(data.length);

			if (!data.length) {
				scrollBox
					.append($('<span>')
						.addClass('list-group-item')
						.text(i18n.t('manifests.no_self_service')))
			}
		});
	});
</script>