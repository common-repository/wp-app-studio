<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    function wpas_add_relationship_form($app_id)
    {
        ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(document).on('click','#rel-is_conditional',function(){
		$('.cond-value').hide();
		$('.cond-value').val('');
		if($(this).prop('checked')){
			app_id = $('input#app').val();
			if($('#rel-from-name').val() != 'user'){
				ent_id = $('#rel-from-name').val();
				if($('#rel-to-name').val() != 'user'){
					relto_ent_id = $('#rel-to-name').val();
				}
			}
			else {
				ent_id = $('#rel-to-name').val();
				relto_ent_id = '';
			}
			$('#rel-conditional-options').show();
			$('#rel-cond_case').val('show');
			$('#rel-cond_type').val('all');
			$.get(ajaxurl,{action:'wpas_get_cond_div',app_id:app_id,ent_id:ent_id,div_id:1,val_type:'none',from:'rel',relto_ent_id:relto_ent_id}).done(function (response){
				$('#rel-cond-list').append(response);
			});
		}
		else {
			$('#rel-conditional-options').hide();
		}
	});
	$.fn.showRelTags = function (app_id,comp_id,div_id,rel_id){
		$.get(ajaxurl,{action:'wpas_get_layout_tags',type:'rel',app_id:app_id,comp_id:comp_id,rel_id:rel_id}, function(response){
			$('#'+div_id).html(response);
			$('#'+div_id).show();
		});
	}
	$(document).on('click','#rel-con-from-tags-div .btn',function(){
		if($('#rel-con-from-tags').is(":visible")){
			$('#rel-con-from-tags-div .tags-collapse').hide();
		}
		else {
			app_id = $('input#app').val();
			rel_id = $('input#rel').val();
			comp_id_to = $('#rel-to-name').val();
			if(comp_id_to){
				$(this).showRelTags(app_id,comp_id_to,'rel-con-from-tags',rel_id);
			}
			else {
				$('#rel-con-from-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
				$('#rel-con-from-tags').show();
			}
		}
	});
	$(document).on('click','#rel-con-to-tags-div .btn',function(){
		if($('#rel-con-to-tags').is(":visible")){
			$('#rel-con-to-tags-div .tags-collapse').hide();
		}
		else {
			app_id = $('input#app').val();
			rel_id = $('input#rel').val();
			comp_id_from = $('#rel-from-name').val();
			if(comp_id_from){
				$(this).showRelTags(app_id,comp_id_from,'rel-con-to-tags',rel_id);
			}
			else {
				$('#rel-con-to-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
				$('#rel-con-to-tags').show();
			}
		}
	});
	$(document).on('click','#rel-rltd-from-tags-div .btn',function(){
		if($('#rel-rltd-from-tags').is(":visible")){
			$('#rel-rltd-from-tags-div .tags-collapse').hide();
		}
		else {
			app_id = $('input#app').val();
			rel_id = $('input#rel').val();
			comp_id_from = $('#rel-from-name').val();
			if(comp_id_from){
				$(this).showRelTags(app_id,comp_id_from,'rel-rltd-from-tags',rel_id);
			}
			else {
				$('#rel-rltd-from-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
				$('#rel-rltd-from-tags').show();
			}
		}
	});
	$(document).on('click','#rel-rltd-to-tags-div .btn',function(){
		if($('#rel-rltd-to-tags').is(":visible")){
			$('#rel-rltd-to-tags-div .tags-collapse').hide();
		}
		else {
			app_id = $('input#app').val();
			rel_id = $('input#rel').val();
			comp_id_to = $('#rel-to-name').val();
			if(comp_id_to){
				$(this).showRelTags(app_id,comp_id_to,'rel-rltd-to-tags',rel_id);
			}
			else {
				$('#rel-rltd-to-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
				$('#rel-rltd-to-tags').show();
			}
		}
	});
	$(document).on('click','#rel-connected-display',function(){
		if($(this).prop('checked'))
		{
			$('#reltabs-2-li').show();
			app_id = $('input#app').val();
			rel_id = $('input#rel').val();
			comp_id_from = $('#rel-from-name').val();
			comp_id_to = $('#rel-to-name').val();
			$('.tags-collapse').hide();
			if($('#rel-reciprocal').prop('checked')){
				$('#rel-connected-to-div').hide();
			}
			else {	
				$('#rel-connected-to-div').show();
			}
			$(this).addCodeMirror([],'rel-con');
		}
		else
		{
			$('#reltabs-2-li').hide();
			$('#relTab a:first').tab('show');
		}
        });
	$(document).on('click','#rel-related-display',function(){
		if($(this).prop('checked'))
		{
			$('#reltabs-3-li').show();
			app_id = $('input#app').val();
			rel_id = $('input#rel').val();
			comp_id_from = $('#rel-from-name').val();
			comp_id_to = $('#rel-to-name').val();
			$('.tags-collapse').hide();
			$(this).addCodeMirror([],'rel-rel');
		}
		else
		{
			$('#reltabs-3-li').hide();
			$('#relTab a:first').tab('show');
		}
        });
	$(document).on('change','#rel-type',function(){
		$('.tags-collapse').hide();
		if($(this).val() == 'many-to-many')
                {
			$('#rel-related-display-div').show();
                }
                else
                {
			$('#rel-related-display-div').hide();
                }
	});
	$(document).on('click','#rel-reciprocal',function(){
		$('#rel-connected-to-div').hide();
	});	
	$(document).on('change','#rel-from-name,#rel-to-name',function(){
		$('.tags-collapse').hide();
		if($('#rel-from-name').val() == $('#rel-to-name').val()){
			$('#rel-reciprocal-div').show();
		}
		else {
			$('#rel-reciprocal-div').hide();
		}
		if($('#rel-from-name').val() == 'user' || $('#rel-to-name').val() == 'user')
		{
			$('#rel-limit_user_relationship_role_div').show();
		}
		else
		{
			$('#rel-limit_user_relationship_role_div').hide();
		}
	});
});
</script>
        <form action="" method="post" id="relationship-form" class="form-horizontal">
        <fieldset>
	<input type="hidden" id="app" name="app" value="">
        <input type="hidden" value="" name="rel" id="rel">
        <div class="well">
        <div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("Relationships are connections between entities. You can create one-to-many(1-M), many-to-many(M-M) relationships. Each relationship may have one to many attributes.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Relationships Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/relationships/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
        <div class="control-group row-fluid">
        <label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-name" id="rel-name" type="text" placeholder="<?php esc_html_e("orders_products","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Relationship name should be in slug form (must not contain capital letters or spaces) and not more than 32 characters long. Previously used relationship names are not allowed. Underscores are allowed.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a></div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label req"><?php esc_html_e("From Entity Name","wp-app-studio");?></label>
        <div class="controls">
        <select id="rel-from-name" name="rel-from-name">
        </select>
        <a href="#" title="<?php esc_html_e("FROM entity is the related entity in a relationship. Many entity instances from the related entity can reference any one entity instance from the primary entity.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a></div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label req"><?php esc_html_e("To Entity Name","wp-app-studio");?></label>
        <div class="controls">
        <select id="rel-to-name" name="rel-to-name">
        </select>
        <a href="#" title="<?php esc_html_e("- To entity - is the primary entity in a relationship. Any one entity instance from the primary entity can be referenced by many entity instances from the related entity.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a></div>
        </div>
	<div class="control-group" id="rel-reciprocal-div" style="display:none;">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Reciprocal","wp-app-studio");?>
			<input name="rel-reciprocal" id="rel-reciprocal" type="checkbox" value="1"/>
			<a href="#"  title="<?php esc_html_e("Used in self-relationships where the connections are shared. For example, in a reciprocal friendship relationship, from one person to another, from and to side of the connection is not important. When implemented, only one metabox shows in Person entity edit screen. If you connect Person A to Person B, both share the same connection. Once you create a connection at the Person A side, you do not need to create the same connection at the Person B side. In other words, if Person A is a friend of Person B, Person B is also assumed to be a friend of Person A. When reciprocal is NOT set, WPAS allows to use -from- and -to- relationship tags in view layouts.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="rel-limit_user_relationship_role_div" style="display: none;">
	<label class="control-label"><?php esc_html_e("Limit By Role","wp-app-studio"); ?></label>
	<div class="controls">
	<select name="rel-limit_user_relationship_role" id="rel-limit_user_relationship_role">
	<option selected="selected" value="false"><?php esc_html_e("Do not limit","wp-app-studio"); ?></option>
	<option value="editor"><?php esc_html_e("Only Editors can be related","wp-app-studio"); ?></option>
	<option value="author"><?php esc_html_e("Only Author can be related","wp-app-studio"); ?></option>
	<option value="contributor"><?php esc_html_e("Only Contributor can be related","wp-app-studio"); ?></option>
	<option value="subscriber"><?php esc_html_e("Only Subscriber can be related","wp-app-studio"); ?></option>
	<option value="administrator"><?php esc_html_e("Only Administrator can be related","wp-app-studio"); ?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Limits the relationship to the group of users who belong to the selected role. Builtin roles: Super Admin - Someone with access to the blog network administration features controlling the entire network (See Create a Network). Administrator - Somebody who has access to all the administration features. Editor - Somebody who can publish and manage posts and pages as well as manage other users's posts, etc. Author - Somebody who can publish and manage their own posts. Contributor - Somebody who can write and manage their posts but not publish them. Subscriber - Somebody who can only manage their profile. If you predefined custom roles, you can select them as well. You can create multiple user relationships with the same entity and limit them by different roles. User to User relationships are not allowed.","wp-app-studio"); ?>" >
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Description","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-desc" name="rel-desc"></textarea>
	<a href="#"  title="<?php esc_html_e("A short descriptive summary of what the relationship is.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Required for Submit","wp-app-studio");?>
			<input name="rel-required" id="rel-required" type="checkbox" value="1"/>
			<a href="#"  title="<?php esc_html_e("Makes the relationship required when entering data using this relationship so it can not be blank.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Required for Search","wp-app-studio");?>
			<input name="rel-srequired" id="rel-srequired" type="checkbox" value="1"/>
			<a href="#"  title="<?php esc_html_e("Makes the relationship required when searching data using this relationship so it can not be blank.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div class="control-group">
    <label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Allow Duplicates","wp-app-studio");?>
			<input name="rel-allow_dupes" id="rel-allow_dupes" type="checkbox" value="1"/>
			<a href="#"  title="<?php esc_html_e("Allows to create multiple connections between two entity records. By default if this option is not set, after you connect record A to record B, record B disappears from the list of candidate records.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
        <div class="control-group row-fluid">
        <label class="control-label req"><?php esc_html_e("Type","wp-app-studio");?></label>
        <div class="controls">
        <select name="rel-type" id="rel-type">
        <option selected="selected" value="one-to-many"><?php esc_html_e("One-to-Many","wp-app-studio");?></option>
        <option value="many-to-one"><?php esc_html_e("Many-to-One","wp-app-studio");?></option>
        <option value="many-to-many"><?php esc_html_e("Many-to-Many","wp-app-studio");?></option>
        <option value="one-to-one"><?php esc_html_e("One-to-One","wp-app-studio");?></option>
        </select><a href="#" title="<?php esc_html_e("Pick the type of relationship between TO and FROM entity. In a one-to-many relationship, each record in the related to entity can be related to many records in the relating entity. For example, in a customer to an invoice relationship each customer can have many invoices but each invoice can only be generated for a single customer. In a many-to-many relationship, one or more records in a entity can be related to 0, 1 or many records in another entity. For example, Each customer can order many products and each product can be ordered by many customers.","wp-app-studio");?>" > <i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group" id="rel-enable_conditional_div" name="rel-enable_conditional_div">
    	<label class="control-label"></label>
	<div class="controls">
			<label class="checkbox"><?php esc_html_e("Enable Conditional Logic","wp-app-studio");?>
            <input name="rel-is_conditional" id="rel-is_conditional" type="checkbox" value="1"/>
			<a href="#"  title="<?php esc_html_e("Applies conditional branching when enabled.","wp-app-studio");?>">
			<i class="icon-info-sign"></i></a>
			</label>
	</div>
	</div>
	<div id="rel-conditional-options" class="control-group row-fluid" style="display:none;">
	<label class="control-label"><?php esc_html_e("Conditional Logic","wp-app-studio");?></label>
	<div class="controls">  
	<div id="rel-cond">
	<div class="control-group row-fluid">
			<div class="controls span12">
			<select name="rel-cond_case" id="rel-cond_case" class="input-small">
			<option value="show"><?php esc_html_e('Show','wp-app-studio');?></option>
			<option value="hide"><?php esc_html_e('Hide','wp-app-studio');?></option></select>
			<?php esc_html_e('This Relationship If','wp-app-studio'); ?>&nbsp;
			<select name="rel-cond_type" id="rel-cond_type" class="input-small">
			<option value="all"><?php esc_html_e('All','wp-app-studio');?></option>
			<option value="any"><?php esc_html_e('Any','wp-app-studio');?></option></select>
			<?php esc_html_e('of the below match:','wp-app-studio'); ?>
			</div>
	</div>
	<div id="rel-cond-list">
	</div>
	</div>
	</div>
	</div>
       <div class="control-group row-fluid">
        <label class="control-label"></label>
        <div class="controls">
        <label class="checkbox"><?php esc_html_e("Display Connected in Frontend","wp-app-studio");?>
        <input name="rel-connected-display" id="rel-connected-display" type="checkbox" value="1"/>
        <a href="#"  title="<?php esc_html_e("When checked, it displays the connected relationship data on the frontend. For example; you have a relationship between products and orders. One product may be ordered multiple times. On a product page, connected option will show the order records that the same product is ordered.","wp-app-studio");?>"><i class="icon-info-sign"></i></a></label>
        </div>
        </div>
        <div class="control-group row-fluid" id="rel-related-display-div">
        <label class="control-label"></label>
        <div class="controls">
        <label class="checkbox"><?php esc_html_e("Display Related in Frontend","wp-app-studio");?>
        <input name="rel-related-display" id="rel-related-display" type="checkbox" value="1"/>
        <a href="#"  title="<?php esc_html_e("When checked, it displays the related relationship data on the frontend. For example; you have a many to many relationship between products and orders. One product may be ordered multiple times. One order may include multiple products. On a product page, related option will show the products that are ordered in the same connected order. This option can be used only in Many-to-Many relationships.","wp-app-studio");?>"><i class="icon-info-sign"></i></a>
        </label>
        </div>
        </div>
	</div> <!-- well end -->
        <ul id="relTab" class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#reltabs-1"><?php esc_html_e("Display Options","wp-app-studio");?></a></li>
        <li id="reltabs-2-li"><a data-toggle="tab" href="#reltabs-2"><?php esc_html_e("Connected","wp-app-studio");?></a></li>
        <li id="reltabs-3-li"><a data-toggle="tab" href="#reltabs-3"><?php esc_html_e("Related","wp-app-studio");?></a></li>
        </ul>
<div id="relTabContent" class="tab-content">
<div id="reltabs-1" class="tab-pane fade in active">
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("From Entity Title","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-from-title" id="rel-from-title" type="text" placeholder="<?php esc_html_e("e.g. Orders (To Entity)","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Default is set to To Entity label.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a></div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("To Entity Title","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-to-title" id="rel-to-title" type="text" placeholder="<?php esc_html_e("e.g. Products (From Entity)","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Default is set to From Entity label.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a></div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("Box Display","wp-app-studio");?></label>
        <div class="controls">
        <select name="rel-box-type" id="rel-box-type">
        <option selected="selected" value="from"><?php esc_html_e("Display in FROM entity","wp-app-studio");?></option>
        <option value="to"><?php esc_html_e("Display in TO entity","wp-app-studio");?></option>
        <option value="any"><?php esc_html_e("Display in ANY entity","wp-app-studio");?></option>
        <option value="false"><?php esc_html_e("Do not display","wp-app-studio");?></option>
        </select>
        <a href="#" title="<?php esc_html_e("Pick the location of relationship metabox. The metabox will be displayed in the editor screen of the selected entity or both.","wp-app-studio");?>" >
        <i class="icon-info-sign"></i></a>
        </div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label" ></label>
        <div class="controls">
            <label class="checkbox"><?php esc_html_e("Main Column Display","wp-app-studio");?>
            <input name="rel-display_in_main" id="rel-display_in_main" type="checkbox" value="1"/>
            <a href="#"  title="<?php esc_html_e("When set, Wp App Studio displays the relationship box in the main column of the entity editor instead of the side column(default). This will allocate more space when defining connections. The relationships with attributes are by default allocated to the main column.","wp-app-studio");?>"><i class="icon-info-sign"></i></a>
            </label>
        </div>
        </div>
</div><!-- end of tab1 -->
<div id="reltabs-2" class="tab-pane fade in">
        <div class="control-group row-fluid">
        <label class="control-label" ><?php esc_html_e("Display Type","wp-app-studio");?></label>
        <div class="controls">
        <select name="rel-connected-display-type" id="rel-connected-display-type" class="input-xlarge">
        <option selected="selected" value="ul"><?php esc_html_e("Unordered List","wp-app-studio");?></option>
        <option value="ol"><?php esc_html_e("Ordered List","wp-app-studio");?></option>
        <option value="inline"><?php esc_html_e("Comma Seperated List","wp-app-studio");?></option>
        <option value="std"><?php esc_html_e("Standard","wp-app-studio");?></option></select>
        <a href="#"  title="<?php esc_html_e("Sets how the connected relationship data will be displayed on the frontend. Standard ,Ordered List, Comma Seperated List, and Unordered List are the options. Standard option creates a div which wraps all relationship data.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group row-fluid" id="rel-connected-filter-div">
	<label class="control-label"><?php esc_html_e("Filter","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" name="rel-connected-filter" id="rel-connected-filter" placeholder="<?php esc_html_e("e.g. attr::emd_product_featured::is::1;tax::product_cat::is::electronics","wp-app-studio");?>" value="" ></textarea>
	<a href="#" title="<?php esc_html_e("Set the default filter for the content to be displayed in the view. You can use view filters to return for example; featured products, on-sale products etc. You can combine multiple filters with semicolon with triggers AND operator. For example;-attr::emd_product_featured::is::1;tax::product_cat::is::electronics- filter shows the featured products in electronics category. The easiest way to create filters is to use the WPAS button on a page toolbar of the generated app to design a filter and then copy paste the required part here.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="well" style="background-color:#e4e4e4;">
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("From Entity Title","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-connected-display-from-title" id="rel-connected-display-from-title"  type="text" placeholder="<?php esc_html_e("e.g. Connected Orders (To Entity)","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Sets the connected relationship title on the - from entity - backend and default entity(entity without a single view) frontend.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("From Entity Header","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-con_from_header" name="rel-con_from_header"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout header of -from entity- records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("From Entity Layout","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-con_from_layout" name="rel-con_from_layout"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout of a single - from entity - record of your view. You can also edit the source code, add entity attributes, taxonomies.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	<div id="rel-con-from-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button id="rel-con-from-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
	</div>
	<div id="rel-con-from-tags" class="tags-collapse"><?php esc_html_e("Loading Layout Tags","wp-app-studio"); ?></div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("From Entity Footer","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-con_from_footer" name="rel-con_from_footer"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout footer of - from entity - records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>
	<div id="rel-connected-to-div" class="well" style="background-color:#f9f9f9;">
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("To Entity Title","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-connected-display-to-title" id="rel-connected-display-to-title" type="text" placeholder="<?php esc_html_e("e.g. Connected Products (From Entity)","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Sets the connected relationship title on the - to entity - backend and default entity(entity without a single view) frontend..","wp-app-studio");?>" ><i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("To Entity Header","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-con_to_header" name="rel-con_to_header"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout header of - to entity - records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("To Entity Layout","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-con_to_layout" name="rel-con_to_layout"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout of a single - to entity - record of your view. You can also edit the source code, add entity attributes, taxonomies.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	<div id="rel-con-to-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button id="rel-con-to-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
	</div>
	<div id="rel-con-to-tags" class="tags-collapse"><?php esc_html_e("Loading Layout Tags","wp-app-studio"); ?></div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("To Entity Footer","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-con_to_footer" name="rel-con_to_footer"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout footer of - to entity - records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>
</div><!-- end of tab2 -->
<div id="reltabs-3" class="tab-pane fade in">
        <div class="control-group row-fluid">
        <label class="control-label" ><?php esc_html_e("Display Type","wp-app-studio");?></label>
        <div class="controls">
        <select name="rel-related-display-type" id="rel-related-display-type" class="input-xlarge">
        <option selected="selected" value="ul"><?php esc_html_e("Unordered List","wp-app-studio");?></option>
        <option value="ol"><?php esc_html_e("Ordered List","wp-app-studio");?></option>
        <option value="inline"><?php esc_html_e("Comma Seperated List","wp-app-studio");?></option>
        <option value="std"><?php esc_html_e("Standard","wp-app-studio");?></option></select>
        <a href="#"  title="<?php esc_html_e("Sets how the related relationship data will be displayed on the frontend. Standard ,Ordered List, Comma Seperated List, and Unordered List are the options. Standard option creates a div which wraps all relationship data. This option can be used only in Many-to-Many relationships.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group row-fluid" id="rel-related-filter-div">
	<label class="control-label"><?php esc_html_e("Filter","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" name="rel-related-filter" id="rel-related-filter" placeholder="<?php esc_html_e("e.g. attr::emd_product_featured::is::1;tax::product_cat::is::electronics","wp-app-studio");?>" value="" ></textarea>
	<a href="#" title="<?php esc_html_e("Set the default filter for the content to be displayed in the view. You can use view filters to return for example; featured products, on-sale products etc. You can combine multiple filters with semicolon with triggers AND operator. For example;-attr::emd_product_featured::is::1;tax::product_cat::is::electronics- filter shows the featured products in electronics category. The easiest way to create filters is to use the WPAS button on a page toolbar of the generated app to design a filter and then copy paste the required part here.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="well" style="background-color:#e4e4e4;">
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("From Entity Title","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-related-display-from-title" id="rel-related-display-from-title" type="text" placeholder="<?php esc_html_e("e.g. Related Products (From Entity)","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Sets the related relationship title on the - from entity - backend and default entity(entity without a single view) frontend. This option can be used only in Many-to-Many relationships.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("From Entity Header","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-rel_from_header" name="rel-rel_from_header"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout header of -from entity- records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("From Entity Layout","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-rel_from_layout" name="rel-rel_from_layout"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout of a single record of your view. You can also edit the source code, add entity attributes, taxonomies.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	<div id="rel-rltd-from-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button id="rel-rltd-from-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
	</div>
	<div id="rel-rltd-from-tags" class="tags-collapse"><?php esc_html_e("Loading Layout Tags","wp-app-studio"); ?></div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("From Entity Footer","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-rel_from_footer" name="rel-rel_from_footer"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout footer of -from entity- records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>
	<div class="well" style="background-color:#f9f9f9;">
        <div class="control-group row-fluid">
        <label class="control-label"><?php esc_html_e("To Entity Title","wp-app-studio");?></label>
        <div class="controls">
        <input name="rel-related-display-to-title" id="rel-related-display-to-title" type="text" placeholder="<?php esc_html_e("e.g. Related Orders (To Entity)","wp-app-studio");?>">
        <a href="#" title="<?php esc_html_e("Sets the related relationship title on the - to entity - backend and default entity(entity without a single view) frontend. This option can be used only in Many-to-Many relationships.","wp-app-studio");?>" ><i class="icon-info-sign"></i></a>
        </div>
        </div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("To Entity Header","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-rel_to_header" name="rel-rel_to_header"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout header of -to entity- records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("To Entity Layout","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-rel_to_layout" name="rel-rel_to_layout"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout of a single record of your view. You can also edit the source code, add entity attributes, taxonomies.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	<div id="rel-rltd-to-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button id="rel-rltd-to-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
	</div>
	<div id="rel-rltd-to-tags" class="tags-collapse"><?php esc_html_e("Loading Layout Tags","wp-app-studio"); ?></div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("To Entity Footer","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="rel-rel_to_footer" name="rel-rel_to_footer"></textarea>
	<a href="#"  title="<?php esc_html_e("Sets the layout footer of -to entity- records.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div>
</div><!-- end of tab3 -->
</div> <!-- end of div content -->
        <div class="control-group emdt-row">
        <button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
        <button class="btn btn-inverse layout-buttons" id="save-relationship" type="submit" value="Save"><i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio");?></button>
        </div>
        </fieldset>
        </form>
<?php
    }
    function wpas_view_relationship($rel,$rel_id,$app)
    {
	if($rel['rel-from-name'] == 'user')
	{
		$from_ent_name = "Users";
	}
	else
	{
		$from_ent_name = $app['entity'][$rel['rel-from-name']]['ent-label'];
	}
	if($rel['rel-to-name'] == 'user')
	{
		$to_ent_name = "Users";
	}
	else
	{
		$to_ent_name = $app['entity'][$rel['rel-to-name']]['ent-label'];
	}
        return '<div class="well form-horizontal">
        <div class="row-fluid">
        <button class="btn  btn-danger pull-left" id="cancel" name="cancel" type="button">
        <i class="icon-off"></i>' . __("Close","wp-app-studio") . '</button>
        <div class="relationship">
        <button class="btn btn-primary pull-right" id="edit-relationship" name="Edit" type="submit" href="#' . esc_attr($rel_id) . '">
        <i class="icon-edit"></i>' . __("Edit","wp-app-studio") . '</button>
        </div>
        </div>
        <fieldset>
        <div class="control-group row-fluid">
        <label class="control-label">' . __("From Entity Name ","wp-app-studio") . '</label>
        <div class="controls"><span id="rel-from-name" class="input-xlarge uneditable-input">' . esc_html($from_ent_name) . '</span>
        </div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label">' . __("To Entity Name","wp-app-studio") . '</label>
        <div class="controls"><span id="rel-to-name" class="input-xlarge uneditable-input">' . esc_html($to_ent_name) . '</span>
        </div>
        </div>
        <div class="control-group row-fluid">
        <label class="control-label">' . __("Relationship Type","wp-app-studio") . '</label>
        <div class="controls"><span id="rel-type" class="input-xlarge uneditable-input">' . esc_html($rel['rel-type']) . '</span>
        </div>
        </div>
        </fieldset>
        </div>';
    }
    ?>
