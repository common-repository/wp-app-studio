<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_branding_header()
{
?>
<div id="was-container-header">
    <div id="header-branding">
        <div class="logo">
            <a title="Wp App Studio <?php esc_html_e("home page","wp-app-studio") ?>" target="_blank"
                href="<?php echo WPAS_URL . "/?pk_campaign=wpas&pk_source=plugin&pk_medium=img&pk_content=logo"; ?>">
                <img src="<?php echo plugins_url('../img/WpAppStudioLogo.png',__FILE__); ?>"></a>
                <?php echo WPAS_VERSION ?>
        </div>
        <div style="padding:10px;"> If you like WP App Studio, we appreciate your 5 <span style="color:#E6B800;"><i class="icon-star icon-large"></i><i class="icon-star icon-large"></i><i class="icon-star icon-large"></i><i class="icon-star icon-large"></i><i class="icon-star icon-large"></i></span> <a href="https://wordpress.org/support/view/plugin-reviews/wp-app-studio" target="_blank">review on WordPres.org.</a></div>
        <div class="header-links">
            <ul class="list-inline">
                <li><a title="<?php esc_html_e("Features","wp-app-studio"); ?>" target="_blank"
                        href="<?php echo WPAS_URL . '/features/?pk_campaign=wpas&pk_source=plugin&pk_medium=btn&pk_content=features'; ?>">
                        <?php esc_html_e("Features","wp-app-studio"); ?></a>
                </li>
                <li><a title="<?php  esc_html_e("Documentation and Support","wp-app-studio");?>" target="_blank"
                        href="<?php echo WPAS_URL . '/wp-app-studio-knowledge-center/?pk_campaign=wpas&pk_source=plugin&pk_medium=btn&pk_content=docs'; ?>">
                        <?php esc_html_e("Docs & Support","wp-app-studio");?></a>
                </li>
                <li><a title="<?php esc_html_e("Buy Wp App Studio created plugins and designs","wp-app-studio"); ?>"
                        target="_blank"
                        href="https://emdplugins.com/?pk_campaign=wpas&pk_source=plugin&pk_medium=btn&pk_content=store">
                        <?php esc_html_e("Store","wp-app-studio"); ?></a></li>
                <li><a class="btn btn-danger" title="<?php esc_html_e("Get Started Now!","wp-app-studio"); ?>" target="_blank"
                        href="<?php echo WPAS_URL . '/wp-app-studio-pricing/?pk_campaign=wpas&pk_source=plugin&pk_medium=btn&pk_content=get-started'; ?>">
                        <?php echo esc_html__('Get Started Now','wp-app-studio') .  "<br> <span style='font-size:85%'>" . esc_html__('<em>Free</em> Plan is available!','wp-app-studio'); ?></span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
}
?>
