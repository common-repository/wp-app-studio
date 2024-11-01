<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_help_tab_form($app_id)
{
	?>
		<form action="" method="post" id="help-field-form" class="form-horizontal">
		<input type="hidden" id="app" name="app" value="<?php echo esc_attr($app_id); ?>">
		<input type="hidden" id="help" name="help" value="0">
		<input type="hidden" id="help_field" name="help_field" value="">
		<div class="well">
		<fieldset>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Tab Title","wp-app-studio"); ?></label>
		<div class="controls">
		<input name="help_fld_name" class="input-xlarge" id="help_fld_name" type="text" placeholder="<?php esc_html_e("This is the name which will appear on the EDIT page","wp-app-studio"); ?>" value="" >                            
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Tab Content","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="help_fld_content" name="help_fld_content"></textarea>
		</div>
		</div>
		</fieldset>
		</div>
		<div class="control-group">
		<button class="btn  btn-danger layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
		<button class="btn btn-primary pull-right layout-buttons" id="save-help-field" name="Save" type="submit"><?php esc_html_e("Save","wp-app-studio"); ?></button>
		</div>
		</form>
		<?php
}
?>
