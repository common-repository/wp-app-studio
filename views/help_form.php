<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_help_form($app_id)
{
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('change','#help-type',function(){
			app_id = $('input#app').val();
			if($(this).find('option:selected').val() == 'ent')
			{
				$('#help-others').show();
				$('#help-screen_type-div').show();
				$.get(ajaxurl,{action:'wpas_get_entities',type:'help',app_id:app_id}, function(response)
				{
					$('select#help-entity').html(response);
					$('#help-entity-div').show();
					$('#help-entity').show();
					$('#help-tax-div').hide();
				});
			}
			else if($(this).find('option:selected').val() == 'tax')
			{
				$('#help-others').show();
				$('#help-screen_type-div').hide();
				$.get(ajaxurl,{action:'wpas_get_entities',type:'tax',app_id:app_id}, function(response)
				{
					$('select#help-tax').html(response);
					$('#help-tax-div').show();
					$('#help-tax').show();
					$('#help-entity-div').hide();
				});
			}
			else
			{
				$('#help-others').hide();
			}
		});
	});
</script>
<div class="well">
<div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("A contextual help section provides additional information to the user on how to navigate the various settings in the admin panel. Each help section are displayed as tabs and attached to an entity or taxonomy. Optionally, you can also include a sidebar help section. The sidebar appears to the right-side of the main help content. Generally, a sidebar includes related info links on the entity or the taxonomy it is attached to.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a><a title="Go to Help Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/contextual-help/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
<form action="" method="post" id="help-form" class="form-horizontal">
	<input type="hidden" value="" name="help" id="help">
	<fieldset>
	<div class="control-group row-fluid" id="help-type-div" name="help-type-div">
	<label class="control-label req"><?php esc_html_e("Type","wp-app-studio"); ?></label>
	<div class="controls">
	<select id="help-type" name="help-type">
	<option value=""><?php esc_html_e("Please select","wp-app-studio"); ?></option>
	<option value="ent"><?php esc_html_e("Entities","wp-app-studio"); ?></option>
	<option value="tax"><?php esc_html_e("Taxonomies","wp-app-studio"); ?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Select the type of help screen.","wp-app-studio"); ?>" ><i class="icon-info-sign"></i></a></div>
	</div>
	<div id="help-others" name="help-others" style="display:none;">
	<div class="control-group row-fluid" id="help-entity-div" name="help-entity-div">
	<label class="control-label req"><?php esc_html_e("Attach To Entity","wp-app-studio"); ?></label>
	<div class="controls">
	<select id="help-entity" name="help-entity">
	</select>
	<a href="#" title="<?php esc_html_e("Select the entity you want to display help screen at.","wp-app-studio"); ?>" ><i class="icon-info-sign"></i></a></div>
	</div>
	<div class="control-group row-fluid" id="help-tax-div" name="help-tax-div">
	<label class="control-label req"><?php esc_html_e("Attach To Taxonomy","wp-app-studio"); ?></label>
	<div class="controls">
	<select id="help-tax" name="help-tax">
	</select>
	<a href="#" title="<?php esc_html_e("Select the taxonomy you want to display help screen at.","wp-app-studio"); ?>" ><i class="icon-info-sign"></i></a></div>
	</div>
	<div class="control-group row-fluid" id="help-screen_type-div" name="help-screen_type-div">
	<label class="control-label req"><?php esc_html_e("Screen Type","wp-app-studio"); ?></label>
	<div class="controls">
	<select id="help-screen_type" name="help-screen_type">
	<option value=""><?php esc_html_e("Please select","wp-app-studio"); ?></option>
	<option value="edit"><?php esc_html_e("Edit Page","wp-app-studio"); ?></option>
	<option id="list" value="list"><?php esc_html_e("List Page","wp-app-studio"); ?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Select the location of the help screen. You can select list or edit page.","wp-app-studio"); ?>" ><i class="icon-info-sign"></i></a></div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Help SideBar","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="help-screen_sidebar" name="help-screen_sidebar"></textarea>
	<a href="#" title="<?php esc_html_e("The content of the help screen sidebar.","wp-app-studio"); ?>" ><i class="icon-info-sign"></i></a></div>
	</div>
	</div><!-- end help-others div -->
	<div class="control-group emdt-row">
	<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
	<button class="btn btn-inverse layout-buttons" id="save-help" type="submit" value="Save"><i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio"); ?></button>
	</div>
	</fieldset>
	</form>
	</div>
<?php
}
function wpas_view_help($help,$help_id,$app)
{
	if($help['help-type'] == 'ent')
	{
		$type = "Entity";
	}
	else
	{
		$type = "Taxonomy";
	}
	$ret = '<div class="well form-horizontal">
		<div class="row-fluid">
		<button class="btn  btn-danger pull-left" id="cancel" name="cancel" type="button">
		<i class="icon-off"></i>' . __("Close","wp-app-studio") . '</button>
		<div class="help">
		<button class="btn btn-primary pull-right" id="edit-help" name="Edit" type="submit" href="#' . esc_attr($help_id) . '">
		<i class="icon-edit"></i>' . __("Edit Help","wp-app-studio") . '</button>
		</div>
		</div>
		<fieldset>
		<div class="control-group">
		<label class="control-label">' . __("Type","wp-app-studio") . ' </label>
		<div class="controls"><span id="help-type" class="input-xlarge uneditable-input">' . $type . '</span>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label">' . __("Attach To","wp-app-studio") . ' </label>';
	if(isset($help['help-entity']))
	{  
		$ret .= '<div class="controls"><span id="help-entity" class="input-xlarge uneditable-input">';
		$ret .= esc_html($app['entity'][$help['help-entity']]['ent-label']);
	}
	elseif(isset($help['help-tax']))
	{
		$ret .= '<div class="controls"><span id="help-tax" class="input-xlarge uneditable-input">';
		$ret .= esc_html($app['taxonomy'][$help['help-tax']]['txn-label']);
	}
	$ret .= '</span>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label">Screen Type </label>
		<div class="controls"><span id="help-screen_type" class="input-xlarge uneditable-input">' . esc_html($help['help-screen_type']) . '</span>
		</div>
		</div>
		</fieldset>
		</div>';
	return $ret;
}
?>
