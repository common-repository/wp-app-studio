<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_add_app_option($app_name)
{
	?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.fn.changeTheme = function (theme_name) {
            new_url = 'http://jqueryui.com/resources/images/themeGallery/theme_90_';
            if (theme_name == 'mint-choc') {
                theme_name = 'mint_choco';
            }
            else if (theme_name == 'vader') {
                theme_name = 'black_matte';
            }
            else if (theme_name == 'redmond') {
                theme_name = 'windoze';
            }
            else if (theme_name == 'start') {
                theme_name = 'start_menu';
            }
            else if (theme_name == 'ui-darkness') {
                theme_name = 'ui_dark';
            }
            else if (theme_name == 'ui-lightness') {
                theme_name = 'ui_light';
            }
            else {
                theme_name = theme_name.replace('-', '_');
            }
            new_url += theme_name;
            new_url += '.png';
            $('#theme_url').attr("src", new_url);
            $('#theme_url').load();
        }
        $(document).on('click', '#ao_modify_navigation_menus', function () {
            if ($(this).prop('checked')) {
                $('#support-cust-nav-div').show();
            }
            else {
                $('#support-cust-nav-div').hide();
            }
        });
        $(document).on('click', '#ao_force_dashboard_to_column', function () {
            if ($(this).prop('checked')) {
                $('#ao_force_col_div').show();
            }
            else {
                $('#ao_force_col_div').hide();
            }
        });
        $(document).on('click', '#ao_set_uitheme', function () {
            if ($(this).prop('checked')) {
                $('#ao_theme_type_div').show();
            }
            else {
                $('#ao_theme_type_div').hide();
                $('#ao_theme_type').val('');
            }
        });
        $(document).on('change', '#ao_theme_type', function () {
            theme_name = $(this).find('option:selected').val();
            $(this).changeTheme(theme_name);
        });
        $(document).on('click', '#ao_adm_notice1', function () {
            if ($(this).prop('checked')) {
                $('#ao_adm_notice1_detail_div').show();
            }
            else {
                $('#ao_adm_notice1_detail_div').hide();
                $('#ao_adm_notice1_url').val('');
                $('#ao_adm_notice1_desc').val('');
            }
        });
        $(document).on('click', '#ao_adm_notice2', function () {
            if ($(this).prop('checked')) {
                $('#ao_adm_notice2_detail_div').show();
            }
            else {
                $('#ao_adm_notice2_detail_div').hide();
                $('#ao_adm_notice2_url').val('');
                $('#ao_adm_notice2_desc').val('');
            }
        });
        $(document).on('click', '#ao_adm_notice3', function () {
            if ($(this).prop('checked')) {
                $('#ao_adm_notice3_detail_div').show();
                $('#ao_adm_notice3_exp').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss' });
            }
            else {
                $('#ao_adm_notice3_detail_div').hide();
                $('#ao_adm_notice3_url').val('');
                $('#ao_adm_notice3_desc').val('');
                $('#ao_adm_notice3_exp').val('');
            }
        });
    });
</script>
<div class="row-fluid" style="display:none;" id="edit-btn-div">
    <div id="app-edit-btn">
        <button class="btn btn-inverse" id="edit-option" name="Edit" type="submit" href="#">
            <i class="icon-edit"></i><?php esc_html_e("Edit","wp-app-studio"); ?></button>
    </div>
