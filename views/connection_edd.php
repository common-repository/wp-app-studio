<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function show_edd_form($app_id)
{
?>
	<div id="connection-edd">
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-edd_label" id="connection-edd_label" type="text" placeholder="<?php esc_html_e("e.g. Tickets","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the connection label which is display under plugin settings page.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid" id="connection-edd-tax-id"> 
	<label class="control-label"><?php esc_html_e("Attach to Taxonomy","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_tax" id="connection-edd_tax" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Display order or download connections depending on the terms of this taxonomy.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid">
    	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Create Order Relationship","wp-app-studio"); ?>
	<input name="connection-edd_order_rel" id="connection-edd_order_rel" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Enables Easy Digital Downloads order relationship.","wp-app-studio"); ?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div id="connection-edd_order" class="well" style="background-color:#FFE8BF;">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Order Term","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_order_term" id="connection-edd_order_term" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the taxonomy term which triggers order connection box.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_order_type" id="connection-edd_order_type" class="input-xlarge">
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
	<input class="input-xlarge" name="connection-edd_order_from" id="connection-edd_order_from" type="text" placeholder="<?php esc_html_e("e.g. Tickets","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for attached entity.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("To Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-edd_order_to" id="connection-edd_order_to" type="text" placeholder="<?php esc_html_e("e.g. Orders","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for order.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Box Display","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_order_box" id="connection-edd_order_box">
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
	<textarea class="wpas-std-textarea" id="connection-edd_order_header" name="connection-edd_order_header"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout header of an order record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Layout","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-edd_order_layout" name="connection-edd_order_layout"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout of an order record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-edd-order-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button type="button" class="btn btn-inverse" data-toggle="collapse" data-target="#connection-edd-order-tags">Show Tags</button>
	</div>
	<div id="connection-edd-order-tags" class="collapse">
	<table class='table table-striped'><tr><th colspan=2>
	<?php esc_html_e('Use template tags below to customize your layout.','wp-app-studio'); ?>
	</th></tr>
	<tr><th><?php echo esc_html__('Functions', 'wp-app-studio') ?></th>
	<td>Translate : <b>!#trans[<?php  esc_html_e('Text to translate','wp-app-studio');?>]#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Date Format:</a> <b>!#date-format['<?php  esc_html_e('Format','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag','wp-app-studio');?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff to Now:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag','wp-app-studio'); ?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag From','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag To','wp-app-studio');?>']#</b>, Control If: <b>!#control-if['<?php esc_html_e('Condition','wp-app-studio');?>','<?php esc_html_e('True Value','wp-app-studio');?>','<?php esc_html_e('False Value','wp-app-studio');?>']#</b></td></tr>
	<tr><th><?php echo esc_html__('Attributes', 'wp-app-studio') ?></th>
	<td><?php echo esc_html__('Order Id','wp-app-studio');?>: <b>!#edd_order_id#</b>, <?php echo esc_html__('Order Link','wp-app-studio');?>: <b>!#edd_order_link#</b>, <?php echo esc_html__('Order Date','wp-app-studio');?>: <b>!#edd_order_date#</b>, <?php echo esc_html__('Order Status','wp-app-studio');?>: <b>!#edd_order_status#</b>, <?php echo esc_html__('Order Total','wp-app-studio');?>: <b>!#edd_order_total#</b>,  <?php echo esc_html__('Licenses Page Link','wp-app-studio');?>: <b>!#edd_order_licenses_url#</b>, <?php echo esc_html__('Download Files','wp-app-studio');?>: <b>!#edd_order_download_files#</b></td></tr>
	<tr><th><?php echo esc_html__('Relationships', 'wp-app-studio') ?></th>
	<td><?php echo esc_html__('Order Download List(Comma Seperated)','wp-app-studio');?>: <b>!#edd_order_downloads_csv#</b>, <?php echo esc_html__('Order Download List(Ordered)','wp-app-studio');?>: <b>!#edd_order_downloads_ol#</b>, <?php echo esc_html__('Order Download List(Unordered)','wp-app-studio');?>: <b>!#edd_order_downloads_ul#</b>, <?php echo esc_html__('Order Download List(Standard)','wp-app-studio');?>: <b>!#edd_order_downloads_div#</b></td></tr>
	</table>
	</div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Footer","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-edd_order_footer" name="connection-edd_order_footer"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout footer of an order record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Purchase History Label","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-edd_recent_orders_label" id="connection-edd_recent_orders_label" type="text" placeholder="<?php esc_html_e("e.g. Open a Ticket","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the button label of purchase history table row.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Purchase History Link","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-edd_recent_orders_url" id="connection-edd_recent_orders_url" type="text" placeholder="<?php esc_html_e("e.g. /open-a-ticket","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the button link of purchase history table row.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- connection-edd_order end -->
	<div class="control-group row-fluid">
    	<label class="control-label"></label>
	<div class="controls">
	<label class="checkbox"><?php esc_html_e("Create Download Relationship","wp-app-studio"); ?>
	<input name="connection-edd_product_rel" id="connection-edd_product_rel" type="checkbox" value="1"/>
	<a href="#" title="<?php esc_html_e("Enables Easy Digital Downloads download relationship.","wp-app-studio"); ?>">
	<i class="icon-info-sign"></i></a>
	</label>
	</div>
	</div>
	<div id="connection-edd_product" class="well" style="background-color:#e4e4e4;">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Download Term","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_product_term" id="connection-edd_product_term" class="input-xlarge">
	</select>
	<a href="#" title="<?php esc_html_e("Sets the taxonomy term which triggers download connection box. Use this to connect downloads that are not related to orders.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Type","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_product_type" id="connection-edd_product_type" class="input-xlarge">
	<option selected="selected" value="one-to-many"><?php esc_html_e("One-to-Many","wp-app-studio");?></option>
	<option value="many-to-many"><?php esc_html_e("Many-to-Many","wp-app-studio");?></option>
	<option value="one-to-one"><?php esc_html_e("One-to-One","wp-app-studio");?></option>
	</select>
	<a href="#" title="<?php esc_html_e("Sets how downloads and attached entity records will be related.e.g. One download may be related to multiple ticket records and one ticket is related to many downloads in one-to-many relationship type.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("From Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-edd_product_from" id="connection-edd_product_from" type="text" placeholder="<?php esc_html_e("e.g. Tickets","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for attached entity.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("To Title","wp-app-studio");?></label>
	<div class="controls">
	<input class="input-xlarge" name="connection-edd_product_to" id="connection-edd_product_to" type="text" placeholder="<?php esc_html_e("e.g. Downloads","wp-app-studio");?>" value="" >
	<a href="#" title="<?php esc_html_e("Sets the relationship box title for download.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Box Display","wp-app-studio");?></label>
	<div class="controls">
	<select name="connection-edd_product_box" id="connection-edd_product_box">
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
	<textarea class="wpas-std-textarea" id="connection-edd_product_header" name="connection-edd_product_header"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout header of a download record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label req"><?php esc_html_e("Layout","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-edd_product_layout" name="connection-edd_product_layout"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout of a download record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-edd-product-tags-div" style="padding:10px 0;">
	<div style="padding:10px;">
	<button type="button" class="btn btn-inverse" data-toggle="collapse" data-target="#connection-edd-product-tags">Show Tags</button>
	</div>
	<div id="connection-edd-product-tags" class="collapse">
	<table class='table table-striped'><tr><th colspan=2>
	<?php esc_html_e('Use template tags below to customize your layout.','wp-app-studio'); ?>
	</th></tr>
	<tr><th><?php echo esc_html__('Functions', 'wp-app-studio') ?></th>
	<td>Translate : <b>!#trans[<?php  esc_html_e('Text to translate','wp-app-studio');?>]#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Date Format:</a> <b>!#date-format['<?php  esc_html_e('Format','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag','wp-app-studio');?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff to Now:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag','wp-app-studio'); ?>']#</b>, <a href="<?php echo WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=conn-functions'; ?>" target="_blank">Human Time Diff:</a> <b>!#human-diff['<?php esc_html_e('Attribute Date Tag From','wp-app-studio');?>','<?php esc_html_e('Attribute Date Tag To','wp-app-studio');?>']#</b>, Control If: <b>!#control-if['<?php esc_html_e('Condition','wp-app-studio');?>','<?php esc_html_e('True Value','wp-app-studio');?>','<?php esc_html_e('False Value','wp-app-studio');?>']#</b></td></tr>
	<tr><th><?php echo esc_html__('Attributes', 'wp-app-studio') ?></th>
	<td><?php echo esc_html__('Download Id','wp-app-studio');?>: <b>!#edd_download_id#</b>, <?php echo esc_html__('Download Link','wp-app-studio');?>: <b>!#edd_download_link#</b>, <?php echo esc_html__('Download Title','wp-app-studio');?>: <b>!#edd_download_title#</b>, <?php echo esc_html__('Download Slug','wp-app-studio');?>: <b>!#edd_download_slug#</b>, <?php echo esc_html__('Download Sku','wp-app-studio');?>: <b>!#edd_download_sku#</b>, <?php echo esc_html__('Download Price','wp-app-studio');?>: <b>!#edd_download_price#</b>, <?php echo esc_html__('Download Featured Image Thumb','wp-app-studio');?>: <b>!#edd_download_image_thumb#</b>, <?php echo esc_html__('Download Description','wp-app-studio');?>: <b>!#edd_download_description#</b>, <?php echo esc_html__('Download Excerpt','wp-app-studio');?>: <b>!#edd_download_excerpt#</b>, <?php echo esc_html__('Download File Download Limit','wp-app-studio');?>: <b>!#edd_download_file_limit#</b>, <?php echo esc_html__('Download Notes','wp-app-studio');?>: <b>!#edd_download_notes#</b>, <?php echo esc_html__('Download Sales','wp-app-studio');?>: <b>!#edd_download_sales#</b>, <?php echo esc_html__('Download Earnings','wp-app-studio');?>: <b>!#edd_download_earnings#</b></td></tr></table>
	</div>
	</div>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Footer","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-edd_product_footer" name="connection-edd_product_footer"></textarea>
	<a href="#" title="<?php esc_html_e("Sets the layout footer of a download record of your view.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	</div>
	</div>
	</div><!-- connection-edd_product end -->
	<div class="section-title"><?php esc_html_e("Purchase History Page","wp-app-studio"); ?></div>
	<div id="connection-edd_my_account" class="well">
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Content Above Purchase History","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-edd_my_account_bef_shc" name="connection-edd_my_account_bef_shc"></textarea>
	<a href="#" title="<?php esc_html_e("Displays the view content above purchase history shortcode.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-edd_my_account_bef" style="padding:10px 0;">
	</div>
	</div>
	</div>
	<div class="control-group row-fluid"> 
	<label class="control-label"><?php esc_html_e("Content After Purchase History","wp-app-studio");?></label>
	<div class="controls">
	<textarea class="wpas-std-textarea" id="connection-edd_my_account_aft_shc" name="connection-edd_my_account_aft_shc"></textarea>
	<a href="#" title="<?php esc_html_e("Displays the view content after purchase history shortcode.","wp-app-studio");?> ">
	<i class="icon-info-sign"></i></a>
	<div id="connection-edd_my_account_aft" style="padding:10px 0;">
	</div>
	</div>
	</div>
	</div>
	</div><!-- end of edd -->
<?php	
}
