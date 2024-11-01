<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_rel_field_form($app_id)
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var options_arr = ['checkbox_list','radio','select','multiselect'];
	$(document).on('change','#rel_fld_type',function(){
                if($.inArray($(this).val(),options_arr) != -1)
                {
                        $('#rel_fld_values_div').show();
                }
                else
                {
                        $('#rel_fld_values_div').hide();
                }
		if($(this).val() == 'checkbox')
		{
			$('#rel_fld_dflt_value_div').hide();
		}
		else
		{
			$('#rel_fld_dflt_value_div').show();
		}
        });
});
</script>
<form action="" method="post" id="rel-field-form" class="form-horizontal">
<input type="hidden" id="app" name="app" value="<?php echo esc_attr($app_id); ?>">
<input type="hidden" id="rel" name="rel" value="0">
<input type="hidden" id="rel_field" name="rel_field" value="">
<div class="well">
<div class="emdt-row emdt-alert">
<div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("An attribute is a property or descriptor of a relationship. For example; quantity ordered is an attribute of the relationship between products and orders entities.","wp-app-studio"); ?>"><i class="icon-info-sign"></i><a title="Go to Relationships Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/relationships/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
                <fieldset>
<div class="control-group row-fluid">
      <label class="control-label req"><?php esc_html_e("Name","wp-app-studio"); ?></label>
     <div class="controls">
     <input name="rel_fld_name" id="rel_fld_name" type="text" placeholder="<?php esc_html_e("e.g quantity_ordered","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("Single word, no spaces, all lower case. Underscores and dashes allowed","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>	
                                                </div>
                                                </div>
                                                <div class="control-group row-fluid">
                                                                        <label class="control-label req"><?php esc_html_e("Label","wp-app-studio"); ?></label>
                                                                        <div class="controls">
                                                                                <input name="rel_fld_label" id="rel_fld_label" type="text" placeholder="<?php esc_html_e("e.g Quantity Ordered","wp-app-studio");?>" value="" > 
                                                                                			<a href="#" title="<?php esc_html_e("This is the name which will appear on the related relationship box of the admin EDIT page of the entity.","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>                                  
                                                                         </div>
                                                </div>
                           <div class="control-group row-fluid">
                               <label class="control-label"><?php esc_html_e("Type","wp-app-studio"); ?></label>
                               <div class="controls">
                                    <select name="rel_fld_type" id="rel_fld_type">
                                           <option selected="selected" value="text"><?php esc_html_e("Text","wp-app-studio"); ?></option>
                                           <option value="textarea"><?php esc_html_e("Text Area","wp-app-studio"); ?></option>
                                           <option value="checkbox"><?php esc_html_e("Checkbox","wp-app-studio"); ?></option>
                                           <option value="checkbox_list"><?php esc_html_e("Checkbox List","wp-app-studio"); ?></option>
					   <option value="select"><?php esc_html_e("Select","wp-app-studio"); ?></option>
					   <option value="multiselect"><?php esc_html_e("MultiSelect","wp-app-studio"); ?></option>
					   <option value="radio"><?php esc_html_e("Radio","wp-app-studio"); ?></option>
					   <option value="date"><?php esc_html_e("Date","wp-app-studio"); ?></option>
					   <option value="datetime"><?php esc_html_e("DateTime","wp-app-studio"); ?></option>
					   <option value="time"><?php esc_html_e("Time","wp-app-studio"); ?></option>
                                     </select>
                           <a href="#" title="<?php esc_html_e("Attribute types defines how the entity attribute will be displayed on the admin edit page of the entity. ","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>                                             
                                                                        </div>
                                          </div>
<div class="control-group row-fluid">
<label class="control-label"><?php esc_html_e("Description","wp-app-studio"); ?></label>
                                                                        <div class="controls">
                                                                                <textarea id="rel_fld_desc" name="rel_fld_desc" class="input-xlarge" rows="3" placeholder="<?php esc_html_e("e.g please enter the quantity ordered.","wp-app-studio");?>"></textarea>
                                                                                <a href="#" title="<?php esc_html_e("instructions for authors. shown when submitting data.","wp-app-studio"); ?>">
					<i class="icon-info-sign"></i></a>
                                                                        </div>
                                        </div>
                                   <div class="control-group row-fluid">
                                                                        <label class="control-label"></label>
                                                        <div class="controls">
                                                        <label class="checkbox"> <?php esc_html_e("Required","wp-app-studio"); ?>
                                                <input id="rel_fld_required" type="checkbox" value="1" name="rel_fld_required">
                                                 <a href="#" title="<?php esc_html_e("Makes the attribute required so it can not be blank.","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>
                                                        </label>
                                                        </div>
                                        </div>
<div class="control-group row-fluid" id="rel_fld_values_div" style="display:none;">
                                                                        <label class="control-label req"><?php esc_html_e("Values","wp-app-studio"); ?></label>
                                                                        <div class="controls">
                                                                                <textarea id="rel_fld_values" name="rel_fld_values" class="input-xlarge" rows="3" placeholder="<?php esc_html_e("e.g. blue;red;white","wp-app-studio"); ?>"></textarea>
                                                                                <a href="#" title="<?php esc_html_e("Enter semicolon separated option labels for the field. There must be only one semicolon between the values. Optionally, you can define value-label combinations using {Value}Label format. If the predined value does not exist, it is automatically created based on the label.","wp-app-studio"); ?>">
					<i class="icon-info-sign"></i></a>
                                                                        </div>
                                        </div>
                                        <div class="control-group row-fluid">
                                                                        <label class="control-label"><?php esc_html_e("Default Value","wp-app-studio"); ?></label>
                                                                        <div class="controls">
                                                                        <input name="rel_fld_dflt_value" id="rel_fld_dflt_value" type="text" placeholder="<?php esc_html_e("Default value of the field","wp-app-studio"); ?>" value="" >
                                                                        <a href="#" title="<?php esc_html_e("Create a default value for the attribute.","wp-app-studio"); ?>">
			<i class="icon-info-sign"></i></a>
                                                                        </div>
                                        </div>
                </fieldset>
</div>
        <div class="control-group emdt-row">
              <button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
           <button class="btn btn-inverse layout-buttons" id="save-relationship-field" name="Save" type="submit"><?php esc_html_e("Save","wp-app-studio"); ?></button>
        </div>
</form>
<?php
}
?>