</div>
<form action="" method="post" id="option-form" class="form-horizontal">
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab"><?php esc_html_e("App Info","wp-app-studio"); ?></a></li>
            <li><a href="#tab2" data-toggle="tab"><?php esc_html_e("Admin","wp-app-studio"); ?></a></li>
            <li><a href="#tab3" data-toggle="tab"><?php esc_html_e("Mail","wp-app-studio"); ?></a></li>
            <li><a href="#tab4" data-toggle="tab"><?php esc_html_e("Assets","wp-app-studio"); ?></a></li>
            <li><a href="#tab5" data-toggle="tab"><?php esc_html_e("CSS","wp-app-studio"); ?></a></li>
            <li><a href="#tab6" data-toggle="tab"><?php esc_html_e("PHP","wp-app-studio"); ?></a></li>
        </ul>
        <input type="hidden" value="" name="app" id="app">
        <div class="tab-content">
            <div class="emdt-row emdt-alert">
                <div class="alert alert-info"><a data-placement="bottom" href="#"
                        title="<?php esc_html_e("Settings page offers quick configuration of some of the features of your application.","wp-app-studio"); ?>"><i
                            class="icon-info-sign"></i></a><a title="Go to App Settings Component page" rel="tooltip"
                        href="<?php echo WPAS_URL . '/components/app-settings/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>"
                        target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div>
            </div>
            <div class="tab-pane active" id="tab1">
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Textdomain","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_plugin_name" id="ao_plugin_name" type="text"
                            placeholder="<?php esc_html_e("e.g. sim-ent","wp-app-studio"); ?>" value="">
                        <a href="#"
                            title="<?php esc_html_e("Set a unique textdomain for your app. It can contain only letters and dashes, not more than 15 chars.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Site URL","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_domain" id="ao_domain" type="text"
                            placeholder="<?php esc_html_e("e.g. http://example.com","wp-app-studio"); ?>" value="">
                        <a href="#"
                            title="<?php esc_html_e("Enter your the URL of site starting with http://..","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("Site Name","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_blog_name" id="ao_blog_name" type="text"
                            placeholder="<?php esc_html_e("e.g. My WordPress Blog","wp-app-studio");?>" value="">
                        <a href="#" title="<?php esc_html_e("Enter your blog's title.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Settings Menu Label","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_set_menu_label" id="ao_set_menu_label" type="text"
                            placeholder="<?php esc_html_e("e.g. WP Ticket","wp-app-studio");?>" value="">
                        <a href="#"
                            title="<?php esc_html_e("Enter your app settings menu label which will be displayed on the left navigation menu of the admin area. It can contain only letters and spaces, not more than 15 chars.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Application Short Desc","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea class="wpas-std-textarea" name="ao_app_sdesc" id="ao_app_sdesc"
                            placeholder="<?php esc_html_e("e.g. Product List Application","wp-app-studio"); ?>"
                            value=""></textarea>
                        <a href="#"
                            title="<?php esc_html_e("Enter a short description of the application","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Application Desc","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea class="wpas-std-textarea" name="ao_app_desc" id="ao_app_desc" value=""></textarea>
                        <a href="#" title="<?php esc_html_e("Enter a description of the application","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Application Version","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_app_version" id="ao_app_version" type="text"
                            placeholder="<?php esc_html_e("e.g 1.0.0","wp-app-studio"); ?>" value="">
                        <a href="#" title="<?php esc_html_e("Enter the application's version number.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Author","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_author" id="ao_author" type="text"
                            placeholder="<?php esc_html_e("Name Of The Plugin Author","wp-app-studio"); ?>" value="">
                        <a href="#" title="<?php esc_html_e("Name of the application author.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Author Site Url","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_author_url" id="ao_author_url" type="text"
                            placeholder="<?php esc_html_e("e.g. http://example.com","wp-app-studio"); ?>" value="">
                        <a href="#" title="<?php esc_html_e("URI of the application author.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label req"><?php esc_html_e("Change Log","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea class="wpas-std-textarea" name="ao_change_log" id="ao_change_log"
                            placeholder="= 1.0.0 =" value=""></textarea>
                        <a href="#"
                            title="<?php esc_html_e("Enter a brief description for changes in your app version.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="control-group row-fluid">
                    <div class="controls">
                        <label class="checkbox"><?php esc_html_e("Set Admin Notice 1","wp-app-studio"); ?>
                            <input type="checkbox" name="ao_adm_notice1" id="ao_adm_notice1" value="1">
                            <a href="#"
                                title="<?php esc_html_e("Displays a primary admin notice to users upon plugin activation with a dismiss link.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </label>
                    </div>
                </div>
                <div id="ao_adm_notice1_detail_div" style="display:none;">
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice URL 1","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice1_url" id="ao_adm_notice1_url" type="text"
                                placeholder="<?php echo "e.g. " . WPAS_URL; ?>" value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the url of the admin notice 1 linked to.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice Description 1","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice1_desc" id="ao_adm_notice1_desc" type="text"
                                placeholder="<?php esc_html_e("e.g. New to WP App Studio? Review the Documentation","wp-app-studio"); ?>"
                                value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the admin notice 1 message. Max 350 chars.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <div class="controls">
                        <label class="checkbox"><?php esc_html_e("Set Admin Notice 2","wp-app-studio"); ?>
                            <input type="checkbox" name="ao_adm_notice2" id="ao_adm_notice2" value="1">
                            <a href="#"
                                title="<?php esc_html_e("Displays a secondary admin notice to users upon plugin activation with a dismiss link.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </label>
                    </div>
                </div>
                <div id="ao_adm_notice2_detail_div" style="display:none;">
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice URL 2","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice2_url" id="ao_adm_notice2_url" type="text"
                                placeholder="<?php echo "e.g. " . WPAS_URL; ?>" value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the url of the admin notice 2 linked to.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice Description 2","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice2_desc" id="ao_adm_notice2_desc" type="text"
                                placeholder="<?php esc_html_e("e.g. New to WP App Studio? Review the Documentation","wp-app-studio"); ?>"
                                value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the admin notice 2 message. Max 350 chars.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <div class="controls">
                        <label class="checkbox"><?php esc_html_e("Set Admin Notice 3","wp-app-studio"); ?>
                            <input type="checkbox" name="ao_adm_notice3" id="ao_adm_notice3" value="1">
                            <a href="#"
                                title="<?php esc_html_e("Displays a primary admin notice to users upon plugin activation with a dismiss link.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </label>
                    </div>
                </div>
                <div id="ao_adm_notice3_detail_div" style="display:none;">
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice URL 3","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice3_url" id="ao_adm_notice3_url" type="text"
                                placeholder="<?php echo "e.g. " . WPAS_URL; ?>" value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the url of the admin notice 3 linked to.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice Description 3","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice3_desc" id="ao_adm_notice3_desc" type="text"
                                placeholder="<?php esc_html_e("e.g. New to WP App Studio? Review the Documentation","wp-app-studio"); ?>"
                                value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the admin notice 3 message. Max 350 chars.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label req"><?php esc_html_e("Notice Expiration 3","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_adm_notice3_exp" id="ao_adm_notice3_exp" type="text"
                                value="">
                            <a href="#"
                                title="<?php esc_html_e("Sets the admin notice 3 expiration date.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <div class="control-group row-fluid">
                        <label class="control-label"><?php esc_html_e("Modify Toolbar ","wp-app-studio"); ?></label>
                        <div class="controls">
                            <select id="ao_modify_admin_bar" name="ao_modify_admin_bar" class="input-large">
                                <option value=""><?php esc_html_e("Please select","wp-app-studio"); ?></option>
                                <option value="1"><?php esc_html_e("Remove both toolbars","wp-app-studio"); ?></option>
                                <option value="2"><?php esc_html_e("Remove backend toolbar","wp-app-studio"); ?></option>
                                <option value="3"><?php esc_html_e("Remove frontend toolbar","wp-app-studio"); ?></option>
                                <option value="4">
                                    <?php esc_html_e("Remove all standard admin toolbar menus","wp-app-studio"); ?></option>
                            </select>
                            <a href="#"
                                title="<?php esc_html_e("Remove both toolbars: Allows to remove admin toolbar from the backend and the front side of your website. Remove backend toolbar: Allows to remove admin toolbar from the backend. Remove frontend toolbar: Allows to remove admin toolbar from the front side of your website. Remove all standard admin toolbar menus: Allows to remove all default admin toolbar menus.","wp-app-studio"); ?>"><i
                                    class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label"><?php esc_html_e("Login logo image url","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_login_logo_url" id="ao_login_logo_url" type="text"
                                placeholder="<?php esc_html_e("http://path-to-my-application-logo","wp-app-studio"); ?>"
                                value="">
                            <a href="#"
                                title="<?php esc_html_e("Enter login logo image url for the application. It is displayed above the login box. For best results, use an image that is less than 326 pixels wide.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label"><?php esc_html_e("Toolbar image url","wp-app-studio"); ?></label>
                        <div class="controls">
                            <input class="input-xlarge" name="ao_admin_logo_url" id="ao_admin_logo_url" type="text"
                                placeholder="<?php esc_html_e("http://path-to-my-application-toolbar-logo","wp-app-studio"); ?>"
                                value="">
                            <a href="#"
                                title="<?php esc_html_e("Enter toolbar image url for the application. It is displayed in the admin toolbar. For best results, use an image that is 20x20 pixels.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="control-group row-fluid">
                        <label class="control-label"><?php esc_html_e("Left footer","wp-app-studio"); ?></label>
                        <div class="controls">
                            <textarea class="wpas-std-textarea" id="ao_left_footer_html"
                                name="ao_left_footer_html"></textarea>
                            <a href="#"
                                title="<?php esc_html_e("Displays a message in the left hand side of the backend footer.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="row-fluid control-group">
                        <label class="control-label"><?php esc_html_e("Right footer","wp-app-studio"); ?></label>
                        <div class="controls">
                            <textarea class="wpas-std-textarea" id="ao_right_footer_html"
                                name="ao_right_footer_html"></textarea>
                            <a href="#"
                                title="<?php esc_html_e("Displays a message in the right hand side of the backend footer.","wp-app-studio"); ?>">
                                <i class="icon-info-sign"></i></a>
                        </div>
                    </div>
                    <div class="controls">
                        <div class="control-group">
                            <label class="checkbox"><?php esc_html_e("Customize navigation menus","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_modify_navigation_menus" id="ao_modify_navigation_menus"
                                    value="1">
                                <a href="#" title="<?php esc_html_e("Allows to display or remove menus.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div id="sub-controls">
                            <div class="subcontrols" style="margin-left: 15px;">
                                <div id="support-cust-nav-div" style="display:none;">
                                    <div class="row-fluid control-group" id="ao_dashboard_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display dashboard menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_dashboard_on" id="ao_dashboard_on"
                                                value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the dashboard menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_posts_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Posts menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_posts_on" id="ao_posts_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the posts menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_media_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Media menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_media_on" id="ao_media_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the media menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_links_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Links menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_links_on" id="ao_links_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the links menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_pages_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Pages menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_pages_on" id="ao_pages_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the pages menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_appearance_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Appearance menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_appearance_on" id="ao_appearance_on"
                                                value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the appearance menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_tools_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Tools menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_tools_on" id="ao_tools_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the tools menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_users_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Users menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_users_on" id="ao_users_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the users menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                    <div class="control-group row-fluid" id="ao_comments_on_div">
                                        <label class="checkbox"><?php esc_html_e("Display Comments menu","wp-app-studio"); ?>
                                            <input type="checkbox" name="ao_comments_on" id="ao_comments_on" value="1">
                                            <a href="#"
                                                title="<?php esc_html_e("Allows to display or remove the comments menu.","wp-app-studio"); ?>">
                                                <i class="icon-info-sign"></i></a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove all default dashboard widgets","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_remove_std_dashboard_widgets"
                                    id="ao_remove_std_dashboard_widgets" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Allows to remove all the standard dashboard widgets.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid">
                            <label
                                class="checkbox"><?php esc_html_e("Force the Number of Columns in Dashboard","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_force_dashboard_to_column"
                                    id="ao_force_dashboard_to_column" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Forces the number of columns in the admin dashboard widgets.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid" id="ao_force_col_div" style="display:none;">
                            <select id="ao_force_dash_column_num" name="ao_force_dash_column_num" class="input-xlarge">
                                <option value=""><?php esc_html_e("Please select","wp-app-studio"); ?></option>
                                <option value="1"><?php esc_html_e("1 column","wp-app-studio"); ?></option>
                                <option value="2"><?php esc_html_e("2 columns","wp-app-studio"); ?></option>
                                <option value="3"><?php esc_html_e("3 columns","wp-app-studio"); ?></option>
                                <option value="4"><?php esc_html_e("4 columns","wp-app-studio"); ?></option>
                                <option value="5"><?php esc_html_e("5 columns","wp-app-studio"); ?></option>
                            </select>
                            <a href="#"
                                title="<?php esc_html_e("Select the number of columns in the admin dashboard widgets.","wp-app-studio"); ?>"><i
                                    class="icon-info-sign"></i></a>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove Visual Shortcode Builder","wp-app-studio"); ?>
                                <input name="ao_remove_stdfilter" id="ao_remove_stdfilter" type="checkbox" value="1" />
                                <a href="#"
                                    title="<?php esc_html_e("Visual Shortcode Builder allows to display or remove standard view filters in WPAS button list on admin edit page screen toolbar. Check to remove this capability.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove Filters","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_remove_colfilter" id="ao_remove_colfilter" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Allows to display or remove Filters and Columns component on admin entity list screens.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove PDF/CSV Export in Filters","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_remove_csvpdf" id="ao_remove_csvpdf" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Allows to display or remove export filter results to pdf or csv file on admin entity list screens.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove Operations","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_remove_operations" id="ao_remove_operations" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Allows to display or remove Operations page and its button. Operations page is used to visually import/export and reset content of a specific entity and available for admins only.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove Analytics","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_remove_analytics" id="ao_remove_analytics" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Allows to display or remove analytics component. Analtics component is used in WPAS button list on admin edit page screen toolbar. to produce summary calculations (SUM, COUNT, MEAN etc.) based on attributes, taxonomies, and relationships.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                        <div class="control-group row-fluid">
                            <label class="checkbox"><?php esc_html_e("Remove Visibility Settings","wp-app-studio"); ?>
                                <input type="checkbox" name="ao_remove_visibility" id="ao_remove_visibility" value="1">
                                <a href="#"
                                    title="<?php esc_html_e("Allows to create or remove visibility settings for attributes, relationships and taxonomies in plugin settings page.","wp-app-studio"); ?>">
                                    <i class="icon-info-sign"></i></a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("Mail FROM email address","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_mail_from_email" id="ao_mail_from_email" type="text"
                            placeholder="<?php esc_html_e("e.g. info@example.com","wp-app-studio"); ?>" value="">
                        <a href="#"
                            title="<?php esc_html_e("Sets the FROM email address for the application wide emails","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("Mail FROM name","wp-app-studio"); ?></label>
                    <div class="controls">
                        <input class="input-xlarge" name="ao_mail_from_name" id="ao_mail_from_name" type="text"
                            placeholder="<?php esc_html_e("e.g. Webmaster","wp-app-studio"); ?>" value="">
                        <a href="#"
                            title="<?php esc_html_e("Sets the name of the sender for the application wide emails.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab4">
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("Images","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea id="ao_img" name="ao_img" class="wpas-std-textarea"
                            placeholder=" YOU MUST USE .jpg,.png .jpeg, .gif, .tiff, .svg"></textarea>
                        <a href="#"
                            title="<?php esc_html_e("Enter semicolon separated image file urls starting with https. All files will available locally. You can point to the files using IMGDIR constant. Exp; IMGDIR/example.png.","wp-app-studio");?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("Fonts","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea id="ao_fonts" name="ao_fonts" class="wpas-std-textarea"
                            placeholder=" YOU MUST USE .eot, .svg, .ttf, .woff"></textarea>
                        <a href="#"
                            title="<?php esc_html_e("Enter semicolon separated font file urls starting with https. All files will available locally. You can point to the files using FONTDIR constant. Exp; FONTDIR/example.ttf.","wp-app-studio");?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab5">
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("Css","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea class="wpas-std-textarea" id="ao_css" name="ao_css"></textarea>
                        <a href="#"
                            title="<?php esc_html_e("Adds app-wide css definitions. You can use this field to insert common CSS definitions.","wp-app-studio"); ?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab6">
                <div class="control-group row-fluid">
                    <label class="control-label"><?php esc_html_e("PHP","wp-app-studio"); ?></label>
                    <div class="controls">
                        <textarea id="ao_php" name="ao_php" class="wpas-std-textarea"
                            placeholder="&lt;php \n//CODE HERE\n?&lt;"><?php echo esc_textarea("<?php \n//CODE HERE\n?>"); ?></textarea>
                        <a href="#" title="<?php esc_html_e("Adds app-wide php code.","wp-app-studio");?>">
                            <i class="icon-info-sign"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="control-group emdt-row">
        <button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button"><i
                class="icon-ban-circle">
            </i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
        <button class="btn btn-inverse layout-buttons" id="update-option" type="submit" value="Update">
            <i class="icon-save"></i><?php esc_html_e("Update","wp-app-studio"); ?></button>
    </div>
</form>
<?php
}
?>
