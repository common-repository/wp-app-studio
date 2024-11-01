<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_glob_form(){
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(document).on('change','#glob-type',function(){
		$(this).showDef($(this).val());
	});
	$.fn.showDef = function (type){
		switch(type){
			case 'textarea':
			case 'wysiwyg':
				$('#glob-req-div').show();
				$('#glob-dflt-div').hide();
				$('#glob-dflt-ta-div').show();
				$('#glob-values-div').hide();
				$('#glob-dflt-checked-div').hide();
				break;
			case 'checkbox_list':
			case 'multi_select':
			case 'radio':
			case 'select':
				$('#glob-req-div').show();
				$('#glob-dflt-div').show();
				$('#glob-dflt-ta-div').hide();
				$('#glob-values-div').show();
				$('#glob-dflt-checked-div').hide();
				break;
			case 'checkbox':
				$('#glob-req-div').show();
				$('#glob-dflt-checked-div').show();
				$('#glob-dflt-div').hide();
				$('#glob-dflt-ta-div').hide();
				$('#glob-values-div').hide();
				break;
			case 'map':
				$('#glob-req-div').hide();
				$('#glob-dflt-div').hide();
				$('#glob-dflt-ta-div').hide();
				$('#glob-values-div').hide();
				break;
			default:
				$('#glob-req-div').show();
				$('#glob-dflt-div').show();
				$('#glob-dflt-ta-div').hide();
				$('#glob-values-div').hide();
				$('#glob-dflt-checked-div').hide();
				break;
		}
	}
});
</script>
<form action="" method="post" id="glob-form" class="form-horizontal">
<input type="hidden" id="app" name="app" value="">
<input type="hidden" value="" name="glob" id="glob">
<fieldset>
	<div class="field-container">
	<div class="well">
	<div class="emdt-row emdt-alert">
	<div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("Globals are app-wide tags which can be used in your view layouts. In contrast to entity attributes, users can set the global value in the plugin settings page, thus applying to all entity records.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Globals Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/global-attributes/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="glob-name" id="glob-name" type="text" placeholder="<?php esc_html_e("e.g. ","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Unique identifier for global attribute. Can not contain capital letters, dashes or spaces. Between 3 and 30 characters.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="glob-label" id="glob-label" type="text" placeholder="<?php esc_html_e("e.g. Product Name","wp-app-studio");?>" value="">
	<a href="#" title="<?php esc_html_e("User friendly name for global attribute. It will appear on the SETTINGS page of your app.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>                          
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Description","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="glob-desc" name="glob-desc" class="wpas-std-textarea" placeholder="<?php esc_html_e("Write a brief description on how the global will be used.","wp-app-studio");?>" ></textarea>
	<a href="#" title="<?php esc_html_e("Instructions or help-text related to your attribute.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>          		
	</div>
    	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="glob-type" id="glob-type">
		<option selected="selected" value=""><?php esc_html_e("Please select","wp-app-studio");?></option>
		<option value="text"><?php esc_html_e("Text","wp-app-studio");?></option>
		<option value="textarea"><?php esc_html_e("Text Area","wp-app-studio");?></option>
		<option value="wysiwyg"><?php esc_html_e("Wysiwyg Editor","wp-app-studio");?></option>
		<option value="checkbox"><?php esc_html_e("Checkbox","wp-app-studio");?></option>
		<option value="checkbox_list"><?php esc_html_e("Checkbox List","wp-app-studio");?></option>
		<option value="radio"><?php esc_html_e("Radios","wp-app-studio");?></option>
		<option value="select"><?php esc_html_e("Select","wp-app-studio");?></option>
		<option value="multi_select"><?php esc_html_e("MultiSelect","wp-app-studio");?></option>
		<option value="map"><?php esc_html_e("Map","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Defines how the global attribute will be displayed.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>      
	</div>
	</div>
	<div class="control-group" id="glob-req-div" style="display:none;">
	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Required","wp-app-studio");?>
	<input name="glob-required" id="glob-required" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Makes the global required so it can not be blank or unset.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="glob-values-div" style="display:none;">
        <label class="control-label req"><?php esc_html_e("Values","wp-app-studio");?></label>
        <div class="controls">
        <textarea id="glob-values" name="glob-values" class="wpas-std-textarea" placeholder="e.g. blue;red;white " ></textarea>
        <a href="#" title="<?php esc_html_e("Enter semicolon separated option labels for the global. There must be only one semicolon between the values. Optionally, you can define value-label combinations using {Value}Label format. If the predined value does not exist, it is automatically created based on the label.","wp-app-studio");?>">
        <i class="icon-info-sign"></i></a>
        </div>
</div>
	<div class="control-group row-fluid" id="glob-dflt-ta-div" style="display:none;">
	<label class="control-label"><?php esc_html_e("Default Value","wp-app-studio");?></label>
	<div class="controls">
	<textarea name="glob-dflt-ta" id="glob-dflt-ta"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the default value(s) for the global, separated by a semicolon. Multiple default values can only be set for select with multiple option and checkbox list types. You must enter the value from Values field and not the label.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="glob-dflt-div" style="display:none;">
	<label class="control-label"><?php esc_html_e("Default Value","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="glob-dflt" id="glob-dflt" type="text" placeholder="" value="" >
	<a href="#" title="<?php esc_html_e("Sets the default value(s) for the attribute, separated by a semicolon. Multiple default values can only be set for select with multiple option and checkbox list types. You must enter the value from Values field and not the label.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="glob-dflt-checked-div" name="glob-dflt-checked-div" style="display:none;">
	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Default Value","wp-app-studio");?>
	<input name="glob-dflt-checked" id="glob-dflt-checked" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Default is unchecked.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div class="control-group emdt-row">
	<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
	<button class="btn btn-inverse layout-buttons" id="save-glob" type="submit" value="Save"><i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio");?></button>
	</div>
</fieldset>
</form>
<?php
}
