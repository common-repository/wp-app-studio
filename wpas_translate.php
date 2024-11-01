<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$local_vars = Array(
'update' => __("Update","wp-app-studio"),
'save' => __("Save","wp-app-studio"),
'application' => __("Application","wp-app-studio"),
'entity' => __("Entity","wp-app-studio"),
'relationship' => __("Relationship","wp-app-studio"),
'help' => __("Help","wp-app-studio"),
'form' => __("Form","wp-app-studio"),
'taxonomy' => __("Taxonomy","wp-app-studio"),
'attribute' => __("Attribute","wp-app-studio"),
'tab' => __("Tab","wp-app-studio"),
'view' => __("View","wp-app-studio"),
'notify' => __("Notification","wp-app-studio"),
'connection' => __("Connection","wp-app-studio"),
'widget' => __("Widget","wp-app-studio"),
'add_new_application_settings'  => __("Add New Application Settings","wp-app-studio"),
'update_application_settings'  => __("Update Application Settings","wp-app-studio"),
'add_new_role'  => __("Add New Role","wp-app-studio"),
'role' => __("Role","wp-app-studio"),
'add_new_tab'  => __("Add New Tab","wp-app-studio"),
'add_new_form'  => __("Add New Form","wp-app-studio"),
'add_new_widget'  => __("Add New Widget","wp-app-studio"),
'add_new_view'  => __("Add New View","wp-app-studio"),
'add_new_notify' => __("Add New Notification","wp-app-studio"),
'add_new_connection' => __("Add New Connection","wp-app-studio"),
'add_new_help'  => __("Add New Help","wp-app-studio"),
'add_new_relationship' => __("Add New Relationship","wp-app-studio"),
'add_new_taxonomy'  => __("Add New Taxonomy","wp-app-studio"),
'add_new_attribute'  => __("Add New Attribute","wp-app-studio"),
'edit_form_layout'  => __("Edit Form Layout","wp-app-studio"),
'edit_admin_layout'  => __("Edit Admin Layout","wp-app-studio"),
'add_new_entity'  => __("Add New Entity","wp-app-studio"),
'update_settings'  => __("Update Settings","wp-app-studio"),
'support_ticket'  => __("Open a support ticket","wp-app-studio"),
'download_msg'  => __("Download","wp-app-studio"),
'glob' => __("Global","wp-app-studio"),
'add_new_glob'  => __("Add New Global","wp-app-studio"),
);
$form_vars = Array(
'req_missing_error' => __("Please add all required fields to the form layout.","wp-app-studio"),
'dupe_error' => __("Please check duplicate entries and try again.","wp-app-studio"),
'dropdown_error' => __("Please select an option for all dropdowns.","wp-app-studio"),
'size_error' => __("Please update element row sizes to the total of 12.","wp-app-studio"),
'multiple_button_error' => __("There must be only one submit button.","wp-app-studio"),
);
$layout_vars = Array(
'edit_tab_title' => __("Tab Title (edit me)","wp-app-studio"),
'edit_acc_title' => __("Accordion Title (edit me)","wp-app-studio"),
'edit_tab_gr_title' => __("Tab Group Title (edit me)","wp-app-studio"),
'edit_acc_gr_title' => __("Accordion Group Title (edit me)","wp-app-studio"),
'drag_drop' => __("DRAG AND DROP","wp-app-studio"),
);
$validate_vars = Array(
'check_app_title' => __("Must contain only letters, numbers or spaces and must start with a letter.","wp-app-studio"),
'nowoo_term' => __("Please select a term for the attached taxonomy.","wp-app-studio"),
'nowoo_tax' => __("Please select a taxonomy which will be connected to both order and product.","wp-app-studio"),
'noedd_term' => __("Please select a term for the attached taxonomy.","wp-app-studio"),
'noedd_tax' => __("Please select a taxonomy which will be connected to both order and download.","wp-app-studio"),
'nocap_err' => __("Please remove capital letters.","wp-app-studio"),
'nospace_err' => __("Please remove spaces.","wp-app-studio"),
'nodash_err' => __("Please remove dashes.","wp-app-studio"),
'check_num' => __("Must contain only integers or -1.","wp-app-studio"),
'check_int' => __("Must contain only integers.","wp-app-studio"),
'check_alpha_num' => __("Must contain only letters or numbers.","wp-app-studio"),
'check_alpha_num_dash' => __("Must contain only letters, numbers or dashes.","wp-app-studio"),
'check_alpha_dash' => __("Must contain only letters or dashes and must start with a letter.","wp-app-studio"),
'check_alpha_dash_fa' => __("Must contain only letters and dashes and start with fa-.","wp-app-studio"),
'check_alpha_num_und' => __("Must contain only letters, numbers or underscores.","wp-app-studio"),
'check_alpha_num_und_dash' => __("Must contain only letters, numbers, underscores or dashes.","wp-app-studio"),
'check_alpha_num_comma' => __("Must contain only letters, numbers and commas.","wp-app-studio"),
'check_alpha_num_und_semi_cur' => __("Must contain only letters, numbers, underscores, semicolon and curly brackets.","wp-app-studio"),
'check_tax_char' => __("Must contain only letters, numbers, underscores, semicolon, curly and square brackets.","wp-app-studio"),
'check_version' => __("Must contain only numbers and dots.","wp-app-studio"),
'check_semico' => __("You need to seperate each option value with a semicolon and each option must have a value defined within curly brackets.","wp-app-studio"),
'check_values' => __("You need to seperate each option value with a semicolon and each option must have a value defined within curly  or/and square brackets.","wp-app-studio"),
'check_js_values' => __("You need to seperate file urls with a semicolon and use only files from cdns: cdnjs.cloudflare.com and cdn.jsdelivr.net or raw.githubusercontent.com.","wp-app-studio"),
'check_img_values' => __("You need to seperate file urls with a semicolon and use only files with .jpg, .jpeg, .png, .tiff, .gif, .svg.","wp-app-studio"),
'check_font_values' => __("You need to seperate file urls with a semicolon and use only files with .eot, .svg, .ttf, .woff.","wp-app-studio"),
'check_default' => __("You cannot have multiple default values.","wp-app-studio"),
'no_reserved' => __("You cannot use reserved words.","wp-app-studio"),
'check_help' => __("Please select a different attach to or screen type.","wp-app-studio"),
'check_unique' => __("Please enter a unique name.","wp-app-studio"),
'check_email' => __("Please enter valid email(s).","wp-app-studio"),
'check_reluser' => __("You cannot create User to User relationship. Please select a different entity.","wp-app-studio"),
'check_dash' => __("Widget must be displayed at least one location.","wp-app-studio"),
'check_app_dash' => __("Your layout can't contain shortcodes which are already in app dashboard.","wp-app-studio"),
'check_notify' => __("Please setup at least one of user or admin notification.","wp-app-studio"),
);

?>
