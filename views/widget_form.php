<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_widget_form($app_id)
{
	?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
				$(document).on('change','#widg-theme_type',function(){
					$(this).showWJquery($(this).val());
				});
				$.fn.showWJquery = function(theme){
					if(theme == 'Na'){
						$('#widg-jquery_div').show();
					}
					else {		
						$('#widg-jquery_div').hide();
					}
				}
				$(document).on('change','#widg-type',function(){
					$(this).showWidgByType($(this).find('option:selected').val());
				});
				$.fn.showWidgByType = function(type,ptype) {	
					ptype = ptype || '';
					if(type == 'sidebar')
					{
						$('#widg-dash_subtype_div').hide();
						$('#widg-side_subtype_div').show();
						$('#widg-label_div').show();
					}
					else if(type == 'dashboard')
					{
						$('#widg-dash_subtype_div').show();
						$('#widg-side_subtype_div').hide();
						$('#widg-label_div').hide();
					}
					else
					{ 
						$('#widg-dash_subtype_div').hide();
						$('#widg-side_subtype_div').hide();
					}
					if(ptype != 'edit')
					{
						$('#widg-html_div').hide();
						$('#widg-wdesc_div').hide();
						$('#widg-layout_div').hide();
						$('#widg-css_div').hide();
						$('#widg-js_div').hide();
						$('#widg-cdnjs_div').hide();
						$('#widg-cdncss_div').hide();
						$('#widg-post_per_page_div').hide();
						$('#widg-order_div').hide();
						$('#widg-orderby_div').hide();
						$('#widg-orderby_comment_div').hide();
						$('#widg-post_status_div').hide();
						$('#widg-comment_status_div').hide();
						$('#widg-wp_dash_div').hide();
						$('#widg-app_dash_div').hide();
						$('#widg-app_dash_loc_div').hide();
					}
					$('#widg-attach_div').hide();
				}
				$(document).on('change','#widg-dash_subtype,#widg-side_subtype',function(){
					var widg_type = $('#widg-type').find('option:selected').val();
					$(this).showWidgFields($(this).find('option:selected').val(),widg_type);
					$('#widg-layout-tags-div .tags-collapse').hide();
				});
				$(document).on('change','#widg-attach',function(){
					app_id = $('input#app').val();
					ent_id = $('#widg-attach').find('option:selected').val();
					subtype = $('#widg-side_subtype').find('option:selected').val();
					dsubtype = $('#widg-dash_subtype').find('option:selected').val();
					$.get(ajaxurl,{action:'wpas_get_orderby_fields',app_id:app_id,ent_id:ent_id}, function(response)
					{
						$('#widg-orderby').html(response);
					});
					$('#widg-layout-tags-div .tags-collapse').hide();
				});
				$(document).on('click','#widg-layout-tags-div .btn',function(){
					if($('#widg-layout-tags').is(":visible")){
						$('#widg-layout-tags-div .tags-collapse').hide();
					}
					else {
						app_id = $('input#app').val();
						ent_id = $('#widg-attach').find('option:selected').val();
						subtype = $('#widg-side_subtype').find('option:selected').val();
						if(subtype == 'integration'){
							$(this).showWidgTags(app_id,0,subtype,'');
						}
						else {
							dsubtype = $('#widg-dash_subtype').find('option:selected').val();
							$(this).showWidgTags(app_id,ent_id,subtype,dsubtype);
						}
					}
				});
				$.fn.showWidgTags = function (app_id,ent_id,subtype,dsubtype){
					if(ent_id != 0 && (subtype == 'entity' || dsubtype == 'entity')){
						$.get(ajaxurl,{action:'wpas_get_layout_tags',type:'tag',app_id:app_id,comp_id:ent_id}, function(response){
							$('#widg-layout-tags').html(response);
							$('#widg-layout-tags').show();
						});
					}
					else if(ent_id == 0 && subtype == 'integration'){
						$.get(ajaxurl,{action:'wpas_get_layout_tags',type:'integration',app_id:app_id,comp_id:ent_id}, function(response){
							$('#widg-layout-tags').html(response);
							$('#widg-layout-tags').show();
						});
					}
					else {
						$('#widg-layout-tags').html("<?php esc_html_e('Please select an entity to view tags','wp-app-studio');?>");
						$('#widg-layout-tags').show();
					}
				}
				$.fn.showWidgFields = function(subtype,widg_type,type){
					type = type || '';
					switch (subtype) {
						case 'integration':
							$('#widg-attach_div').hide();
							$('#widg-wdesc_div').show();
							$('#widg-layout_div').show();
							$('#widg-layout_header_div').hide();
							$('#widg-layout_footer_div').hide();
							$('#widg-css_div').show();
							$('#widg-js_div').show();
							$('#widg-cdnjs_div').show();
							$('#widg-cdncss_div').show();
							$('#widg-post_per_page_div').hide();
							$('#widg-order_div').hide();
							$('#widg-orderby_div').hide();
							$('#widg-orderby_comment_div').hide();
							$('#widg-post_status_div').hide();
							$('#widg-comment_status_div').hide();
							app_id = $('input#app').val();
							if(widg_type == 'dashboard'){
								$('#widg-wp_dash_div').show();
								$('#widg-app_dash_div').show();
								if(type != 'edit')
								{
									$('#widg-app_dash').prop('checked',true);
									$('#widg-app_dash').val(1);
								}
							}
							break;
						case 'admin':
							$('#widg-html_div').show();
							$('#widg-wdesc_div').show();
							$('#widg-attach_div').hide();
							$('#widg-layout_div').hide();
							$('#widg-layout_header_div').hide();
							$('#widg-layout_footer_div').hide();
							$('#widg-css_div').hide();
							$('#widg-js_div').hide();
							$('#widg-cdnjs_div').hide();
							$('#widg-cdncss_div').hide();
							$('#widg-post_per_page_div').hide();
							$('#widg-order_div').hide();
							$('#widg-orderby_div').hide();
							$('#widg-orderby_comment_div').hide();
							$('#widg-post_status_div').hide();
							$('#widg-comment_status_div').hide();
							$('#widg-wp_dash_div').show();
							$('#widg-app_dash_div').show();
							if(type != 'edit')
							{
								$('#widg-app_dash').prop('checked',true);
								$('#widg-app_dash').val(1);
							}
							break;
						case 'entity':
							if(widg_type == 'dashboard')
							{
								$('#widg-wp_dash_div').show();
								$('#widg-app_dash_div').show();
								if(type != 'edit')
								{
									$('#widg-app_dash').prop('checked',true);
									$('#widg-app_dash').val(1);
								}
							}
							else
							{
								$('#widg-wp_dash_div').hide();
								$('#widg-app_dash_div').hide();
								$('#widg-app_dash_loc_div').hide();
							}
							$('#widg-wdesc_div').show();
							$('#widg-html_div').hide();
							$('#widg-attach_div').show();
							$('#widg-layout_div').show();
							$('#widg-layout_header_div').show();
							$('#widg-layout_footer_div').show();
							$('#widg-css_div').show();
							$('#widg-js_div').show();
							$('#widg-cdnjs_div').show();
							$('#widg-cdncss_div').show();
							$('#widg-post_per_page_div').show();
							$('#widg-order_div').show();
							$('#widg-orderby_div').show();
							$('#widg-orderby_comment_div').hide();
							$('#widg-post_status_div').show();
							$('#widg-comment_status_div').hide();
							if(type != 'edit')
							{
								app_id = $('input#app').val();
								$.get(ajaxurl,{action:'wpas_get_entities',type:'widget',app_id:app_id}, function(response)
								{
									$('#add-widget-div #widg-attach').html(response);
								});
							}
							break; 
						case 'comment':
							if(widg_type == 'dashboard')
							{
								$('#widg-wp_dash_div').show();
								$('#widg-app_dash_div').show();
								if(type != 'edit')
								{
									$('#widg-app_dash').prop('checked',true);
									$('#widg-app_dash').val(1);
								}
							}
							else
							{
								$('#widg-wp_dash_div').hide();
								$('#widg-app_dash_div').hide();
								$('#widg-app_dash_loc_div').hide();
							}
							$('#widg-wdesc_div').show();
							$('#widg-html_div').hide();
							$('#widg-attach_div').show();
							$('#widg-layout_div').hide();
							$('#widg-layout_header_div').hide();
							$('#widg-layout_footer_div').hide();
							$('#widg-css_div').hide();
							$('#widg-js_div').hide();
							$('#widg-cdnjs_div').hide();
							$('#widg-cdncss_div').hide();
							$('#widg-post_per_page_div').show();
							$('#widg-order_div').show();
							$('#widg-orderby_div').hide();
							$('#widg-orderby_comment_div').show();
							$('#widg-post_status_div').hide();
							$('#widg-comment_status_div').show();
							if(type != 'edit')
							{
								app_id = $('input#app').val();
								$.get(ajaxurl,{action:'wpas_get_entities',type:'widget-comment',app_id:app_id}, function(response)
								{
									$('#add-widget-div #widg-attach').html(response);
								});
							}
							break; 
						default:
							$('#widg-html_div').hide();
							$('#widg-attach_div').hide();
							$('#widg-layout_div').hide();
							$('#widg-layout_header_div').hide();
							$('#widg-layout_footer_div').hide();
							$('#widg-css_div').hide();
							$('#widg-js_div').hide();
							$('#widg-cdnjs_div').hide();
							$('#widg-cdncss_div').hide();
							$('#widg-post_per_page_div').hide();
							$('#widg-order_div').hide();
							$('#widg-orderby_div').hide();
							$('#widg-orderby_comment_div').hide();
							$('#widg-post_status_div').hide();
							$('#widg-comment_status_div').hide();
							$('#widg-wp_dash_div').hide();
							$('#widg-app_dash_div').hide();
							$('#widg-app_dash_loc_div').hide();
							break;
					}
				}
				$(document).on('click','#widg-app_dash',function(){
					if($(this).prop('checked'))
					{
						$('#widg-app_dash_loc_div').show();
					}
					else
					{
						$('#widg-app_dash_loc_div').hide();
					}
				});
		});
	</script>
		<form action="" method="post" id="widget-form" class="form-horizontal">
		<input type="hidden" id="app" name="app" value="">
		<input type="hidden" value="" name="widget" id="widget">
		<fieldset>
		<div class="well">
		<div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("Widgets add content and features to your Sidebars or Dashboard. You can display entity data in a sidebar or dashboard widget.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a><a title="Go to Widgets Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/widgets/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="widg-name" id="widg-name" type="text" placeholder="<?php esc_html_e("e.g. customer_survey","wp-app-studio");?>" value="" >
		<a href="#" title="<?php esc_html_e("Unique identifier for the widget. Can not contain capital letters,dashes or spaces. Between 3 and 30 characters.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
                <div class="control-group row-fluid" id="widg-label_div" style="display:none;">
                <label class="control-label req"><?php esc_html_e("Label","wp-app-studio"); ?></label>
                <div class="controls">
                <input class="input-xlarge" name="widg-label" id="widg-label" type="text" placeholder="<?php esc_html_e("e.g. Recent Products","wp-app-studio"); ?>">
                <a href="#" title="<?php esc_html_e("Sets the initial title of the widget which will displayed on the backend.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div class="control-group row-fluid">
                <label class="control-label req"><?php esc_html_e("Title","wp-app-studio"); ?></label>
                <div class="controls">
                <input class="input-xlarge" name="widg-title" id="widg-title" type="text" placeholder="<?php esc_html_e("e.g. Recent Orders","wp-app-studio"); ?>">
                <a href="#" title="<?php esc_html_e("Sets the title of the widget on sidebar or dashboard.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div class="control-group row-fluid">
                <label class="control-label req"><?php esc_html_e("Type","wp-app-studio"); ?></label>
                <div class="controls">
                <select name="widg-type" id="widg-type" class="input-xlarge">
                <option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio"); ?></option>
                <option value="sidebar"><?php esc_html_e("Sidebar","wp-app-studio"); ?></option>
                <option value="dashboard"<?php esc_html_e(">Dashboard","wp-app-studio"); ?></option>
                </select>
                <a href="#" title="<?php esc_html_e("Sets type of the your widget. You can create a Dashboard or Sidebar widget.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div class="control-group row-fluid" id="widg-dash_subtype_div" style="display:none;">
                <label class="control-label req"><?php esc_html_e("Subtype","wp-app-studio"); ?></label>
                <div class="controls">
                <select name="widg-dash_subtype" id="widg-dash_subtype" class="input-xlarge">
                <option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio"); ?></option>
                <option value="entity"><?php esc_html_e("Entity","wp-app-studio"); ?></option>
                <option value="comment"><?php esc_html_e("Comment","wp-app-studio"); ?></option>
                <option value="admin"><?php esc_html_e("Admin","wp-app-studio"); ?></option>
                <option value="integration"><?php esc_html_e("Integration","wp-app-studio"); ?></option>
                </select>
                <a href="#" title="<?php esc_html_e("Sets the type of dashboard widget.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div class="control-group row-fluid" id="widg-side_subtype_div" style="display:none;">
                <label class="control-label req"><?php esc_html_e("Subtype","wp-app-studio"); ?></label>
                <div class="controls">
                <select name="widg-side_subtype" id="widg-side_subtype" class="input-xlarge">
                <option value="" selected="selected"><?php esc_html_e("Please select","wp-app-studio"); ?></option>
                <option value="entity"><?php esc_html_e("Entity","wp-app-studio"); ?></option>
                <option value="comment"><?php esc_html_e("Comment","wp-app-studio"); ?></option>
                <option value="integration"><?php esc_html_e("Integration","wp-app-studio"); ?></option>
                </select>
                <a href="#" title="<?php esc_html_e("Sets the type of sidebar widget. ","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div class="control-group row-fluid" id="widg-attach_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Attach to Entity","wp-app-studio"); ?></label>
		<div class="controls">
		<select id="widg-attach" name="widg-attach">
		</select><a href="#" title="<?php esc_html_e("All widgets must be attached to a predefined entity. Entity widgets display the attached entity's content.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
                <div class="control-group row-fluid" id="widg-wdesc_div" style="display:none;">
                <label class="control-label"><?php esc_html_e("Description","wp-app-studio"); ?></label>
                <div class="controls">
                <textarea name="widg-wdesc" id="widg-wdesc" class="wpas-std-textarea"></textarea>
                <a href="#" title="<?php esc_html_e("Sets the initial short description explaining what the widget does.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
                <div class="control-group row-fluid" id="widg-html_div" style="display:none;">
                <label class="control-label"><?php esc_html_e("Widget message","wp-app-studio"); ?></label>
                <div class="controls">
		<textarea class="wpas-std-textarea" name="widg-html" id="widg-html" placeholder="<?php esc_html_e("Optionally you can set an initial message","wp-app-studio"); ?>"></textarea>
		<a href="#" title="<?php esc_html_e("Sets the initial message of the dashboard widget for application-wide messages.","wp-app-studio"); ?>">
                <i class="icon-info-sign"></i></a>
                </div>
                </div>
		<div id="widg-layout_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Template","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="widg-theme_type" id="widg-theme_type" class="input-xlarge">
		<option value="Na" selected>None</option>
		<option value="Bootstrap">WPAS</option>
		</select>
		<a href="#" title="<?php esc_html_e("Sets the frontend framework which will be used to configure the overall look and feel of the widget. If you pick jQuery UI, you can choose your theme from App's Settings under the theme tab.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="control-group row-fluid" id="widg-jquery_div" name="widg-jquery_div">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Enable jQuery","wp-app-studio");?>
		<input name="widg-jquery" id="widg-jquery" type="checkbox" value="1" checked/>
		<a href="#" title="<?php esc_html_e("Enables jQuery.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
                <div class="control-group row-fluid" id="widg-layout_header_div">
                <label class="control-label"><?php esc_html_e("Header","wp-app-studio"); ?></label>
                <div class="controls">
                <textarea id="widg-layout_header" name="widg-layout_header" class="wpas-std-textarea"></textarea>
                <a href="#" title="<?php esc_html_e("It defines the header content of the widget. The header content is static and displayed on the top section of your widget's content.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
                </div>
                </div>
                <div class="control-group row-fluid">
                <label class="control-label req"><?php esc_html_e("Layout","wp-app-studio"); ?></label>
                <div class="controls">
                <textarea id="widg-layout" name="widg-layout" class="wpas-std-textarea"></textarea>
                <a href="#" title="<?php esc_html_e("The widget layout defines how the content will be displayed within the widget. Click Show tags button to customize the content to be returned.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
                <div id="widg-layout-tags-div" style="padding:10px 0;">
                <div style="padding:10px;">
                <button id="widg-layout-tags-btn" type="button" class="btn btn-inverse"><?php esc_html_e("Show Tags","wp-app-studio"); ?></button>
                </div>
                <div id="widg-layout-tags" class="tags-collapse"><?php esc_html_e("Loading Layout Tags","wp-app-studio"); ?></div>
                </div>
                </div>
                </div>
                <div class="control-group row-fluid" id="widg-layout_footer_div">
                <label class="control-label"><?php esc_html_e("Footer","wp-app-studio"); ?></label>
                <div class="controls">
                <textarea id="widg-layout_footer" name="widg-layout_footer" class="wpas-std-textarea"></textarea>
                <a href="#" title="<?php esc_html_e("It defines the footer content of the widget. The footer content is static and displayed on the bottom section of your widget's content.","wp-app-studio"); ?>"><i class="icon-info-sign"></i></a>
                </div>
                </div>
                </div>
		<div id="widg-css_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CSS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="widg-css_enq" id="widg-css_enq" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the script file which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Css ","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="widg-css" name="widg-css"></textarea>
		<a href="#" title="<?php esc_html_e("The custom css code to be used when displaying the content. You can leave this field blank and use WPAS app css file.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div id="widg-js_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("JS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="widg-js_enq" id="widg-js_enq" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the script file which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("JS","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" id="widg-js" name="widg-js"></textarea>
		<a href="#" title="<?php esc_html_e("The custom JavaScript code which will be enqueued to the view. Do not include script tags.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div id="widg-cdnjs_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN JS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="widg-cdn_jsname" id="widg-cdn_jsname" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the script file which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN JS","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="widg-cdnjs" name="widg-cdnjs" class="wpas-std-textarea" placeholder=" YOU MUST USE HTTPS e.g. https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.0.5/readmore.min.js;https://cdn.jsdelivr.net/ace/1.1.9/min/ace.js" ></textarea>
		<a href="#" title="<?php esc_html_e("Enter semicolon separated JavaScript file urls starting with https. We only accept files from the following sources; cdnjs.cloudflare.com and cdn.jsdelivr.net or raw.githubusercontent.com. All files will be downloaded and merged before getting locally enqueued to the view they are linked to.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div id="widg-cdncss_div" style="display:none;">
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN CSS Name","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="widg-cdn_cssname" id="widg-cdn_cssname" type="text" placeholder="<?php esc_html_e("e.g. sc-products","wp-app-studio");?>">
		<a href="#" title="<?php esc_html_e("The name of the stylesheet which can be used to dedupe links pointing to the same content.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("CDN CSS","wp-app-studio"); ?></label>
		<div class="controls">
		<textarea id="widg-cdncss" name="widg-cdncss" class="wpas-std-textarea" placeholder=" YOU MUST USE HTTPS e.g. https://cdnjs.cloudflare.com/ajax/libs/example/2.0.5/example.min.css;https://cdn.jsdelivr.net/example/1.1.9/min/example.min.css" ></textarea>
		<a href="#" title="<?php esc_html_e("Enter semicolon separated CSS file urls starting with https. We only accept files from the following sources; cdnjs.cloudflare.com and cdn.jsdelivr.net or raw.githubusercontent.com. All files will be downloaded and merged before getting locally enqueued to the view they are linked to.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-wp_dash_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Display in Wordpress Dashboard","wp-app-studio");?>
		<input name="widg-wp_dash" id="widg-wp_dash" type="checkbox" value="1">
		<a href="#" title="<?php esc_html_e("When set, displays widget in wordpress dashboard.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-app_dash_div" style="display:none;">
		<label class="control-label"></label>
		<div class="controls">
		<label class="checkbox"><?php esc_html_e("Display in App Dashboard","wp-app-studio");?>
		<input name="widg-app_dash" id="widg-app_dash" type="checkbox" value="1" checked>
		<a href="#" title="<?php esc_html_e("When set, displays widget in app dashboard.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</label>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-app_dash_loc_div" style="display:none;">
		<label class="control-label req"><?php esc_html_e("Dashboard Location","wp-app-studio");?></label>
		<div class="controls">
		<select name="widg-app_dash_loc" id="widg-app_dash_loc" class="input-xlarge">
		<option value="">Please select</option>
		<option value="wholecol">One Column</option>
		<option value="normal">Two Column Left</option>
		<option value="side">Two Column Right</option>
		</select>
		<a href="#" title="<?php esc_html_e("The title of the dashboard. Max:255 char.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>	
		<div class="control-group row-fluid" id="widg-post_per_page_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Per Page ","wp-app-studio"); ?></label>
		<div class="controls">
		<input id="widg-post_per_page" name="widg-post_per_page" class="input-mini" type="text" placeholder="<?php esc_html_e("e.g. 16'","wp-app-studio"); ?>" value="">
		<a href="#" title="<?php esc_html_e("Number of entity/comment content to show per page. Use any integer value or -1 to show all.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-order_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("List Order ","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="widg-order" id="widg-order" class="input-small">
		<option value="DESC" selected="selected"><?php esc_html_e("Descending","wp-app-studio"); ?></option>
		<option value="ASC"><?php esc_html_e("Ascending","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Allows the content to be sorted ascending or descending. Defaults to descending.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-orderby_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Sort Retrieved By ","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="widg-orderby" id="widg-orderby" class="input-small">
		</select>
		<a href="#" title="<?php esc_html_e("Allows sorting of retrieved content by a parameter selected. Defaults to date.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-orderby_comment_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Sort Retrieved By ","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="widg-orderby_comment" id="widg-orderby_comment" class="input-small">
		<option value="date" selected="selected"><?php esc_html_e("Date","wp-app-studio"); ?></option>
		<option value="ID"><?php esc_html_e("ID","wp-app-studio"); ?></option>
		<option value="author"><?php esc_html_e("Author","wp-app-studio"); ?></option>
		<option value="author_email"><?php esc_html_e("Author Email","wp-app-studio"); ?></option>
		<option value="author_IP"><?php esc_html_e("Author IP","wp-app-studio"); ?></option>
		<option value="author_url"><?php esc_html_e("Author Url","wp-app-studio"); ?></option>
		<option value="content"><?php esc_html_e("Content","wp-app-studio"); ?></option>
		<option value="parent"><?php esc_html_e("Parent","wp-app-studio"); ?></option>
		<option value="post_ID"><?php esc_html_e("Post id","wp-app-studio"); ?></option>
		<option value="approved"><?php esc_html_e("Approved","wp-app-studio"); ?></option>
		<option value="agent"><?php esc_html_e("Agent","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Allows sorting of retrieved content by a parameter selected. Defaults to date.","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div id="widg-post_status_div">
		<div class="control-group row-fluid" style="display:none;">
		<label class="control-label"><?php esc_html_e("Show By Status ","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="widg-post_status" id="widg-post_status" class="input-small">
		<option value="publish" selected="selected"><?php esc_html_e("Publish","wp-app-studio"); ?></option>
		<option value="pending"><?php esc_html_e("Pending","wp-app-studio"); ?></option>
		<option value="draft"><?php esc_html_e("Draft","wp-app-studio"); ?></option>
		<option value="auto-draft"><?php esc_html_e("With no content","wp-app-studio"); ?></option>
		<option value="future" ><?php esc_html_e("Future","wp-app-studio"); ?></option>
		<option value="private"><?php esc_html_e("Private","wp-app-studio"); ?></option>
		<option value="trash"><?php esc_html_e("Trash","wp-app-studio"); ?></option>
		<option value="any"><?php esc_html_e("Any but excluded from search","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Retrieves content by status, default value is publish","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label"><?php esc_html_e("Filter","wp-app-studio");?></label>
		<div class="controls">
		<textarea class="wpas-std-textarea" name="widg-filter" id="widg-filter" placeholder="<?php esc_html_e("e.g. attr::emd_product_featured::is::1;tax::product_cat::is::electronics","wp-app-studio");?>" value="" ></textarea>
		<a href="#" title="<?php esc_html_e("Set the default filter for the content to be displayed in the widget. You can use widget filters to return for example; featured products, on-sale products etc. You can combine multiple filters with semicolon which triggers AND operator. For example;-attr::emd_product_featured::is::1;tax::product_cat::is::electronics- filter shows the featured products in electronics category. The easiest way to create filters is to use the WPAS button on a page toolbar of the generated app to design a filter and then copy paste the required part here. Please note that we emd_ prefix vs. WPAS ent_ for attributes.","wp-app-studio");?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div class="control-group row-fluid" id="widg-comment_status_div" style="display:none;">
		<label class="control-label"><?php esc_html_e("Show By Status ","wp-app-studio"); ?></label>
		<div class="controls">
		<select name="widg-comment_status" id="widg-comment_status" class="input-small">
		<option value="approve" selected="selected"><?php esc_html_e("Approved","wp-app-studio"); ?></option>
		<option value="hold"><?php esc_html_e("Hold","wp-app-studio"); ?></option>
		<option value="spam"><?php esc_html_e("Spam","wp-app-studio"); ?></option>
		<option value="trash"><?php esc_html_e("Trash","wp-app-studio"); ?></option>
		<option value="post-trashed" ><?php esc_html_e("Post Trashed","wp-app-studio"); ?></option>
		</select>
		<a href="#" title="<?php esc_html_e("Retrieves content by status, default value is publish","wp-app-studio"); ?>">
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		</div>
		<div class="control-group emdt-row">
		<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button">
		<i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
		<button class="btn btn-inverse layout-buttons" id="save-widget" type="submit" value="Save">
		<i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio"); ?></button>
		</div>
		</fieldset>
		</form>
		<?php
}
?>
