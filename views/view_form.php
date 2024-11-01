<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_shortcode_form($app_id)
{
	?>
<script type="text/JavaScript">
jQuery(document).ready(function($) {
	$(document).on('change','#shc-view_type',function(){
		app_id = jQuery('input#app').val();
		var selected_type = $(this).find('option:selected').val();
		$(this).showShcTabs(selected_type,app_id,1);
		$('#show-tags-div .tags-collapse').hide();
		if(selected_type == 'single'){
			$('#show-js-tags-div .tags-collapse').hide();
		}
		else {
			$('#show-js-tags-div').hide();
		}
	});
	$(document).on('change','#shc-theme_type',function(){
		$(this).showJquery($(this).val());
	});
	$(document).on('click','#show-js-tags-div .btn',function(){
		if($('#shc-js-tags').is(":visible")){
			$('#show-js-tags-div .tags-collapse').hide();
		}
		else {
			app_id = $('input#app').val();
			ent_id = $('#shc-attach').find('option:selected').val();
			if(ent_id) {
				$(this).showJsTags(app_id,ent_id,'js','');
			}
			else {
				$('#shc-js-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
				$('#shc-js-tags').show();
			}
		}
	});
	$(document).on('click','#show-tags-div .btn',function(){
		if($('#shc-layout-tags').is(":visible")){
			$('#show-tags-div .tags-collapse').hide();
		}
		else {
			var shc_type = $('#shc-view_type').find('option:selected').val();
			app_id = $('input#app').val();
			if(shc_type == 'integration'){
				$(this).showShcTags(app_id,0,'integration','');
			}
			else if(shc_type == 'search'){
				comp_id = $('#shc-attach_form').find('option:selected').val();
				if(comp_id){
					$(this).showShcTags(app_id,comp_id,'tag-form','');
				}
			}
			else if(shc_type == 'autocomplete'){
				var ent_id = [];
				$.each($('#shc-attach').find('option:selected'), function(){            
					ent_id.push($(this).val());
				});
				if(ent_id.length > 1){	
					$(this).showShcTags(app_id,'','tag-rel','');
				}
				else if(ent_id.length == 1) {
					$(this).showShcTags(app_id,$('#shc-attach').find('option:selected').val(),'tag-rel','');
				}
			}
			else {
				ent_id = $('#shc-attach').find('option:selected').val();
				if(ent_id) {
					if($.inArray(shc_type,['single','archive','tax']) != -1 ){ 
						$(this).showShcTags(app_id,ent_id,'tag-nocount','');
					}
					else if(shc_type == 'chart' && $('#shc-chart_type').find('option:selected').val() == 'org'){
						$(this).showShcTags(app_id,ent_id,'tag-nocount','org');
					}
					else if(shc_type == 'emd_chart'){
						$(this).showShcTags(app_id,ent_id,'tag-nocount','jorg');
					}
					else if(shc_type != 'chart'){
						$(this).showShcTags(app_id,ent_id,'tag-rel','');
					}
				}
				else{
					$('#shc-layout-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
					$('#shc-layout-tags').show();
				}
			}
		}
	});
	$.fn.showJquery = function(theme){
		if(theme == 'Na'){
			$('#shc-jquery_div').show();
		}
		else {		
			$('#shc-jquery_div').hide();
		}
	}
	$(document).on('click','#shc-return_ids',function(){
                if($(this).prop('checked')){
			$(this).showLayoutDivs('hide');
		}
		else {
			$(this).showLayoutDivs('show');
		}
	});
	$.fn.showLayoutDivs = function (type,pagenav){
		if(typeof pagenav === 'undefined'){
                        pagenav  = 0;
                }
                if(type == 'hide'){
			$('#shc-theme_type_div').hide();	
			$('#shc-hier_div').hide();
			$('#shc-hier_vals_div').hide();
			$('#shc-sc_pagenav_div').hide();
			$('#shc-nav_ajax_div').hide();
			$('#shc-pgn_class_div').hide();
			$('#shc-layout_header_div').hide();
			$('#shc-layout_div').hide();
			$('#shc-layout_footer_div').hide();
			$('#shc-sc_css_div').hide();
			$('#shc-sc_js_div').hide();
			$('#shc-sc_cdncss_div').hide();
			$('#shc-sc_cdnjs_div').hide();
		}
		else {
			$('#shc-theme_type_div').show();	
			$('#shc-hier_div').show();
			$('#shc-hier_vals_div').hide();
			$('#shc-sc_pagenav_div').show();
			if(pagenav == 1){
				$('#shc-nav_ajax_div').show();
			}
			else {
				$('#shc-nav_ajax_div').hide();
			}
			$('#shc-pgn_class_div').hide();
			$('#shc-layout_header_div').show();
			$('#shc-layout_div').show();
			$('#shc-layout_footer_div').show();
			$('#shc-sc_css_div').show();
			$('#shc-sc_js_div').show();
			$('#shc-sc_cdncss_div').show();
			$('#shc-sc_cdnjs_div').show();
		}
	}
	$(document).on('change','#shc-attach',function(){
		shc_type = $('#shc-view_type').find('option:selected').val();
		app_id = $('input#app').val();
		var ent_id = [];
		$.each($(this).find('option:selected'), function(){            
			ent_id.push($(this).val());
		});	
		//ent_id = $(this).find('option:selected').val();
		chart_type = $('#shc-chart_type').find('option:selected').val();
		$('#show-tags-div .tags-collapse').hide();
		$('#show-js-tags-div .tags-collapse').hide();
		if(shc_type == 'std' && $(this).find('option:selected').attr('hier') == 1){
			$('#shc-hier_div').show();
		}
		if(shc_type == 'datagrid')
		{
			$.get(ajaxurl,{action:'wpas_get_table_cols',app_id:app_id,chart_ent:ent_id}, function(response){
				$('#shc-table_ids').html(response[0]);
			},'json');
			$('#shc-table_div').show();
		}
		if($.inArray(shc_type,['datagrid','std','autocomplete']) != -1 && ent_id != ''){
			$.get(ajaxurl,{action:'wpas_get_orderby_fields',app_id:app_id,ent_id:ent_id}, function(response)
			{
				$('#shc-sc_orderby').html(response);
			});
			if(shc_type == 'autocomplete'){
				$.get(ajaxurl,{action:'wpas_get_entities',type:'auto_tax',app_id:app_id,chart_ent:ent_id}, function(response)
				{
					$('#add-shortcode-div #shc-autocomplete_tax').html(response);
					$('#shc-autocomplete_tax').show();
				});
			}
		}
	});
	$(document).on('click','#shc-hier',function(){
		if($(this).prop('checked'))
		{
			$('#shc-sc_pagenav_div').hide();
			$('#shc-nav_ajax_div').hide();
			$('#shc-hier_vals_div').show();
		}
		else {
			$('#shc-sc_pagenav_div').show();
			$('#shc-nav_ajax_div').hide();
			$('#shc-hier_vals_div').hide();
		}
	});	
	$(document).on('click','#shc-sc_pagenav',function(){
		if($(this).prop('checked'))
		{
			$('#shc-pgn_class_div').show();
			$('#shc-nav_ajax_div').show();
		}
		else {
			$('#shc-pgn_class_div').hide();
			$('#shc-nav_ajax_div').hide();
		}
	});
	$(document).on('change','#shc-attach_form',function(){
		app_id = $('input#app').val();
		comp_id = $(this).find('option:selected').val();
		$.get(ajaxurl,{action:'wpas_get_orderby_fields',app_id:app_id,form_id:comp_id}, function(response)
		{
			$('#shc-sc_orderby').html(response);
		});
	});
	$.fn.showShcTags = function (app_id,comp_id,type,shc){
		shc_id = $('input#shc').val();
		new_shc = shc;
		if(shc == 'jorg'){
			new_shc = 'org';
		}
		$.get(ajaxurl,{action:'wpas_get_layout_tags',type:type,app_id:app_id,comp_id:comp_id,shc:new_shc,shc_id:shc_id}, function(response){
			if(shc == 'org'){
				$('#shc-org-layout-tags').html(response);
				$('#shc-org-layout-tags').show();
				$('#shc-org-tooltip-layout-tags').html(response);
				$('#shc-org-tooltip-layout-tags').show();
			}
			else if(shc == 'jorg'){
				$('#shc-emd-org-layout-tags').html(response);
				$('#shc-emd-org-layout-tags').show();
				$('#shc-emd-org-tooltip-layout-tags').html(response);
				$('#shc-emd-org-tooltip-layout-tags').show();
			}
			else {	
				$('#shc-layout-tags').html(response);
				$('#shc-layout-tags').show();
			}
		});
	}
	$.fn.showJsTags = function (app_id,comp_id,type,shc){
		$.get(ajaxurl,{action:'wpas_get_layout_tags',type:type,app_id:app_id,comp_id:comp_id,shc:shc}, function(response){
			$('#shc-js-tags').html(response);
			$('#shc-js-tags').show();
			$('#show-js-tags-div').show();
		});
	}
	$.fn.showShcTabs = function(selected_type,app_id,get_vals){
		$('#shcTab').show();
		$('#ShcTabContent').show();
		$('#shc-pgn_class_div').hide();
		switch (selected_type) {
			case 'std':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').show();
				$('#shc-nav_ajax_div').hide();
				$('#shc-hier_div').show();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').show();
				$('#shc-filter-div').show();
				$('#add-shortcode-div #shc-attach').removeAttr('multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
				$('#shc-return_ids_div').show();
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-setup_page_div').show();
				$('#shc-rmv_wpasbtn_div').show();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').show();
                        	$('#shc-layout_footer_div').show();
                        	$('#shc-layout_div').show();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
			case 'autocomplete':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').show();
				$('#shc-filter-div').show();
				$('#shc-return_ids_div').hide();
				$('#add-shortcode-div #shc-attach').attr('multiple','multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach[]');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'autocomplete',app_id:app_id}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-setup_page_div').show();
				$('#shc-rmv_wpasbtn_div').show();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').show();
                        	$('#shc-layout_footer_div').show();
                        	$('#shc-layout_div').show();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-autocomplete-div').show();
				$('#shc-table_div').hide();
				break;
			case 'search':
				$('#shc-theme_type_div').hide();
				$('#shc-sc_pagenav_div').show();
				$('#shc-nav_ajax_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').show();
				$('#shc-filter-div').hide();
				$('#shc-return_ids_div').hide();
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_search_forms',app_id:app_id}, function(response)
					{
						$('#shc-attach_form').html(response);
						$('#shc-attach_form_div').show();
					});
				}
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_div').hide();
                        	$('#shc-setup_page_div').hide();
                                $('#shc-setup_page_title_div').hide();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').show();
                        	$('#shc-layout_footer_div').show();
                        	$('#shc-layout_div').show();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
			case 'single':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-return_ids_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#add-shortcode-div #shc-attach').removeAttr('multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id,subtype:selected_type}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
				$('#shctabs-2-li').hide();
				$('#shcTab a:first').tab('show');
				$('#shc-filter-div').hide();
                        	$('#shc-setup_page_div').hide();
                                $('#shc-setup_page_title_div').hide();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').show();
				$('#show-tags-div').show();
				$('#show-js-tags-div').show();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;	
			case 'archive':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-return_ids_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').hide();
				$('#shcTab a:first').tab('show');
				$('#shc-filter-div').hide();
				$('#add-shortcode-div #shc-attach').removeAttr('multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id,subtype:selected_type}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-setup_page_div').hide();
                                $('#shc-setup_page_title_div').hide();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').show();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
			case 'tax':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-return_ids_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').hide();
				$('#shcTab a:first').tab('show');
				$('#shc-filter-div').hide();
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'tax',app_id:app_id,subtype:selected_type}, function(response)
					{
						$('#add-shortcode-div #shc-attach_tax').html(response);
						$('#shc-attach_tax_div').show();
					});
				}
				$('#shc-attach_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-setup_page_div').hide();
                                $('#shc-setup_page_title_div').hide();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').show();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
			case 'chart':
				$('#shctabs-2-li').hide();
				$('#shcTab a:first').tab('show');
				$('#shc-return_ids_div').hide();
				$('#shc-filter-div').hide();
				$('#add-shortcode-div #shc-attach').removeAttr('multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
                        	$('#shc-setup_page_div').show();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').show();
				$('#shc-theme_type_div').hide();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').hide();
				$('#shc-chart_div').show();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				$(this).chartType('');
				break;
			case 'emd_chart':
				$('#shctabs-2-li').hide();
				$('#shcTab a:first').tab('show');
				$('#shc-return_ids_div').hide();
				$('#shc-filter-div').hide();
				$('#add-shortcode-div #shc-attach').removeAttr('multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
                        	$('#shc-setup_page_div').show();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').show();
				$('#shc-theme_type_div').hide();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').show();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
			case 'datagrid':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').show();
				$('#shc-nav_ajax_div').hide();
				$('#shc-return_ids_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').show();
				$('#shc-filter-div').hide();
				$('#add-shortcode-div #shc-attach').removeAttr('multiple');
				$('#add-shortcode-div #shc-attach').attr('name','shc-attach');
				if(get_vals == 1)
				{
					$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id}, function(response)
					{
						$('#add-shortcode-div #shc-attach').html(response);
						$('#shc-attach_div').show();
					});
				}
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-setup_page_div').show();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').show();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-font_awesome_div').hide();
				$('#shc-dashicon_div').hide();
				$('#shc-jquery_div').hide();
				$('#shc-table_div').show();
				$('#shc-autocomplete-div').hide();
				break;
			case 'integration':
				$('#shc-theme_type_div').show();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-return_ids_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shctabs-2-li').hide();
				$('#shcTab a:first').tab('show');
				$('#shc-filter-div').hide();
				$('#shc-attach_div').hide();
				$('#shc-attach').val('');
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_form_div').hide();
                        	$('#shc-setup_page_div').show();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').show();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
                        	$('#shc-layout_div').show();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
			default:
				$('#shcTab').hide();
                                $('#ShcTabContent').hide();
                                $('#shc-view_type').val('');
                                $('#add-shortcode-div input#app').val(app_id);
				$('#shc-return_ids_div').hide();
                                $('#shc-setup_page_title_div').hide();
                                $('#shc-app_dash_title_div').hide();
                                $('#shc-app_dash_loc_div').hide();
                                $('#shc-table_col').html(''); 
				$('#shc-theme_type_div').hide();
				$('#shc-sc_pagenav_div').hide();
				$('#shc-nav_ajax_div').hide();
				$('#shc-hier_div').hide();
				$('#shc-hier_vals_div').hide();
				$('#shc-attach_form_div').hide();
				$('#shc-attach_tax_div').hide();
				$('#shc-attach_div').hide();
				$('#shctabs-2-li').show();
				$('#shc-filter-div').hide();
                        	$('#shc-setup_page_div').hide();
				$('#shc-rmv_wpasbtn_div').hide();
                        	$('#shc-app_dash_div').hide();
                        	$('#shc-layout_header_div').hide();
                        	$('#shc-layout_footer_div').hide();
                        	$('#shc-layout_div').hide();
				$('#show-tags-div').show();
				$('#show-js-tags-div').hide();
				$('#shc-chart_div').hide();
				$('#shc-emd-chart_div').hide();
				$('#shc-table_div').hide();
				$('#shc-autocomplete-div').hide();
				break;
		}
	}
	$.fn.vhAxis = function(sel,app_id,chart_ent,chart_type,func,selected,fid){
		var type = sel;
		var show_id = '';
		if(fid == 'haxis')
		{
			show_id = '#shc-haxis';
		}
		else if(fid == 'vaxis')
		{
			show_id = '#shc-vaxis';
			if(sel == 'attribute' && func == 'count')
			{
				type = 'attribute';
			}
			else if(sel == 'attribute')
			{
				type = 'num_attribute';
			}	
		}
		if(sel == 'taxonomy')
		{
			type  = 'tax';
		}
		else if(sel == 'relationship')
		{
			type  = 'form_dependents';
		}
		switch (sel){
			case 'taxonomy':	
				$.get(ajaxurl,{action:'wpas_get_entities',type:type,app_id:app_id,chart_ent:chart_ent,values:selected}, function(response){
					$(show_id+ '_id').html(response);
				});
				break;
			case 'attribute':
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:type,app_id:app_id,ent_id:chart_ent,value:selected}, function(response){
					$(show_id+ '_id').html(response['pre']+response['list']);
				}, 'json');
				break;
			case 'date':
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:type,app_id:app_id,ent_id:chart_ent,value:selected}, function(response){
					$(show_id+ '_id').html(response['pre']+response['list']);
				}, 'json');
				break;
			case 'relationship':
				$.get(ajaxurl,{action:'wpas_get_entities',type:type,app_id:app_id,primary_entity:chart_ent,add_sel:1,values:selected}, function(response){
					$(show_id+ '_id').html(response);
				});
				break;
			case 'connection':
				$.get(ajaxurl,{action:'wpas_get_connections',type:type,app_id:app_id,ent_id:chart_ent,value:selected}, function(response){
					$(show_id+ '_id').html(response);
				});
				break;
		}
		$(show_id + "_div").show();
		if(chart_type == 'pie')
		{
			$('#shc-vaxis_title_div').hide();
			if(sel == 'unique')
			{
				$('#shc-haxis_div').hide();
			}
			else
			{
				$('#shc-haxis_title_div').hide();
			}
		}
		else
		{
			if(sel == 'unique')
			{
				$('#shc-haxis_div').hide();
			}
			else if(sel == 'entity')
			{
				$('#shc-vaxis_div').hide();
			}
			else
			{
				$('#shc-vaxis_title_div').show();
				$('#shc-haxis_title_div').show();
			}
		}
		if(sel == 'date' && chart_type != 'table')
		{
			$(show_id +'_date_type_div').show();
		}
		else
		{
			$(show_id +'_date_type_div').hide();
			$(show_id +'_date_range_div').hide();
		}
	};
	$.fn.vhAxisType = function(chart,func,id,value){
		if(id=='#shc-haxis_type')
		{
			if(func == 'none')
			{
				func = 'uniq';
			}
			else
			{
				func = 'count';
			}
		}
		app_id = $('input#app').val();
		ent_id = $('#shc-attach').find('option:selected').val();
		$.get(ajaxurl,{action:'wpas_get_chart_conn',app_id:app_id,ent_id:ent_id,func:func,value:value}, function(response){
			if(id=='#shc-vaxis_type' && chart == 'pie' && func == 'count')
			{
				$('#shc-vaxis_type_div').hide();
				$('#shc-vaxis_div').hide();
			}
			else
			{
				$(id).html(response);
				$(id).show();
			}
		});
	}
	$.fn.chartFunc = function(chart_type){
		switch (chart_type) {
			case 'pie':
				var funcs = '<option value="">Please select</option><option value="none">None</option><option value="sum">Sum</option><option value="count">Count</option>';
				break;
			default:
				var funcs = '<option value="">Please select</option><option value="none">None</option><option value="count">Count</option><option value="sum">Sum</option><option value="avg">Average</option><option value="max">Max</option><option value="min">Min</option>';
				break;
		}
		$('#shc-chart_func').html(funcs);
	}
	$(document).on('change','#shc-chart_func',function(){
		var func = $(this).find('option:selected').val();
		var chart = $('#shc-chart_type').find('option:selected').val();
		$(this).vhAxisType(chart,func,'#shc-vaxis_type','');
		$(this).vhAxisType(chart,func,'#shc-haxis_type','');
	});
	$(document).on('change','#shc-chart_type',function(){
		var chart = $(this).find('option:selected').val();
		$(this).chartType(chart);
		$(this).chartFunc(chart);
	});
	$(document).on('change','#shc-org_type',function(){
		org_type = $(this).find('option:selected').val();
		if(org_type == 'hier'){
			$('#shc-org_val_div').hide();
		}
		else if(org_type == 'rel'){
			$('#shc-org_val_div').show();
		}
		app_id = $('input#app').val();
		ent_id = $('#shc-attach').find('option:selected').val();
		$('#show-tags-div .tags-collapse').hide();
		$('#show-js-tags-div .tags-collapse').hide();
		$.get(ajaxurl,{action:'wpas_get_org_vals',app_id:app_id,ent_id:ent_id}, function(response){
			$('#shc-org_val').html(response);
		});
	});	
	$.fn.chartType = function(chart){
		switch (chart){
			case 'org':
				app_id = $('input#app').val();
				ent_id = $('#shc-attach').find('option:selected').val();
				$.get(ajaxurl,{action:'wpas_get_org_types',app_id:app_id,ent_id:ent_id}, function(response){
					$('#shc-org_type').html(response);
				});
				$('#shc-org_div').show();
				$('#shc-vaxis_type_div').hide();
				$('#shc-haxis_type_div').hide();
				$('#shc-chart_func_div').hide();
				$('#shc-pie_type_div').hide();
				$('#shc-chart_stacked_div').hide();
				$('#shc-legend_pos_div').hide();
				$('#shc-chart_height_div').hide();
				$('#shc-chart_width_div').hide();
				break;
			case 'bar':
				$('#shc-org_div').hide();
				$('#shc-legend_pos_div').show();
				$('#shc-vaxis_type_div').show();
				$('#shc-haxis_type_div').show();
				$('#shc-chart_func_div').show();
				$('#shc-pie_type_div').hide();
				$('#shc-chart_stacked_div').show();
				$('#shc-chart_title_div').show();
				$('#shc-chart_height_div').show();
				$('#shc-chart_width_div').show();
				$('.haxis').each(function() {
					axis_label = $(this).html().replace("(H)","(V)");
					$(this).html(axis_label);
				});
				$('.vaxis').each(function() {
					axis_label = $(this).html().replace("(V)","(H)");
					$(this).html(axis_label);
				});
				break;
			case 'pie':
				$('#shc-org_div').hide();
				$('#shc-legend_pos_div').show();
				$('#shc-vaxis_type_div').show();
				$('#shc-haxis_type_div').show();
				$('#shc-haxis_div').show();
				$('#shc-pie_type_div').show();
				$('#shc-chart_func_div').show();
				$('#shc-chart_stacked_div').hide();
				$('#shc-chart_title_div').show();
				$('#shc-chart_height_div').show();
				$('#shc-chart_width_div').show();
				$('.haxis').each(function() {
					axis_label = $(this).html().replace("(V)","(H)");
					$(this).html(axis_label);
				});
				$('.vaxis').each(function() {
					axis_label = $(this).html().replace("(H)","(V)");
					$(this).html(axis_label);
				});
				break;
			case 'column':
			case 'line':
			case 'area':
				$('#shc-org_div').hide();
				$('#shc-legend_pos_div').show();
				if(chart == 'column')
				{
					$('#shc-chart_stacked_div').show();
				}
				else
				{
					$('#shc-chart_stacked_div').hide();
				}
				$('#shc-vaxis_type_div').show();
				$('#shc-haxis_type_div').show();
				$('#shc-chart_func_div').show();
				$('#shc-pie_type_div').hide();
				$('#shc-chart_title_div').show();
				$('#shc-chart_height_div').show();
				$('#shc-chart_width_div').show();
				$('.haxis').each(function() {
					axis_label = $(this).html().replace("(V)","(H)");
					$(this).html(axis_label);
				});
				$('.vaxis').each(function() {
					axis_label = $(this).html().replace("(H)","(V)");
					$(this).html(axis_label);
				});
				break;
			default:
				$('#shc-org_div').hide();
				$('#shc-legend_pos_div').show();
				$('#shc-vaxis_type_div').hide();
				$('#shc-haxis_type_div').hide();
				$('#shc-haxis_div').hide();
				$('#shc-vaxis_div').hide();
				$('#shc-vaxis_type_div').hide();
				$('#shc-chart_func_div').hide();
				$('#shc-pie_type_div').hide();
				$('#shc-chart_stacked_div').hide();
				$('#shc-table_div').hide();
				$('#shc-chart_title_div').show();
				$('#shc-chart_height_div').hide();
				$('#shc-chart_width_div').hide();
				break;
		}
	}	
	$(document).on('change','#shc-vaxis_type,#shc-haxis_type',function(){
		if($(this).attr('id') == 'shc-vaxis_type')
		{
			fid = 'vaxis';
		}
		else
		{
			fid = 'haxis';
		}
		app_id = $('input#app').val();
		chart_ent = $('#shc-attach').find('option:selected').val();
		chart_type = $('#shc-chart_type').find('option:selected').val();
		func = $('#shc-chart_func').find('option:selected').val();
		var sel = $(this).find('option:selected').val();
		$(this).vhAxis(sel,app_id,chart_ent,chart_type,func,'',fid);
	});
	$(document).on('change','#shc-emd-chart_type',function(){
		var chart = $(this).find('option:selected').val();
		app_id = $('input#app').val();
		ent_id = $('#shc-attach').find('option:selected').val();
		$.get(ajaxurl,{action:'wpas_get_org_types',app_id:app_id,ent_id:ent_id}, function(response){
			$('#shc-emd-org_type').html(response);
			$('#shc-emd-org_type_div').show();
		});
	});
	$(document).on('change','#shc-emd-org_type',function(){
		org_type = $(this).find('option:selected').val();
		if(org_type == 'hier'){
			$('#shc-emd-org_val_div').hide();
		}
		else if(org_type == 'rel'){
			$('#shc-emd-org_val_div').show();
		}
		app_id = $('input#app').val();
		ent_id = $('#shc-attach').find('option:selected').val();
		$('#show-tags-div .tags-collapse').hide();
		$('#show-js-tags-div .tags-collapse').hide();
		$.get(ajaxurl,{action:'wpas_get_org_vals',app_id:app_id,ent_id:ent_id}, function(response){
			$('#shc-emd-org_val').html(response);
		});
	});	
	$(document).on('change','#shc-table_ids',function(){
		$('#shc-table_col').append($("<option></option>").attr("value",$("option:selected",this).val()).text($("option:selected",this).html()));
		$("option:selected",this).prop('disabled','disabled');
		$("option:selected",this).removeAttr('selected');	
			//var newval = '';
			/*if($('#shc-table_col').val() != '')
			{
				newval = $('#shc-table_col').val()+';'+$("option:selected",this).attr('col');
			}
			else
			{
				newval = $("option:selected",this).attr('col');
			}
			$("option:selected",this).attr('disabled','disabled');
			$("option:selected",this).removeAttr('selected');	
			$('#shc-table_col').val(newval);	*/
	});
	$(document).on('change','#shc-table_col',function(){
		var tval = $("option:selected",this).val();
		$("option:selected",this).remove();
		$('#shc-table_ids option[value=' + tval + ']').removeAttr('disabled');
	});
	$(document).on('change','#shc-haxis_date_type,#shc-vaxis_date_type',function(){
		var myid = $(this).attr('id');
		if(myid == 'shc-haxis_date_type')
		{
			divtype = 'haxis';
		}
		else
		{
			divtype = 'vaxis';
		}	
		var type = $(this).find('option:selected').val();
		$(this).vhDateType(divtype,type,'');
	});
	$.fn.saveGridCols = function(){
		$('#shc-table_col option').each(function()
		{
			$(this).prop("selected",true);
		});
	}
	$.fn.updateGridCols = function(cols){
		$.each(cols,function(i,val) {
			$('#shc-table_col option[value=' + val + ']').removeAttr('selected');
			$('#shc-table_ids option[value=' + val + ']').prop('disabled','disabled');
		});
	}
	$.fn.vhDateType = function(divtype,type,value){
		if(type != 'year')
		{
			$.get(ajaxurl,{action:'wpas_get_date_ranges',type:type,value:value}, function(response)
			{
				$('#shc-'+divtype+'_date_range').html(response);
				$('#shc-'+divtype+'_date_range_div').show();
			});
		}
		else
		{
			$('#shc-'+divtype+'_date_range_div').hide();
		}
	}
	$(document).on('change','#shc-attach_tax',function(){
		var app_id = $('input#app').val();
		var tax_id = $('#shc-attach_tax').val();
		if(tax_id != '')
		{
			$.get(ajaxurl,{action:'wpas_get_tax_values',app_id:app_id,tax_id:tax_id}, function(response)
			{
				$('#add-shortcode-div #shc-attach_taxterm').html(response);
			});
			$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id,tax_id:tax_id}, function(response)
                        {
                                $('#add-shortcode-div #shc-attach').html(response);
                                $('#shc-attach_div').show();
                        });
		}
	});
	$(document).on('click','#shc-setup_page',function(){
                if($(this).prop('checked'))
                {
                        $('#shc-setup_page_title_div').show();
                }
                else
                {
                        $('#shc-setup_page_title_div').hide();
                }
        });
	$(document).on('click','#shc-app_dash',function(){
                if($(this).prop('checked'))
                {
                        $('#shc-app_dash_title_div').show();
                        $('#shc-app_dash_loc_div').show();
                }
                else
                {
                        $('#shc-app_dash_title_div').hide();
                        $('#shc-app_dash_loc_div').hide();
                }
        });
});			
</script>
		<form action="" method="post" id="shortcode-form" class="form-horizontal">
		<input type="hidden" id="app" name="app" value="">
		<input type="hidden" value="" name="shc" id="shc">
		<fieldset>
		<div class="well">
		<div class="emdt-row emdt-alert">
		<div class="alert alert-info">
		<a data-placement="bottom" href="#" title="<?php esc_html_e("Views help you display content where and how you wanted on the frontend.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a><a title="Go to Views Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/views/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-label" id="shc-label" type="text" placeholder="<?php esc_html_e("e.g. sc_products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("General name for the view. By enclosing the view name in square brackets in a page, post or a text widget, you can display the content returned by the view shortcode's query. The view name should be all lowercase and use all letters, but numbers and underscores (not dashes!) should work fine too. Max 30 characters allowed. If the shortcode is used in a text widget or a page and the content has multiple pages, paginated navigation links are displayed. You can filter the content by generating a shortcode filter using the WPAS toolbar button on a page or post.","wp-app-studio"); ?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
                <label class="control-label"><?php esc_html_e("Description","wp-app-studio"); ?></label>
                <div class="controls">
                <textarea name="shc-desc" id="shc-desc" class="wpas-std-textarea"></textarea>
                <a href="#" title="<?php esc_html_e("Sets the initial short description for the view.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-view_type" id="shc-view_type" class="input-xlarge">
		<option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio"); ?></option>
		<option value="std"><?php esc_html_e("Standard","wp-app-studio"); ?></option>
		<option value="search"><?php esc_html_e("Search","wp-app-studio"); ?></option>
		<option value="single"><?php esc_html_e("Single","wp-app-studio"); ?></option>
		<option value="archive"><?php esc_html_e("Archive","wp-app-studio"); ?></option>
		<option value="tax"><?php esc_html_e("Taxonomy","wp-app-studio"); ?></option>
		<option value="chart"><?php esc_html_e("Google Chart","wp-app-studio"); ?></option>
		<option value="emd_chart"><?php esc_html_e("Emd Chart","wp-app-studio"); ?></option>
		<option value="datagrid"><?php esc_html_e("Data grid","wp-app-studio"); ?></option>
		<option value="integration"><?php esc_html_e("Integration","wp-app-studio"); ?></option>
		<option value="autocomplete"><?php esc_html_e("Autocomplete","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Sets the type of view to be created.You can create search, standard, single, archive, and taxonomy views. All views except single view produce a list of content. The single views display individual entity content. Each entity can only have one single view. Search views are for displaying search results and must be attached to at least one search form. Taxonomy views display the content of a taxonomy. Each taxonomy can have only one taxonomy view. Archive views display a list of entity content. Each entity can have only one archive view. In addition, you can sort, filter the archived content of views using the filter tab. Single views diplay only one record so can not be filtered or sorted. If you like to display multiple versions of the archived content of an entity, you can create a standard view. There is no limitation of the number of standard views that can be attached to an entity. Standard views can be put on a page or post using the wpas toolbar button.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-attach_form_div" name="shc-attach_form_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Attach to Form","wp-app-studio"); ?></label>
		<div class="controls">
		<select id="shc-attach_form" name="shc-attach_form">
		</select><a href="#" title="<?php esc_html_e("Search forms must be attached to an already created view. A search view defines the format of how search results will be displayed.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div id="shc-attach_tax_div" name="shc-attach_tax_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Attach to Taxonomy","wp-app-studio"); ?></label>
		<div class="controls">
		<select id="shc-attach_tax" name="shc-attach_tax">
		</select><a href="#" title="<?php esc_html_e("Taxonomy views must be attached to a predefined taxonomy.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
                <div class="control-group row-fluid">
                <label class="control-label"><?php esc_html_e("Attach to Term","wp-app-studio"); ?></label>
                <div class="controls">
                <select id="shc-attach_taxterm" name="shc-attach_taxterm">
		<option value=''><?php esc_html_e("Apply to all","wp-app-studio"); ?></option>
                </select><a href="#" title="<?php esc_html_e("Taxonomy views can be attached to a predefined taxonomy term.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		</div>
		<div class="control-group row-fluid" id="shc-attach_div" name="shc-attach_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Attach to Entity","wp-app-studio"); ?></label>
		<div class="controls">
		<select id="shc-attach" name="shc-attach">
		</select><a href="#" title="<?php esc_html_e("Views must be attached to a predefined entity. The attached entity's content is returned by the view after query filters applied.","wp-app-studio"); ?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-return_ids_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Returns Ids Only","wp-app-studio");?>
		<input name="shc-return_ids" id="shc-return_ids" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("It returns ids of the attached entity when selected. The returned ids can be used to pass view results to other shortcodes for integration purposes.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
                </div>
		<div id="view-tabs">
        <ul id="shcTab" class="nav nav-tabs">
        <li id="shctabs-1-li" class="active"><a data-toggle="tab" href="#shctabs-1"><?php esc_html_e("Display Options","wp-app-studio"); ?></a></li>
        <li id="shctabs-2-li"><a data-toggle="tab" href="#shctabs-2"><?php esc_html_e("Filters","wp-app-studio"); ?></a></li>
        <li id="shctabs-3-li"><a data-toggle="tab" href="#shctabs-3"><?php esc_html_e("Messages","wp-app-studio"); ?></a></li>
        </ul>
        <div id="ShcTabContent" class="tab-content">
        <div class="row-fluid"><div class="btn emdt-row emdt-alert"><a data-placement="bottom" href="#" title="<?php esc_html_e("Display Options tab configures how the view will be displayed on the frontend. Filters tab defines how the content will be returned by setting sort order, number of records etc. Messages tab helps you define the messages to be displayed to users when the view's content is requested.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></div></div>
	<div id="shctabs-1" class="tab-pane fade in active">
		<div class="control-group row-fluid" id="shc-setup_page_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Create Setup Page","wp-app-studio");?>
		<input name="shc-setup_page" id="shc-setup_page" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, the view will be created as a page upon activation.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-rmv_wpasbtn_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Remove from WPAS button list","wp-app-studio");?>
		<input name="shc-rmv_wpasbtn" id="shc-rmv_wpasbtn" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, this view is removed from the WPAS button in page toolbar.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-setup_page_title_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Setup Page Title","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-setup_page_title" id="shc-setup_page_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("The title of the setup page. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid" id="shc-app_dash_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Display in App Dashboard","wp-app-studio");?>
		<input name="shc-app_dash" id="shc-app_dash" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, displays shortcode in app dashboard. App Dashboard can only contain one instance of chart or datagrid shortcode. You can not select to display an integration view on your app dashboard if it includes a chart or datagrid which is already selected to be displayed on your app dashboard.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-app_dash_title_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Dashboard Title","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-app_dash_title" id="shc-app_dash_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("The title of the dashboard. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid" id="shc-app_dash_loc_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Dashboard Location","wp-app-studio");?></label>
		<div class="controls">
		<select name="shc-app_dash_loc" id="shc-app_dash_loc" class="input-xlarge">
		<option value="">Please select</option>
		<option value="wholecol">One Column</option>
		<option value="normal">Two Column Left</option>
		<option value="side">Two Column Right</option>
		</select>
		<a href="#" title="<?php esc_html_e("The title of the dashboard. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div id="shc-theme_type_div" name="shc-theme_type_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Template","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-theme_type" id="shc-theme_type" class="input-xlarge">
		<option value="Na">None</option>
		<option value="Bootstrap">WPAS</option>
		</select>
		<a href="#" title="<?php esc_html_e("Sets the frontend framework which will be used to configure the overall look and feel of the view. If you pick jQuery UI, you can choose your theme from App's Settings under the theme tab. Default is Twitter Bootstrap.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-jquery_div" name="shc-jquery_div">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable jQuery","wp-app-studio");?>
		<input name="shc-jquery" id="shc-jquery" type="checkbox" value="1" checked/>
		<a href="#" title="<?php esc_html_e("Enables jQuery.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-font_awesome_div" name="shc-font_awesome_div">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable Font Awesome","wp-app-studio");?>
		<input name="shc-font_awesome" id="shc-font_awesome" type="checkbox" value="1" checked/>
		<a href="#" title="<?php esc_html_e("Enables Font Awesome webfont for radios, checkboxes and other icons. Can not be disabled for the Bootstrap framework.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-dashicon_div" name="shc-dashicon_div">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable Dashicons","wp-app-studio");?>
		<input name="shc-dashicon" id="shc-dashicon" type="checkbox" value="1" checked/>
		<a href="#" title="<?php esc_html_e("Enables Dashicons webfont for radios, checkboxes and other icons.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-hier_div" style="display:none;">
                <label class="control-label"></label>
                <label class="checkbox span9"><?php esc_html_e("Enable hierarchical display.","wp-app-studio"); ?>
                <input type="checkbox" value="1" id="shc-hier" name="shc-hier">
                <a title="<?php esc_html_e("Enables hierarchical display.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
		<div id="shc-hier_vals_div" style="display:none;">
		<div class="control-group row-fluid">
                <label class="control-label"></label>
                <label class="span9"><?php esc_html_e("Hierarchical list type","wp-app-studio"); ?>
		<select name="shc-hier_list" id="shc-hier_list" class="input-xlarge">
		<option value="ol" selected>Ordered List</option>
		<option value="ul">Unordered List</option>
		<option value="none">None</option>
		</select>
                <a title="<?php esc_html_e("Select the list type which will be used to display hierarchical elements. When using hierarchical display, ul, ol, and li tags are not necessary if -None- option is not selected. In -None- display type, you must enter the ul or ol tags in the header section, in layouts all markup is wrapped inside li tag.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
		<div class="control-group row-fluid">
                <label class="control-label"></label>
                <label class="span9"><?php esc_html_e("Hierarchical display root class","wp-app-studio"); ?>
		<input class="input-small" name="shc-hier_class" id="shc-hier_class" type="text" placeholder="<?php esc_html_e("e.g. stacked","wp-app-studio");?>" value="" >
                <a title="<?php esc_html_e("Sets the root class of the unordered or ordered list in hierarchical display.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
		<div class="control-group row-fluid">
                <label class="control-label"></label>
                <label class="span9"><?php esc_html_e("Hierarchical display depth","wp-app-studio"); ?>
		<input class="input-small" name="shc-hier_depth" id="shc-hier_depth" type="text" placeholder="<?php esc_html_e("e.g. 3","wp-app-studio");?>" value="" >
                <a title="<?php esc_html_e("Sets the hierarchical display depth. Leave it blank to display all.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
                </div>
		<div id="shc-sc_pagenav_div">
		<div class="control-group row-fluid">
                <label class="control-label"></label>
                <label class="checkbox span9"><?php esc_html_e("Enable paged navigation.","wp-app-studio"); ?>
                <input type="checkbox" value="1" id="shc-sc_pagenav" name="shc-sc_pagenav">
                <a title="<?php esc_html_e("Enables pagination links.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
		<div class="control-group row-fluid" id="shc-nav_ajax_div">
                <label class="control-label"></label>
                <label class="checkbox span9"><?php esc_html_e("Enable ajax paged navigation.","wp-app-studio"); ?>
                <input type="checkbox" value="1" id="shc-nav_ajax" name="shc-nav_ajax">
                <a title="<?php esc_html_e("Enables ajax pagination links.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
                </div>
		<div class="control-group row-fluid" id="shc-pgn_class_div">
                <label class="control-label"><?php esc_html_e("Pagination Class","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-pgn_class" id="shc-pgn_class" type="text" placeholder="<?php esc_html_e("e.g. visible-lg","wp-app-studio");?>" value="" >
                <a title="<?php esc_html_e("Add the specified custom CSS class to ul element. The class definition can be put in the CSS field. For example, .pagination-lg for larger blocks or .pagination-sm for smaller blocks.","wp-app-studio"); ?>" href="#">
                <i class="icon-info-sign"></i></a>
               </label>
                </div>
                </div>
		<div id="shc-table_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Show Index","wp-app-studio");?>
		<input name="shc-show_index" id="shc-show_index" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, it displays the row index as the grid's first column.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Show Hide Columns","wp-app-studio");?>
		<input name="shc-show_hide_col" id="shc-show_hide_col" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, it gives the user an option to choose which columns to show/hide in the form of a button.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("List","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-table_ids" id="shc-table_ids" class="input-xlarge" size=10 multiple>
		</select>
		<a href="#" title="<?php esc_html_e("Select the attribute, taxonomy, or relationship identifier you would like to include in your grid by default. Select by clicking on the item.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Columns","wp-app-studio");?></label>
		<div class="controls">
		<select name="shc-table_col[]" id="shc-table_col" class="input-xlarge" size=10 multiple="multiple">
		</select>
		<a href="#" title="<?php esc_html_e("Displays the attributes, taxonomies, or relationship identifiers selected from the list. Deselect by clicking on the item.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		</div><!-- end of shc-table_div -->
		<div id="shc-autocomplete-div" name="shc-autocomplete-div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Attach to Taxonomy","wp-app-studio"); ?></label>
		<div class="controls">
		<select id="shc-autocomplete_tax" name="shc-autocomplete_tax[]" multiple>
		</select><a href="#" title="<?php esc_html_e("You can allow users to limit autocomplete search results by the selected taxonomies","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Min Input Length","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-large" name="shc-autocomp_min" id="shc-autocomp_min" type="text" placeholder="<?php esc_html_e("e.g.3","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("Minimum input length to start searching.","wp-app-studio"); ?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Placeholder","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-large" name="shc-autocomp_placeholder" id="shc-autocomp_placeholder" type="text" placeholder="<?php esc_html_e("e.g. Enter your search terms","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("Sets the placeholder displayed in autocomplete search box.","wp-app-studio"); ?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Limit Results","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-large" name="shc-autocomp_limitresults" id="shc-autocomp_limitresults" type="text" placeholder="<?php esc_html_e("e.g. 5","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("Sets the number of returned results.","wp-app-studio"); ?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("No Results Message","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-large" name="shc-autocomp_noresults" id="shc-autocomp_noresults" type="text" placeholder="<?php esc_html_e("e.g. No results","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("Sets the message returned if there are no results.","wp-app-studio"); ?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>	
		<div class="control-group row-fluid" id="shc-layout_header_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Header","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-layout_header" name="shc-layout_header" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("It defines the header content of the view. The header content is static and displayed on the top section of your view's content.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-layout_div">
		<label class="control-label req"><?php esc_html_e("Layout","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-sc_layout" data-editor="php" name="shc-sc_layout" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the layout of a single record which can include the view tags available in the tag collapse. If the view type is standard, the layout defines your loop. If the hierarchial display is enabled, the layout displays all parent-child relationships in the format set in the hierarchial list type dropdown. ","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		<div id="show-tags-div" style="padding:10px 0;">
		<div style="padding:10px;">
		<button id="shc-layout-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
		</div>
		<div id="shc-layout-tags" class="tags-collapse"><?php esc_html_e('Loading Layout Tags','wp-app-studio'); ?></div>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-layout_footer_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Footer","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-layout_footer" name="shc-layout_footer" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("It defines the footer content of the view. The footer content is static and displayed on the bottom section of your view's content.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		</div>
		</div>
		<!-- emd-chart_div beg -->
		<div id="shc-emd-chart_div" style="display:none;">
		<div class="control-group row-fluid" id="shc-emd-chart_title_div">
		<label class="control-label"><?php esc_html_e("Chart Title","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-emd-chart_title" id="shc-emd-chart_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("Text to display above the chart. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Subtype","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-emd-chart_type" id="shc-emd-chart_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="org">Org</option>
		</select>
		<a href="#" title="<?php esc_html_e("Set the type of chart.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-emd-org_type_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Org Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-emd-org_type" id="shc-emd-org_type" class="input-xlarge">
		</select>
		<a href="#" title="<?php esc_html_e("Two types of associations are supported;relationship and hierarchical. Relationships are defined in the relationships in menu. The applicable relationships are of one-to-many type and between the same entity with reciprocal option set to false. Exp; Employee to employee relationship with manager and staff roles. Hierarchical type can be set in the entity editor by checking Hierarchical option set to true.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-emd-org_val_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Org Value","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-emd-org_val" id="shc-emd-org_val" class="input-large">
		</select>
		<a href="#" title="<?php esc_html_e("Set the name of the relationship to be drawn in Org Type.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Node Layout","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-emd-org_layout" name="shc-emd-org_layout" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the layout of a node record which can include the view tags available in the tag collapse. If the view type is standard, the layout defines your loop.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		<div id="show-tags-div" style="padding:10px 0;">
		<div style="padding:10px;">
		<button id="shc-emd-org-layout-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio");?></button>
		</div>
		<div id="shc-emd-org-layout-tags" class="tags-collapse"><?php esc_html_e('Loading Layout Tags','wp-app-studio'); ?></div>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Node Class","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-emd-org_class" id="shc-emd-org_class" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("A class name to assign to node elements. Apply CSS to this class name to specify colors or styles for the org chart elements.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Tooltip Layout","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-emd-org_tooltip_layout" name="shc-emd-org_tooltip_layout" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the layout of tooltip of a node record which can include the view tags available in the tag collapse.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		<div id="show-tags-div" style="padding:10px 0;">
		<div style="padding:10px;">
		<button id="shc-emd-org-tooltip-layout-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio");?></button>
		</div>
		<div id="shc-emd-org-tooltip-layout-tags" class="tags-collapse"><?php esc_html_e('Loading Layout Tags','wp-app-studio'); ?></div>
		</div>
		</div>
		</div>
		</div><!-- emd-chart_div end -->	
		<div id="shc-chart_div" style="display:none;">
		<div class="control-group row-fluid" id="shc-chart_title_div">
		<label class="control-label"><?php esc_html_e("Chart Title","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-chart_title" id="shc-chart_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("Text to display above the chart. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Subtype","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-chart_type" id="shc-chart_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="column">Column</option>
		<option value="bar">Bar</option>
		<option value="line">Line</option>
		<option value="area">Area</option>
		<option value="pie">Pie</option>
		<option value="org">Org</option>
		</select>
		<a href="#" title="<?php esc_html_e("Set the type of chart.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-chart_func_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Function","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-chart_func" id="shc-chart_func" class="input-xlarge">
		<option value="">Please select</option>
		<option value="none">None</option>
		<option value="count">Count</option>
		<option value="sum">Sum</option>
		<option value="avg">Average</option>
		<option value="max">Max</option>
		<option value="min">Min</option>
		</select>
		<a href="#" title="<?php esc_html_e("Sets aggregation function which will perform an action across all values in each group. Groups can be specified as attributes, taxonomies, dates, or relationships. Aggregation functions only apply on the numeric data for a group. None option does not apply any function. Count returns the count of elements. Null cells are not counted. Average returns the average value of all values. Max returns the maximum value. Min returns the minimum value. Sum returns the sum of all values. The fuction is applied to the variable selected for vertical column in column charts, horizontal column in bar charts.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-pie_type_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Pie Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-pie_type" id="shc-pie_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="pie">2D</option>
		<option value="3d">3D</option>
		<option value="donut">Donut</option>
		</select>
		<a href="#" title="<?php esc_html_e("Select the type of pie chart.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-haxis_type_div" style="display:none;">
		<label class="control-label req haxis"><?php esc_html_e("Axis Type (H)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-haxis_type" id="shc-haxis_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="date">Date</option>
		<option value="attribute">Attribute</option>
		<option value="taxonomy">Taxonomy</option>
		<option value="relationship">Relationship</option>
		</select>
		<a href="#" title="<?php esc_html_e("The horizontal axis with an exception of a bar chart displays the categories in your content. You can use dates, attributes, taxonomies, or relationships as your categories. Date option offers data level and data range features for better categorization.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div id="shc-haxis_div" style="display:none;">
		<div class="control-group row-fluid" id="shc-haxis_title_div">
		<label class="control-label haxis"><?php esc_html_e("Axis Title (H)","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-haxis_title" id="shc-haxis_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("The title of the horizontal axis. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label req haxis"><?php esc_html_e("Axis Value (H)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-haxis_id" id="shc-haxis_id" class="input-xlarge">
		<option value="">Please select</option>
		</select>
		<a href="#" title="<?php esc_html_e("Select the specific date, attribute, taxonomy, or relationship for your horizontal axis categories.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-haxis_date_type_div" style="display:none;">
		<label class="control-label req haxis"><?php esc_html_e("Date Level (H)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-haxis_date_type" id="shc-haxis_date_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="year">Year</option>
		<option value="month">Month</option>
		<option value="day">Day</option>
		</select>
		<a href="#" title="<?php esc_html_e("Select how you want to display your date category. You can use year or month for summarization.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-haxis_date_range_div" style="display:none;">
		<label class="control-label req haxis"><?php esc_html_e("Date Range (H)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-haxis_date_range" id="shc-haxis_date_range" class="input-xlarge">
		</select>
		<a href="#" title="<?php esc_html_e("Select the date range.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		</div> <!-- end of haxis_div -->
		<div class="control-group row-fluid" id="shc-vaxis_type_div" style="display:none;">
		<label class="control-label req vaxis"><?php esc_html_e("Axis Type (V)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-vaxis_type" id="shc-vaxis_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="date">Date Field</option>
		<option value="attribute">Attribute Field</option>
		<option value="taxonomy">Taxonomy</option>
		<option value="relationship">Relationship</option>
		</select>
		<a href="#" title="<?php esc_html_e("The vertical axis with the exception of bar charts displays the scale of a measure categorized by the horizontal axis. A measure is a property of which calculations (e.g., sum, count, average, minimum, maximum) can be made. You can use dates, attributes, taxonomies, and relationships as your vertical axis measures. Date is a special attribute type and offers data range level and data range features for better categorization.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div id="shc-vaxis_div" style="display:none;">
		<div class="control-group row-fluid" id="shc-vaxis_title_div">
		<label class="control-label vaxis"><?php esc_html_e("Axis Title (V)","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-vaxis_title" id="shc-vaxis_title" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("The title of the vertical axis. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label req vaxis"><?php esc_html_e("Axis Value (V)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-vaxis_id" id="shc-vaxis_id" class="input-xlarge">
		<option value="">Please select</option>
		</select>
		<a href="#" title="<?php esc_html_e("Select the measure you would to use in your vertical axis.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-vaxis_date_type_div" style="display:none;">
		<label class="control-label req vaxis"><?php esc_html_e("Date Level (V)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-vaxis_date_type" id="shc-vaxis_date_type" class="input-xlarge">
		<option value="">Please select</option>
		<option value="year">Year</option>
		<option value="month">Month</option>
		<option value="day">Day</option>
		</select>
		<a href="#" title="<?php esc_html_e("Select how you want to display your date measure. You can use year or month for summarization.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-vaxis_date_range_div" style="display:none;">
		<label class="control-label req vaxis"><?php esc_html_e("Date Range (V)","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-vaxis_date_range" id="shc-vaxis_date_range" class="input-xlarge">
		</select>
		<a href="#" title="<?php esc_html_e("Select the range of dates to be used in your measure.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		</div> <!-- end of vaxis_div -->
		<div class="control-group row-fluid" id="shc-chart_height_div">
		<label class="control-label"><?php esc_html_e("Height","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-chart_height" id="shc-chart_height" type="text" placeholder="<?php esc_html_e("e.g. 100px","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("Sets the height of the chart area. Set a simple number in pixels.Example: 100px.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid" id="shc-chart_width_div">
		<label class="control-label"><?php esc_html_e("Width","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-chart_width" id="shc-chart_width" type="text" placeholder="<?php esc_html_e("e.g. 100px","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("Sets the width of the chart area. Set a simple number in pixels. Example: 100px. Leave it blank for responsive sizing i.e. chart will resize itself based on the screen size.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div id="shc-org_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Org Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-org_type" id="shc-org_type" class="input-xlarge">
		</select>
		<a href="#" title="<?php esc_html_e("Two types of associations are supported;relationship and hierarchical. Relationships are defined in the relationships in menu. The applicable relationships are of one-to-many type and between the same entity with reciprocal option set to false. Exp; Employee to employee relationship with manager and staff roles. Hierarchical type can be set in the entity editor by checking Hierarchical option set to true.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-org_val_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Org Value","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-org_val" id="shc-org_val" class="input-large">
		</select>
		<a href="#" title="<?php esc_html_e("Set the name of the relationship to be drawn in Org Type.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Node Layout","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-org_layout" name="shc-org_layout" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the layout of a node record which can include the view tags available in the tag collapse. If the view type is standard, the layout defines your loop.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		<div id="show-tags-div" style="padding:10px 0;">
		<div style="padding:10px;">
		<button id="shc-org-layout-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio");?></button>
		</div>
		<div id="shc-org-layout-tags" class="tags-collapse"><?php esc_html_e('Loading Layout Tags','wp-app-studio'); ?></div>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Node Class","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-org_class" id="shc-org_class" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("A class name to assign to node elements. Apply CSS to this class name to specify colors or styles for the org chart elements.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Selected Node Class","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-org_sel_class" id="shc-org_sel_class" type="text" placeholder="<?php esc_html_e("e.g. Customer Survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("A class name to assign to selected node elements. Apply CSS to this class name to specify colors or styles for selected chart elements.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Tooltip Layout","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-org_tooltip_layout" name="shc-org_tooltip_layout" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the layout of tooltip of a node record which can include the view tags available in the tag collapse.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		<div id="show-tags-div" style="padding:10px 0;">
		<div style="padding:10px;">
		<button id="shc-org-tooltip-layout-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio");?></button>
		</div>
		<div id="shc-org-tooltip-layout-tags" class="tags-collapse"><?php esc_html_e('Loading Layout Tags','wp-app-studio'); ?></div>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Allow Collapse","wp-app-studio");?>
		<input name="shc-org_collapse" id="shc-org_collapse" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("Determines if double click will collapse a node.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Org Size","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-org_size" id="shc-org_size" class="input-xlarge">
		<option value='small' selected><?php esc_html_e('Small','wp-app-studio'); ?></option>
		<option value='medium'><?php esc_html_e('Medium','wp-app-studio'); ?></option>
		<option value='large'><?php esc_html_e('Large','wp-app-studio'); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Sets the whole size of the org chart to be drawn.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div><!-- org div end -->	
		<div class="control-group row-fluid" id="shc-legend_pos_div">
		<label class="control-label"><?php esc_html_e("Legend Position","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-legend_pos" id="shc-legend_pos" class="input-xlarge">
		<option value="top">Top</option>
		<option value="bottom">Bottom</option>
		<option value="left">Left</option>
		<option value="right">Right</option>
		<option value="in">In</option>
		<option value="none">None</option>
		</select>
		<a href="#" title="<?php esc_html_e("Position of the legend. Can be one of the following: Bottom - Below the chart. Left - To the left of the chart. In - Inside the chart, by the top left corner. Right - To the right of the chart. Incompatible with the vAxes option. Top - Above the chart. None - No legend is displayed.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="shc-chart_stacked_div">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Is Stacked","wp-app-studio");?>
		<input name="shc-chart_stacked" id="shc-chart_stacked" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, the chart series are displayed on top of one another.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		</div><!-- end of chart div -->
		<div class="control-group row-fluid" id="shc-sc_css_div">
		<label class="control-label"><?php esc_html_e("Css","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="shc-sc_css" name="shc-sc_css"></textarea>
		<a href="#" title="<?php esc_html_e("The custom CSS code to be used when displaying the content. It is handy when you added custom classes in the layout editor and want to add CSS class definitions. You can leave this field blank and use a common CSS file for all. All CSS code put in here are merged and shared by all views except search form result views. Search form result view CSS code are included in the CSS file of the corresponding form.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div id="shc-sc_js_div">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("JS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-js_enq" id="shc-js_enq" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the script file which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("JS","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="shc-sc_js" name="shc-sc_js"></textarea>
		<a href="#" title="<?php esc_html_e("The custom JavaScript code which will be enqueued to the view. Do not include script tags.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		<div id="show-js-tags-div" style="padding:10px 0;">
		<div style="padding:10px;">
		<button id="shc-js-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio");?></button>
		</div>
		<div id="shc-js-tags" class="tags-collapse"><?php esc_html_e("Loading Layout Tags","wp-app-studio"); ?></div>
		</div>
		</div>
		</div>
		</div>
		<div id="shc-sc_cdnjs_div">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN JS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-cdn_jsname" id="shc-cdn_jsname" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the script file which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN JS","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-sc_cdnjs" name="shc-sc_cdnjs" class="wpas-std-textarea" placeholder=" YOU MUST USE HTTPS e.g. https://cdnjs.cloudflare.com/ajax/libs/example.js/2.0.5/example.min.js;https://cdn.jsdelivr.net/example/1.1.9/min/example.min.js" ></textarea>
		<a href="#" title="<?php esc_html_e("Enter semicolon separated JavaScript file urls starting with https. We only accept files from the following sources; cdnjs.cloudflare.com and cdn.jsdelivr.net or raw.githubusercontent.com. All files will be downloaded and merged before getting locally enqueued to the view they are linked to.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div id="shc-sc_cdncss_div">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN CSS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="shc-cdn_cssname" id="shc-cdn_cssname" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the stylesheet which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN CSS","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-sc_cdncss" name="shc-sc_cdncss" class="wpas-std-textarea" placeholder=" YOU MUST USE HTTPS e.g. https://cdnjs.cloudflare.com/ajax/libs/example/2.0.5/example.min.css;https://cdn.jsdelivr.net/example/1.1.9/min/example.min.css" ></textarea>
		<a href="#" title="<?php esc_html_e("Enter semicolon separated CSS file urls starting with https. We only accept files from the following sources; cdnjs.cloudflare.com and cdn.jsdelivr.net or raw.githubusercontent.com. All files will be downloaded and merged before getting locally enqueued to the view they are linked to.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		</div> <!-- end of tab1 -->
		<div id="shctabs-2" class="tab-pane fade in">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Entities Per Page","wp-app-studio"); ?></label>
		<div class="controls">
		<input id="shc-sc_post_per_page" name="shc-sc_post_per_page" class="input-mini" type="text" placeholder="<?php esc_html_e("e.g. 16","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Specify the number of content block to show per page. Use any integer value or -1 to show all.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("List Order","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-sc_order" id="shc-sc_order" class="input-small">
		<option value="DESC" selected="selected"><?php esc_html_e("Descending","wp-app-studio"); ?></option>
		<option value="ASC"><?php esc_html_e("Ascending","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Allows the content to be sorted ascending or descending by a parameter selected. Defaults to descending.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Sort Retrieved Posts By","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-sc_orderby" id="shc-sc_orderby" class="input-small">
		</select>
		<a href="#" title="<?php esc_html_e("Allows sorting of retrieved content by a parameter selected. Defaults to date.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Show By Status","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="shc-sc_post_status" id="shc-sc_post_status" class="input-small">
		<option value="publish" selected="selected"><?php esc_html_e("Publish","wp-app-studio"); ?></option>
		<option value="pending"><?php esc_html_e("Pending","wp-app-studio"); ?></option>
		<option value="title"><?php esc_html_e("Draft","wp-app-studio"); ?></option>
		<option value="auto-draft"><?php esc_html_e("With no content","wp-app-studio"); ?></option>
		<option value="future"><?php esc_html_e("Future","wp-app-studio"); ?></option>
		<option value="private"><?php esc_html_e("Private","wp-app-studio"); ?></option>
		<option value="trash"><?php esc_html_e("Trash","wp-app-studio"); ?></option>
		<option value="any"><?php esc_html_e("Any but excluded from search","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Retrieves content by status, default value is publish.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="shc-filter-div">
		<label class="control-label"><?php esc_html_e("Filter","wp-app-studio");?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" name="shc-filter" id="shc-filter" placeholder="<?php esc_html_e("e.g. attr::emd_product_featured::is::1;tax::product_cat::is::electronics","wp-app-studio");?>" value="" ></textarea>
		<a href="#" title="<?php esc_html_e("Set the default filter for the content to be displayed in the view. You can use view filters to return for example; featured products, on-sale products etc. You can combine multiple filters with semicolon with triggers AND operator. For example;-attr::emd_product_featured::is::1;tax::product_cat::is::electronics- filter shows the featured products in electronics category. The easiest way to create filters is to use the WPAS button on a page toolbar of the generated app to design a filter and then copy paste the required part here.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div> <!-- end of tab2 -->
		<div id="shctabs-3" class="tab-pane fade in">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("No Access Message","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="shc-no_access_msg" name="shc-no_access_msg" class="wpas-std-textarea"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the text which will be displayed to users that do not have access to this view.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div> <!-- end of tab3 -->
		<div class="control-group emdt-row">
		<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button">
		<i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
		<button class="btn btn-inverse layout-buttons" id="save-shortcode" type="submit" value="Save">
		<i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio"); ?></button>
		</div>
		</fieldset>
		</form>
		<?php
}
?>
