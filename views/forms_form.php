<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_form_layout_form()
{
?>
<div class="modal hide" id="errorModalForm">
  <div class="modal-header">
        <button id="error-form-close" type="button" class="close" data-dismiss="errorModalForm" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio");?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("Please add all required fields to the form layout.","wp-app-studio");?>
  </div>
  <div class="modal-footer">
<button id="error-form-ok" data-dismiss="errorModalForm" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio");?></button>
  </div>
</div>
<form action="" method="post" id="form-layout">
<input type="hidden" id="app" name="app" value="">
<input type="hidden" value="" name="form" id="form">
<div class="row-fluid" id= "form-layout-bin-ctr">
</div>
<div id="form-layout-frm-btn" class="emdt-row control-group">
<button id="cancel" class="btn btn-inverse layout-buttons" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
<button id="save-form-layout" class="btn btn-inverse layout-buttons" type="submit" name="Save"><i class="icon-save"></i>
<?php esc_html_e("Save","wp-app-studio");?>
</button>
</div>
</form>
<?php
}
function wpas_get_ent_tax_rel_count($app,$form_id)
{
	$tax_count = 0;
	$rel_count = 0;
	$ent_field_count = 0;
	$ent_id = $app['form'][$form_id]['form-attached_entity'];
	if(!empty($app['entity'][$ent_id]['field']))
	{
		foreach($app['entity'][$ent_id]['field'] as $appfield)
		{
			if(!in_array($appfield['fld_type'],Array('hidden_constant','hidden_function')))
			{
				$ent_field_count ++;
			}
		}
	}
	if(!empty($app['form'][$form_id]['form-dependents']))
	{
		$rel_count = count($app['form'][$form_id]['form-dependents']);
	}
	if(!empty($app['taxonomy']))
	{
		foreach($app['taxonomy'] as $mytaxonomy)
		{
			if(in_array($ent_id,$mytaxonomy['txn-attach']))
			{
				$tax_count ++;
			}
		}
	}
	return Array($ent_field_count,$rel_count,$tax_count);
}
function wpas_form_container($layout,$app,$form_id)
{
	list($ent_field_count,$rel_count,$tax_count) = wpas_get_ent_tax_rel_count($app,$form_id);
	$layout_html = "<div class=\"layout-bin span3 pull-left\" data-spy=\"affix\" data-offset-top=50>
			<ul class=\"ui-draggable\">
			<li class=\"ui-draggable\"><div class=\"form-hr\" id=\"form-hr\"><div><i class=\"icon-resize-horizontal\"></i>HR</div></div></li>
			<li class=\"ui-draggable\"><div class=\"form-text\" id=\"form-text\"><div> <i class=\"icon-text-width\"></i>" . __("Text","wp-app-studio") . "</div></div></li>";
	if($ent_field_count != 0 || $tax_count != 0 || $rel_count != 0)
	{
		$layout_html .="<li class=\"ui-draggable\"><div class=\"form-attr\" id=\"form-element\"><div> <i class=\"icon-tasks\"></i>" . __("Element","wp-app-studio") . "</div></div></li>";
	}
	$layout_html .= "</ul></div><div id=\"form-layout-ctr\" class=\"ui-droppable ui-sortable  span9 pull-right\">";
	if(!is_array($layout))
	{
		$layout_html .="<div class=\"dragme\">" . __("DRAG AND DROP") . "</div>";
	}
	else
	{
		$text = "";
		$selected_vals = Array();
		$sizes = Array();
		for($i=1;$i<=count($layout);$i++)
		{
			$is_hidden = 0;
			if(isset($layout[$i]['obtype']) && in_array($layout[$i]['obtype'],Array('hr','text')))
			{
				$class = $layout[$i]['obtype'];
			}
			else
			{
				$class = 'element';
			}
			$id = "form-" . $class . "-" . $i;
			$layout_html .= "<div id='" . esc_attr($id) . "' class='form-" . esc_attr($class) . "'>";
			$layout_html .= "<div class='emdt-row form-field-str'>";
			$layout_html .= "<div class='span1 layout-edit-icons'>";
			if((isset($layout[$i]['obtype']) && $layout[$i]['obtype'] != 'hr') || !isset($layout[$i]['obtype']))
			{
				$layout_html .= "<a class='edit'><i class='icon-edit pull-left'></i></a>";
			}
			$layout_html .= "</div><div id='field-labels' class='emdt-row'>";
			if(!in_array($class,Array('hr','text')))
			{
				for($j=1;$j<= count($layout[$i]);$j++)
				{
					if(isset($layout[$i][$j]))
				   	{
						$layout_html .= "<div id='field-label" . $j . "' class='span" . $layout[$i][$j]['size'];
						if($layout[$i][$j]['obtype'] == 'btn-std')
						{
							$layout_html .= " btn-std";
						}
						elseif($layout[$i][$j]['obtype'] == 'custom_fields')
						{
							$layout_html .= " custom-fld";
						}
						elseif(!empty($layout[$i][$j]['attr']) && in_array($app['entity'][$layout[$i][$j]['entity']]['field'][$layout[$i][$j]['attr']]['fld_type'],Array('hidden_constant','hidden_function')))
						{
							$layout_html .= " hidden-fld";
							$is_hidden = 1;
						} 
						elseif(!empty($layout[$i][$j]['glb']))
						{
							$layout_html .= " glb-fld";
						}
						else
						{
							$layout_html .= " elmt";
						}	
						$layout_html .= "'>";
						if(isset($layout[$i][$j]['obtype']))
						{
							$connector = "";
							switch($layout[$i][$j]['obtype']) {
								case 'attr':
									if(isset($layout[$i][$j]['attr'])){
						 				$layout_html .= esc_html($app['entity'][$layout[$i][$j]['entity']]['field'][$layout[$i][$j]['attr']]['fld_label']);
										$connector = 'fld';
									}
									break;
								case 'tax':
									if($layout[$i][$j]['tax'] == 'cat')
									{
										$layout_html .= "Categories";
										$connector='blttax_';
									}
									elseif($layout[$i][$j]['tax'] == 'tag')
									{
										$layout_html .= "Tags";
										$connector='blttax_';
									}
									else
									{
						 				$layout_html .= esc_html($app['taxonomy'][$layout[$i][$j]['tax']]['txn-label']);
										$connector='tax';
									}	
									break;
								case 'relent':
									$myrel = $app['relationship'][$layout[$i][$j]['relent']];
						 			$layout_html .= esc_html(wpas_get_rel_full_name($myrel,$app));
									$connector='rel';
									break;	
								case 'custom_fields':
									$layout_html .= __('Custom Fields','wpas');
									$connector = 'custom_fields';
									break;
								case 'conn':
									$myconn = $app['connection'][$layout[$i][$j]['conn']];
									if($layout[$i][$j]['ext'] == 'mailchimp'){
						 				$layout_html .= esc_html($app['connection'][$layout[$i][$j]['conn']]['connection-mailchimp_label']);
										$connector='mailchimp';
									}
									elseif($layout[$i][$j]['ext'] == 'woo_ord'){
						 				$layout_html .= esc_html($app['connection'][$layout[$i][$j]['conn']]['connection-woo_label']);
										$layout_html .= " Order";
										$connector='woo_ord';
									}
									elseif($layout[$i][$j]['ext'] == 'woo_prd'){
						 				$layout_html .= esc_html($app['connection'][$layout[$i][$j]['conn']]['connection-woo_label']);
										$layout_html .= " Product";
										$connector='woo_prd';
									}
									if($layout[$i][$j]['ext'] == 'edd_ord'){
						 				$layout_html .= esc_html($app['connection'][$layout[$i][$j]['conn']]['connection-edd_label']);
										$layout_html .= " Order";
										$connector='edd_ord';
									}
									elseif($layout[$i][$j]['ext'] == 'edd_prd'){
						 				$layout_html .= esc_html($app['connection'][$layout[$i][$j]['conn']]['connection-edd_label']);
										$layout_html .= " Download";
										$connector='edd_prd';
									}
									break;	
								case 'glb':
									if(isset($layout[$i][$j]['glb'])){
										 $layout_html .= esc_html($app['glob'][$layout[$i][$j]['glb']]['glob-label']);
										$connector = 'glb';
									}
									break;
								case 'btn-std':
									$layout_html .= "Submit Button";
									break;
							}
							if($layout[$i][$j]['obtype'] == 'btn-std')
							{	
								$selected_vals[$j] = "submit";
							}
							else
							{
								$selected_vals[$j] = $layout[$i][$j]['entity'] . "__" . $connector . $layout[$i][$j][$layout[$i][$j]['obtype']];
							}
						}
						$layout_html .= "</div>";	
						$sizes[$j] = $layout[$i][$j]['size'];
					}
				}
			}
			elseif($class == 'hr')
			{
				$layout_html .= "<hr>";
			}
			else
			{
				$layout_html .= ucfirst($class);
			}
			$layout_html .= "</div><div class='span1 layout-edit-icons'>";
			$layout_html .= "<a class='delete'><i class='icon-trash pull-right'></i></a></div></div>";
			$layout_html .= "<div id='" . esc_attr($id) . "-inside' class='form-inside'>";
			if($class == 'text')
			{
				$layout_html .= "<div class='control-group row-fluid'>";
				$layout_html .= "<label class='control-label'>" . __("Description","wp-app-studio") . "</label>";
				$layout_html .= "<div class='controls'>";
				$layout_html .= "<textarea id='form-text-desc-" . $i . "' class='wpas-std-textarea' name='form-text-desc-" . $i . "'>";
				if(isset($layout[$i]['desc']))
				{
					$layout_html .= $layout[$i]['desc']; 
				}
				$layout_html .= "</textarea></div></div>"; 
			}
			elseif($class == 'hr')
			{
				$layout_html .= "<input type='hidden' id='form-hr-" . $i . "' name='form-hr-" . $i . "' value=1>";
			}
			else
			{
				$count = $j - 1;
				$layout_html .= wpas_get_form_layout_select_all($app,$form_id,$count,$i,$is_hidden,$selected_vals,$sizes);
			}
			$layout_html .= "</div></div>";
		}
	}
	$latest_count = count($layout) + 1;
	$layout_html .= "<input type='hidden' id='form-field-count' name='form-field-count' value='" . $latest_count . "'></div>";
	return $layout_html;
}
function wpas_add_forms_form($app_id)
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$.fn.initForm = function(app_id) {
		$.get(ajaxurl,{action:'wpas_get_entities',type:'form',app_id:app_id}, function(response){
			$('#add-form-div #form-attached_entity').html(response);
		});
		$('#form-dependents').html('');
		$('#form-font_awesome').prop('checked', true);
		$('#form-confirm_url_div').hide();
		$('#form-email_user_div').hide();
		$('#form-email_admin_div').hide();
		$('#form-schedule_div').hide();
		$('#form-tabs').hide();
		$('#formtabs-3-li').show();
		$('#form-submit_status_div').show();
		$('#form-visitor_submit_status_div').show();
		$('#form-noresult_msg_div').hide();
		$('#form-ajax_search_div').hide();
		$('#form-enable_operators_div').hide();
		$('#form-result_templ_div').hide();
		$('#form-result_fields_div').hide();
		$('#form-setup_page_title_div').hide();
		$('#form-dropdown_color_div').show();
	}
	$('#form-schedule_start').datetimepicker({dateFormat:'yy-mm-dd',timeFormat:'hh:mm:ss'});
	$('#form-schedule_end').datetimepicker({dateFormat:'yy-mm-dd',timeFormat:'hh:mm:ss'});
	$(document).on('click','#form-advanced-option',function(){
		if($(this).prop('checked'))
		{
			$('#form-tabs').show();
		}
		else
		{
			$('#form-tabs').hide();
		}
	});
	$(document).on('change','#form-form_type',function(){
		if($(this).find('option:selected').val() == 'search')
		{
			app_id = $('input#app').val();
			$('#formtabs-3-li').hide();
			$('#form-submit_status_div').hide();
			$('#form-visitor_submit_status_div').hide();
			$('#form-noresult_msg_div').show();
			$('#form-ajax_search_div').show();
			$('#form-enable_operators_div').show();
			$('#form-result_templ_div').show();
			$('#form-result_fields_div').hide();
		}
		else
		{
			$('#formtabs-3-li').show();
			$('#form-submit_status_div').show();
			$('#form-visitor_submit_status_div').show();
			$('#form-noresult_msg_div').hide();
			$('#form-ajax_search_div').hide();
			$('#form-enable_operators_div').hide();
			$('#form-result_templ_div').hide();
			$('#form-result_fields_div').hide();
		}
	});
	$(document).on('change','#form-result_templ',function(){
		if($(this).find('option:selected').val() == 'cust_table')
		{
			$('#form-result_fields_div').hide();
		}
		else {
			app_id = $('input#app').val();
			ent_id = $('#form-attached_entity').val();
			$.get(ajaxurl,{action:'wpas_get_table_cols',app_id:app_id,chart_ent:ent_id,table_cols:'',conn:1}, function(response){
				$('#form-result_fields').html(response[0]);
			},'json');
			$('#form-result_fields_div').show();
		}
	});
	
	$(document).on('change','#form-temp_type',function(){
		if($(this).find('option:selected').val() == 'Bootstrap')
		{
			$('#form-font_awesome').prop('checked',true);
			$('#form-submit_button_fa_div').show();
			$('#form-dropdown_color_div').show();
		}
		else
		{
			$('#form-dropdown_color_div').hide();
		}
	});
	$(document).on('click','#form-font_awesome',function(){
		if($(this).prop('checked'))
		{
			$('#form-submit_button_fa_div').show();
		}
		else
		{
			$('#form-submit_button_fa_div').hide();
		}
	});
	$(document).on('click','#form-disable_submit',function(){
		if($(this).prop('checked'))
		{
			$('#form-submit_status_div').hide();
			$('#form-visitor_submit_status_div').hide();
		}
		else {
			$('#form-submit_status_div').show();
			$('#form-visitor_submit_status_div').show();
		}
	});
	$(document).on('change','#form-confirm_method',function(){
		if($(this).find('option:selected').val() == 'text')
		{
			$('#form-confirm_txt_div').show();
			$('#form-confirm_url_div').hide();
		}
		else if($(this).find('option:selected').val() == 'redirect')
		{
			$('#form-confirm_txt_div').hide();
			$('#form-confirm_url_div').show();
			$('#form-ajax').prop('checked',false);
		}
	});
	$(document).on('click','#form-enable_form_schedule',function(){
		if($(this).prop('checked'))
		{
			$('#form-schedule_div').show();
		}
		else
		{
			$('#form-schedule_div').hide();
		}
	});
	$(document).on('click','#form-setup_page',function(){
		if($(this).prop('checked'))
		{
			$('#form-setup_page_title_div').show();
		}
		else
		{
			$('#form-setup_page_title_div').hide();
		}
	});
});
</script>
<form action="" method="post" id="form-form" class="form-horizontal">
<input type="hidden" id="app" name="app" value="">
<input type="hidden" value="" name="form" id="form">
<fieldset>
	<div class="field-container">
	<div class="well">
	<div class="emdt-row emdt-alert">
	<div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("Forms allow a user to enter data directly to your entities, taxonomies, and/or relationships. Forms are the main data entry interface for your apps.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Forms Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/forms/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="form-name" id="form-name" type="text" placeholder="<?php esc_html_e("e.g. customer_survey","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Unique identifier for the form. Can not contain capital letters, dashes or spaces. Between 3 and 30 characters.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-form_type" id="form-form_type" class="input-xlarge">
	<option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio");?></option>
	<option value="submit"><?php esc_html_e("Submit","wp-app-studio");?></option>
        <option value="search"><?php esc_html_e("Search","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the type of form to be created. Submit forms are for sending and saving data. Search forms are for searching content and displaying results on a page.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-form-attached_entity_div"> 
	<label class="control-label req"><?php esc_html_e("Attached to Entity","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-attached_entity" id="form-attached_entity" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the primary entity for your form. The selected entity will be main entry point and will be used for the dependent selection.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-dependents_div"> 
	<label class="control-label"><?php esc_html_e("Dependents","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-dependents[]" id="form-dependents" multiple="multiple" size=5 class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the dependents of the primary entity for your form. The attributes of the dependents will be included in the form layout.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="form-form_title" id="form-form_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Optional. Sets the first piece of text displayed to users when they see your form. Optional. Max:40 char. Use it to standardize the form's title.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>	
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Description","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="form-form_desc" name="form-form_desc"></textarea>
	<a href="#" title="<?php esc_html_e("Optional. Set a short description or instructions, notes, or guidelines that users should read when filling out the form. This will appear directly below the form title and above the fields.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Show Advanced Options","wp-app-studio");?>
	<input name="form-advanced-option" id="form-advanced-option" type="checkbox" value="1"/>
	</label>
	</div>
	</div>
	</div><!--well-->
	<div id="form-tabs" style="display:none;">
	<ul id="formTab" class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#formtabs-1"><?php esc_html_e("Display Options","wp-app-studio");?></a></li>
	<li><a data-toggle="tab" href="#formtabs-2"><?php esc_html_e("Submissions","wp-app-studio");?></a></li>
	<li id="formtabs-3-li"><a data-toggle="tab" href="#formtabs-3"><?php esc_html_e("Confirmations","wp-app-studio");?></a></li>
	<li><a data-toggle="tab" href="#formtabs-4"><?php esc_html_e("Scheduling","wp-app-studio");?></a></li>
	</ul>
	<div id="FormTabContent" class="tab-content">
	<div class="row-fluid">
	<div class="btn emdt-row emdt-alert"><a data-placement="bottom" href="#" title="<?php esc_html_e("Display Options tab configures how the form will be displayed on the frontend. Confirmations tab defines the notifications after data entry occured. Submissions tab sets the options for the submit button, spam protection, and how the data entry will be saved. Use scheduling tab to create a form submission schedule.","wp-app-studio");?>"><i class="icon-info-sign"></i></a></div>
	</div>
	<div id="formtabs-1" class="tab-pane fade in active">
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Create Setup Page","wp-app-studio");?>
	<input name="form-setup_page" id="form-setup_page" type="checkbox" value="1">
	<a href="#" title="<?php esc_html_e("When enabled, creates a setup page for your submit form upon plugin activation.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-setup_page_title_div" style="display:none;">
	<label class="control-label req"><?php esc_html_e("Page Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="form-setup_page_title" id="form-setup_page_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the title of the setup page for your submit form.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>	
	<div class="control-group row-fluid" id="form-temp_type_div"> 
	<label class="control-label"><?php esc_html_e("Template","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-temp_type" id="form-temp_type" class="input-xlarge">
	<option value="Bootstrap" selected="selected">WPAS</option>
	<option value="Na">None</option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the frontend framework which will be used to configure the overall look and feel of the form. If you pick JQuery UI, you can choose your theme from App's Settings under the theme tab. Default is Twitter Bootstrap.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>				
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Enable Font Awesome","wp-app-studio");?>
	<input name="form-font_awesome" id="form-font_awesome" type="checkbox" value="1" checked/>
	<a href="#" title="<?php esc_html_e("Enables Font Awesome webfont for radios, checkboxes and other icons. Can not be disabled for the Bootstrap framework.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Targeted Device","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-targeted_device" id="form-targeted_device" class="input-xlarge">
	<option value="desktops" selected="selected"><?php esc_html_e("Desktops","wp-app-studio");?></option>
	<option value="phones"><?php esc_html_e("Phones","wp-app-studio");?></option>
	<option value="tablets"><?php esc_html_e("Tablets","wp-app-studio");?></option>
	<option value="large_desktops"><?php esc_html_e("Large Desktops","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the targeted device that your form will primarily be displayed on.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>		
	<div class="control-group row-fluid" id="form-label_position_div"> 
	<label class="control-label"><?php esc_html_e("Label Placement","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-label_position" id="form-label_position" class="input-xlarge">
	<option value="top" selected="selected"><?php esc_html_e("Top","wp-app-studio");?></option>
	<option value="left"><?php esc_html_e("Left","wp-app-studio");?></option>
	<option value="inside"><?php esc_html_e("Inside","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the field label position relative to the field input location. Options are Top,Left or Inside. Pick your label placement based on the space you have available for the form. Min 680px required for inside/top label placement with 3 column layout. If you enabled operators in your search form, you will need more space for multi-layout designs. You can always adjust the width css element of your form container when needed. Enabling operators will give access to all of your data so limiting access by role may always be a good idea.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
        <div class="control-group row-fluid" id="form-element-size_div">
        <label class="control-label"><?php esc_html_e("Element Size","wp-app-studio");?></label>
        <div class="controls">
        <select name="form-element_size" id="form-element_size" class="input-xlarge">
        <option value="medium" selected="selected"><?php esc_html_e("Medium","wp-app-studio");?></option>
        <option value="small"><?php esc_html_e("Small","wp-app-studio");?></option>
        <option value="large"><?php esc_html_e("Large","wp-app-studio");?></option>
        </select>
        <a href="#" title="<?php esc_html_e("Sets the field height to create larger or smaller form controls that match button sizes.","wp-app-studio");?>">
         <i class="icon-info-sign"></i></a>
        </div>
        </div>	
        <div class="control-group row-fluid" id="form-dropdown_color_div">
        <label class="control-label"><?php esc_html_e("Dropdown Color","wp-app-studio");?></label>
        <div class="controls">
        <select name="form-dropdown_color" id="form-dropdown_color" class="input-xlarge">
        <option value="default" selected="selected"><?php esc_html_e("Default","wp-app-studio");?></option>
        <option value="primary"><?php esc_html_e("Primary","wp-app-studio");?></option>
        <option value="info"><?php esc_html_e("Info","wp-app-studio");?></option>
        <option value="success"><?php esc_html_e("Success","wp-app-studio");?></option>
        <option value="warning"><?php esc_html_e("Warning","wp-app-studio");?></option>
        <option value="danger"><?php esc_html_e("Danger","wp-app-studio");?></option>
        <option value="inverse"><?php esc_html_e("Inverse","wp-app-studio");?></option>
        </select>
        <a href="#" title="<?php esc_html_e("Changes the background color of dropdowns.","wp-app-studio");?>">
         <i class="icon-info-sign"></i></a>
        </div>
        </div>	
        <div class="control-group row-fluid" id="form-result_templ_div" style="display:none;">
        <label class="control-label"><?php esc_html_e("Result Template","wp-app-studio");?></label>
        <div class="controls">
        <select name="form-result_templ" id="form-result_templ" class="input-xlarge">
        <option value="simple_table"><?php esc_html_e("Basic Html Table","wp-app-studio");?></option>
        <option value="adv_table"><?php esc_html_e("Advanced Datagrid Table","wp-app-studio");?></option>
        <option value="cust_table"><?php esc_html_e("Custom","wp-app-studio");?></option>
        </select>
        <a href="#" title="<?php esc_html_e("For Basic Html and Advanced Datagrid Tables select the result fields below. For the Custom option, create a search view.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
        </div>	
        <div class="control-group row-fluid" id="form-result_fields_div" style="display:none;">
        <label class="control-label req"><?php esc_html_e("Result Fields","wp-app-studio");?></label>
        <div class="controls">
        <select name="form-result_fields[]" id="form-result_fields" multiple="multiple" class="input-xlarge">
        </select>
        <a href="#" title="<?php esc_html_e("Select the fields for your search results.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
        </div>	
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Display Radios and Checkboxes Inline","wp-app-studio");?>
	<input name="form-display_inline" id="form-display_inline" type="checkbox" value="1" checked/>
	<a href="#" title="<?php esc_html_e("Sets a series of checkboxes or radios appear on the same line.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-ajax_search_div" style="display:none;">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Enable Ajax","wp-app-studio");?>
	<input name="form-ajax_search" id="form-ajax_search" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Enables ajax when displaying search results without reloading the page.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-enable_operators_div" style="display:none;">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Enable Search Operators","wp-app-studio");?>
	<input name="form-enable_operators" id="form-enable_operators" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Enables operators in search forms such as '<, >, Is, Search' etc.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("No Access Message","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="form-not_loggedin_msg" name="form-not_loggedin_msg" class="wpas-std-textarea"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the text which will be displayed to users that do not have access to this form.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-noresult_msg_div" style="display:none;">
	<label class="control-label"><?php esc_html_e("No Results Message","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="form-noresult_msg" name="form-noresult_msg" class="wpas-std-textarea"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the text which will be displayed when there are no results to show.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>	<!--formtabs-1-->			
	<div id="formtabs-2" class="tab-pane fade in">
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Disable Submit Action","wp-app-studio");?>
	<input name="form-disable_submit" id="form-disable_submit" type="checkbox" value="1">
	<a href="#" title="<?php esc_html_e("Disables submit action when checked. For example, you can disable submit action when you do not want store form results such as calculations.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-submit_status_div"> 
	<label class="control-label"><?php esc_html_e("Submit Status","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-submit_status" id="form-submit_status" class="input-xlarge">
	<option value="publish"><?php esc_html_e("Publish","wp-app-studio");?></option>
	<option value="draft"><?php esc_html_e("Draft","wp-app-studio");?></option>
	<option value="future"><?php esc_html_e("Future","wp-app-studio");?></option>
	<option value="private"><?php esc_html_e("Private","wp-app-studio");?></option>
	<option value="trash"><?php esc_html_e("Trash","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the status of all form entries for the users who have -edit_published- capability for this entity. Publish - Entry is available immediately. Draft - Entry is in draft status. Future - Entry is will be published in the future. Private - Entry is not visible to users who are not logged in. Trash - Entry is in trashbin. Default is publish.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-visitor_submit_status_div"> 
	<label class="control-label"><?php esc_html_e("Visitor Submit Status","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-visitor_submit_status" id="form-visitor_submit_status" class="input-xlarge">
	<option value="publish"><?php esc_html_e("Publish","wp-app-studio");?></option>
	<option value="draft"><?php esc_html_e("Draft","wp-app-studio");?></option>
	<option value="future"><?php esc_html_e("Future","wp-app-studio");?></option>
	<option value="private"><?php esc_html_e("Private","wp-app-studio");?></option>
	<option value="trash"><?php esc_html_e("Trash","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the status of all form entries for the users who have NOT -edit_published- capability for this entity. Publish - Entry is available immediately. Draft - Entry is in draft status. Future - Entry is will be published in the future. Private - Entry is not visible to users who are not logged in. Trash - Entry is in trashbin. Default is publish.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-submit_button_type_div"> 
	<label class="control-label"><?php esc_html_e("Submit Button Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-submit_button_type" id="form-submit_button_type" class="input-xlarge">
	<option value="btn-standard" selected="selected"><?php esc_html_e("Standard (White - #FFFFF)","wp-app-studio");?></option>
	<option value="btn-primary"><?php esc_html_e("Primary (Blue - #006DCC)","wp-app-studio");?></option>
	<option value="btn-info"><?php esc_html_e("Info (Light Blue - #49AFCD)","wp-app-studio");?></option>
	<option value="btn-success"><?php esc_html_e("Success (Green - #5BB75B)","wp-app-studio");?></option>
	<option value="btn-warning"><?php esc_html_e("Warning (Orange - #FAA732)","wp-app-studio");?></option>
	<option value="btn-danger"><?php esc_html_e("Danger (Red - #DA4F49)","wp-app-studio");?></option>
	<option value="btn-inverse"><?php esc_html_e("Inverse (Black - #363636)","wp-app-studio");?></option>
	<option value="btn-link"><?php esc_html_e("Link (Blue -  #0088CC)","wp-app-studio");?></option>
	<option value="btn-jui"><?php esc_html_e("jQuery UI (Themeable)","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Standard button is a white background button with a darkgray border. Primary button provides extra visual weight and identifies the primary action in a set of buttons. Info button is used as an alternative to the standard style. Success button indicates a successful or positive action. Warning button indicates caution should be taken with this action. Danger button indicates a dangerous or potentially negative action. Inverse button is alternate dark gray button, not tied to a semantic action or use. Link button deemphasizes a button by making it look like a link while maintaining button behavior.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Submit Button Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="form-submit_button_label" id="form-submit_button_label" type="text" placeholder="<?php esc_html_e("e.g. Submit","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the submit button label of your form. Max:30 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a> (<?php esc_html_e("Default: Submit","wp-app-studio");?>)
	</div>
	</div>	
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Create Block Level Button","wp-app-studio");?>
	<input name="form-submit_button_block" id="form-submit_button_block" type="checkbox" value="1">
	<a href="#" title="<?php esc_html_e("Makes the button span the full width of its grid size.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-submit_button_size_div"> 
	<label class="control-label"><?php esc_html_e("Submit Button Size","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-submit_button_size" id="form-submit_button_size" class="input-xlarge">
	<option value="btn-std" selected="selected"><?php esc_html_e("Standard","wp-app-studio");?></option>
	<option value="btn-xlarge"><?php esc_html_e("XLarge","wp-app-studio");?></option>
	<option value="btn-large"><?php esc_html_e("Large","wp-app-studio");?></option>
	<option value="btn-small"><?php esc_html_e("Small","wp-app-studio");?></option>
	<option value="btn-mini"><?php esc_html_e("Mini","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the submit button size of your form.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div id="form-submit_button_fa_div" name="form-submit_button_fa_div">
	<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Submit Button Icon Class","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="form-submit_button_fa" id="form-submit_button_fa" type="text" placeholder="" value="" >
		<a href="#" title="<?php esc_html_e("Sets the font awesome icon which will be displayed next to the button text.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a><a href="<?php echo WPAS_URL . '/articles/supported-icons/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=cheatsheet';?>" target="_blank"><?php esc_html_e("Cheatsheet","wp-app-studio");?></a>
		</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Submit Button Icon Size","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-submit_button_fa_size" id="form-submit_button_fa_size" class="input-xlarge">
	<option value="" selected="selected"><?php esc_html_e("Standard","wp-app-studio");?></option>
	<option value="fa-lg"><?php esc_html_e("Large","wp-app-studio");?></option>
	<option value="fa-2x"><?php esc_html_e("2x","wp-app-studio");?></option>
	<option value="fa-3x"><?php esc_html_e("3x","wp-app-studio");?></option>
	<option value="fa-4x"><?php esc_html_e("4x","wp-app-studio");?></option>
	<option value="fa-5x"><?php esc_html_e("5x","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the size of font awesome icon which will be displayed next to the button text.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-submit_button_position_div"> 
	<label class="control-label"><?php esc_html_e("Submit Button Icon Position","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-submit_button_fa_pos" id="form-submit_button_fa_pos" class="input-xlarge">
	<option value="left" selected="selected"><?php esc_html_e("Left","wp-app-studio");?></option>
	<option value="right"><?php esc_html_e("Right","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the position of icon within the submit button.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div> <!-- form-submit_button_fa_div -->
	<div class="control-group row-fluid" id="form-show_captcha_div"> 
	<label class="control-label"><?php esc_html_e("Show Captcha","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-show_captcha" id="form-show_captcha" class="input-xlarge">
	<option value="never-show"><?php esc_html_e("Never Show","wp-app-studio");?></option>
	<option value="show-always"><?php esc_html_e("Always Show","wp-app-studio");?></option>
	<option value="show-to-visitors"><?php esc_html_e("Visitors Only","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets Captcha display option. WPAS forms use the - honeypot - technique by default however CAPTCHAs can also be used for even stronger protection. Always Show displays captcha for everybody. Visitors Only option shows it for only visitors. Never Show option disables it.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>		
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Disable After","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-mini" name="form-disable_after" id="form-disable_after" type="text" placeholder="<?php esc_html_e("e.g. 5","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Disables form submissions after the set number reached. Leave blank for no limit.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>	<!--formtabs-2-->
	<div id="formtabs-3" class="tab-pane fade in">
	<div class="control-group row-fluid" id="form-confirm_method_div"> 
	<label class="control-label"><?php esc_html_e("Confirmation Method","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-confirm_method" id="form-confirm_method" class="input-xlarge">
	<option value="text" selected><?php esc_html_e("Show text","wp-app-studio");?></option>
	<option value="redirect"><?php esc_html_e("Redirect","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the event that will occur after a successful entry. Show text option display a text message. Redirect option redirects users toanother URL.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-confirm_txt_div">
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Enable Ajax","wp-app-studio");?>
	<input name="form-ajax" id="form-ajax" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("When set ajax form submissions are enabled.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="form-show_after_submit_div"> 
	<label class="control-label"><?php esc_html_e("After Submit","wp-app-studio");?></label>
	<div class="controls">
	<select name="form-show_after_submit" id="form-show_after_submit" class="input-xlarge">
	<option value="show" selected><?php esc_html_e("Show Form","wp-app-studio");?></option>
	<option value="clear"><?php esc_html_e("Clear Form","wp-app-studio");?></option>
	<option value="hide"><?php esc_html_e("Hide Form","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets what users see after a successful submission. Show Form option shows the completed form. Clear Form option resets all fields to their defaults. Hide Form option hides the form from the user who completed the entry.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Success Text","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="form-confirm_success_txt" name="form-confirm_success_txt" class="wpas-std-textarea">
	<?php esc_html_e("Thanks for your submission.","wp-app-studio");?>
	</textarea>
	<a href="#" title="<?php esc_html_e("Sets the text which will be displayed to users after a successful entry.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>		
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Error Text","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="form-confirm_error_txt" name="form-confirm_error_txt" class="wpas-std-textarea">
	<?php esc_html_e("There has been an error when submitting your entry. Please contact the site administrator.","wp-app-studio");?>
	</textarea>
	<a href="#" title="<?php esc_html_e("Sets the text which will be displayed to users after an unsuccessful entry.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>		
	</div>
	<div class="control-group row-fluid" id="form-confirm_url_div" style="display:none;">
	<label class="control-label"><?php esc_html_e("Confirmation URL","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="form-confirm_url" id="form-confirm_url" type="text" placeholder="<?php esc_html_e("e.g. http://example.com/myform-confirm.php","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("When set, after a successful entry, users get redirected to another url. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>	<!--formtabs-3-->
	<div id="formtabs-4" class="tab-pane fade in">
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Enable Form Scheduling","wp-app-studio");?>
	<input name="form-enable_form_schedule" id="form-enable_form_schedule" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Set to make the form automatically become active or inactive at a certain date.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div id="form-schedule_div" style="display:none;"> 
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Start Datetime","wp-app-studio");?></label>
	<div id="form-datetime_start" class="controls">
	<input class="input-xlarge" name="form-schedule_start" id="form-schedule_start" type="text">
	<a href="#" title="<?php esc_html_e("The start datetime after which form will be active.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>	
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("End Datetime","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="form-schedule_end" id="form-schedule_end" type="text">
	<a href="#" title="<?php esc_html_e("The last form submission datetime after which form will be inactive.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>	
	</div>
	</div>	<!--formtabs-4-->	
	</div>	<!--tab-contform-->	
	</div><!--field-container-->
	<div class="control-group">
	<button class="btn  btn-danger layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
	<button class="btn btn-primary pull-right layout-buttons" id="save-form" type="submit" value="Save"><i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio");?></button>
	</div>
</fieldset>
</form>
<?php
}
?>
