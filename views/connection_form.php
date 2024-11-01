<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_connection_form($app_id)
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
        $.fn.initConnection = function(app_id) {
                $.get(ajaxurl,{action:'wpas_get_entities',type:'form',app_id:app_id}, function(response){
                        $('#add-connection-div #connection-entity').html(response);
			$('#connection-fields').hide();
			$('#connection-inline-entity').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
                });
        }
	$(document).on('change','#connection-type',function(){
		type = $(this).val();
		$(this).showCon(type);
	});
	$.fn.showCon = function (type){
		if(type == 'inc_email'){
			$('#connection-fields').show();
			$('#connection-inline-entity').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'inline_entity'){
			$('#connection-fields').hide();
			$('#connection-inline-entity').show();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'youtube_api'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').show();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'calendar' || type == 'calendar_lite'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').show();
			if(type == 'calendar_lite'){
				$('#connection-calendar-pro').hide();
			}
			else {
				$('#connection-calendar-pro').show();
			}
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'rating' || type == 'rating_lite'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').show();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'woocommerce'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').show();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
			app_id = $('input#app').val();
			$(this).showShcs(app_id,'woo');
		}
		else if(type == 'edd'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').show();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
			app_id = $('input#app').val();
			$(this).showShcs(app_id,'edd');
		}
		else if(type == 'ldap'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'repeating'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').show();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
		else if(type == 'trigger'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').show();
			$('#connection-scheduler').hide();
		}
		else if(type == 'scheduler'){
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').show();
		}
		else {
			$('#connection-inline-entity').hide();
			$('#connection-fields').hide();
			$('#connection-youtube').hide();
			$('#connection-calendar').hide();
			$('#connection-calendar-pro').hide();
			$('#connection-rating').hide();
			$('#connection-woocommerce').hide();
			$('#connection-woo_order').hide();
			$('#connection-woo_product').hide();
			$('#connection-edd').hide();
			$('#connection-edd_order').hide();
			$('#connection-edd_product').hide();
			$('#connection-mailchimp').hide();
			$('#connection-repeating').hide();
			$('#connection-trigger').hide();
			$('#connection-scheduler').hide();
		}
	}
	$(document).on('change','#connection-entity',function(){
		ent_id = $(this).val();
		app_id = $('input#app').val();
		con_type = $('#connection-type').val();
		if(con_type == 'inc_email'){
			$(this).incEmail(app_id,ent_id,'','');
		}
		else if(con_type == 'inline_entity'){
			$(this).inlineEnt(app_id,ent_id,'','');
		}
		else if(con_type == 'youtube_api'){
			$(this).youtubeFields(app_id,ent_id);
		}
		else if(con_type == 'calendar' || con_type == 'calendar_lite'){
			$(this).calFields(app_id,ent_id,con_type,'','');
		}
		else if(con_type == 'woocommerce'){
			$(this).wooeddTax('woo',app_id,ent_id,'');
		}
		else if(con_type == 'edd'){
			$(this).wooeddTax('edd',app_id,ent_id,'');
		}
		else if(con_type == 'mailchimp'){
			$(this).mailchimp(app_id,ent_id);
		}
		else if(con_type == 'rating' || con_type == 'rating_lite'){
			$(this).ratingAdminLoc(app_id,ent_id,'');
		}
		else if(con_type == 'repeating'){
			$(this).repeatingEnt(app_id,ent_id,'','');
		}
		else if(con_type == 'trigger'){
			$(this).triggerEnt(app_id,ent_id,'','');
		}
		else if(con_type == 'scheduler'){
			$(this).schedulerEnt(app_id,ent_id,'','');
		}
	});
	$(document).on('change','#connection-mailchimp_form',function(){
		form_id = $(this).val();	
		app_id = $('input#app').val();
		if(form_id != '' && app_id != ''){
			$.get(ajaxurl,{action:'wpas_get_form_taxs',app_id:app_id,form_id:form_id,values:''}, function(response){
				$('#add-connection-div #connection-mailchimp_tax').html(response);
				$('#add-connection-div #connection-mailchimp_tax_div').show();
			});
		}
	});
	$(document).on('change','#connection-woo_tax,#connection-edd_tax',function(){
		tax_id = $(this).val();
		app_id = $('input#app').val();
		if($(this).attr('id') == 'connection-woo_tax'){
			ctype = 'woo';
		}
		else {
			ctype = 'edd';
		}
		$(this).wooeddTerm(ctype,app_id,tax_id,'','both');
	});
	$(document).on('click','#connection-woo_order_rel,#connection-edd_order_rel',function(){
		val = 0;
		if($(this).prop('checked')){
			val = 1;
		}
		if($(this).attr('id') == 'connection-woo_order_rel'){
			type = 'woo';
		}
		else {
			type = 'edd';
		}
		$(this).showWooEddOrder(val,type);
	});
	$(document).on('click','#connection-woo_product_rel,#connection-edd_product_rel',function(){
		val = 0;
		if($(this).prop('checked')){
			val = 1;
		}
		if($(this).attr('id') == 'connection-woo_product_rel'){
			type = 'woo';
		}
		else {
			type = 'edd';
		}
		$(this).showWooEddProduct(val,type);
	});
	$.fn.ratingAdminLoc = function (app_id,ent_id,val){
		$.get(ajaxurl,{action:'wpas_admin_loc',app_id:app_id,ent_id:ent_id,value:val}, function(response){
			$('#connection-rating_admin_loc').html(response);
		});
	}
	$.fn.showShcs = function (app_id,type){
		$.get(ajaxurl,{action:'wpas_shortcode_list',app_id:app_id}, function(response){
			$('#connection-'+type+'_my_account_aft').html(response);
			$('#connection-'+type+'_my_account_bef').html(response);
		});
	}
	$.fn.showWooEddOrder = function (checked,type){
		if(checked == 1){
			$('#connection-'+type+'_order').show();
		}
		else {
			$('#connection-'+type+'_order').hide();
		}
	}
	$.fn.showWooEddProduct = function (checked,type){
		if(checked == 1){
			$('#connection-'+type+'_product').show();
		}
		else {
			$('#connection-'+type+'_product').hide();
		}
	}
	$.fn.wooeddTerm = function (ctype,app_id,tax_id,val,type){
		$.get(ajaxurl,{action:'wpas_get_tax_values',app_id:app_id,tax_id:tax_id,type:'conn',value:val}, function(response){
			if(type == 'order' || type == 'both'){
				$('#add-connection-div #connection-'+ctype+'_order_term').html(response);
			}
			if(type == 'product' || type == 'both'){
				$('#add-connection-div #connection-'+ctype+'_product_term').html(response);
			}	
		});
	}
	$.fn.wooeddTax = function (type,app_id,ent_id,val){
		$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'tax',chart_ent:ent_id,values:val}, function(response){
			$('#add-connection-div #connection-'+type+'_tax').html(response);
		});
	}
	$.fn.schedulerEnt = function (app_id,ent_id,ftype,val){
		if(ftype == ''){
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'tax',chart_ent:ent_id,values:val,add_sel:2}, function(response){
				$('#add-connection-div #connection-scheduler_tax').html(response);
			});
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'form_dependents',primary_entity:ent_id,values:val}, function(response){
				$('#add-connection-div #connection-scheduler_rel').html(response);
			});
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-scheduler_cond_attr').html(response['list']);
			}, 'json');
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-scheduler_act_attr').html(response['list']);
			}, 'json');
		}
		else if(ftype == 'tax'){
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'tax',chart_ent:ent_id,values:val,add_sel:2}, function(response){
				$('#add-connection-div #connection-scheduler_tax').html(response);
			});
		}
		else if(ftype == 'rel'){
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'form_dependents',primary_entity:ent_id,values:val}, function(response){
				$('#add-connection-div #connection-scheduler_rel').html(response);
			});
		}
		else if(ftype == 'cattr'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-scheduler_cond_attr').html(response['list']);
			}, 'json');
		}
		else if(ftype == 'aattr'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-scheduler_act_attr').html(response['list']);
			}, 'json');
		}
	}
	$.fn.triggerEnt = function (app_id,ent_id,ftype,val){
		if(ftype == ''){
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'tax',chart_ent:ent_id,values:val,add_sel:2}, function(response){
				$('#add-connection-div #connection-trigger_tax').html(response);
			});
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'form_dependents',primary_entity:ent_id,values:val}, function(response){
				$('#add-connection-div #connection-trigger_rel').html(response);
			});
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-trigger_cond_attr').html(response['list']);
			}, 'json');
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-trigger_act_attr').html(response['list']);
			}, 'json');
		}
		else if(ftype == 'tax'){
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'tax',chart_ent:ent_id,values:val,add_sel:2}, function(response){
				$('#add-connection-div #connection-trigger_tax').html(response);
			});
		}
		else if(ftype == 'rel'){
			$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'form_dependents',primary_entity:ent_id,values:val}, function(response){
				$('#add-connection-div #connection-trigger_rel').html(response);
			});
		}
		else if(ftype == 'cattr'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-trigger_cond_attr').html(response['list']);
			}, 'json');
		}
		else if(ftype == 'aattr'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'all',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-trigger_act_attr').html(response['list']);
			}, 'json');
		}
	}
	$.fn.repeatingEnt = function (app_id,ent_id,ftype,val){
		if(ftype == ''){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'date',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-repeating_date').html(response['pre']+response['list']);
				$('#add-connection-div #connection-repeating_dep_dates').html(response['list']);
			}, 'json');
			$.get(ajaxurl,{action:'wpas_get_table_cols',app_id:app_id,chart_ent:ent_id,table_cols:val,conn:1}, function(response){
				$('#add-connection-div #connection-repeating_not_copy').html(response[0]);
			},'json');
		}
		else if(ftype == 'date'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'date',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-repeating_date').html(response['pre']+response['list']);
			}, 'json');
		}	
		else if(ftype == 'ddate'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'date',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-repeating_dep_dates').html(response['list']);
			}, 'json');
		}	
		else if(ftype == 'no_copy'){
			$.get(ajaxurl,{action:'wpas_get_table_cols',app_id:app_id,chart_ent:ent_id,table_cols:val,conn:1}, function(response){
				$('#add-connection-div #connection-repeating_not_copy').html(response[0]);
			},'json');
		}
	}
	$.fn.calFields = function (app_id,ent_id,con_type,ftype,val){
		if(ftype == '' || ftype == 'name'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-calendar_title').html(response['pre']+response['list']);
			}, 'json');
		}
		if(ftype == ''){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'date',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-calendar_start').html(response['pre']+response['list']);
				$('#add-connection-div #connection-calendar_end').html(response['pre']+response['list']);
			}, 'json');
		}
		else if(ftype == 'sdate'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'date',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-calendar_start').html(response['pre']+response['list']);
			}, 'json');
		}
		else if(ftype == 'edate'){
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'date',app_id:app_id,ent_id:ent_id,value:val}, function(response){
				$('#add-connection-div #connection-calendar_end').html(response['pre']+response['list']);
			}, 'json');
		}
		if(con_type == 'calendar'){
			if(ftype == '' || ftype == 'url'){
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'url',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-calendar_url').html(response['pre']+response['list']);
				}, 'json');
			}
			if(ftype == ''){
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'color',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-calendar_bg_color').html(response['pre']+response['list']);
					$('#add-connection-div #connection-calendar_border_color').html(response['pre']+response['list']);
					$('#add-connection-div #connection-calendar_text_color').html(response['pre']+response['list']);
				}, 'json');
			}
			else if(ftype == 'bgcolor'){
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'color',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-calendar_bg_color').html(response['pre']+response['list']);
				}, 'json');
			}
			else if(ftype == 'bcolor'){
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'color',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-calendar_border_color').html(response['pre']+response['list']);
				}, 'json');
			}
			else if(ftype == 'tcolor'){
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'color',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-calendar_text_color').html(response['pre']+response['list']);
				}, 'json');
			}
		}
	}
	$.fn.youtubeFields = function (app_id,ent_id){
		$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id}, function(response){
			$('#add-connection-div #connection-youtube_video_id').html(response['pre']+response['list']);
			$('#add-connection-div #connection-youtube_username').html(response['pre']+response['list']);
		}, 'json');
	}
	$.fn.inlineEnt = function (app_id,ent_id,val_ent,val_loc){
		$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'inline_tax',chart_ent:ent_id,values:val_ent}, function(response){
			$('#add-connection-div #connection-inl_entity').html(response);
			$('#add-connection-div #connection-inl_entity-div').show();
		});
		$.get(ajaxurl,{action:'wpas_get_inline_ent_attr',app_id:app_id,ent_id:ent_id,values:val_loc}, function(response){
			$('#add-connection-div #connection-inl_loc').html(response);
		});
	}
	$.fn.mailchimp = function (app_id,ent_id,val,values){
		if(ent_id != '' && app_id != ''){
			$.get(ajaxurl,{action:'wpas_get_submit_forms',app_id:app_id, ent_id:ent_id, val:val}, function(response)
			{
				$('#add-connection-div #connection-mailchimp_form').html(response);
				$('#add-connection-div #connection-mailchimp').show();
				$('#add-connection-div #connection-mailchimp_tax_div').hide();
				if(values){
					$.get(ajaxurl,{action:'wpas_get_form_taxs',app_id:app_id,form_id:val,values:values}, function(response){
					$('#add-connection-div #connection-mailchimp_tax').html(response);
					$('#add-connection-div #connection-mailchimp_tax_div').show();
					});
				}
			});
		}
	}
	$.fn.incEmail = function (app_id,ent_id,ftype,val){
		if(ent_id != '' && app_id != ''){
			if(ftype == '' || ftype == 'tax'){
				$.get(ajaxurl,{action:'wpas_get_entities',app_id:app_id,type:'tax',chart_ent:ent_id,values:val}, function(response){
					$('#add-connection-div #connection-inc_tax').html(response);
				});
			}
			if(val != '' && ftype == 'subject')
			{
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-inc_subject').html(response['pre']+response['list']);
				}, 'json');
			}
			if(ftype == 'from')
			{
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'email',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#connection-inc_email_div').show();
					$('#add-connection-div #connection-inc_email').html(response['pre']+response['list']);
				}, 'json');
			}	
			if(ftype == 'from_name')
			{
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#connection-inc_name_div').show();
					$('#add-connection-div #connection-inc_name').html(response['list']);
				}, 'json');
			}		
			if(ftype == '' && $('#connection-inc_vis_submit').prop('checked')){
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'email',app_id:app_id,ent_id:ent_id}, function(response){
					$('#add-connection-div #connection-inc_email').html(response['pre']+response['list']);
				}, 'json');
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id}, function(response){
					$('#add-connection-div #connection-inc_name').html(response['list']);
					$('#add-connection-div #connection-inc_subject').html(response['pre']+response['list']); 
				}, 'json');
			}
			else if(ftype == '' && val == '') {
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id}, function(response){
					$('#add-connection-div #connection-inc_subject').html(response['pre']+response['list']); 
				}, 'json');
				$('#connection-inc_email_div').hide();
				$('#connection-inc_name_div').hide();
			}
			if(ftype == '' || ftype == 'date')
			{
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'pdate',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-inc_date').html(response['list']);
				}, 'json');
			}	
			if(ftype == '' || ftype == 'body')
			{
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'body',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-inc_body').html(response['pre']+response['list']);
				}, 'json');
			}
			if(ftype == '' || ftype == 'att')
			{
				$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'attach',app_id:app_id,ent_id:ent_id,value:val}, function(response){
					$('#add-connection-div #connection-inc_att').html(response['pre']+response['list']);
				}, 'json');
			}
		}
	}
	$(document).on('click','#connection-inc_vis_submit',function(){
		if($(this).prop('checked')){
			app_id = $('input#app').val();
			ent_id = $('input#ent').val();
			if(ent_id == ''){
				ent_id = $('#connection-entity').val();
			}
			$('#connection-inc_vis_status_div').show();
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'email',app_id:app_id,ent_id:ent_id}, function(response){
				$('#add-connection-div #connection-inc_email').html(response['pre']+response['list']);
			}, 'json');
			$.get(ajaxurl,{action:'wpas_get_ent_fields',type:'name',app_id:app_id,ent_id:ent_id}, function(response){
				$('#add-connection-div #connection-inc_name').html(response['list']);
			}, 'json');
			$('#connection-inc_email_div').show();
			$('#connection-inc_name_div').show();
		}
		else {
			$('#connection-inc_vis_status_div').hide();
			$('#connection-inc_email_div').hide();
			$('#connection-inc_name_div').hide();
		}
	});
});
</script>
	<form action="" method="post" id="connection-form" class="form-horizontal">
	<input type="hidden" id="app" name="app" value="">
	<input type="hidden" value="" name="connection" id="connection">
	<fieldset>
	<div class="field-container">
	<div class="well">
	<div class="emdt-row emdt-alert">
	<div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("Connections allow entities to get and send data from/to external apps or services such as incoming/outgoing email, twitter, facebook etc.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Connections Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/connections/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-name" id="connection-name" type="text" placeholder="<?php esc_html_e("e.g. customer_survey","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Unique identifier for connection. Can not contain capital letters, dashes or spaces. Between 3 and 30 characters.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-type" id="connection-type" class="input-xlarge">
	<option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio");?></option>
	<option value="inc_email"><?php esc_html_e("Incoming Email","wp-app-studio");?></option>
	<option value="inline_entity"><?php esc_html_e("Inline Entity","wp-app-studio");?></option>
	<option value="youtube_api"><?php esc_html_e("Youtube Lite","wp-app-studio");?></option>
	<option value="calendar_lite"><?php esc_html_e("Calendar Lite","wp-app-studio");?></option>
	<option value="calendar"><?php esc_html_e("Calendar","wp-app-studio");?></option>
	<option value="rating"><?php esc_html_e("Rating","wp-app-studio");?></option>
	<option value="rating_lite"><?php esc_html_e("Rating Lite","wp-app-studio");?></option>
	<option value="woocommerce"><?php esc_html_e("WooCommerce","wp-app-studio");?></option>
	<option value="edd"><?php esc_html_e("Easy Digital Downloads","wp-app-studio");?></option>
	<option value="ldap"><?php esc_html_e("Active Directory/LDAP","wp-app-studio");?></option>
	<option value="mailchimp"><?php esc_html_e("MailChimp","wp-app-studio");?></option>
	<option value="repeating"><?php esc_html_e("Repeating","wp-app-studio");?></option>
	<option value="trigger"><?php esc_html_e("Trigger","wp-app-studio");?></option>
	<option value="scheduler"><?php esc_html_e("Scheduler","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the type of connection to be created. Connections with their name ending with lite are included in ProDev.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Attached to Entity","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-entity" id="connection-entity" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the primary entity for connection. The selected entity will be used to get/send data from/to external apps or services. It will be used for the dependent selection as well.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div id="connection-fields">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Submit Status","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_status" id="connection-inc_status" class="input-xlarge">
	<option value="publish"><?php esc_html_e("Publish","wp-app-studio");?></option>
	<option value="draft"><?php esc_html_e("Draft","wp-app-studio");?></option>
	<option value="private"><?php esc_html_e("Private","wp-app-studio");?></option>
	<option value="trash"><?php esc_html_e("Trash","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the status of all entries for the users who have -edit_published- capability. Available values are Publish, Draft, Private, and Trash.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Allow Visitors to Submit","wp-app-studio"); ?>
			<input name="connection-inc_vis_submit" id="connection-inc_vis_submit" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("It allows users who have NOT -edit_published- capability to send content through connections.","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="connection-inc_vis_status_div" style="display:none;"> 
	<label class="control-label req"><?php esc_html_e("Visitor Submit Status","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_vis_status" id="connection-inc_vis_status" class="input-xlarge">
	<option value="publish"><?php esc_html_e("Publish","wp-app-studio");?></option>
	<option value="draft"><?php esc_html_e("Draft","wp-app-studio");?></option>
	<option value="private"><?php esc_html_e("Private","wp-app-studio");?></option>
	<option value="trash"><?php esc_html_e("Trash","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the status of all entries for the users who have NOT -edit_published- capability. Available values are Publish, Draft, Private, and Trash.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Default Taxonomy","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_tax" id="connection-inc_tax" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the default taxonomy of the imported entity records.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="connection-inc_email_div"> 
	<label class="control-label req"><?php esc_html_e("From Address","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_email" id="connection-inc_email" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Maps the from address of an incoming message to an entity attribute. Displayed when -Allow Visitors to Submit- checked otherwise WordPress user email used.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="connection-inc_name_div"> 
	<label class="control-label req"><?php esc_html_e("From Name","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_name[]" id="connection-inc_name" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Maps the from name of an incoming message to an entity attribute. Displayed when -Allow Visitors to Submit- checked otherwise WordPress user name used.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Subject","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_subject" id="connection-inc_subject" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Maps the subject text of an incoming message to an entity attribute.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Date","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_date[]" id="connection-inc_date" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Maps the date of an incoming message to an entity attribute.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Body","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_body" id="connection-inc_body" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Maps the body of an incoming message to an entity attribute.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Attachment","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inc_att" id="connection-inc_att" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Maps the attachment of an incoming message to an entity attribute.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of connection-fields -->
	<div id="connection-inline-entity">
	<div class="control-group row-fluid" id="connection-inl_entity-div" style="display:none;"> 
	<label class="control-label req"><?php esc_html_e("Inline Entity","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inl_entity" id="connection-inl_entity" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the inline entity for connection. Inline entities can not shared by multiple entities.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Button Location","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-inl_loc[]" id="connection-inl_loc" class="input-xlarge" multiple>
	<option value=""><?php esc_html_e("Please select","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Set the location of the inline entity button; content, excerpt, or comment editors can be used. If you select content, quick tag editor button is added by default.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Button Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-inl_blabel" id="connection-inl_blabel" type="text" placeholder="<?php esc_html_e("e.g. customer_survey","wp-app-studio");?>" value="">
	<a href="#" title="<?php esc_html_e("Sets the inline entity button label.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Button Icon","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-inl_bicon" id="connection-inl_bicon" type="text" placeholder="<?php esc_html_e("e.g. fa-heart","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the inline entity button icon. Use cheat-sheet for possible icons.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a><a href="<?php echo WPAS_URL . '/articles/supported-icons/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=cheatsheet'; ?>" target="_blank"><?php esc_html_e("Cheatsheet","wp-app-studio");?></a>
	</div>
	</div>
	</div><!-- end of inline entity -->	
	<div id="connection-youtube">
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Default Youtube API Key","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-youtube_api_key" id="connection-youtube_api_key" type="text" placeholder="" value="" >
	<a href="#" title="<?php esc_html_e("Google API Key to pull statistics using API v3.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Youtube Video ID","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-youtube_video_id" id="connection-youtube_video_id" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Maps the video id attribute.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Youtube Username","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-youtube_username" id="connection-youtube_username" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Maps the username attribute.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of youtube -->	
	<div id="connection-scheduler">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Taxonomies","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-scheduler_tax[]" id="connection-scheduler_tax" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the taxonomies to be used in the configuration of a trigger.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Relationships","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-scheduler_rel[]" id="connection-scheduler_rel" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the relationships to be used in the configuration of a scheduler.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Condition Attributes","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-scheduler_cond_attr[]" id="connection-scheduler_cond_attr" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the attributes to be used in the configuration of a scheduler condition.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Action Attributes","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-scheduler_act_attr[]" id="connection-scheduler_act_attr" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the attributes to be used in the configuration of a scheduler action.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of scheduler -->	
	<div id="connection-trigger">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Taxonomies","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-trigger_tax[]" id="connection-trigger_tax" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the taxonomies to be used in the configuration of a trigger.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Relationships","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-trigger_rel[]" id="connection-trigger_rel" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the relationships to be used in the configuration of a trigger.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Condition Attributes","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-trigger_cond_attr[]" id="connection-trigger_cond_attr" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the attributes to be used in the configuration of a trigger condition.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Action Attributes","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-trigger_act_attr[]" id="connection-trigger_act_attr" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Select the attributes to be used in the configuration of a trigger action.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of trigger -->	
	<div id="connection-repeating">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-repeating_label" id="connection-repeating_label" type="text" placeholder="<?php esc_html_e("e.g. Repeating Event","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets connection label.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Primary Date","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-repeating_date" id="connection-repeating_date" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("The name of the attribute that is set to repeat.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Dependent Dates","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-repeating_dep_dates[]" id="connection-repeating_dep_dates" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("One or more dates that are dependent on the primary date. Dependent dates are modified for each repeating object based on the repeating frequency set.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Not Copy","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-repeating_not_copy[]" id="connection-repeating_not_copy" class="input-xlarge" style="height:100px;" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Set the items not to be copied for each repeating object.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of repeating -->	
	<div id="connection-calendar">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-calendar_label" id="connection-calendar_label" type="text" placeholder="<?php esc_html_e("e.g. Event Calendar","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets connection label.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Title","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_title" id="connection-calendar_title" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("The text on an event's element.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Start","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_start" id="connection-calendar_start" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("The date/time an event begins.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("End","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_end" id="connection-calendar_end" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("The exclusive date/time an event ends.For events starting and ending at the same date use the same attribute in start such as birthdays.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div id="connection-calendar-pro">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Url","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_url" id="connection-calendar_url" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("A URL that will be visited when this event is clicked by the user.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Background Color","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_bg_color" id="connection-calendar_bg_color" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets an event's background color.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Border Color","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_border_color" id="connection-calendar_border_color" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets an event's border color.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Text Color","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-calendar_text_color" id="connection-calendar_text_color" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets an event's text color.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div><!-- end of pro calendar -->	
	</div>
	</div>
	</div><!-- end of calendar -->	
	<div id="connection-rating">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-rating_label" id="connection-rating_label" type="text" placeholder="<?php esc_html_e("e.g. Article Rating","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets connection label.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Admin Location","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-rating_admin_loc" id="connection-rating_admin_loc" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Assigns rating attribute to a location in admin entity layout.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of rating -->	
	<div id="connection-woocommerce">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_label" id="connection-woo_label" type="text" placeholder="<?php esc_html_e("e.g. Tickets","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the connection label which is display under plugin settings page.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="connection-woo-tax-id"> 
	<label class="control-label"><?php esc_html_e("Attach to Taxonomy","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_tax" id="connection-woo_tax" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Display order or product connections depending on the terms of this taxonomy.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
    	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Create Order Relationship","wp-app-studio"); ?>
	<input name="connection-woo_order_rel" id="connection-woo_order_rel" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Enables WooCommerce order relationship.","wp-app-studio"); ?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div id="connection-woo_order" class="well" style="background-color:#FFE8BF;">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Order Term","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_order_term" id="connection-woo_order_term" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the taxonomy term which triggers order connection box.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_order_type" id="connection-woo_order_type" class="input-xlarge">
	<option selected="selected" value="one-to-many"><?php esc_html_e("One-to-Many","wp-app-studio");?></option>
	<option value="many-to-many"><?php esc_html_e("Many-to-Many","wp-app-studio");?></option>
	<option value="many-to-one"><?php esc_html_e("Many-to-One","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets how order and attached entity records will be related.e.g. One order may be related to multiple ticket records and one ticket is related to many orders in one-to-many relationship type.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("From Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_order_from" id="connection-woo_order_from" type="text" placeholder="<?php esc_html_e("e.g. Tickets","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for attached entity.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("To Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_order_to" id="connection-woo_order_to" type="text" placeholder="<?php esc_html_e("e.g. Orders","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for order.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Box Display","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_order_box" id="connection-woo_order_box">
	<option selected="selected" value="from"><?php esc_html_e("Display in FROM entity","wp-app-studio");?></option>
        <option value="to"><?php esc_html_e("Display in TO entity","wp-app-studio");?></option>
        <option value="any"><?php esc_html_e("Display in ANY entity","wp-app-studio");?></option>
        <option value="false"><?php esc_html_e("Do not display","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Pick the location of relationship metabox. The metabox will be displayed in the editor screen of the selected entity or both.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Header","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_order_header" name="connection-woo_order_header"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout header of an order record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Layout","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_order_layout" name="connection-woo_order_layout"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout of an order record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-woo-order-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button type="button" class="btn btn-inverse" data-toggle="collapse" data-target="#connection-woo-order-tags">Show Tags</button>
	</div>
	<div id="connection-woo-order-tags" class="collapse">
	<table class='table table-striped'><tr><th colspan=2>
	<?php esc_html_e('Use template tags below to customize your layout.','wp-app-studio'); ?>
	</th></tr>
	<tr><th><?php echo esc_html__('Functions', 'wp-app-studio') ?></th>
	<td>Translate : <b>!#trans[<?php  esc_html_e('Text to translate','wp-app-studio');?>]#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Date Format:</a> <b>!#date-format['<?php  esc_html_e('Format','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag','wp-app-studio');?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff to Now:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag','wp-app-studio'); ?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag From','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag To','wp-app-studio');?>']#</b>, Control If: <b>!#control-if['<?php esc_html_e('Condition','wp-app-studio');?>','<?php esc_html_e('True Value','wp-app-studio');?>','<?php esc_html_e('False Value','wp-app-studio');?>']#</b></td></tr>
	<tr><th><?php echo esc_html__('Attributes', 'wp-app-studio') ?></th>
	<td><?php echo esc_html__('Order Id','wp-app-studio');?>: <b>!#woo_order_id#</b>, <?php echo esc_html__('Order Link','wp-app-studio');?>: <b>!#woo_order_link#</b>, <?php echo esc_html__('Order Date','wp-app-studio');?>: <b>!#woo_order_date#</b>, <?php echo esc_html__('Order Status','wp-app-studio');?>: <b>!#woo_order_status#</b>, <?php echo esc_html__('Order Total','wp-app-studio');?>: <b>!#woo_order_total#</b></td></tr>
	<tr><th><?php echo esc_html__('Relationships', 'wp-app-studio') ?></th>
	<td><?php echo esc_html__('Order Product List(Comma Seperated)','wp-app-studio');?>: <b>!#woo_order_products_csv#</b>, <?php echo esc_html__('Order Product List(Ordered)','wp-app-studio');?>: <b>!#woo_order_products_ol#</b>, <?php echo esc_html__('Order Product List(Unordered)','wp-app-studio');?>: <b>!#woo_order_products_ul#</b>, <?php echo esc_html__('Order Product List(Standard)','wp-app-studio');?>: <b>!#woo_order_products_div#</b></td></tr>
	</table>
	</div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Footer","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_order_footer" name="connection-woo_order_footer"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout footer of an order record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("My Account Recent Orders Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_recent_orders_label" id="connection-woo_recent_orders_label" type="text" placeholder="<?php esc_html_e("e.g. Open a Ticket","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the button label of my account page recent orders table row.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("My Account Recent Orders Link","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_recent_orders_url" id="connection-woo_recent_orders_url" type="text" placeholder="<?php esc_html_e("e.g. /open-a-ticket","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the button link of my account page recent orders table row.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- connection-woo_order end -->
	<div class="control-group row-fluid">
    	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Create Product Relationship","wp-app-studio"); ?>
	<input name="connection-woo_product_rel" id="connection-woo_product_rel" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Enables WooCommerce product relationship.","wp-app-studio"); ?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div id="connection-woo_product" class="well" style="background-color:#e4e4e4;">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Product Term","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_product_term" id="connection-woo_product_term" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the taxonomy term which triggers product connection box. Use this to connect products that are not related to orders.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_product_type" id="connection-woo_product_type" class="input-xlarge">
	<option selected="selected" value="one-to-many"><?php esc_html_e("One-to-Many","wp-app-studio");?></option>
	<option value="many-to-many"><?php esc_html_e("Many-to-Many","wp-app-studio");?></option>
	<option value="one-to-one"><?php esc_html_e("One-to-One","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets how product and attached entity records will be related.e.g. One product may be related to multiple ticket records and one ticket is related to many products in one-to-many relationship type.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("From Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_product_from" id="connection-woo_product_from" type="text" placeholder="<?php esc_html_e("e.g. Tickets","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for attached entity.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("To Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-woo_product_to" id="connection-woo_product_to" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for product.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Box Display","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-woo_product_box" id="connection-woo_product_box">
	<option selected="selected" value="from"><?php esc_html_e("Display in FROM entity","wp-app-studio");?></option>
        <option value="to"><?php esc_html_e("Display in TO entity","wp-app-studio");?></option>
        <option value="any"><?php esc_html_e("Display in ANY entity","wp-app-studio");?></option>
        <option value="false"><?php esc_html_e("Do not display","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Pick the location of relationship metabox. The metabox will be displayed in the editor screen of the selected entity or both.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Header","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_product_header" name="connection-woo_product_header"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout header of a product record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Layout","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_product_layout" name="connection-woo_product_layout"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout of a product record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-woo-product-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button type="button" class="btn btn-inverse" data-toggle="collapse" data-target="#connection-woo-product-tags">Show Tags</button>
	</div>
	<div id="connection-woo-product-tags" class="collapse">
	<table class='table table-striped'><tr><th colspan=2>
	<?php esc_html_e('Use template tags below to customize your layout.','wp-app-studio'); ?>
	</th></tr>
	<tr><th><?php echo esc_html__('Functions', 'wp-app-studio') ?></th>
	<td>Translate : <b>!#trans[<?php  esc_html_e('Text to translate','wp-app-studio');?>]#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Date Format:</a> <b>!#date-format['<?php  esc_html_e('Format','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag','wp-app-studio');?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff to Now:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag','wp-app-studio'); ?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag From','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag To','wp-app-studio');?>']#</b>, Control If: <b>!#control-if['<?php esc_html_e('Condition','wp-app-studio');?>','<?php esc_html_e('True Value','wp-app-studio');?>','<?php esc_html_e('False Value','wp-app-studio');?>']#</b></td></tr>
	<tr><th><?php echo esc_html__('Attributes', 'wp-app-studio') ?></th>
	<td><?php echo esc_html__('Product Id','wp-app-studio');?>: <b>!#woo_product_id#</b>, <?php echo esc_html__('Product Link','wp-app-studio');?>: <b>!#woo_product_link#</b>, <?php echo esc_html__('Product Title','wp-app-studio');?>: <b>!#woo_product_title#</b>, <?php echo esc_html__('Product Sku','wp-app-studio');?>: <b>!#woo_product_sku#</b>, <?php echo esc_html__('Product Price','wp-app-studio');?>: <b>!#woo_product_price#</b>, <?php echo esc_html__('Product Main Image Thumb','wp-app-studio');?>: <b>!#woo_product_image_thumb#</b>, <?php echo esc_html__('Product Rating','wp-app-studio');?>: <b>!#woo_product_rating#</b>, <?php echo esc_html__('Add to Cart','wp-app-studio');?>: <b>!#woo_product_add_to_cart#</b></td></tr></table>
	</div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Footer","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_product_footer" name="connection-woo_product_footer"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout footer of a product record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- connection-woo_product end -->
	<div class="section-title"><?php esc_html_e("My Account Page","wp-app-studio"); ?></div>
	 <div id="connection-woo_my_account" class="well">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Content Above Recent Orders Title","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_my_account_bef_shc" name="connection-woo_my_account_bef_shc"></textarea>
	<a href="#" title="<?php esc_html_e("Displays the view content above recent orders title in my account page.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-woo_my_account_bef" style="padding:10px 0;">
	</div>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Content After My Address Title","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-woo_my_account_aft_shc" name="connection-woo_my_account_aft_shc"></textarea>
	<a href="#" title="<?php esc_html_e("Displays the view content after my address title in my account page.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-woo_my_account_aft" style="padding:10px 0;">
	</div>
	</div>
	</div>
	</div>
	</div><!-- end of woocommerce -->	
	<div id="connection-mailchimp">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-mailchimp_label" id="connection-mailchimp_label" type="text" placeholder="<?php esc_html_e("e.g. Contact Mailchimp","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the connection label.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Attached Form","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-mailchimp_form" id="connection-mailchimp_form" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the form to be integrated with mailchimp.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="connection-mailchimp_tax_div" style="display:none;"> 
	<label class="control-label"><?php esc_html_e("Attached Taxonomy","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-mailchimp_tax[]" id="connection-mailchimp_tax" class="input-xlarge" multiple>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the taxonomy to be used in MailChimp group mapping.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- end of mailchimp -->	
	</div><!--well-->
	<?php show_edd_form($app_id); ?>
	<div class="control-group emdt-row">
	<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
	<button class="btn btn-inverse layout-buttons" id="save-connection" type="submit" value="Save"><i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio");?></button>
	</div>
</fieldset>
</form>
<?php
}
add_action('wp_ajax_wpas_shortcode_list', 'wpas_shortcode_list');
function wpas_shortcode_list(){
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$app = wpas_get_app($app_id);
	$ret = '';
	if(!empty($app['shortcode'])){
		foreach($app['shortcode'] as $myview){
			if(!in_array($myview['shc-view_type'],Array('search','single','archive','tax','autocomplete'))){
				$label = $myview['shc-setup_page_title'];
				if(empty($label)){
					$label = ucfirst(str_replace('_',' ',$myview['shc-label']));
				}
				$ret .= $label . ": <b>!#shortcode[" . $myview['shc-label'] . ']#</b>, ';
			}
		}
	}
	if(!empty($app['form'])){
		foreach($app['form'] as $myform){
			$label = $myform['form-setup_page_title'];
			if(empty($label)){
				$label = ucfirst(str_replace('_',' ',$myview['shc-label']));
			}
			$ret .= $label . ": <b>!#shortcode[" . $myform['form-name'] . ']#</b>, ';
		}
	}
	$ret = "<table class='table table-striped'><tr><th colspan=2>" .
	esc_html__('Use tags below to customize.','wp-app-studio') .
	"</th></tr><tr><th>" . esc_html__('Functions', 'wp-app-studio') . "</th>
        <td>" . esc_html__('Translate','wp-app-studio') . " : <b>!#trans[" . esc_html__('Text to translate','wp-app-studio') . "]#</b>
	<tr><th>" . esc_html__('Shortcodes', 'wp-app-studio') . "</th><td>" . $ret .
	"</td></tr></table>";
	echo $ret;
	die();
}
