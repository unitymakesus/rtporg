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
    <?php settings_fields( 'sircus-viewer-option-group-cache' ); ?>
    <?php do_settings_sections( 'sircus-viewer-option-group-cache' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'Caching', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <div class="field">
                    <input type="checkbox" name="sircus_cache_enabled" value="1" <?php checked( 1 == get_option('sircus_cache_enabled' ) ); ?> />
                    <span>Enable</span>
                    <p class="description">
                        <?php
                        _e(
                            "Caution: For advanced users/developers only. ",
                            SIRCUS_VIEWER_TEXT_DOMAIN
                        );
                        ?>
                    </p>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e( 'Cache Lifetime (seconds)', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <input class="textinput regular-text ltr" type="text" name="sircus_cache_lifetime" value="<?php echo get_option('sircus_cache_lifetime'); ?>" />
                <p class="description">This is only in effect if caching is enabled.</p>
            </td>
        </tr>

    </table>

    <?php submit_button(); ?>

</form>
</div>