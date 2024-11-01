jQuery(document).ready(function($) {
	$('.wpas-edition-lic').on('change', function() {
		var checked_lic = $(this);
		var use = 0;
		if($(checked_lic).prop('checked')){
			use = 1;
		}	
		$.post(ajaxurl,{action:'wpas_use_license_key',type:'edition',key:$(this).attr('id'),use:use}, function(response){
			if(response == 'valid' && use == 1){
				$('.wpas-edition-lic').not(checked_lic).prop('checked', false);
			}  
			else if(response == 'valid' && use == 0){
				$(checked_lic).prop('checked', false);
			}
			else if(response == 'invalid'){
				$(checked_lic).prop('checked', false);
				alert('You can only use valid license keys for generation.');
			}
		});
	});
	$('.wpas-conn-lic').on('change', function() {
		var checked_lic = $(this);
		var use = 0;
		if($(checked_lic).prop('checked')){
			use = 1;
		}	
		$.post(ajaxurl,{action:'wpas_use_license_key',type:'connection',key:$(this).attr('id'),use:use}, function(response){
			if(response == 'invalid'){
				$(checked_lic).prop('checked', false);
				alert('You can only use valid license keys for generation.');
			}
		});
	});
});
