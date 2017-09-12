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
    <?php settings_fields( 'sircus-viewer-option-group' ); ?>
    <?php do_settings_sections( 'sircus-viewer-option-group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'Enable Caching', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td><input type="checkbox" name="sircus_cache_enabled" value="1" <?php checked( 1 == get_option('sircus_cache_enabled' ) ); ?> />
            <span>If you have caching enabled, be sure to set an appropriate cache lifetime.</span></td>
        </tr>

        <tr valign="top">
            <td colspan="3">
                <span>
                    <?php
                    _e(
                        "CAUTION: Only modify this value if you know what you're doing. " .
                        "This is a convenience for developers that could cause the SIRCUS viewer to operate slowly.",
                        SIRCUS_VIEWER_TEXT_DOMAIN
                    );
                    ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Cache Lifetime (seconds)', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td><input class="textinput regular-text ltr" type="text" name="sircus_cache_lifetime" value="<?php echo get_option('sircus_cache_lifetime'); ?>" />
            <span>This is only in effect if caching is enabled.</span></td>
        </tr>

        <tr valign="top">
            <td colspan="3">
                <span>
                    <?php
                    _e(
                        "CAUTION: Only modify this value if you know what you're doing. " .
                        "This is a convenience for developers that could cause the SIRCUS viewer to stop updating.",
                        SIRCUS_VIEWER_TEXT_DOMAIN
                    );
                    ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'SIRCUS List API Endpoint', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td><input class="textinput regular-text ltr" type="text" name="sircus_endpoint_list" value="<?php echo get_option('sircus_endpoint_list'); ?>" /></td>
        </tr>

        <tr valign="top">
            <td colspan="3">
                <span>
                    <?php
                        _e(
                            "CAUTION: Only modify this value if you know what you're doing. " .
                            "This is a convenience for developers that could cause the SIRCUS viewer to stop working.",
                            SIRCUS_VIEWER_TEXT_DOMAIN
                        );
                    ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'SIRCUS Items API Endpoint', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td><input class="textinput regular-text ltr" type="text" name="sircus_endpoint_items" value="<?php echo get_option('sircus_endpoint_items'); ?>" /></td>
        </tr>

        <tr valign="top">
            <td colspan="3">
                <span>
                    <?php
                    _e(
                        "CAUTION: Only modify this value if you know what you're doing. " .
                        "This is a convenience for developers that could cause the SIRCUS viewer to stop working.",
                        SIRCUS_VIEWER_TEXT_DOMAIN
                    );
                    ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'SIRCUS API Key', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td><input class="textinput regular-text ltr" type="text" name="sircus_api_key" value="<?php echo get_option('sircus_api_key'); ?>" /></td>
        </tr>

        <tr valign="top">
            <td colspan="3">
                <span>
                    <?php
                    _e(
                        "CAUTION: Only modify this value if you know what you're doing. " .
                        "This is a convenience for developers that could cause the SIRCUS viewer to stop working.",
                        SIRCUS_VIEWER_TEXT_DOMAIN
                    );
                    ?>
                </span>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><?php _e( 'Display This List Of Tags In The Filter', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <textarea cols="80" name="sircus_tag_list" ><?php echo get_option('sircus_tag_list'); ?></textarea>
                <p class="description">
                    <?php
                    _e(
                        "Enter a comma separated list of tags. " .
                        "Rtp, Research, Education, Jobs",
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