<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_taxonomy_form()
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(document).on('click','#txn-is_conditional',function(){
		$('.cond-value').hide();
		$('.cond-value').val('');
		if($(this).prop('checked')){
			app_id = $('input#app').val();
			ent_id = $('#txn-attach').find('option:selected').val();
			txn_id = $('input#txn').val();
			$('#txn-conditional-options').show();
			$('#txn-cond_case').val('show');
			$('#txn-cond_type').val('all');
			$.get(ajaxurl,{action:'wpas_get_cond_div',app_id:app_id,ent_id:ent_id,div_id:1,val_type:'none',from:'txn',field_id:txn_id}).done(function (response){
				$('#txn-cond-list').append(response);
			});
		}
		else {
			$('#txn-conditional-options').hide();
		}
	});
	$(document).on('click','#txn-inline',function(){
		app_id = $('input#app').val();
		if($(this).prop('checked')){
			$(this).setInline('inline',app_id,'');
		}
		else {
			$(this).setInline('notinline',app_id,'');
		}
	});
	$.fn.setInline = function (type,app_id){
		if(type == 'inline')
		{
			$('#txn-srequired-div').hide();
			$('#txn-required-div').hide();
			$('#mytxnTab a:first').tab('show');
			$('#txntabs-2-li').hide();
			$('#txntabs-2').removeClass('active');
			if(app_id != ''){
				$.get(ajaxurl,{action:'wpas_get_entities',type:'inline_tax',app_id:app_id}, function(response)
				{
					$('#add-taxonomy-div #txn-attach').html(response);
				});
			}
		}
		else {
			$('#txn-srequired-div').show();
			$('#txn-required-div').show();
			$('#mytxnTab a:first').tab('show');
			$('#txntabs-2-li').show();
			if(app_id != ''){
				$.get(ajaxurl,{action:'wpas_get_entities',type:'taxonomy',app_id:app_id}, function(response)
				{
					$('#add-taxonomy-div #txn-attach').html(response);
				});
			}
		}
	}
	$(document).on('change','#txn-hierarchical',function(){
		if($(this).find('option:selected').val() == 1)
		{
			$('#txn-parent_item_div').show();
			$('#txn-parent_item_colon_div').show();
			$('#txn-separate_items_with_comas_div').hide();
			$('#txn-add_or_remove_items_div').hide();
			$('#txn-choose_from_most_used_div').hide();
                }
                else
                {
                        $('#txn-parent_item_div').hide();
                        $('#txn-parent_item_colon_div').hide();
			$('#txn-separate_items_with_comas_div').show();
			$('#txn-add_or_remove_items_div').show();
			$('#txn-choose_from_most_used_div').show();
                }
	});
	$(document).on('click','#txn-advanced-option',function(){
                if($(this).prop('checked'))
                {
			$('#txntabs').show();
			$('#mytxnTab a:first').tab('show');
			$('#txntabs-2').removeClass('fade active');
			$('#txntabs-1').addClass('active');
                }
                else
                {
                        $('#txntabs').hide();
                }
        });
	$(document).on('change','#txn-show_ui',function(){
		if($(this).find('option:selected').val() == 1)
		{
                        $('#txn-show-in-menu-div').show();
                        $('#txn-show-in-nav-menus-div').show();
                }
                else
                {
                        $('#txn-show-in-menu-div').hide();
                        $('#txn-show-in-nav-menus-div').hide();
                }
        });
	$(document).on('change','#txn-rewrite',function(){
		if($(this).find('option:selected').val() == 0)
                {
                        $('#txn-custom_rewrite_slug').prop('disabled',true);
                }
                if($(this).find('option:selected').val() == 1)
                {
                        $('#txn-custom_rewrite_slug').removeAttr('disabled');
                }
        });
});
</script>
<form action="" method="post" id="taxonomy-form" class="form-horizontal">
			<input type="hidden" value="" name="txn" id="txn">
        	<fieldset>
