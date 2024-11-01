<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_import_page($msg='')
{
?>
<div id="was-container" class="container-fluid">
<ul class="breadcrumb">
<li id="first">
<a href="<?php echo admin_url('admin.php?page=wpas_app_list'); ?>">
<i class="icon-home"></i>
<?php esc_html_e("Home","wp-app-studio"); ?>
</a>
<span class="divider">/</span>
</li>
<li id="second" class="inactive"><?php esc_html_e("Import","wp-app-studio"); ?></li>
</ul>
<?php
if($msg == 'success')
{
?>
<div class='alert alert-success'><?php esc_html_e("Import completed successfully.","wp-app-studio"); ?></div><p>
<?php
}
elseif($msg == 'entity_exists')
{
?>
<div class='alert alert-error'><?php esc_html_e("Import has not been completed. This entity already exists in this application.","wp-app-studio"); ?></div><p>
<?php
}
elseif($msg == 'dupe_diff_date')
{
?>
<div class='alert alert-error'><?php esc_html_e("Import completed successfully with a warning: An application with the same id already exists.","wp-app-studio"); ?>
</div><p>
<?php
}
elseif($msg == 'dupe_name')
{
?>
<div class='alert alert-error'><?php esc_html_e("Import completed successfully with a warning: An application with the same name already exists.","wp-app-studio"); ?>
</div><p>
<?php
}
elseif($msg == 'dupe')
{
?>
<div class='alert alert-error'><?php esc_html_e("Import has not been completed. This application already exists.","wp-app-studio"); ?>
</div><p>
<?php
}
elseif($msg == 'error_data')
{
?>
<div class='alert alert-error'><?php esc_html_e("Import has not been completed. Data is not in correct format.","wp-app-studio"); ?>
</div><p>
<?php
}
elseif(!empty($msg))
{
?>
<div class='alert alert-error'><?php echo esc_html($msg); ?></div><p>
<?php }
if(empty($_GET['type']))
{ 
	echo '<p class="install-help">' . esc_html__("Import a WP App Studio Application in .wpas format by uploading it here.","wp-app-studio") . '</p>';
?>
	<form class="form-inline" name="importWpas" enctype="multipart/form-data" method="POST" action="">
	<?php wp_nonce_field('wpas_import_file','wpas_import_nonce'); ?>
	<input type="file" name="wpasimport" class="input-xlarge" id="wpasimport">
	<button type="submit" class="button-primary"><?php esc_html_e("Import Now","wp-app-studio"); ?></button>
	</form>
	</div>
<?php
}
elseif(sanitize_text_field($_GET['type']) == 'entity') {
	if(empty($_GET['app'])){
		echo '<div class="alert alert-error">' . esc_html__('No app found to import entity to') . '</div><p>';
	}
	else {
	echo '<p class="install-help">' . esc_html__("Import an Entity in .wpas format by uploading it here.","wp-app-studio") . '</p>';
?>
		<form class="form-inline" name="importWpas" enctype="multipart/form-data" method="POST" action="">
		<?php wp_nonce_field('wpas_import_file','wpas_import_nonce'); ?>
		<input type="file" name="wpasimport" class="input-xlarge" id="wpasimport">
		<button type="submit" class="button-primary"><?php esc_html_e("Import Now","wp-app-studio"); ?></button>
		</form>
	<?php
	}
	echo '</div>';
}
}
?>
