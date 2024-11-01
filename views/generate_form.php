<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_generate_page()
{
	wpas_generate_app();
}	
function wpas_display_generate_page($submits,$alert,$success)
{
	$apps_options = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$submit_results = "";
	$message = "";
	$apps = wpas_get_app_list();
	$app_link = "";
	$export_link = "";
	$app_data_link = wp_nonce_url(admin_url('admin.php?page=wpas_add_new_app&edit'),'wpas_edit_app_nonce');
	$app_export_link = wp_nonce_url(admin_url('admin.php?page=wpas_app_list&export=1'),'wpas_export');
	if(!empty($apps))
	{
		$apps_pluck = wp_list_pluck( $apps, 'app_name', 'app_id' );
		asort($apps_pluck);
		foreach($apps_pluck as $key => $app_pluck){
			$myapp = $apps[$key];	
			$apps_options .= "<option value='" . esc_attr($key) . "'";
			if(!empty($_REQUEST['app']) && sanitize_text_field($_REQUEST['app']) == $key)
			{
				$app_link = $app_data_link . '&app=' . sanitize_text_field($_REQUEST['app']);
				$export_link = $app_export_link . '&app=' . sanitize_text_field($_REQUEST['app']);
				$apps_options .= " selected";
			}
			$apps_options .= ">" .  esc_html($myapp['app_name']) . "</option>";
		}
	}
	if(empty($submits))
	{
		$total = 0;
		$submit_results = "<tr><td colspan=8>" . __("No application has been submitted.","wp-app-studio") . "</td></tr>";
	}
	else
	{
		$total = count($submits);
		$page =1;
        	if(isset($_REQUEST['generatepage']))
        	{
                	$page = intval ($_REQUEST['generatepage']);
        	}
		$count =0;
		$submits = array_reverse($submits);
		foreach($submits as $mysubmit)
		{
		 	if($count < ($page * 10) && $count >= ($page-1)*10)
			{
                                $alt = "";
                                if($count %2)
                                {
                                        $alt = "alternate";
                                }
				if(isset($mysubmit['status_link']))
				{
					if(strpos($mysubmit['status'],'Error') !== false)
					{	
						$mysubmit['status_link'] = "<a class='btn btn-danger btn-mini' href='" . esc_url($mysubmit['status_link']) . "' target='_blank'>" . __("Open a support ticket","wp-app-studio") . "</a>";
					}
					elseif(strpos($mysubmit['status'],'Success') !== false || strpos($mysubmit['status'],'Change') !== false)
					{
						$down_msg = __("Download","wp-app-studio");
						$mysubmit['status_link'] = "<a class='btn btn-success btn-mini' href='" . esc_url($mysubmit['status_link']) . "'>" . $down_msg . "</a>";
					}
				}
				$submit_results .= "<tr class='" . $alt . "'><td>" . esc_html($mysubmit['app_submitted']) . "</td>
				<td id='status'>" . $mysubmit['status'] . "</td>
				<td id='download-link'>" . $mysubmit['status_link'] . "</p></td>
				<td>" . esc_html($mysubmit['date_submit']) . "</td></tr>";
			}
                        $count ++;
		}
	}
	if(!empty($alert))
	{
		$message = "<div class='alert alert-error'>" . $alert . "</div>";
	}
	elseif($success == 1)
	{
		$message = "<div class='alert alert-success'>" . __("We have received your app and started the generation process. It could take 2-10 mins depending on the load. Please come back and check the generation status by clicking on the Refresh button below.","wp-app-studio") . "</div>";
	}
	?>
		<div id="was-container" class="container-fluid">
		<ul class="breadcrumb">
		<li id="first">
		<a href="<?php echo admin_url('admin.php?page=wpas_app_list'); ?>">
		<i class="icon-home"></i><?php esc_html_e("Home","wp-app-studio"); ?></a>
		<span class="divider">/</span>
		</li>
		<li id="second" class="inactive"><?php esc_html_e("Generate","wp-app-studio"); ?></li>
		</ul>
		<div class="row-fluid">
		<div id="generate" class="span12">
		<form id="generate_form" class="form-horizontal" method="post" >
		<fieldset>
		<?php wp_nonce_field('wpas_generate_app','wpas_generate_nonce'); ?>
		<div class="well">
		<?php 
		//check if license entered don't show
		$wpas_licenses = get_option('wpas_licenses',Array());
		if(empty($wpas_licenses) || empty($wpas_licenses['edition'])){
		?>
		<div class="well-white alert-block">
		<?php printf(esc_html__('You need to have a valid plan license to generate your app. If you do not have a license yet, please <a href="%s" target="_blank">join a plan</a>.','wp-app-studio'), WPAS_URL . '/wp-app-studio-pricing/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=trygenerate-nolicense'); ?>
		<p>
		<?php printf(__('If you have an existing license, please go to <a href="%s">licenses page</a> to activate your license key.','wp-app-studio'),esc_url(admin_url('admin.php?page=wpas_licenses_page'))); ?>
		</p></div><hr>
		<?php } ?>
		<?php echo $message; ?>
		<div class="control-group">
		<label class="control-label"><?php esc_html_e("Apps","wp-app-studio"); ?></label>
		<div class="controls">
		<select id="app" name="app">
		<?php echo $apps_options; ?>
		</select>
		<div id="wpas-edit-export-div" class="emdt-row" style="width:220px;padding:20px 0;<?php echo (empty($app_link)) ? 'display:none;' : ''; ?>">
		<a id="app-link" class="btn btn-inverse" data-link="<?php echo $app_data_link;?>" href="<?php echo $app_link; ?>"><?php esc_html_e('Edit App','wp-app-studio'); ?></a>
		<a class="btn btn-inverse" id="export-link" data-link="<?php echo $app_export_link;?>" href="<?php echo $export_link; ?>"><?php esc_html_e('Export App','wp-app-studio'); ?></a>
		</div><!-- end btn-group -->
		</div>
		</div>
		<div id="frm-btn" class="control-group">
		<label class="control-label"></label>
		<div class="controls">
		<button id="generate" class="btn btn-success btn-large" type="submit">
		<i class="icon-play"></i><?php esc_html_e("Generate","wp-app-studio"); ?></button>
		</div>
		</div>
		</div>
		</fieldset>
		</div>
		</div>
		<div class="row-fluid">
		<div id='status_info' class='alert alert-info' style='display:none;'></div>
		</div>
		<div class="row-fluid">
		<div id='status_error' class='alert alert-error' style='display:none;'></div>
		</div>
		<?php wpas_modal_confirm_delete(1); ?>
		<div id="generatelog" class="row-fluid">
		<div class="tablenav top">
		<div class="alignleft actions">
		<a id="clear-log" class="btn btn-inverse" href="" title="<?php esc_html_e("Clear Log","wp-app-studio"); ?>"><?php esc_html_e("Clear Log History","wp-app-studio"); ?></a>
		</div>
		<div class="pagination pagination-right">
		<?php 
		if($total > 0)
		{
			if(!empty($_GET['app'])){
				$base = admin_url('admin.php?page=wpas_generate_page&app=' . sanitize_text_field($_GET['app']));
			}
			else {
				$base = admin_url('admin.php?page=wpas_generate_page');
			}
			$paging = paginate_links( array(
						'total' => ceil($total/10),
						'current' => $page,
						'base' => $base .'&%_%',
						'format' => 'generatepage=%#%',
						'type' => 'array',
					) );
			$paging_html = "<ul>";
			if(!empty($paging))
			{
				foreach($paging as $key_paging => $my_paging)
				{
					$paging_html .= "<li";
					if(($page == 1 && $key_paging == 0) || ($page > 1 && $page == $key_paging))
					{
						$paging_html .= " class='active'";
					}
					$paging_html .= ">" . $my_paging . "</li>";
				}
				$paging_html .= "</ul>";
			}
			echo wp_kses_post($paging_html);			
		}
		?>
		</div>
		</div>
		<table class="table table-striped table-condensed table-bordered" cellspacing="0">
		<thead><tr class="theader">
		<th><?php esc_html_e("App Name","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Status","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Status Link","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Submit Date","wp-app-studio"); ?></th>
		</tr>
		</thead>
		<tbody id="the-list">
		<?php echo $submit_results; ?>
		</tbody>
		</table>
		</div>
		</div>
		</form>
		<?php
}