<div class="well">
		<div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("A taxonomy is a way to group things together. It might contain only one attribute of interest to users.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a><a title="Go to Taxonomies Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/custom-taxonomies/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
                <div class="control-group row-fluid">
						<label class="control-label req"><?php esc_html_e("Name","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-name" id="txn-name" type="text" placeholder="<?php esc_html_e("e.g. product_tag","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e(" General name for the taxonomy, usually singular. Name should be in slug form (must not contain capital letters or spaces or reserved words) and not more than 32 characters long. Previously used entity or taxonomy names are not allowed. Dashes and underscores are allowed.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                </div>
                <div class="control-group row-fluid">
						<label class="control-label req"><?php esc_html_e("Plural","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-label" id="txn-label" type="text" placeholder="<?php esc_html_e("e.g. Product Tags","wp-app-studio"); ?>"> <a href="#" title="<?php esc_html_e("Taxonomy label.  Used in the admin menu for displaying custom taxonomy.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Singular","wp-app-studio"); ?></label>
                    <div class="controls">
                    <input class="input-xlarge" name="txn-singular-label" id="txn-singular-label" type="text" placeholder="<?php esc_html_e("e.g. Product Tag","wp-app-studio"); ?>">
                    <a href="#" title="<?php esc_html_e("Taxonomy Singular label. Used when a singular label is needed.","wp-app-studio"); ?>" >
                    <i class="icon-info-sign"></i></a>
                    </div>
                </div>
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable Sortable","wp-app-studio"); ?>
		<input name="txn-sortable" id="txn-sortable" type="checkbox" value="1"/>
		<a href="#" title="<?php esc_html_e("Makes taxonomy drag and drop sortable in admin list page.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Inline Taxonomy","wp-app-studio"); ?>
		<input name="txn-inline" id="txn-inline" type="checkbox" value="1"/>
		<a href="#" title="<?php esc_html_e("Creates the required configuration to be used in WPAS inline entity connection type. Inline taxonomies can be shared by multiple inline entities. Inline entity connection type is used to create attribute mapping for WPAS Inline Entity extension.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Description","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="txn-tax_desc" name="txn-tax_desc"></textarea>
		<a href="#" title="<?php esc_html_e("A short, optional descriptive summary of what the taxonomy is. It will be displayed in the front-end forms if the taxonomy is used in a form layout. Leave it blank if you do not need help text for your taxonomy. Max 500 chars.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
				<div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Attach to Entity","wp-app-studio"); ?></label>
                    <div class="controls">
<select id="txn-attach" name="txn-attach[]" multiple="multiple">
</select><a href="#" title="<?php esc_html_e("Select one or more entities your taxonomy will be attached to.","wp-app-studio"); ?>" > <i class="icon-info-sign"></i></a>
					</div>
                </div>
	<div class="control-group row-fluid" id='txn-required-div'>
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Required for Submit","wp-app-studio"); ?>
			<input name="txn-required" id="txn-required" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the taxonomy required. When you set a taxonomy required, users must assign at least one taxonomy value when they create an entity record.","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group row-fluid" id='txn-srequired-div'>
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Required for Search","wp-app-studio"); ?>
			<input name="txn-srequired" id="txn-srequired" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the taxonomy required. When you set a taxonomy required, users must assign at least one taxonomy value when they search entity records using the taxonomy.","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group" id="txn-list-visible-div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Visible in Admin List","wp-app-studio");?>
            <input name="txn-list_visible" id="txn-list_visible" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Makes the taxonomy visible in admin list page of the entity.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
				<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Hierarchical","wp-app-studio"); ?></label>
			<div class="controls">
				<select name="txn-hierarchical" id="txn-hierarchical" class="input-mini">
					<option value="0" selected="selected"><?php esc_html_e("False","wp-app-studio"); ?></option>
					<option value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
				</select> <a href="#" title="<?php esc_html_e("Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.","wp-app-studio"); ?>" >
				<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: False","wp-app-studio"); ?>)
			</div>
		</div>
				<div class="control-group row-fluid">
			<label class="control-label"><?php esc_html_e("Display Type","wp-app-studio"); ?></label>
			<div class="controls">
				<select name="txn-display_type" id="txn-display_type" class="input-xlarge">
					<option value="multi" selected="selected"><?php esc_html_e("Multiple Select","wp-app-studio"); ?></option>
					<option value="single"><?php esc_html_e("Single Select","wp-app-studio"); ?></option>
				</select> <a href="#" title="<?php esc_html_e("Set to allow single or multiple taxonomy value entry.","wp-app-studio"); ?>" >
				<i class="icon-info-sign"></i></a> (<?php esc_html_e("default: Multiple Select","wp-app-studio"); ?>)
			</div>
		</div>
        <div class="control-group row-fluid" id="txn-values_div" >
        <label class="control-label"><?php esc_html_e("Values","wp-app-studio");?></label>
        <div class="controls">
        <textarea id="txn-values" name="txn-values" class="wpas-std-textarea" placeholder="e.g. blue{color blue}[color];red{color red}[color];white{color white}[color]" ></textarea>
        <a href="#" title="<?php esc_html_e("Enter semicolon separated option values for the taxonomy. There must be only one semicolon between the values. Optiopnally Term descriptions and term parent can be entered using term{term-description}[term-parent] format. For example; Monkey{Monkey is a funny animal}[Animal]","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
</div>
        <div class="control-group row-fluid" id="txn-dflt_value_div" name="txn-dflt_value_div">
                        <label class="control-label"><?php esc_html_e("Default Value","wp-app-studio");?></label>
                        <div class="controls">
                        <input class="input-xlarge" name="txn-dflt_value" id="txn-dflt_value" type="text" placeholder="" value="" >
                        <a href="#" title="<?php esc_html_e("Sets the default value or values separated by a semicolon for the taxonomy.","wp-app-studio");?>">
                        <i class="icon-info-sign"></i></a>
                        </div>
        </div>
	<div class="control-group" id="txn-enable_conditional_div" name="txn-enable_conditional_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Enable Conditional Logic","wp-app-studio");?>
            <input name="txn-is_conditional" id="txn-is_conditional" type="checkbox" value="1"/>
			<a href="#" title="<?php esc_html_e("Applies conditional branching when enabled.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div id="txn-conditional-options" class="control-group row-fluid" style="display:none;">
	<label class="control-label"><?php esc_html_e("Conditional Logic","wp-app-studio");?></label>
	<div class="controls">  
	<div id="txn-cond">
	<div class="control-group row-fluid">
			<div class="controls span12">
			<select name="txn-cond_case" id="txn-cond_case" class="input-small">
			<option value="show"><?php esc_html_e('Show','wp-app-studio');?></option>
			<option value="hide"><?php esc_html_e('Hide','wp-app-studio');?></option></select>
			<?php esc_html_e('This Taxonomy If','wp-app-studio'); ?>&nbsp;
			<select name="txn-cond_type" id="txn-cond_type" class="input-small">
			<option value="all"><?php esc_html_e('All','wp-app-studio');?></option>
			<option value="any"><?php esc_html_e('Any','wp-app-studio');?></option></select>
			<?php esc_html_e('of the below match:','wp-app-studio'); ?>
			</div>
	</div>
	<div id="txn-cond-list">
	</div>
	</div>
	</div>
	</div>
		<div class="control-group row-fluid">
		<label class="control-label"></label>
		<div class="controls"><label class="checkbox"><?php esc_html_e("Show Advanced Options","wp-app-studio"); ?>
		<input name="txn-advanced-option" id="txn-advanced-option" type="checkbox" value="1"/>
		</label>
		</div>
		</div>    
</div>
    <div id="txntabs" style="display:none;">
                <ul id="mytxnTab" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#txntabs-1"><?php esc_html_e("Label Options","wp-app-studio"); ?></a></li>
                        <li id="txntabs-2-li"><a data-toggle="tab" href="#txntabs-2" ><?php esc_html_e("Options","wp-app-studio"); ?></a></li>
                </ul>
        <div id="mytxnTabContent" class="tab-content">
           <div class="row-fluid"><div class="btn emdt-row emdt-alert"><a data-placement="bottom" href="#" title="<?php esc_html_e("If you are unfamiliar with these labels and leave them empty they will be automatically created based on your taxonomy name and the default configuration.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a></div></div>
            <div id="txntabs-1" class="tab-pane fade in active">
		<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Menu Name","wp-app-studio"); ?></label>
	<div class="controls">
	<input class="input-xlarge" name="txn-menu_name" id="txn-menu_name" type="text" placeholder="<?php esc_html_e("e.g. Product Tags","wp-app-studio"); ?>">
	<a href="#" title="<?php esc_html_e("It defines the menu name text. This string is the name to give menu items. Defaults to value of taxonomy name.","wp-app-studio"); ?> ">
	<i class="icon-info-sign"></i></a>
	</div>
 </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Search Items","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-search_items"  id="txn-search_items" type="text" placeholder="<?php esc_html_e("e.g. Search Product Tags","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Search Items. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
					</div>
					<div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Popular Items","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-popular_items" id="txn-popular_items" type="text" placeholder="<?php esc_html_e("e.g. Popular Product Tags","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Popular Items. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
                    	</div>
                    </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("All Items","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-all_items" id="txn-all_items" type="text" placeholder="<?php esc_html_e("e.g. All Product Tags","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for All Items. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                    <div class="control-group row-fluid" id="txn-parent_item_div" style="display:none;">
						<label class="control-label"><?php esc_html_e("Parent Item","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-parent_item" id="txn-parent_item" type="text" placeholder="<?php esc_html_e("e.g. Parent Product Tag","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Parent Item. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                    <div class="control-group row-fluid" id="txn-parent_item_colon_div" style="display:none;">
						<label class="control-label"><?php esc_html_e("Parent Item:","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-parent_item_colon" id="txn-parent_item_colon" type="text" placeholder="<?php esc_html_e("e.g. Parent Product Tag:","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Parent Item:. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
					<div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Edit Item","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-edit_item" id="txn-edit_item" type="text" placeholder="<?php esc_html_e("e.g. Edit Product Tag","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Edit Item. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Update Item","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-update_item" id="txn-update_item" type="text" placeholder="<?php esc_html_e("e.g. Update Product Tag","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Update Item. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Add New Item","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-add_new_item" id="txn-add_new_item" type="text" placeholder="<?php esc_html_e("e.g. Add New Product Tag","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Add New Item. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("New Item Name","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-new_item_name" id="txn-new_item_name" type="text" placeholder="<?php esc_html_e("e.g. New Product Tag Name","wp-app-studio"); ?>">
						 <a href="#" title="<?php esc_html_e("Custom taxonomy label for New Item Name. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
					<div class="control-group row-fluid" id="txn-separate_items_with_comas_div">
						<label class="control-label"><?php esc_html_e("Separate Items with Commas","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-separate_items_with_comas" id="txn-separate_items_with_comas" type="text" placeholder="<?php esc_html_e("e.g. Separate product tags with commas","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Separate Items with Commas. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                    <div class="control-group row-fluid" id="txn-add_or_remove_items_div">
						<label class="control-label"><?php esc_html_e("Add or Remove Items","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-add_or_remove_items" id="txn-add_or_remove_items" type="text" placeholder="<?php esc_html_e("e.g. Add or remove product tags","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Add or Remove Items. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
            <div class="control-group row-fluid" id="txn-choose_from_most_used_div">
						<label class="control-label"><?php esc_html_e("Choose From Most Used","wp-app-studio"); ?></label>
						<div class="controls">
						<input class="input-xlarge" name="txn-choose_from_most_used" id="txn-choose_from_most_used" type="text" placeholder="<?php esc_html_e("e.g. Choose from the most used product tags","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Custom taxonomy label for Choose From Most Used. Used in the admin menu for displaying taxonomies.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>
						</div>
                    </div>
                </div>
		<div id="txntabs-2" class="tab-pane fade">
<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Available for Public","wp-app-studio"); ?></label>
	<div class="controls">
	<select name="txn-public" id="txn-public" class="input-mini" >
	<option selected="selected" value="1"><?php esc_html_e("True","wp-app-studio"); ?></option>
	<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Whether this taxonomy is intended to be used publicly either via the admin interface or by front-end users. -false- Taxonomy is not intended to be used publicly and should generally be unavailable in in the admin interface and on the front end unless explicitly planned for elsewhere. -true - Taxonomy is intended for public use. This includes on the front end and in the admin interface.","wp-app-studio"); ?>">
	<i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
	</div>
                                        </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Show UI","wp-app-studio"); ?></label>
						<div class="controls">
							<select name="txn-show_ui" id="txn-show_ui" class="input-mini">
								<option value="1" selected="selected"><?php esc_html_e("True","wp-app-studio"); ?></option>
								<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
							</select> <a href="#" title="<?php esc_html_e("Whether to generate a default UI for managing this taxonomy.","wp-app-studio"); ?>" >
							<i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
						</div>
                    </div>
                    <div class="control-group row-fluid" id="txn-show-in-menu-div">
						<label class="control-label"><?php esc_html_e("Show In Menu","wp-app-studio"); ?></label>
						<div class="controls">
							<select name="txn-show_in_menu" id="txn-show_in_menu" class="input-mini">
								<option value="1" selected="selected"><?php esc_html_e("True","wp-app-studio"); ?></option>
								<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
							</select> <a href="#" title="<?php esc_html_e("Display taxonomy in the admin menu below the entity it is registered to.","wp-app-studio"); ?>" >
							<i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
						</div>
                    </div>
                    <div class="control-group row-fluid" id="txn-show-in-nav-menus-div">
						<label class="control-label"><?php esc_html_e("Show In Navigation Menus","wp-app-studio"); ?></label>
						<div class="controls">
							<select name="txn-show_in_nav_menus" id="txn-show_in_nav_menus" class="input-mini">
								<option value="1" selected="selected"><?php esc_html_e("True","wp-app-studio"); ?></option>
								<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
							</select> <a href="#" title="<?php esc_html_e("True makes this taxonomy available for selection in navigation menus under Appearance > Menus link.","wp-app-studio"); ?>" >
							<i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
						</div>
                    </div>
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Show In Tag Clouds","wp-app-studio"); ?></label>
						<div class="controls">
							<select name="txn-show_tagcloud" id="txn-show_tagcloud" class="input-mini">
								<option value="1" selected="selected"><?php esc_html_e("True","wp-app-studio"); ?></option>
								<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
							</select> <a href="#" title="<?php esc_html_e("Whether to allow the Tag Cloud widget to use this taxonomy.","wp-app-studio"); ?>" >
							<i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
						</div>
                    </div>                    
                    <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Query Var","wp-app-studio"); ?></label>
						<div class="controls">
							<select name="txn-query_var" id="txn-query_var" class="input-mini">
								<option value="1" selected="selected"><?php esc_html_e("True","wp-app-studio"); ?></option>
								<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
							</select>
							<a href="#" title="<?php esc_html_e("False to disable the query_var, set as string to use custom query_var instead of default which is the taxonomy's name.","wp-app-studio"); ?>" >
							<i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
						</div>
                    </div>
 					<div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Rewrite","wp-app-studio"); ?></label>
						<div class="controls">
							<select name="txn-rewrite" id="txn-rewrite" class="input-mini">
								<option value="1" selected="selected"><?php esc_html_e("True","wp-app-studio"); ?></option>
								<option value="0"><?php esc_html_e("False","wp-app-studio"); ?></option>
							</select>
							<a href="#" title="<?php esc_html_e("Set to false to prevent automatic URL rewriting a.k.a. pretty permalinks.","wp-app-studio"); ?>" ><i class="icon-info-sign"></i></a> (<?php esc_html_e("default:True","wp-app-studio"); ?>)
						</div>
                    </div>
             <div class="control-group row-fluid">
						<label class="control-label"><?php esc_html_e("Custom Rewrite Slug","wp-app-studio"); ?></label>
						<div class="controls">
						<input name="txn-custom_rewrite_slug" id="txn-custom_rewrite_slug" type="text" placeholder="<?php esc_html_e("e.g. product_tags","wp-app-studio"); ?>">
						<a href="#" title="<?php esc_html_e("Used as pretty permalink text (i.e. /tag/) - defaults to taxonomy's name slug.","wp-app-studio"); ?>" >
						<i class="icon-info-sign"></i></a>(<?php esc_html_e("default: taxonomy name","wp-app-studio"); ?>)
						</div>
                    </div>
            </div>
     	</div>
	</div>
					<div class="control-group emdt-row">
					   <button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button">
					   <i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
					   <button class="btn btn-inverse layout-buttons" id="save-taxonomy" type="submit" value="Save">
					   <i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio"); ?></button>
                	</div>
		</fieldset>
	</form>
<?php
}
?>
