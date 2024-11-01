<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_notify_form()
{
?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$.fn.getEmails = function (app_id,level,attach_to,attach_tax,values) {
			attach_to = attach_to || '';
			attach_tax = attach_tax || '';
			values = values || '';
			if(attach_to == '')
			{
				if(level == 'tax')
				{
					attach_to = $('#notify-attach_ent').val();
					attach_tax = $('#notify-attached_to').val();
				}
				else
				{
					attach_to = $('#notify-attached_to').val();
					attach_tax = '';
				}
			}
              		$.get(ajaxurl,{action:'wpas_get_email_attrs',level:level,attach_to:attach_to,attach_tax:attach_tax,app_id:app_id,values:values}, function(response)
			{
				$('#add-notify-div #notify-confirm_sendto').html(response);
			});
		}
		$(document).on('change','#notify-attached_to',function(){
			app_id = $('input#app').val();
			level = $('#notify-level').val();
			if(level == 'tax')
			{
				tax_id = $(this).val();
				$.get(ajaxurl,{action:'wpas_get_entities',type:'shortcode',app_id:app_id,tax_id:tax_id}, function(response)
                        	{
					$('#notify-attach_ent').html(response);
					$('#notify-attach_ent_div').show();
                        	});
			}
			else
			{
				$('#notify-attach_ent_div').hide();
				if($('#notify-email_user_confirm').prop('checked'))
				{
					$(this).getEmails(app_id,level);
				}
			}
			$('.tags-collapse').hide();
		});
		$(document).on('click','#notify-admin-tags-div .btn',function(){
			if($('#notify-admin-tags').is(":visible")){
				$('#notify-admin-tags-div .tags-collapse').hide();
			}
			else {
				app_id = $('input#app').val();
				level = $('#notify-level').val();
				$(this).showNotifyTags(app_id,level,'notify-admin-tags');
			}
		});
		$(document).on('click','#notify-user-tags-div .btn',function(){
			if($('#notify-user-tags').is(":visible")){
				$('#notify-user-tags-div .tags-collapse').hide();
			}
			else {
				app_id = $('input#app').val();
				level = $('#notify-level').val();
				$(this).showNotifyTags(app_id,level,'notify-user-tags');
			}
		});
		$.fn.showNotifyTags = function (app_id,level,div_id,values){
			values = values || '';
			type = 'notify-tag-rel';
			switch (level) {
				case 'attr': 
					if(values != ''){
						comp = values['notify-attached_to'].split("__");
					}
					else {
						comp = $('#notify-attached_to').val().split("__");
					}
					comp_id = comp[1];
					break;
				case 'tax':
					if(values != ''){
						comp_id = values['notify-attach_ent'];
					}
					else {
						comp_id = $('#notify-attach_ent').val();
					}
					break;
				case 'rel':
					type = 'notify-rel';
					if(values != ''){
						comp_id = values['notify-attached_to'];
					}
					else {
						comp_id = $('#notify-attached_to').val();
					}
					break;
				case 'entity':
				case 'com':
				default:
					if(values != ''){
						comp_id = values['notify-attached_to'];
					}
					else {
						comp_id = $('#notify-attached_to').val();
					}
					break;
			}
			if(!comp_id){
				$('#'+div_id).html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
				$('#'+div_id).show();
			}
			else {
				$.get(ajaxurl,{action:'wpas_get_layout_tags',type:type,app_id:app_id,comp_id:comp_id}, function(response){
					$('#'+div_id).html(response);
					$('#'+div_id).show();
				});
			}
		}
		$(document).on('change','#notify-attach_ent',function(){
			app_id = $('input#app').val();
			if($('#notify-email_user_confirm').prop('checked'))
			{
				$(this).getEmails(app_id,$('#notify-level').val());
			}
			$('.tags-collapse').hide();
		});
		$('#notify-email_user_div').hide();
		$('#notify-change_val_div').hide();
		$(document).on('click','#notify-change',function(){
			notify_level = $('#notify-level').val();
			if($(this).prop('checked') && (notify_level == 'attr' || notify_level == 'tax'))
			{
				$('#notify-change_val_div').show();
			}
			else
			{
				$('#notify-change_val_div').hide();
				$('#notify-change_val').val('');
			}
		});
		$.fn.setLevel = function (type, change_sel, sel_val) {
			app_id = $('input#app').val();
			$.get(ajaxurl,{action:'wpas_get_notify_attach',app_id:app_id,type:type, value:sel_val},function(response) {
				$('#notify-attached_to').html(response);
			});
			if(change_sel == 1  && (type == 'attr' || type== 'tax'))
			{
				$('#notify-change_val_div').show();
			}
			else
			{
				$('#notify-change_val_div').hide();
				$('#notify-change_val').val('');
			}
			switch (type) {
				case 'entity':
					$('#notify-front-add-div').show();
					$('#notify-back-add-div').show();
					$('#notify-add-div').hide();
					$('#notify-delete-div').show();
					$('#notify-trash-div').show();
					$('#notify-change-div').show();
					break;
				case 'com':
					$('#notify-front-add-div').hide();
					$('#notify-back-add-div').hide();
					$('#notify-add-div').show();
					$('#notify-delete-div').show();
					$('#notify-trash-div').show();
					$('#notify-change-div').show();
					break;
				case 'rel':
					$('#notify-back-add-div').show();
					$('#notify-delete-div').show();
					$('#notify-change-div').hide();
					$('#notify-add-div').hide();
					$('#notify-trash-div').hide();
					//$('#notify-front-add-div').hide();
					$('#notify-front-add-div').show();
					break;	
				case 'attr':
				case 'tax':
					$('#notify-front-add-div').hide();
					$('#notify-back-add-div').hide();
					$('#notify-delete-div').hide();
					$('#notify-trash-div').hide();
					$('#notify-add-div').hide();
					$('#notify-change-div').show();
					break;
			}
			if(type != 'tax')
			{
				$('#notify-attach_ent_div').hide();
			}
		}
		$(document).on('change','#notify-level',function(){
			change_sel = 0;
			if($('#notify-change').prop('checked'))
			{
				change_sel = 1;
			}
			$(this).setLevel($(this).val(),change_sel);
			$('.tags-collapse').hide();
		});
		$(document).on('click','#notify-email_user_confirm',function(){
		if($(this).prop('checked'))
		{
			app_id = $('input#app').val();
			$('#notify-email_user_div').show();
			level = $('#notify-level').val();
			$(this).getEmails(app_id,level);
			$('.tags-collapse').hide();
		}
		else
		{
			$('#notify-email_user_div').hide();
		}
	});
	$(document).on('click','#notify-email_admin_confirm',function(){
		if($(this).prop('checked'))
		{
			$('#notify-email_admin_div').show();
			level = $('#notify-level').val();
			$('.tags-collapse').hide();
		}
		else
		{
			$('#notify-email_admin_div').hide();
		}
	});
	});
