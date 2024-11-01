<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_entity_form()
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(document).on('click','#ent-inline-ent',function(){
		if($(this).prop('checked')){
			$(this).setInlineTabs('inline');
		}
		else {
			$(this).setInlineTabs('notinline');
		}
	});
	$.fn.setInlineTabs = function (type){
		if(type == 'inline')
		{
			$('#myTab a:first').tab('show');
			$('#tabs-3-li').hide();
			$('#tabs-4-li').hide();
			$('#tabs-5-li').hide();
			$('#tabs-6-li').hide();
			$('#tabs-3').removeClass('active');
			$('#tabs-4').removeClass('active');
			$('#tabs-5').removeClass('active');
			$('#tabs-6').removeClass('active');
			$('#ent-hierarchical-div').hide();
			$('#ent-msg-cust-fields-div').hide();
		}	
		else {
			$('#myTab a:first').tab('show');
			$('#tabs-3-li').show();
			$('#tabs-4-li').show();
			$('#tabs-5-li').show();
			$('#tabs-6-li').show();
			$('#ent-hierarchical-div').hide();
			$('#ent-msg-cust-fields-div').show();
			$('#ent-hierarchical-div').hide();
		}	
	}
	$(document).on('click','#ent-supports_comments',function(){
		if($(this).prop('checked'))
		{
			$('#ent-com_type_div').show();
			$('#ent-com_type').val('wp');
		}
		else
		{
			$('#ent-com_type_div').hide();
			$('#ent-com_detail_div').hide();
		}
	});
	$(document).on('change','#ent-com_type',function(){
		if($(this).find('option:selected').val() == 'custom')
		{
			$('#ent-com_detail_div').show();
			$('#ent-com_enable_trash').prop('checked',true);
			$('#ent-com_enable_spam').prop('checked',true);
		}
		else
		{
			$('#ent-com_detail_div').hide();
		}
	});
	$(document).on('change','#ent-rewrite',function(){
		if($(this).find('option:selected').val() == 0)
		{
			$('#ent-rewrite_slug').prop('disabled',true);
		}
		if($(this).find('option:selected').val() == 1)
		{
			$('#ent-rewrite_slug').removeAttr('disabled');
		}
	});
	$(document).on('change','#ent-hierarchical',function(){
		if($(this).find('option:selected').val() == 1)
		{
			$('#ent-page-attributes-div').show();
			$('#ent-parent_item_colon_div').show();
		}
		else
		{
			$('#ent-page-attributes-div').hide();
			$('#ent-parent_item_colon_div').hide();
		}
	});
	$(document).on('click','#ent-advanced-option',function(){
		if($(this).prop('checked'))
		{
			$('#ent-hierarchical-div').show();
			$('#ent-inline-ent_div').show();
			$('#ent-sortable_div').show();
			$('#tabs').show();
		}
		else
		{
			$('#ent-inline-ent_div').hide();
			$('#ent-sortable_div').hide();
			$('#ent-hierarchical-div').hide();
			$('#tabs').hide();
		}
	});
	$(document).on('change','#ent-show_ui',function(){
		if($(this).find('option:selected').val() == 0)
		{
			$('#ent-show_in_menu_div').hide();
			$('#ent-menu_icon_type_div').hide();
			$(this).showEntIcons('');
			$('#ent-menu_position_div').hide();
			$('#ent-top_level_page_div').hide();
		}
		else
		{
			$('#ent-show_in_menu_div').show();
			$('#ent-menu_icon_type_div').show();
			$('#ent-menu_icon_type').val('');
			$('#ent-menu_position_div').show();
			$('#ent-top_level_page_div').show();
		}
	});
	$(document).on('change','#ent-show_in_menu',function(){
		var menu_selected = $(this).find('option:selected').val();
		if(menu_selected == 0)
		{
			$('#ent-menu_icon_type_div').hide();
			$(this).showEntIcons('');
			$('#ent-menu_position_div').hide();
			$('#ent-top_level_page_div').hide();
		}
		else if(menu_selected == 2)
		{
			$('#ent-menu_icon_type_div').show();
			$('#ent-menu_icon_type').val('');
			$(this).showEntIcons('');
			$('#ent-menu_position_div').hide();
			$('#ent-top_level_page_div').show();
		}
		else
		{
			$('#ent-menu_icon_type_div').show();
			$('#ent-menu_icon_type').val('');
			$(this).showEntIcons('');
			$('#ent-menu_position_div').show();
			$('#ent-top_level_page_div').hide();
		}
	});
	$.fn.showEntIcons = function(icon_type){
		switch (icon_type) {
			case 'image':
				$('#ent-menu_icon_div').show();
				$('#ent-menu_icon_fa_div').hide();
				$('#ent-menu_icon_dash_div').hide();
				$('#ent-menu_icon_base64_div').hide();
				$('#ent-menu_icon_base64').val('');
				break;
			case 'fa':
				$('#ent-menu_icon_div').hide();
				$('#ent-menu_icon_fa_div').show();
				$('#ent-menu_icon_dash_div').hide();
				$('#ent-menu_icon_base64_div').hide();
				$('#ent-menu_icon_base64').val('');
				break;
			case 'dash':
				$('#ent-menu_icon_div').hide();
				$('#ent-menu_icon_fa_div').hide();
				$('#ent-menu_icon_dash_div').show();
				$('#ent-menu_icon_base64_div').hide();
				$('#ent-menu_icon_base64').val('');
				break;
			case 'base64':
				$('#ent-menu_icon_div').hide();
				$('#ent-menu_icon_fa_div').hide();
				$('#ent-menu_icon_dash_div').hide();
				$('#ent-menu_icon_base64_div').show();
				break;
			default:
				$('#ent-menu_icon_div').hide();
				$('#ent-menu_icon_fa_div').hide();
				$('#ent-menu_icon_dash_div').hide();
				$('#ent-menu_icon_base64_div').hide();
				$('#ent-menu_icon_base64').val('');
				break;
		}
	}
	$(document).on('change','#ent-menu_icon_type',function(){
		$(this).showEntIcons($(this).val());
	});
});
</script>
<form action="" method="post" id="entity-form" class="form-horizontal">
			<input type="hidden" value="" name="ent" id="ent">
	<fieldset>
		<div class="well">
		<div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("The entity is a person, object, place or event for which data is collected.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a><a title="Go to Entities Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/entities/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
		<div class="field-container">
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-name" id="ent-name" type="text" placeholder="<?php esc_html_e("e.g. product","wp-app-studio"); ?>" value="" >
		<a href="#" title="<?php esc_html_e("General name for the entity, usually singular max. 16 characters, can not contain capital letters,reserved words,dashes or spaces.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e(" Plural","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-label" id="ent-label" type="text" value="" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>"/>
		<a href="#" title="<?php esc_html_e("A plural descriptive name for the entity marked for translation.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Singular","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-singular-label" id="ent-singular-label" type="text" value="" placeholder="<?php esc_html_e("e.g. Product","wp-app-studio"); ?>"/>
		<a href="#" title="<?php esc_html_e("It is the name for one object of this entity.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Description","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="ent-desc" name="ent-desc"></textarea>
		<a href="#" title="<?php esc_html_e("A short descriptive summary of what the entity is.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Show Advanced Options","wp-app-studio"); ?>
		<input name="ent-advanced-option" id="ent-advanced-option" type="checkbox" value="1"/>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-sortable_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable Sortable","wp-app-studio"); ?>
		<input name="ent-sortable" id="ent-sortable" type="checkbox" value="1"/>
		<a href="#" title="<?php esc_html_e("Makes entity drag and drop sortable in admin list page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-inline-ent_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Inline Entity","wp-app-studio"); ?>
		<input name="ent-inline-ent" id="ent-inline-ent" type="checkbox" value="1"/>
		<a href="#" title="<?php esc_html_e("Creates the required configuration to be used in WPAS inline entity connection type. Inline entities can not have custom attributes and only support built-in title and content. Inline entity connection type is used to create attribute mapping for WPAS Inline Entity extension.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<?php wpas_modal_confirm_delete(2); ?>
		<div class="control-group row-fluid" id='ent-hierarchical-div' style="display:none;">
		<label class="control-label"><?php esc_html_e("Hierarchical","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-hierarchical" id="ent-hierarchical" class="input-mini">
		<option selected="selected" value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		<option value="1"><?php esc_html_e("True","wp-app-studio");?></option></select>
		<a href="#" title="<?php esc_html_e("Whether the entity is hierarchical (e.g. page). Allows Parent to be specified.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: False","wp-app-studio"); ?>)
		</div>
		</div>
		</div>
		</div><!--well-->
		<div id="tabs" style="display:none;">
		<ul id="myTab" class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#tabs-1"><?php esc_html_e("Label Options","wp-app-studio"); ?></a></li>
		<li id='tabs-2-li'><a data-toggle="tab" href="#tabs-2"><?php esc_html_e("Messages","wp-app-studio"); ?></a></li>
		<li id='tabs-3-li'><a data-toggle="tab" href="#tabs-3"><?php esc_html_e("Options","wp-app-studio"); ?></a></li>
		<li id='tabs-4-li'><a data-toggle="tab" href="#tabs-4"><?php esc_html_e("Menu Options","wp-app-studio"); ?></a></li>
		<li id='tabs-5-li'><a data-toggle="tab" href="#tabs-5"><?php esc_html_e("Display Options","wp-app-studio"); ?></a></li>
		<li id='tabs-6-li'><a data-toggle="tab" href="#tabs-6"><?php esc_html_e("Comments","wp-app-studio"); ?></a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
		<div class="row-fluid">
		<div class="btn emdt-row emdt-alert"><a data-placement="bottom" href="#" title="<?php esc_html_e("If you are unfamiliar with these labels and leave them empty they will be automatically created based on your entity name and the default configuration.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></div>
		</div>
		<div id="tabs-1" class="tab-pane fade in active">
		<div class="field_groups">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Menu Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-menu_name" id="ent-menu_name" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the menu name text. This string is the name to give menu items. Defaults to value of entity name","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Add New","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-add_new"  id="ent-add_new" type="text" placeholder="<?php esc_html_e("e.g. Add New","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e(" It defines the add new text. The default is Add New for both hierarchical and non-hierarchical entities.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" All Items","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-all_items"  id="ent-all_items" type="text" placeholder="<?php esc_html_e("e.g. All Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the all items text used in the menu. Default is the Name label.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" Add New Item","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-add_new_item"  id="ent-add_new_item" type="text" placeholder="<?php esc_html_e("e.g. Add New Product","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e(" It defines the add new item text. If the entity hierarchical the default is Add New Post otherwise it is Add New Page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" Edit Item","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-edit_item"  id="ent-edit_item" type="text" placeholder="<?php esc_html_e("e.g. Edit Product","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the edit item text. If the entity hierarchical the default is Edit Post otherwise it is Edit Page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" New Item","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-new_item"  id="ent-new_item" type="text" placeholder="<?php esc_html_e("e.g. New Product","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the new item text. If the entity hierarchical the default is New Post otherwise it is New Page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" View Item","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-view_item"  id="ent-view_item" type="text" placeholder="<?php esc_html_e("e.g. View Product","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the view item text. If the entity hierarchical the default is View Post otherwise it is View Page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" Search Items","wp-app-studio"); ?> </label>
		<div class="controls">
		<input class="input-xlarge" name="ent-search_items"  id="ent-search_items" type="text" placeholder="<?php esc_html_e("e.g. Search Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the search items text. If the entity hierarchical the default is Search Post otherwise it is Search Page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" Not Found","wp-app-studio"); ?> </label>
		<div class="controls">
		<input class="input-xlarge" name="ent-not_found"  id="ent-not_found" type="text" placeholder="<?php esc_html_e("e.g. No Products Found","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the not found text. If the entity hierarchical the default is No Post found otherwise it is No Page found.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e(" Not Found in Trash","wp-app-studio"); ?> </label>
		<div class="controls">
		<input class="input-xlarge" name="ent-not_found_in_trash"  id="ent-not_found_in_trash" type="text" placeholder="<?php esc_html_e("e.g. No Products found in Trash","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the not found in trash text. If the entity hierarchical the default is No posts found in Trash otherwise it is No pages found in Trash.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-parent_item_colon_div" style="display:none;">
		<label class="control-label"><?php esc_html_e(" Parent Item:","wp-app-studio"); ?> </label>
		<div class="controls">
		<input class="input-xlarge" name="ent-parent_item_colon"  id="ent-parent_item_colon" type="text" placeholder="<?php esc_html_e("e.g. Parent Product:","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("It defines the parent text. This string is not used on non-hierarchical types. In hierarchical ones the default is Parent.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		</div>
		<div id="tabs-2" class="tab-pane fade">
		<div class="field_groups">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Updated","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_upd" id="ent-msg_upd" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when entity updated.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div id="ent-msg-cust-fields-div">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Custom Field Updated","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_cust_upd" id="ent-msg_cust_upd" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when a custom field is updated. Entity must support custom fields for this message to be displayed.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Custom Field Deleted","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_cust_dlt" id="ent-msg_cust_dlt" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when a custom field is deleted. Entity must support custom fields for this message to be displayed.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Default Updated","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_dflt_upd" id="ent-msg_dflt_upd" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays default entity updated message when no other entity message applicable.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Revision","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_revision" id="ent-msg_revision" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays entity restored to revision from message.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Published","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_published" id="ent-msg_published" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when entity published.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Saved","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_saved" id="ent-msg_saved" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when entity saved.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Pending Submitted","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_pending" id="ent-msg_pending" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when entity pending submitted.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Future Submitted","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_future" id="ent-msg_future" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when entity scheduled to be published in future.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Draft Updated","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-msg_draft" id="ent-msg_draft" type="text" placeholder="<?php esc_html_e("e.g. Products","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Displays when entity draft updated.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		</div> 
		<div id="tabs-3" class="tab-pane fade">
		<div class="field_groups">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Available for Public","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-publicly_viewable" id="ent-publicly_viewable" class="input-mini" >
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Whether this entity is intended to be used publicly either via the admin interface or by front-end users. -false- Entity is not intended to be used publicly and should generally be unavailable in the admin interface and on the front end unless explicitly planned for elsewhere. -true - Entity is intended for public use. This includes on the front end and in the admin interface.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>(<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Has Archive","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-has_archive" id="ent-has_archive" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Enables entity archives. Will use entity name as archive slug by default.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Exclude From Search","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-exclude_from_search" id="ent-exclude_from_search" class="input-mini">
		<option selected="selected" value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		<option value="1"><?php esc_html_e("True","wp-app-studio"); ?></option></select>
		<a href="#" title="<?php esc_html_e("Whether to exclude objects of this entity from front end search results and archives.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: False","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Publicly Queryable","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-publicly_queryable" id="ent-publicly_queryable" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option></select>
		<a href="#" title="<?php esc_html_e("Whether queries can be performed on the front end in the URL address.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Capability Type","wp-app-studio"); ?> </label>
		<div class="controls">
		<select name="ent-capability_type" id="ent-capability_type">
		<option selected="selected" value="post"><?php esc_html_e("Use Post / Page","wp-app-studio"); ?></option>
		<option value="entity_name"><?php esc_html_e("Use Entity Name","wp-app-studio"); ?></option></select>
		<a href="#" title="<?php esc_html_e("The string to use to build the read, edit, and delete capabilities. The default is post. If the hierarchical option is selected default becomes page. If you choose to use ENTITY NAME as type, then you MUST assign its capabilities to a role. Otherwise, you will not be able to access to the entity.","wp-app-studio"); ?>"> <i class="icon-info-sign"></i></a>(<?php esc_html_e("default: post or page","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Rewrite","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-rewrite" id="ent-rewrite" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Triggers the handling of rewrites for this entity. To prevent rewrites, set to false. Default: true and use entity name as slug","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Custom Rewrite Slug","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-rewrite_slug" id="ent-rewrite_slug" type="text" placeholder="<?php esc_html_e("e.g. product","wp-app-studio"); ?>" value=""/>
		<a href="#" title="<?php esc_html_e("Customize the permastruct slug. Max. 16 characters, can not contain capital letters or spaces. Defaults to the entity name.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>(<?php esc_html_e("default: Entity name","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Query Var","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-query-var" id="ent-query-var" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Sets the query_var key for this entity. Default: true - sets to entity. false - Disables query_var key use. A post type cannot be loaded at /?{query_var}={single_post_slug} ","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Can Export","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-can_export" id="ent-can_export" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Can this entity be exported.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Show in rest","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-show_rest" id="ent-show_rest" class="input-mini">
		<option selected="selected" value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		<option value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Whether to expose this entity in the REST API.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: False","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Rest base","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-large" name="ent-rest_base" id="ent-rest_base" type="text" placeholder="<?php esc_html_e("e.g. product","wp-app-studio"); ?>" value=""/>
		<a href="#" title="<?php esc_html_e("The base slug that this entity will use when accessed using the REST API. ","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>(<?php esc_html_e("default: Entity name","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Rest controller class","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-large" name="ent-rest_controller" id="ent-rest_controller" type="text" value="WP_REST_Posts_Controller"/>
		<a href="#" title="<?php esc_html_e("An optional custom controller to use instead of WP_REST_Posts_Controller. Must be a subclass of WP_REST_Controller.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>(<?php esc_html_e("default: WP_REST_Posts_Controller","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Supports","wp-app-studio"); ?></label>
		<div class="controls">
		<label class="checkbox"><input name="ent-supports_title" id="ent-supports_title" type="checkbox" value="1">&nbsp;<?php esc_html_e("Title","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the title entry meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_editor" id="ent-supports_editor" type="checkbox" value="1">&nbsp;<?php esc_html_e("Editor","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the input text area for editor meta box","wp-app-studio"); ?>" /><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_author" id="ent-supports_author" type="checkbox" value="1">&nbsp;<?php esc_html_e("Author","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the author meta box. Use set_author capability in a permission role to display or hide.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_thumbnail" id="ent-supports_thumbnail" type="checkbox" value="1">&nbsp;<?php esc_html_e("Featured Image","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the featured image meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_excerpt" id="ent-supports_excerpt" type="checkbox" value="1">&nbsp;<?php esc_html_e("Excerpt","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds a customized excerpt meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_trackbacks" id="ent-supports_trackbacks" type="checkbox" value="1">&nbsp;<?php esc_html_e("Trackbacks","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the trackbacks meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_custom_fields" id="ent-supports_custom_fields" type="checkbox" value="1">&nbsp;<?php esc_html_e("Custom Fields","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the custom fields meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-supports_revisions" id="ent-supports_revisions" type="checkbox" value="1">&nbsp;<?php esc_html_e("Revisions","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the revisions meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		<div id="ent-page-attributes-div" style="display:none;">
		<label class="checkbox"><input name="ent-supports_page_attributes" id="ent-supports_page_attributes" type="checkbox" value="1">&nbsp;<?php esc_html_e("Page attributes","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the page attribute meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		</div>
		<label class="checkbox"><input name="ent-supports_post_formats" id="ent-supports_post_formats" type="checkbox" value="1">&nbsp;<?php esc_html_e("Post Formats","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds the post format meta box","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Built-in Taxonomies","wp-app-studio"); ?></label>
		<div class="controls">
		<label class="checkbox"><input name="ent-taxonomy_category" id="ent-taxonomy_category" type="checkbox" value="1">&nbsp;<?php esc_html_e("Categories","wp-app-studio"); ?>&nbsp; <a href="#" title="<?php esc_html_e("Enables Built-in Category taxonomy support for the entity. Categories link shows in the entity submenu when enabled.","wp-app-studio"); ?>"> <i class="icon-info-sign"></i></a></label>
		<label class="checkbox"><input name="ent-taxonomy_post_tag" id="ent-taxonomy_post_tag" type="checkbox" value="1">&nbsp;<?php esc_html_e("Tags","wp-app-studio"); ?>&nbsp;
	<a href="#" title="<?php esc_html_e("Enables Built-in Tags taxonomy support. Tags link shows in the entity submenu when enabled.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		</div>
		</div>
		</div>
		</div> 
		<div id="tabs-4" class="tab-pane fade">
		<div class="field_groups">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Show UI","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-show_ui" id="ent-show_ui" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Whether to generate a default UI for managing this entity in the admin area.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-show_in_menu_div">
		<label class="control-label"><?php esc_html_e("Show in Menu","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-show_in_menu" id="ent-show_in_menu" class="input-mini">
		<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
		<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
		<option value="2"><?php esc_html_e("Define Top Level Page","wp-app-studio"); ?></option></select>
		<a href="#" title="<?php esc_html_e("Where to show the entity in the admin menu. Show UI must be true. False - do not display in the admin menu. True - display as a top level menu.","wp-app-studio"); ?>  "><i class="icon-info-sign"></i></a> (<?php esc_html_e("default: True","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-menu_icon_type_div">
		<label class="control-label"><?php esc_html_e("Icon Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-menu_icon_type" id="ent-menu_icon_type">
		<option selected="selected" value=""><?php esc_html_e("Default","wp-app-studio"); ?></option>
		<option value="image"><?php esc_html_e("Image","wp-app-studio"); ?></option>
		<option value="fa"><?php esc_html_e("Font Awesome","wp-app-studio"); ?></option>
		<option value="dash"><?php esc_html_e("Dashicons","wp-app-studio"); ?></option>
		<option value="base64"><?php esc_html_e("Base64 Svg","wp-app-studio"); ?></option></select>
		<a href="#" title="<?php esc_html_e("Sets the type of icon for your entity. You can assign an image, font-awesome, dashicon or base64-encoded SVG icons. If the default icon option is selected, then the pushpin icon is displayed. Dashicon icons can only be used for WordPress Version 3.8+.","wp-app-studio"); ?>  "><i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-menu_icon_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Menu-icon 16x16","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-menu_icon" id="ent-menu_icon" type="text" placeholder="<?php esc_html_e("enter the url of the image including http://","wp-app-studio");?>"/>
		<a href="#" title="<?php esc_html_e("The icon which will be displayed on the menu bar of the entity","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>(<?php esc_html_e("default: Post icon","wp-app-studio"); ?>)
		</div>
		</div>
                <div class="control-group row-fluid" id="ent-menu_icon_fa_div" style="display:none;">
                <label class="control-label req"><?php esc_html_e("Icon Class","wp-app-studio"); ?></label>
                <div class="controls">
                <input class="input-small" name="ent-menu_icon_fa" id="ent-menu_icon_fa" type="text" placeholder="<?php esc_html_e("exp; fa-rocket","wp-app-studio");?>"/>
                <a href="#" title="<?php esc_html_e("Sets the class of the icon which will be displayed on the menu bar of the entity","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
		<a target="_blank" href="<?php echo WPAS_URL . '/articles/supported-icons/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=cheatsheet'; ?>"><?php esc_html_e("Cheatsheet","wp-app-studio");?></a>
                </div>
                </div>
                <div class="control-group row-fluid" id="ent-menu_icon_dash_div" style="display:none;">
                <label class="control-label req"><?php esc_html_e("Icon Class","wp-app-studio"); ?></label>
                <div class="controls">
                <input class="input-small" name="ent-menu_icon_dash" id="ent-menu_icon_dash" type="text" placeholder="<?php esc_html_e("exp; camera","wp-app-studio");?>"/>
                <a href="#" title="<?php esc_html_e("Enter the class of the icon  which will be displayed on the menu bar of the entity. See the dashicon section of the supported icons page by clicking on the cheatsheet link.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
                <a target="_blank" href="<?php echo WPAS_URL . '/articles/supported-icons/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=cheatsheet'; ?>"><?php esc_html_e("Cheatsheet","wp-app-studio");?></a>
                </div>
                </div>															
                <div class="control-group row-fluid" id="ent-menu_icon_base64_div" style="display:none;">
                <label class="control-label req"><?php esc_html_e("Base64 SVG URI","wp-app-studio"); ?></label>
                <div class="controls">
		<textarea id="ent-menu_icon_base64" name="ent-menu_icon_base64" class="wpas-std-textarea"></textarea>
                <a href="#" title="<?php esc_html_e("Enter a base64-encoded SVG using a data URI (Max 20X20 px allowed) which will be displayed on the menu bar of the entity","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
                </div>
                </div>															
		<div class="control-group row-fluid" id="ent-menu_position_div"> 
		<label class="control-label"><?php esc_html_e(" Show Menu Below","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-menu_position" id="ent-menu_position">
		<option value="5"><?php esc_html_e("Posts","wp-app-studio"); ?></option>
		<option value="10"><?php esc_html_e("Media","wp-app-studio"); ?></option>
		<option value="15"><?php esc_html_e("Links","wp-app-studio"); ?></option>
		<option value="20"><?php esc_html_e("Pages","wp-app-studio"); ?></option>
		<option value="25"><?php esc_html_e("Comments","wp-app-studio"); ?></option>
		<option value="60"><?php esc_html_e("First Seperator","wp-app-studio"); ?></option>
		<option value="65"><?php esc_html_e("Plugins","wp-app-studio"); ?></option>
		<option value="70"><?php esc_html_e("Users","wp-app-studio"); ?></option>
		<option value="75"><?php esc_html_e("Tools","wp-app-studio"); ?></option>
		<option value="80"><?php esc_html_e("Settings","wp-app-studio"); ?></option>
		<option value="100"><?php esc_html_e("Second Seperator","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("The position in the menu order the post type should appear.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-display_idx_div">
		<label class="control-label"><?php esc_html_e("Entity Display Index","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-mini" name="ent-display_idx" id="ent-display_idx" type="text" placeholder="0" />
		<a href="#" title="<?php esc_html_e("Sets the position of the entity relative to the other entities in the app. Numbers only. Enter 0 for alphabetical order.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>(<?php esc_html_e("default: 0","wp-app-studio"); ?>)
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-top_level_page_div" style="display:none;">
		<label class="control-label"><?php esc_html_e(" Top level page","wp-app-studio"); ?></label>
		<div class="controls">
		<input name="ent-top_level_page" id="ent-top_level_page" size="5" type="text" placeholder="<?php esc_html_e(" e.g. &#39;plugins.php&#39;","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("If an existing top level page such as 'tools.php' or 'edit.php?post_type=page', the entity will be placed as a sub menu of that.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div> 
		</div> 
		<div id="tabs-5" class="tab-pane fade">
		<div class="field_groups">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Default Group Title","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-default_grp_title" id="ent-default_grp_title" type="text" placeholder="<?php esc_html_e("e.g. Product Info","wp-app-studio"); ?>" value="" >
		<a href="#" title="<?php esc_html_e("Sets the default group title if there is no entity layout defined.","wp-app-studio"); ?>"> <i class="icon-info-sign"></i></a>
		</div>
		</div> 
		</div>
		</div> <!-- end if tab5-->
		<div id="tabs-6" class="tab-pane fade">
		<div class="field_groups">
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><input name="ent-supports_comments" id="ent-supports_comments" type="checkbox" value="1">&nbsp;<?php esc_html_e("Enable Entity Comments","wp-app-studio"); ?>
		<a href="#" title="<?php esc_html_e("Adds custom emd-comment module to your entity. In emd-comments, comments made displayed under entity menu and not mixed with built-in post or page comments.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		</div>
		</div>
		<div class="control-group row-fluid" id="ent-com_type_div" name="ent-com_type_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-com_type" id="ent-com_type">
		<option value="wp"><?php esc_html_e("Built-in","wp-app-studio"); ?></option>
		<option value="custom"><?php esc_html_e("Custom","wp-app-studio");?></option></select>
		<a href="#" title="<?php esc_html_e("You can choose either built-in or custom commenting funtionality. Built-in commenting accumulates comments in Comments menu. Custom commenting creates its own menu item under the menu of your entity and accumulates the recieved comments there.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div id="ent-com_detail_div" name="ent-com_detail_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Display Type","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="ent-com_display_type" id="ent-com_display_type">
		<option value=""><?php esc_html_e("Please Select","wp-app-studio"); ?></option>
		<option value="backend"><?php esc_html_e("Backend Only","wp-app-studio"); ?></option>
		<option value="shc"><?php esc_html_e("Use Shortcode","wp-app-studio");?></option>
		<option value="noshc"><?php esc_html_e("Use Theme Template","wp-app-studio");?></option></select>
		<a href="#" title="<?php esc_html_e("Sets how custom comments are displayed. Use Shortcode - you can use !#shortcode[emd_comments]# code in the single layout view of your entity to display custom comments. Custom comment html, css, and javascript files will be used to display comments. Backend Only - comments are displayed in the admin edit screen of your entity. Use Theme Template - custom comments are displayed using the template(comments.php) your theme provides.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-com_name" id="ent-com_name" type="text" placeholder="<?php esc_html_e("e.g. customer_response","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Create a unique name for your comment subentity. Only alphanumeric and underscore characters allowed.i Limited to 20 characters.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Single Label","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-com_single_label" id="ent-com_single_label" type="text" placeholder="<?php esc_html_e("e.g. Customer Response","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Define a singular name for your comment subentiy.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Plural Label","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="ent-com_plural_label" id="ent-com_plural_label" type="text" placeholder="<?php esc_html_e("e.g. Customer Responses","wp-app-studio"); ?>" value="" />
		<a href="#" title="<?php esc_html_e("Define a plural name for your comment subentiy.","wp-app-studio"); ?> ">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Enable Trash","wp-app-studio"); ?></label>
		<div class="controls">
		<label class="checkbox"><input name="ent-com_enable_trash" id="ent-com_enable_trash" type="checkbox" value="1" checked>
		<a href="#" title="<?php esc_html_e("When enabled it allows to move your comment subentity records to trash.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Enable Spam","wp-app-studio"); ?></label>
		<div class="controls">
		<label class="checkbox"><input name="ent-com_enable_spam" id="ent-com_enable_spam" type="checkbox" value="1" checked>
		<a href="#" title="<?php esc_html_e("When enabled it allows to move your comment subentity records to spam.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></label>
		</div>
		</div>
		</div><!-- end of detail div-->
		</div>
		</div><!-- end of tab6-->
		</div>
		</div>
		<div class="control-group emdt-row">
		<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
		<button class="btn btn-inverse layout-buttons" id="save-entity" type="submit" value="Save"><i class="icon-save"></i>
		<?php esc_html_e("Save","wp-app-studio"); ?></button>
		</div>
	</fieldset>
	</form>
<?php
}
function wpas_view_entity($ent,$ent_id)
{
	$style = "";
	if(in_array($ent['ent-name'],Array('post','page')))
	{ 
		$style = 'style="display:none;"';
	}
	$ret = '<div class="well form-horizontal">
		<div class="row-fluid">
		<button class="btn  btn-danger pull-left" id="cancel" name="cancel" type="button">
		<i class="icon-off"></i>' . __("Close","wp-app-studio") . '</button>
		<div class="entity">'; 
	$ret .= '<button class="btn btn-primary pull-right" id="edit-entity" name="Edit" type="submit" href="#' . esc_attr($ent_id) . '" ' . $style . '>
		<i class="icon-edit"></i>' . __("Edit","wp-app-studio") . '</button>';
	$ret .= '</div>
		</div>
		<fieldset>
		<div class="control-group row-fluid">
		<label class="control-label">' . __("Name","wp-app-studio") . '</label>
		<div class="controls"><span id="ent-name" class="input-xlarge uneditable-input">' . esc_html($ent['ent-name']) . '</span>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label">' . __("Plural","wp-app-studio") . '</label>
		<div class="controls"><span id="ent-label" class="input-xlarge uneditable-input">' . esc_html($ent['ent-label']) . '</span>
		</div>
		</div>
		</fieldset>
		</div>';
	return $ret;
}
?>
