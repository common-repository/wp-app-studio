<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_ent_field_form($app_id,$ent_id)
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
        var mobile_arr = ['text','digits_only','no_whitespace'];
        var options_arr = ['checkbox_list','radio','select'];
	var filterable_arr = ['wysiwyg','file','image'];
	var listable_arr = ['wysiwyg','textarea'];
	var min_max_value_arr = ['decimal','digits_only','integer'];
	var min_max_length_arr = ['text','letters_with_punc','alphanumeric','letters_only','no_whitespace','textarea','password'];
	var min_max_words_arr = ['textarea'];
	var required_arr = ['file','image','hidden_constant','hidden_function'];
	var srequired_arr = ['file','image'];
	var clone_arr = ['alphanumeric','color','credit_card','decimal','digits_only','email','integer','ip4','ip6','letters_with_punc','letters_only','mobile_uk','no_whitespace','phone_uk','phone_us','zipcode_uk','text','url','vin_number_us','zipcode_us','oembed'];
	//var not_uniq_arr = ['file','image','hidden_constant','hidden_function','checkbox','checkbox_list','radio','select','textarea','wysiwyg','password'];
	var not_uniq_arr = ['file','image','hidden_constant','hidden_function','hidden_constant_datetime','textarea','wysiwyg','password'];
	$.fn.changeValidateMsg = function(myItem,page_type,builtin){
		switch(myItem) {
		case 'email':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid email address.","wp-app-studio");?>');		
			break;
		case 'url':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid URL.","wp-app-studio");?>');		
			break;
		case 'decimal':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid number.","wp-app-studio");?>');		
			break;
		case 'digits_only':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter only digits.","wp-app-studio");?>');		
			break;
		case 'credit_card':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid credit card number.","wp-app-studio");?>');
			break;
		case 'phone_us':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid phone number.","wp-app-studio");?>');
			break;
		case 'phone_uk':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid phone number.","wp-app-studio");?>');
			break;
		case 'mobile_uk':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid mobile number.","wp-app-studio");?>');
			break;
		case 'letters_with_punc':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Letters or punctuation only please.","wp-app-studio");?>');
			break;
		case 'alphanumeric':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Letters, numbers, and underscores only please.","wp-app-studio");?>');
			break;
		case 'letters_only':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Letters only please.","wp-app-studio");?>');
			break;
		case 'no_whitespace':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("No white space please.","wp-app-studio");?>');
			break;
		case 'zipcode_us':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("The specified US ZIP Code is invalid.","wp-app-studio");?>');
			break;
		case 'zipcode_uk':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please specify a valid postcode.","wp-app-studio");?>');
			break;
		case 'integer':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("A positive or negative non-decimal number please.","wp-app-studio");?>');
			break;
		case 'vin_number_us':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("The specified vehicle identification number (VIN) is invalid.","wp-app-studio");?>');
			break;
		case 'ip4':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid IP v4 address.","wp-app-studio");?>');
			break;
		case 'ip6':
			$('#validation-message').text('<?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a valid IP v6 address.","wp-app-studio");?>');
			break;
		default:	
			$('#validation-message').text('');		
			break;
		}
		$('#fld_is_filterable_div').show();
		$('#fld_is_mobile_div').hide();
		$('#fld_list_visible_div').show();
		$('#fld_required_div').show();
		$('#fld_srequired_div').show();
		$('#fld_dflt_value_div').show();
		$('#fld_dflt_value').datetimepicker("destroy");
		$('#fld_uniq_id_div').show();
		$('#fld_include_title_div').show();
		$('#fld_map_div').hide();
		$('#fld_map_attached').val('');
		$('#fld_country_attached').val('');
		$('#fld_state_attached').val('');
		$('#fld_map_marker_title').val('');
		$('#fld_map_info_window').val('');
		$('#fld_calc_formula_div').hide();
		$('#enable_conditional_div').show();
		$('#fld_country_attached_div').hide();
		$('#fld_state_attached_div').hide();
		if(myItem == 'image')
		{
			$('#fld_include_title_div').hide();
			$('#fld_dflt_value_div').hide();
			$('#fld_file_size_div').show();
			$('#fld_file_ext_div').show();
			$('#fld_image_thickbox_div').show();
			$('#validation-options').show();		
			$('#max-file-uploads').show();		
			$('#fld_file_ext').val('jpg,jpeg,png,gif');	
		}
		if(myItem == 'file')
		{
			$('#fld_include_title_div').hide();
			$('#fld_dflt_value_div').hide();
			$('#fld_file_size_div').show();
			$('#fld_file_ext_div').show();
			$('#fld_image_thickbox_div').hide();
			$('#validation-options').show();		
			$('#max-file-uploads').show();		
			$('#fld_file_ext').val('');	
		}
		if(myItem == 'date')
		{
			$('#fld_include_title_div').hide();
			$('#date-format').show();
			$('#fld_dflt_value').datetimepicker("destroy");
			$('#fld_dflt_value').datepicker({dateFormat:'yy-mm-dd'});
		}
 		else if(myItem == 'datetime')
		{
			$('#fld_include_title_div').hide();
			$('#date-format').show();
			$('#time-format').show();
			$('#fld_dflt_value').datetimepicker("destroy");
			$('#fld_dflt_value').datetimepicker({dateFormat:'yy-mm-dd',timeFormat:'hh:mm'});
		}
		else if(myItem == 'time')
		{
			$('#fld_include_title_div').hide();
			$('#time-format').show();
			$('#fld_dflt_value').datetimepicker("destroy");
			$('#fld_dflt_value').datetimepicker({timeFormat:'hh:mm',dateFormat: '',timeOnly:true});
		}
		if($.inArray(myItem,min_max_value_arr) != -1)
                {
			$('#validation-options').show();		
			$('#min-max-value').show();		
                }
		if($.inArray(myItem,min_max_length_arr) != -1)
                {
			$('#validation-options').show();		
			$('#min-max-length').show();		
                }
		if($.inArray(myItem,min_max_words_arr) != -1)
                {
			$('#validation-options').show();		
			$('#min-max-words').show();		
                }
                if($.inArray(myItem,options_arr) != -1)
                {
                        $('#fld_values_div').show();
                }
                if($.inArray(myItem,mobile_arr) != -1)
                {
			$('#fld_is_mobile_div').show();
                }
                if($.inArray(myItem,['checkbox','checkbox_list','radio']) != -1)
                {
                        $('#fld_fa_chkd_div').show();
                        $('#fld_fa_unchkd_div').show();
			if(myItem == 'radio')
			{
				$('#fld_fa_chkd_val').attr('placeholder','fa-circle');
				$('#fld_fa_unchkd_val').attr('placeholder','fa-circle-o');
			}
			else
			{
				$('#fld_fa_chkd_val').attr('placeholder','fa-check-square-o');
				$('#fld_fa_unchkd_val').attr('placeholder','fa-square-o');
			}
                }
		if($.inArray(myItem,clone_arr) != -1 && builtin != 1)
                {
			$('#fld_clone_div').show();		
                }
		else {
			$('#fld_clone_div').hide();		
		}
		if(myItem == 'text')
		{
			$('#fld_allow_html_div').show();
			$('#fld_user_map_div').show();
		}
 		else if(myItem == 'textarea')
		{
			$('#fld_allow_html_div').show();
			$('#fld_user_map_div').hide();
		}
		else
		{
			$('#fld_allow_html_div').hide();
			$('#fld_user_map_div').hide();
		}
		if(myItem == 'select')
		{
			$('#fld_is_advanced_div').show();
			$('#fld_multiple_div').show();
		}
		if(myItem == 'user')
		{
			if(page_type != 'edit'){
				app_id = $('input#app').val();
				$.get(ajaxurl,{action:'wpas_get_roles',type:'user',app_id:app_id}, function(response){
					$('#fld_limit_user_role').html(response);
					$('#fld_limit_user_role_div').show();
				});
			}
			$('#fld_is_advanced_div').show();
			$('#fld_multiple_div').hide();
		}
		else
		{
			$('#fld_limit_user_role_div').hide();
		}
		if($.inArray(myItem,filterable_arr) != -1)
		{
                        $('#fld_is_filterable_div').hide();
			$('#fld_is_filterable').prop('checked',false);
		}
		if($.inArray(myItem,listable_arr) != -1)
		{
			$('#fld_list_visible_div').hide();
			$('#fld_list_visible').prop('checked',false);
		}
		if($.inArray(myItem,required_arr) != -1)
		{
                        $('#fld_required_div').hide();
                        $('#fld_required').prop('checked',false);
		}
		if($.inArray(myItem,srequired_arr) != -1)
		{
                        $('#fld_srequired_div').hide();
                        $('#fld_srequired').prop('checked',false);
		}
		if(myItem == 'hidden_function')
		{
			$('#fld_dflt_value_div').hide();
			$('#fld_hidden_func_div').show();
			$('#fld_searchable_div').show();
			$('#enable_conditional_div').hide();
		}
		if(myItem == 'hidden_constant' || myItem == 'hidden_constant_datetime')
		{
			$('#fld_searchable_div').show();
			$('#enable_conditional_div').hide();
		}
		if($.inArray(myItem,not_uniq_arr) != -1)
		{
                        $('#fld_uniq_id_div').hide();
                        $('#fld_uniq_id').prop('checked',false);
		}
		if(myItem == '')
		{
			$('#fld_uniq_id_div').hide();
                        $('#fld_uniq_id').prop('checked',false);
                        $('#fld_required_div').hide();
                        $('#fld_srequired_div').hide();
                        $('#fld_required').prop('checked',false);
                        $('#fld_srequired').prop('checked',false);
                        $('#fld_is_filterable_div').hide();
			$('#fld_is_filterable').prop('checked',false);
			$('#fld_list_visible_div').hide();
			$('#fld_list_visible').prop('checked',false);
			$('#fld_dflt_value_div').hide();
			$('#fld_dflt_value').val('');
		}
		if(myItem == 'checkbox')
		{
			$('#fld_dflt_checked_div').show();
			$('#fld_dflt_value_div').hide();
			$('#fld_dflt_value').val('');
		}
		if(myItem == 'map')
		{
			$('#fld_uniq_id_div').hide();
			$('#fld_include_title_div').hide();
			$('#fld_required_div').hide();
			$('#fld_srequired_div').hide();
                        $('#fld_required').prop('checked',false);
                        $('#fld_srequired').prop('checked',false);
                        $('#fld_is_filterable_div').hide();
			$('#fld_is_filterable').prop('checked',false);
			$('#fld_list_visible_div').hide();
			$('#fld_list_visible').prop('checked',false);
			$('#fld_dflt_value_div').hide();
			$('#fld_dflt_value').val('');
			$('#enable_conditional_div').hide();
			if(page_type != 'edit'){
				app_id = $('input#app').val();
				ent_id = $('input#ent').val();
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'map',app_id:app_id,ent_id:ent_id}, function(response){
					$('#fld_map_attached').html(response['pre']+response['list']);
					$('#fld_map_marker_title').html(response['pre']+response['list']);
					$('#fld_map_info_window').html(response['pre']+response['list']);
					$('#fld_map_div').show();
				}, 'json');
			}
		}	
		if(myItem == 'state')
		{
			app_id = $('input#app').val();
			ent_id = $('input#ent').val();
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'country',app_id:app_id,ent_id:ent_id}, function(response){
				$('#fld_country_attached').html(response['pre']+response['list']);
				$('#fld_country_attached_div').show();
			}, 'json');
		}			
		if(myItem == 'city')
		{
			app_id = $('input#app').val();
			ent_id = $('input#ent').val();
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'state',app_id:app_id,ent_id:ent_id}, function(response){
				$('#fld_state_attached').html(response['pre']+response['list']);
				$('#fld_state_attached_div').show();
			}, 'json');
		}			
		if(myItem == 'calculated')
		{
			$('#fld_dflt_value_div').hide();
			$('#fld_dflt_value').val('');
			$('#enable_conditional_div').hide();
			$('#fld_calc_formula_div').show();
			app_id = $('input#app').val();
			ent_id = $('input#ent').val();
			fld_id = $('input#ent_field').val();
			$.get(ajaxurl,{action:'wpas_get_layout_tags',type:'formula',app_id:app_id,comp_id:ent_id,fld_id:fld_id}, function(response){
				$('#fld_formula_tags').html(response);
			});
		}
		if($('#validation-message').text() == '')
                {
                        $('#validation-message').hide();           
                }
                else
                {
                        $('#validation-message').show();           
                }
	}
	$(document).on('change','#fld_type',function(){
		$(this).initAttr();
		$('#fld_dflt_value').val('');
		$('#fld_required').prop('checked',false);
		$('#fld_srequired').prop('checked',false);
		$('#fld_uniq_id').prop('checked',false);
		$('#fld_include_title').prop('checked',false);
		$('#fld_required').prop('disabled',false);
		$('#fld_srequired').prop('disabled',false);
		$(this).changeValidateMsg($(this).val(),'',$('#fld_builtin').val());
        });
	$.fn.initAttr = function(){
		$('#fld_dflt_checked_div').hide();
		$('#fld_fa_chkd_div').hide();
		$('#fld_fa_unchkd_div').hide();
		$('#fld_allow_html_div').hide();
		$('#fld_user_map_div').hide();
		$('#validation-message').hide();
		$('#validation-options').hide();
		$('#fld_values_div').hide();
		$('#fld_hidden_func_div').hide();
		$('#fld_searchable_div').hide();
		$('#fld_dflt_value_div').hide();
		$('#max-file-uploads').hide();
		$('#date-format').hide();
		$('#time-format').hide();
		$('#min-max-value').hide();
		$('#min-max-length').hide();
		$('#min-max-words').hide();
		$('#fld_file_size_div').hide();
		$('#fld_required_div').hide();
		$('#fld_srequired_div').hide();
		$('#fld_uniq_id_div').hide();
		$('#fld_include_title_div').hide();
		$('#fld_is_filterable_div').hide();
		$('#fld_list_visible_div').hide();
		$('#fld_multiple_div').hide();
		$('#fld_is_advanced_div').hide();
		$('#fld_file_ext_div').hide();
		$('#fld_image_thickbox_div').hide();
		$('#fld_limit_user_role_div').hide();
		$('#fld_autoinc_field_div').hide();
		$('#fld_concat_field_div').hide();
		$('#fld_map_div').hide();
		$('#fld_calc_formula_div').hide();
		$('#fld_clone_div').hide();		
		$('#fld_clone_options_div').hide();		
	}
	$.fn.changeReqMult = function(uniq){
		if(uniq == 1)
		{
			$('#fld_required').prop('checked',true);
			$('#fld_required').prop('disabled',true);
		}
		else
		{
			$('#fld_required').prop('checked',false);
			$('#fld_required').prop('disabled',false);
		}
	}			
	$(document).on('click','#fld_uniq_id',function(){
		if($(this).prop('checked')){
			$(this).changeReqMult(1);
		}
		else
		{
			$(this).changeReqMult(0);
		}
	});
	$.fn.showAutoInc = function(type,show){
		if(show == 'autoinc'){
			$('#fld_concat_field_div').hide();
			$('#fld_autoinc_field_div').show();
			if(type == 'add'){
				$('#fld_autoinc_start').val(1);
				$('#fld_autoinc_incr').val(1);
			}
		}
		else if(show == 'concat'){
			$('#fld_autoinc_field_div').hide();
			$('#fld_concat_field_div').show();
			app_id = $('input#app').val();
			ent_id = $('input#ent').val();
			fld_id = $('input#ent_field').val();
			$.get(ajaxurl,{action:'wpas_get_layout_tags',type:'concat',app_id:app_id,comp_id:ent_id,fld_id:fld_id}, function(response){
				$('#fld_concat_tags').html(response);
			});
		}	
		else {
			$('#fld_autoinc_field_div').hide();
			$('#fld_concat_field_div').hide();
		}
	}
	$(document).on('change','#fld_hidden_func',function(){
		$(this).showAutoInc('add',$(this).val());
	});
	$(document).on('click','#fld_clone',function(){
		if($(this).prop('checked')){
			$('#fld_clone_options_div').show();
		}
		else {
			$('#fld_clone_options_div').hide();
		}
	});
	$(document).on('click','#fld_is_conditional',function(){
		$('.cond-value').hide();
		$('.cond-value').val('');
		if($(this).prop('checked')){
			app_id = $('input#app').val();
			ent_id = $('input#ent').val();
			field_id = $('input#ent_field').val();
			$('#conditional-options').show();
			$('#fld_cond_case').val('show');
			$('#fld_cond_type').val('all');
			$.get(ajaxurl,{action:'wpas_get_cond_div',app_id:app_id,ent_id:ent_id,div_id:1,val_type:'none',from:'fld',field_id:field_id}).done(function (response){
				$('#fld_cond-list').append(response);
			});
		}
		else {
			$('#conditional-options').hide();
		}
	});
	$.fn.changeCondVal = function(list_id,div_id,type,app_id,ent_id,att_id,value){
                if($.inArray(type,['select','checkbox_list','radio','checkbox']) != -1)
		{
			att_id = att_id.replace('attr-','');
			$('#' + list_id + 'cond_value_' + div_id).val('');
			$('#' + list_id + 'cond_value_' + div_id).hide();
			$.get(ajaxurl,{action:'wpas_get_default_vals',app_id:app_id,ent_id:ent_id,att_id:att_id,value:value}).done(function(response){
			$('#' + list_id + 'cond_sel_value_'+ div_id).html(response);
			$('#' + list_id + 'cond_sel_value_'+ div_id).show();
			});
		}
		else if(type == 'tax'){
			att_id = att_id.replace('tax-','');
			$('#' + list_id + 'cond_value_' + div_id).val('');
			$('#' + list_id + 'cond_value_' + div_id).hide();
			$.get(ajaxurl,{action:'wpas_get_tax_values',app_id:app_id,tax_id:att_id,value:value,type:'cond'}, function(response){
				$('#' + list_id + 'cond_sel_value_'+ div_id).html(response);
				$('#' + list_id + 'cond_sel_value_'+ div_id).show();
			});
		}
		else {
			$('#' + list_id + 'cond_value_' + div_id).show();
			$('#' + list_id + 'cond_sel_value_' + div_id + ' :selected').val('');
			$('#' + list_id + 'cond_sel_value_' + div_id).hide();
		}
	}
});
</script>
<input type="hidden" id="app" name="app" value="<?php echo $app_id; ?>">
<input type="hidden" id="ent" name="ent" value="<?php echo $ent_id;  ?>">
<input type="hidden" id="ent_field" name="ent_field" value="">
<input type="hidden" id="fld_builtin" name="fld_builtin" value="0">
<div class="well">
	<div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("An attribute is a property or descriptor of an entity, for example, Customer Name is an attribute of the entity Customer.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Attributes Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/attributes/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
  <fieldset>
  	<div class="control-group row-fluid">
			<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-xlarge" name="fld_name" id="fld_name" type="text" placeholder="<?php esc_html_e("e.g. product_name","wp-app-studio");?>" value="">
			<a href="#" title="<?php esc_html_e("General name for the attribute, single word, no spaces, all lower case. Underscores and dashes allowed","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>			
			</div>
	</div>
	<div class="control-group row-fluid">
			<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-xlarge" name="fld_label" id="fld_label" type="text" placeholder="<?php esc_html_e("e.g. Product Name","wp-app-studio");?>" value="">
			<a href="#" title="<?php esc_html_e("User friendly name for your attribute. It will appear on the EDIT page of the entity.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>                          
			</div>
	</div>
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Description","wp-app-studio");?></label>
			<div class="controls">
					<textarea id="fld_desc" name="fld_desc" class="wpas-std-textarea" placeholder="<?php esc_html_e("Write a brief description on how the attribute will be used.","wp-app-studio");?>" ></textarea>
					<a href="#" title="<?php esc_html_e("Instructions or help-text related to your attribute.","wp-app-studio");?>">
					<i class="icon-info-sign"></i></a>          		
			</div>
    </div>
	<div class="control-group row-fluid">
			<label class="control-label req"><?php esc_html_e("Type","wp-app-studio");?></label>
			<div class="controls">
					<select name="fld_type" id="fld_type">
						<option selected="selected" value=""><?php esc_html_e("Please select","wp-app-studio");?></option>
						<optgroup label="<?php esc_html_e("Text","wp-app-studio");?>">
						<option value="alphanumeric"><?php esc_html_e("AlphaNumeric","wp-app-studio");?></option>
						<option value="credit_card"><?php esc_html_e("Credit Card","wp-app-studio");?></option>
						<option value="decimal"><?php esc_html_e("Decimal","wp-app-studio");?></option>
						<option value="digits_only"><?php esc_html_e("Digits Only","wp-app-studio");?></option>
						<option value="email"><?php esc_html_e("Email","wp-app-studio");?></option>
						<option value="integer"><?php esc_html_e("Integer","wp-app-studio");?></option>
						<option value="ip4"><?php esc_html_e("IP Address V4","wp-app-studio");?></option>
						<option value="ip6"><?php esc_html_e("IP Address V6","wp-app-studio");?></option>
						<option value="letters_only"><?php esc_html_e("Letters Only","wp-app-studio");?></option>
						<option value="letters_with_punc"><?php esc_html_e("Letters with Punctuation","wp-app-studio");?></option>
						<option value="mobile_uk"><?php esc_html_e("Mobile UK","wp-app-studio");?></option>
						<option value="no_whitespace"><?php esc_html_e("No WhiteSpace","wp-app-studio");?></option>
						<option value="password"><?php esc_html_e("Password","wp-app-studio");?></option>
						<option value="phone_uk"><?php esc_html_e("Phone UK","wp-app-studio");?></option>
						<option value="phone_us"><?php esc_html_e("Phone US","wp-app-studio");?></option>
						<option value="zipcode_uk"><?php esc_html_e("Postal Code UK","wp-app-studio");?></option>
						<option value="text"><?php esc_html_e("Plain Text","wp-app-studio");?></option>
						<option value="url"><?php esc_html_e("URL","wp-app-studio");?></option>
						<option value="vin_number_us"><?php esc_html_e("VIN Number US","wp-app-studio");?></option>
						<option value="zipcode_us"><?php esc_html_e("Zipcode US","wp-app-studio");?></option>
						</optgroup>
						<optgroup label="<?php esc_html_e("Date/Time","wp-app-studio");?>">
						<option value="date"><?php esc_html_e("Date","wp-app-studio");?></option>
						<option value="datetime"><?php esc_html_e("DateTime","wp-app-studio");?></option>
						<option value="time"><?php esc_html_e("Time","wp-app-studio");?></option>
						</optgroup>
						<optgroup label="<?php esc_html_e("Textarea","wp-app-studio");?>">
						<option value="textarea"><?php esc_html_e("Text Area","wp-app-studio");?></option>
						<option value="wysiwyg"><?php esc_html_e("Wysiwyg Editor","wp-app-studio");?></option>
						</optgroup>
						<optgroup label="<?php esc_html_e("Uploaders","wp-app-studio");?>">
						<option value="file"><?php esc_html_e("File Uploader","wp-app-studio");?></option>
						<option value="image"><?php esc_html_e("Image Uploader","wp-app-studio");?></option>
						</optgroup>
						<optgroup label="<?php esc_html_e("Hidden","wp-app-studio");?>">
						<option value="hidden_constant"><?php esc_html_e("Hidden Constant","wp-app-studio");?></option>
						<option value="hidden_constant_datetime"><?php esc_html_e("Hidden Constant DateTime","wp-app-studio");?></option>
						<option value="hidden_function"><?php esc_html_e("Hidden Function","wp-app-studio");?></option>
						</optgroup>
						<optgroup label="<?php esc_html_e("Selectors","wp-app-studio");?>">
						<option value="checkbox"><?php esc_html_e("Checkbox","wp-app-studio");?></option>
						<option value="checkbox_list"><?php esc_html_e("Checkbox List","wp-app-studio");?></option>
						<option value="radio"><?php esc_html_e("Radios","wp-app-studio");?></option>
						<option value="select"><?php esc_html_e("Select","wp-app-studio");?></option>
						<option value="user"><?php esc_html_e("User List","wp-app-studio");?></option>
						<option value="color"><?php esc_html_e("Color Picker","wp-app-studio");?></option>
						<option value="country"><?php esc_html_e("Country","wp-app-studio");?></option>
						<option value="state"><?php esc_html_e("State","wp-app-studio");?></option>
						<option value="city"><?php esc_html_e("City","wp-app-studio");?></option>
						</optgroup>
						<optgroup label="<?php esc_html_e("Misc","wp-app-studio");?>">
						<option value="map"><?php esc_html_e("Map","wp-app-studio");?></option>
						<option value="calculated"><?php esc_html_e("Calculated","wp-app-studio");?></option>
						<option value="oembed"><?php esc_html_e("Oembed","wp-app-studio");?></option>
						</optgroup>
					</select>
			<a href="#" title="<?php esc_html_e("Defines the attribute display and validation type.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>      
			<span id="validation-message" class="label label-info" style="display:none;"> </span>
			</div>
	  </div>
	<div id="fld_country_attached_div" name="fld_country_attached_div">
	<div class="control-group">
		<label class="control-label req"><?php esc_html_e("Attached Country","wp-app-studio");?></label>
		<div class="controls">
			<select name="fld_country_attached" id="fld_country_attached">
			</select>
			<a href="#" title="<?php esc_html_e("Sets the country attribute for the state.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>      
		</div>
	</div>
	</div>
	<div id="fld_state_attached_div" name="fld_state_attached_div">
	<div class="control-group">
		<label class="control-label req"><?php esc_html_e("Attached State","wp-app-studio");?></label>
		<div class="controls">
			<select name="fld_state_attached" id="fld_state_attached">
			</select>
			<a href="#" title="<?php esc_html_e("Sets the state attribute for the city.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>      
		</div>
	</div>
	</div>
	<div id="fld_map_div" name="fld_map_div">
	<div class="control-group">
		<label class="control-label req"><?php esc_html_e("Attached Address","wp-app-studio");?></label>
		<div class="controls">
			<select name="fld_map_attached" id="fld_map_attached">
			</select>
			<a href="#" title="<?php esc_html_e("Sets the address attribute for the map.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>      
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php esc_html_e("Marker Title","wp-app-studio");?></label>
		<div class="controls">
			<select name="fld_map_marker_title" id="fld_map_marker_title">
			</select>
			<a href="#" title="<?php esc_html_e("Sets the marker title attribute for the map.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>      
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php esc_html_e("Info Window","wp-app-studio");?></label>
		<div class="controls">
			<select name="fld_map_info_window" id="fld_map_info_window">
			</select>
			<a href="#" title="<?php esc_html_e("Sets the info window attribute for the map.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>      
		</div>
	</div>
	</div>
	<div class="control-group" id="fld_uniq_id_div" name="fld_uniq_id_div">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox">
			<?php esc_html_e("Unique","wp-app-studio");?>
			<input name="fld_uniq_id" id="fld_uniq_id" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("An identifier which is guaranteed to be unique among all identifiers used for those objects and for a specific purpose. Exp; VIN of a car uniquely identifies a car among other cars. A unique identifier is used in forms as a searchable dropdown to link related entities. A unique identifier may be a combination of multiple attributes or a single attribute.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_include_title_div" name="fld_include_title_div">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Include in Title","wp-app-studio");?>
			<input name="fld_include_title" id="fld_include_title" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Adds this attribute to title field. If there is no attribute selected in an entity, unique fields are added by default.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_required_div" name="fld_required_div">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Required for Submit","wp-app-studio");?>
			<input name="fld_required" id="fld_required" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the attribute required so it can not be blank.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_srequired_div" name="fld_srequired_div">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Required for Search","wp-app-studio");?>
			<input name="fld_srequired" id="fld_srequired" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the attribute required for search form submissions so it can not be blank.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_list_visible_div" name="fld_list_visible_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Visible in Admin List","wp-app-studio");?>
            <input name="fld_list_visible" id="fld_list_visible" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the attribute visible in admin list page of the entity.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_is_filterable_div" name="fld_is_filterable_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Filterable","wp-app-studio");?>
            <input name="fld_is_filterable" id="fld_is_filterable" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the attribute filterable in admin list page of the entity.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_is_mobile_div" name="fld_is_mobile_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Mobile","wp-app-studio");?>
            <input name="fld_is_mobile" id="fld_is_mobile" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Treat this field as a mobile phone number.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div id="fld_calc_formula_div" name="fld_calc_formula_div">
	<div class="control-group">
        <label class="control-label req"><?php esc_html_e("Formula","wp-app-studio");?></label>
        <div class="controls">
        <textarea id="fld_calc_formula" name="fld_calc_formula" class="wpas-std-textarea" placeholder="e.g. " ></textarea>
        <a href="#" title="<?php esc_html_e("Enter the formula to be used in the calculations. Make sure to use only attributes available and functions supported defined by their parameters. You do not need to wrap strings with quotes.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
	</div>
	<div class="control-group">
        <label class="control-label"></label>
        <div class="controls" id="fld_formula_tags" name="fld_formula_tags">
	</div>
	</div>
	<div class="control-group">
        <label class="control-label req"><?php esc_html_e("Return Type","wp-app-studio");?></label>
        <div class="controls">
	<select name="fld_formula_return_type" id="fld_formula_return_type">
	<option value=""><?php esc_html_e("Please Select","wp-app-studio");?></option>
	<option value="text"><?php esc_html_e("Text","wp-app-studio");?></option>
	<option value="numeric"><?php esc_html_e("Numeric","wp-app-studio");?></option>
	<option value="date"><?php esc_html_e("Date","wp-app-studio");?></option>
	<option value="datetime"><?php esc_html_e("DateTime","wp-app-studio");?></option>
	<option value="time"><?php esc_html_e("Time","wp-app-studio");?></option>
	</select>
        <a href="#" title="<?php esc_html_e("Enter the data type which will be returned as a result of the formula above.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
	</div>
	</div>
	<div class="control-group" id="fld_allow_html_div" name="fld_allow_html_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Allow Html","wp-app-studio");?>
            <input name="fld_allow_html" id="fld_allow_html" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Allows html tags to be entered. When unchecked html tags are escaped.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_is_advanced_div" name="fld_is_advanced_div" style="display:none;">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Advanced","wp-app-studio");?>
            <input name="fld_is_advanced" id="fld_is_advanced" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Enables support for searching, remote data sets, and infinite scrolling of results.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group row-fluid" name="fld_file_size_div" id="fld_file_size_div" style="display:none;">
			<label class="control-label"><?php esc_html_e("Maximum File Size","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-large" name="fld_file_size" id="fld_file_size" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Set maximum file size in kilobytes. Only numbers allowed. Leave it blank for no limit.","wp-app-studio");?> <?php esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please upload no greater than X kbytes.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group row-fluid" name="fld_file_ext_div" id="fld_file_ext_div" style="display:none;">
			<label class="control-label"><?php esc_html_e("Allowed Extensions","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-large" name="fld_file_ext" id="fld_file_ext" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Sets the file extensions allowed to upload. exp. for files : pdf,txt for images: jpg,png. Leave it blank for all types.","wp-app-studio") .' '. esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please upload a valid file type.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group" id="fld_multiple_div" name="fld_multiple_div" style="display:none;">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Multiple","wp-app-studio");?>
            <input name="fld_multiple" id="fld_multiple" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Allows users to select multiple values when set.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="fld_user_map_div" name="fld_user_map_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("User Map","wp-app-studio");?></label>
		<div class="controls">
			<select name="fld_user_map" id="fld_user_map">
			<option selected="selected" value=""><?php esc_html_e("Please select","wp-app-studio");?></option>
			<option value="user_login"><?php esc_html_e("Login","wp-app-studio");?></option>
			<option value="user_nicename"><?php esc_html_e("Nicename","wp-app-studio");?></option>
			<option value="display_name"><?php esc_html_e("Display Name","wp-app-studio");?></option>
			<option value="user_firstname"><?php esc_html_e("First Name","wp-app-studio");?></option>
			<option value="user_lastname"><?php esc_html_e("Last Name","wp-app-studio");?></option>
			<option value="nickname"><?php esc_html_e("NickName","wp-app-studio");?></option>
			</select>
			<a href="#" title="<?php esc_html_e("Allows to map to user fields when user is logged in.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
		</div>
	</div>
	<div id="fld_clone_div" name="fld_clone_div" style="display:none;">
	<div class="control-group">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Enable Cloning","wp-app-studio");?>
            <input name="fld_clone" id="fld_clone" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Allows users to set multiple values for the attribute.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div id="fld_clone_options_div" name="fld_clone_options_div" style="display:none;">
	<div class="control-group">
    	<label class="control-label"></label>
	<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable Sorting","wp-app-studio");?>
		<input name="fld_sort_clone" id="fld_sort_clone" type="checkbox" value="1"/>
		<a href="#" title="<?php esc_html_e("Allows users to sort cloned values.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Max Clone","wp-app-studio");?></label>
	<div class="controls">
		<input class="input-mini" name="fld_max_clone" id="fld_max_clone" type="text" placeholder="" value="" >
		<a href="#" title="<?php esc_html_e("Sets the maximum number of clones.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Wrapper Class","wp-app-studio");?></label>
	<div class="controls">
		<input class="input-xlarge" name="fld_wrapper_clone" id="fld_wrapper_clone" type="text" placeholder="E.g. class1 class2" value="" >
		<a href="#" title="<?php esc_html_e("Sets the class name of wrapper div. Multiple class names separated by space can be used.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>
	</div>
	<div class="control-group" id="fld_image_thickbox_div" name="fld_image_thickbox_div" style="display:none;">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Advanced","wp-app-studio");?>
            <input name="fld_image_thickbox" id="fld_image_thickbox" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Displays media dialog box shows up when set. The standard is browser file upload dialog.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group row-fluid" name="fld_hidden_func_div" id="fld_hidden_func_div" style="display:none;">
			<label class="control-label"><?php esc_html_e("Hidden Function","wp-app-studio");?></label>
			<div class="controls">
			<select name="fld_hidden_func" id="fld_hidden_func">
			<option selected="selected" value=""><?php esc_html_e("Please select","wp-app-studio");?></option>
			<option value="user_login"><?php esc_html_e("Username","wp-app-studio");?></option>
			<option value="user_email"><?php esc_html_e("User Email","wp-app-studio");?></option>
			<option value="user_firstname"><?php esc_html_e("User Firstname","wp-app-studio");?></option>
			<option value="user_lastname"><?php esc_html_e("User Lastname","wp-app-studio");?></option>
			<option value="user_displayname"><?php esc_html_e("User Display Name","wp-app-studio");?></option>
			<option value="user_id"><?php esc_html_e("User ID","wp-app-studio");?></option>
			<option value="date_mm_dd_yyyy"><?php esc_html_e("Current Date (MM-DD-YYYY)","wp-app-studio");?></option>
			<option value="date_dd_mm_yyyy"><?php esc_html_e("Current Date (DD-MM-YYYY)","wp-app-studio");?></option>
			<option value="current_year"><?php esc_html_e("Current Year (YYYY)","wp-app-studio");?></option>
			<option value="current_month"><?php esc_html_e("Current Month Name (January)","wp-app-studio");?></option>
			<option value="current_month_num"><?php esc_html_e("Current Month (01)","wp-app-studio");?></option>
			<option value="current_day"><?php esc_html_e("Current Day (01)","wp-app-studio");?></option>
			<option value="now"><?php esc_html_e("Now (YYYY-MM-DD HH:mm:ss)","wp-app-studio");?></option>
			<option value="current_time"><?php esc_html_e("Current Time (HH:mm:ss)","wp-app-studio");?></option>
			<option value="unique_id"><?php esc_html_e("Unique Identifier","wp-app-studio");?></option>
			<option value="autoinc"><?php esc_html_e("Sequence","wp-app-studio");?></option>
			<option value="param_pass"><?php esc_html_e("Parameter Pass","wp-app-studio");?></option>
			<option value="concat"><?php esc_html_e("Concatenate","wp-app-studio");?></option>
			</select>
			<a href="#" title="<?php esc_html_e("Sets a default value for the attribute.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group" id="fld_searchable_div" name="fld_searchable_div" style="display:none;">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Searchable","wp-app-studio");?>
            <input name="fld_searchable" id="fld_searchable" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the hidden function or hidden constant attribute searchable in the front end. Searchable hidden attributes can be used in the search forms.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div id="date-format" style="display:none;">
	<div class="control-group row-fluid">
			<label class="control-label req"><?php esc_html_e("Date Format","wp-app-studio");?></label>
			<div class="controls">
			<select name="fld_date_format" id="fld_date_format">
			<option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio");?></option>
			<option value="mm-dd-yy"><?php esc_html_e("MM-DD-YYYY","wp-app-studio");?></option>
			<option value="yy-mm-dd"><?php esc_html_e("YYYY-MM-DD","wp-app-studio");?></option>
			<option value="dd-mm-yy"><?php esc_html_e("DD-MM-YYYY","wp-app-studio");?></option>
			<option value="mm/dd/yy"><?php esc_html_e("MM/DD/YYYY","wp-app-studio");?></option>
			<option value="yy/mm/dd"><?php esc_html_e("YYYY/MM/DD","wp-app-studio");?></option>
			<option value="dd/mm/yy"><?php esc_html_e("DD/MM/YYYY","wp-app-studio");?></option>
			</select>
			<a href="#" title="<?php esc_html_e("Select a date format which will be used in the admin entity list and as a default in the frontend views.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	</div>
	<div id="time-format" style="display:none;">
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Time Format","wp-app-studio");?></label>
			<div class="controls">
			<select name="fld_time_format" id="fld_time_format">
			<option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio");?></option>
			<option value="hh:mm:ss"><?php esc_html_e("HH:mm:ss","wp-app-studio");?></option>
			<option value="hh:mm"><?php esc_html_e("HH:mm","wp-app-studio");?></option>
			</select>
			<a href="#" title="<?php esc_html_e("Select a time format.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	</div>
	<div id="validation-options" class="control-group row-fluid" style="display:none;">
	<label class="control-label"><?php esc_html_e("Validation Options","wp-app-studio");?></label>
	<div class="controls">  
	<div id="min-max-length" style="display:none;">
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Minimum Length","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_min_length" id="fld_min_length" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Create a minumum length for the attribute.","wp-app-studio") . esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter at least X characters.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Maximum Length","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_max_length" id="fld_max_length" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Create a maximum length for the attribute","wp-app-studio") .  esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter no more than X characters.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	</div>
	<div id="min-max-value" style="display:none;">
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Minimum Value","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_min_value" id="fld_min_value" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Create a minumum value for the attribute.","wp-app-studio") . esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a value greater than or equal to X.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Maximum Value","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_max_value" id="fld_max_value" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Create a maximum value for the attribute.","wp-app-studio") . esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter a value less than or equal to X.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	</div>
	<div id="min-max-words" style="display:none;">
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Minimum Words","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_min_words" id="fld_min_words" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Create a minumum number of words for the attribute.","wp-app-studio") . esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter at least X words.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Maximum Words","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_max_words" id="fld_max_words" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Create a maximum number of words for the attribute.","wp-app-studio") . esc_html_e("Validation Message:","wp-app-studio") . ' ' . esc_html_e("Please enter X words or less.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	</div>
	<div id="max-file-uploads" style="display:none;">
	<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Max File Uploads","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-mini" name="fld_max_file_uploads" id="fld_max_file_uploads" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Sets the number of maximum allowable file uploads.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	</div>
	</div><!--validation-optiond-->
	</div>
	<div class="control-group row-fluid" id="fld_values_div" style="display:none;">
        <label class="control-label req"><?php esc_html_e("Values","wp-app-studio");?></label>
        <div class="controls">
        <textarea id="fld_values" name="fld_values" class="wpas-std-textarea" placeholder="e.g. blue;red;white " ></textarea>
        <a href="#" title="<?php esc_html_e("Enter semicolon separated option labels for the field. There must be only one semicolon between the values. Optionally, you can define value-label combinations using {Value}Label format. If the predined value does not exist, it is automatically created based on the label.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
</div>
	<div class="control-group row-fluid" id="fld_dflt_value_div" name="fld_dflt_value_div">
			<label class="control-label"><?php esc_html_e("Default Value","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-xlarge" name="fld_dflt_value" id="fld_dflt_value" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Sets the default value(s) for the attribute, separated by a semicolon. Multiple default values can only be set for select with multiple option and checkbox list types. You must enter the value from Values field and not the label.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</div>
	</div>
	<div class="control-group row-fluid" id="fld_dflt_checked_div" name="fld_dflt_checked_div" style="display:none;">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Default Value","wp-app-studio");?>
			<input name="fld_dflt_checked" id="fld_dflt_checked" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Select the default state of the checkbox. If checked the default value will be checked.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="fld_fa_chkd_div" name="fld_fa_chkd_div" style="display:none;">
			<label class="control-label"><?php esc_html_e("Checked Icon Class","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-xlarge" name="fld_fa_chkd_val" id="fld_fa_chkd_val" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Sets font awesome web font icon class for selected values.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a><a href="<?php echo WPAS_URL . '/articles/supported-icons/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=cheatsheet'; ?>" target="_blank"><?php esc_html_e("Cheatsheet","wp-app-studio");?></a>
			</div>
	</div>
	<div class="control-group row-fluid" id="fld_fa_unchkd_div" name="fld_fa_unchkd_div" style="display:none;">
			<label class="control-label"><?php esc_html_e("Unchecked Icon Class","wp-app-studio");?></label>
			<div class="controls">
			<input class="input-xlarge" name="fld_fa_unchkd_val" id="fld_fa_unchkd_val" type="text" placeholder="" value="" >
			<a href="#" title="<?php esc_html_e("Sets font awesome web font icon class for unselected values.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a><a href="<?php echo WPAS_URL . '/articles/supported-icons/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=cheatsheet'; ?>" target="_blank"><?php esc_html_e("Cheatsheet","wp-app-studio");?></a>
			</div>
	</div>
	<div class="control-group row-fluid" id="fld_limit_user_role_div" name="fld_limit_user_role_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Limit By Role","wp-app-studio");?></label>
		<div class="controls">
		<select id="fld_limit_user_role" name="fld_limit_user_role" multiple>
		</select>
		<a href="#" title="<?php esc_html_e("Sets the user roles which will be displayed in the user list dropdown.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
	</div>
	<div id="fld_autoinc_field_div" name="fld_autoinc_field_div" style="display:none;">
	<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Start At Value","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="fld_autoinc_start" id="fld_autoinc_start" type="text" placeholder="" value="" >
		<a href="#" title="<?php esc_html_e("Sets sequence start at value, set to 1 if empty.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
	</div>
	<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Increment By","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="fld_autoinc_incr" id="fld_autoinc_incr" type="text" placeholder="" value="" >
		<a href="#" title="<?php esc_html_e("Sets sequence increment by value, set to 1 if empty.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
	</div>
	</div>
	<div id="fld_concat_field_div" name="fld_concat_field_div" style="display:none;">
	<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Concat String","wp-app-studio");?></label>
		<div class="controls">
		<textarea id="fld_concat_string" name="fld_concat_string" class="wpas-std-textarea" placeholder='e.g. !#ent_first_name# !#ent_last_name#' ></textarea>
		<a href="#" title="<?php esc_html_e("Strings created here become available as an attribute tag. Make sure only to use available tags below. You do not need to wrap strings with quotes.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
	</div>
	<div class="control-group">
        <label class="control-label"></label>
        <div class="controls" id="fld_concat_tags" name="fld_concat_tags">
	</div>
	</div>
	</div>
	<div class="control-group" id="enable_conditional_div" name="enable_conditional_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Enable Conditional Logic","wp-app-studio");?>
            <input name="fld_is_conditional" id="fld_is_conditional" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Applies conditional branching when enabled.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div id="conditional-options" class="control-group row-fluid" style="display:none;">
	<label class="control-label"><?php esc_html_e("Conditional Logic","wp-app-studio");?></label>
	<div class="controls">  
	<div id="cond">
	<div class="control-group row-fluid">
			<div class="controls span12">
			<select name="fld_cond_case" id="fld_cond_case" class="input-small">
			<option value="show"><?php esc_html_e('Show','wp-app-studio');?></option>
			<option value="hide"><?php esc_html_e('Hide','wp-app-studio');?></option></select>
			<?php esc_html_e('This Attribute If','wp-app-studio'); ?>&nbsp;
			<select name="fld_cond_type" id="fld_cond_type" class="input-small">
			<option value="all"><?php esc_html_e('All','wp-app-studio');?></option>
			<option value="any"><?php esc_html_e('Any','wp-app-studio');?></option></select>
			<?php esc_html_e('of the below match:','wp-app-studio'); ?>
			</div>
	</div>
	<div id="fld_cond-list">
	</div>
	</div>
	</div>
	</div>
  </fieldset>
</div>
	<div class="control-group emdt-row">
		  <button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
	   <button class="btn btn-inverse layout-buttons" id="save-entity-field" name="Save" type="submit"><?php esc_html_e("Save","wp-app-studio");?>
	   </button>
	</div>
<?php
}
?>