</script>
	<form action="" method="post" id="notify-form" class="form-horizontal">
	<input type="hidden" id="app" name="app" value="">
	<input type="hidden" value="" name="notify" id="notify">
	<fieldset>
	<div class="field-container">
	<div class="well">
	<div class="emdt-row emdt-alert">
	<div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("Notifications are system alerts based on the additions, deletions or updates of main entity related objects and sent to WordPress users and admins in the form of emails.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Notifications Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/notifications/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-name" id="notify-name" type="text" placeholder="<?php esc_html_e("e.g. customer_survey","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Unique identifier for the notification. Can not contain capital letters, dashes or spaces. Between 3 and 30 characters.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-label" id="notify-label" type="text" placeholder="<?php esc_html_e("e.g. customer_survey","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Label of your notification. Displayed at the app settings notifications tab after app generation.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Description","wp-app-studio"); ?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" name="notify-desc" id="notify-desc"></textarea>
	<a href="#" title="<?php esc_html_e("Initial short description for the notification. Displayed at the app settings notifications tab after app generation.","wp-app-studio"); ?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Level","wp-app-studio");?></label>
	<div class="controls">
	<select name="notify-level" id="notify-level" class="input-xlarge">
	<option value="entity" selected><?php esc_html_e("Entity","wp-app-studio");?></option>
	<option value="attr"><?php esc_html_e("Attribute","wp-app-studio");?></option>
	<option value="tax"><?php esc_html_e("Taxonomy","wp-app-studio");?></option>
	<option value="rel"><?php esc_html_e("Relationship","wp-app-studio");?></option>
	<option value="com"><?php esc_html_e("Comment","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets the level of notifications to be configured. Entity level allows sending notifications when there is a backend(admin) addition, frontend(forms) addition, deletion of a record, or any change in entity objects such as taxonomies, relationships etc. Attribute and taxonomy level notifications are sent when there is any value change or when the value changed to a specific value specified in the change value field. Relationship level notifications are sent when there is an addition from the backend or when a connection get deleted for a specific relationship specified at the Attached To field. Comment level notifications are sent when when the comment records, specified at the Attached to field, gets a new addition, changed, deleted or put in trash.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="notify-attached_to_div"> 
	<label class="control-label req"><?php esc_html_e("Attached to","wp-app-studio");?></label>
	<div class="controls">
	<select name="notify-attached_to" id="notify-attached_to" style="width:auto;">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the primary object for your notification. The selected object will be used to trigger notifications.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="notify-attach_ent_div" style="display:none;"> 
	<label class="control-label req"><?php esc_html_e("Attach to Entity","wp-app-studio");?></label>
	<div class="controls">
	<select name="notify-attach_ent" id="notify-attach_ent" style="width:auto;">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the primary entity for your notification. The selected entity will be used to trigger notifications.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req">Events</label>
	<div class="controls span2" id="notify-front-add-div"><label class="checkbox"><?php esc_html_e("Frontend Add","wp-app-studio");?>
	<input name="notify-events[]" id="notify-front-add" type="checkbox" value="front-add"/>
	</label>
	</div>
	<div class="controls span2" id="notify-back-add-div"><label class="checkbox"><?php esc_html_e("Backend Add","wp-app-studio");?>
	<input name="notify-events[]" id="notify-back-add" type="checkbox" value="back-add"/>
	</label>
	</div>
	<div class="controls span2" id="notify-add-div"><label class="checkbox"><?php esc_html_e("Add","wp-app-studio");?>
	<input name="notify-events[]" id="notify-add" type="checkbox" value="add"/>
	</label>
	</div>
	<div class="controls span2" id="notify-change-div"><label class="checkbox"><?php esc_html_e("Change","wp-app-studio");?>
	<input name="notify-events[]" id="notify-change" type="checkbox" value="change"/>
	</label>
	</div>
	<div class="controls span2" id="notify-delete-div"><label class="checkbox"><?php esc_html_e("Delete","wp-app-studio");?>
	<input name="notify-events[]" id="notify-delete" type="checkbox" value="delete"/>
	</label>
	</div>
	<div class="controls span2" id="notify-trash-div"><label class="checkbox"><?php esc_html_e("Trash","wp-app-studio");?>
	<input name="notify-events[]" id="notify-trash" type="checkbox" value="trash"/>
	</label>
	</div>
	</div>
	<div class="control-group row-fluid" id="notify-change_val_div" style="display:none;">
	<label class="control-label"><?php esc_html_e("Change Value","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-change_val" id="notify-change_val" type="text" placeholder="<?php esc_html_e("e.g. ","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the value which will be used to trigger notification..","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	</div><!--well-->
	<div id="notify-tabs">
	<ul id="notifyTab" class="nav nav-tabs">
	<li class="active" id="notifytabs-1-li"><a data-toggle="tab" href="#notifytabs-1"><?php esc_html_e("User Notification","wp-app-studio");?></a></li>
	<li id="notifytabs-2-li"><a data-toggle="tab" href="#notifytabs-2"><?php esc_html_e("Admin Notification","wp-app-studio");?></a></li>
	</ul>
	<div id="NotifyTabContent" class="tab-content">
	<div class="row-fluid">
	<div class="btn emdt-row emdt-alert"><a data-placement="bottom" href="#" title="<?php esc_html_e("Display Options tab configures user and admin notification messages to be sent when the specified event(s) occur.","wp-app-studio");?>"><i class="icon-info-sign"></i></a></div>
	</div>
	<div id="notifytabs-1" class="tab-pane fade in active">
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Enable User Notification","wp-app-studio");?></label>
	<input name="notify-email_user_confirm" id="notify-email_user_confirm" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("When checked, users will be get notifications. You can enable or disable user notifications from app settings page notifications tab after your app generated.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div id="notify-email_user_div">
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Email Send To","wp-app-studio");?></label>
	<div class="controls">
	<select name="notify-confirm_sendto[]" id="notify-confirm_sendto" style="width:auto;" multiple="multiple">
	</select>
	<a href="#" title="<?php esc_html_e("Select the email attribute you want to send the receipt to. The user email address must be available in the attribute selected otherwise no emails are sent.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email Reply To","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_replyto" id="notify-confirm_replyto" type="text" placeholder="<?php esc_html_e("e.g. user-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the email address used for reply messages. Multiple email addresses must be separated by coma. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email CC","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_user_cc" id="notify-confirm_user_cc" type="text" placeholder="<?php esc_html_e("e.g. user-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the email address that user notification will be CCed. Multiple email addresses must be separated by coma. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email BCC","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_user_bcc" id="notify-confirm_user_bcc" type="text" placeholder="<?php esc_html_e("e.g. user-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the email address that user notification will be BCCed. Multiple email addresses must be separated by coma. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Email Subject","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_subject" id="notify-confirm_subject" type="text" placeholder="<?php esc_html_e("e.g. Thanks for filling out my form","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the subject field of user emails. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Email Message","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="notify-confirm_msg" name="notify-confirm_msg" class="wpas-std-textarea">
	</textarea>
	<a href="#" title="<?php esc_html_e("Notification message to be sent. You can use HTML. You should use <br> or <p> tags for line breaks. Use Show Tags to customize your message with tags available to your entity.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	<div id="notify-user-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button id="notify-user-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
	</div>
	<div id="notify-user-tags" class="tags-collapse"><?php esc_html_e("Loading Tags","wp-app-studio"); ?></div>
	</div><!-- end of notfiy-tags-div -->
	</div>
	</div>
	</div>
	</div> <!--notifytabs-1-->
	<div id="notifytabs-2" class="tab-pane fade in">
	<div class="control-group row-fluid">
	<label class="control-label"></label>
	<div class="controls"><label class="checkbox"><?php esc_html_e("Enable Admin Notification","wp-app-studio");?></label>
	<input name="notify-email_admin_confirm" id="notify-email_admin_confirm" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("When checked, admin user(s) will be get notifications. You can enable or disable user notifications from app settings page notifications tab after your app generated.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div id="notify-email_admin_div" style="display:none;">
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email Send To","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_admin_sendto" id="notify-confirm_admin_sendto" type="text" placeholder="<?php esc_html_e("e.g. admin-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("The admin email address(es). Multiple email addresses must be separated by coma. When left blank no notifications get sent. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email Reply To","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_admin_replyto" id="notify-confirm_admin_replyto" type="text" placeholder="<?php esc_html_e("e.g. admin-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("The admin email address used for reply messages. Multiple email addresses must be separated by coma. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email Cc","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_admin_cc" id="notify-confirm_admin_cc" type="text" placeholder="<?php esc_html_e("e.g. user-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the email address that the admin notification will be CCed. Multiple email addresses must be separated by coma. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	<div class="control-group row-fluid">
	<label class="control-label"><?php esc_html_e("Email Bcc","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_admin_bcc" id="notify-confirm_admin_bcc" type="text" placeholder="<?php esc_html_e("e.g. user-emails@example.com","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the email address that the admin notification will be BCCed. Multiple email addresses must be separated by coma. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div> 
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Email Subject","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="notify-confirm_admin_subject" id="notify-confirm_admin_subject" type="text" placeholder="<?php esc_html_e("The admin message subject.","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the subject of admin emails. Max:255 Char.","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
	<label class="control-label req"><?php esc_html_e("Email Message","wp-app-studio");?></label>
	<div class="controls">
	<textarea id="notify-confirm_admin_msg" name="notify-confirm_admin_msg" class="wpas-std-textarea">
	</textarea>
	<a href="#" title="<?php esc_html_e("Notification message to be sent. You can use HTML. You should use <br> or <p> tags for line breaks. Use Show Tags to customize your message with tags available to your entity","wp-app-studio");?>">
	<i class="icon-info-sign"></i></a>
	<div id="notify-admin-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button id="notify-admin-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
	</div>
	<div id="notify-admin-tags" class="tags-collapse"><?php esc_html_e("Loading Tags","wp-app-studio"); ?></div>
	</div><!-- end of notfiy-tags-div -->
	</div>
	</div>
	</div>
	</div> <!--notifytabs-2-->
	</div>  <!--tab-contnotify-->
	</div><!--field-container-->
	<div class="control-group">
	<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
	<button class="btn btn-inverse layout-buttons" id="save-notify" type="submit" value="Save"><i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio");?></button>
	</div>
	</fieldset>
	</form>
<?php
}
?>
