<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:42 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="wrap">
<h2><?php _e( 'SIRCUS Viewer Settings', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'sircus-viewer-option-group-api' ); ?>
    <?php do_settings_sections( 'sircus-viewer-option-group-api' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'SIRCUS List API Endpoint', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <input class="textinput regular-text ltr" type="text" name="sircus_endpoint_list" value="<?php echo get_option('sircus_endpoint_list'); ?>" />
                <p class="description">
                    <?php
                        _e(
                            "Caution: Only modify this value if you know what you're doing. " .
                            "This is a convenience for developers that could cause the SIRCUS viewer to stop working.",
                            SIRCUS_VIEWER_TEXT_DOMAIN
                        );
                    ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'SIRCUS Items API Endpoint', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <input class="textinput regular-text ltr" type="text" name="sircus_endpoint_items" value="<?php echo get_option('sircus_endpoint_items'); ?>" />
                <p class="description">
                    <?php
                    _e(
                        "Caution: Only modify this value if you know what you're doing. " .
                        "This is a convenience for developers that could cause the SIRCUS viewer to stop working.",
                        SIRCUS_VIEWER_TEXT_DOMAIN
                    );
                    ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'SIRCUS API Key', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <input class="textinput regular-text ltr" type="text" name="sircus_api_key" value="<?php echo get_option('sircus_api_key'); ?>" />
                <p class="description">
                    <?php
                    _e(
                        "Caution: Only modify this value if you know what you're doing. " .
                        "This is a convenience for developers that could cause the SIRCUS viewer to stop working.",
                        SIRCUS_VIEWER_TEXT_DOMAIN
                    );
                    ?>
                </p>
            </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>