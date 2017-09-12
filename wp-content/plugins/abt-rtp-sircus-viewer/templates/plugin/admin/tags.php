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
    <?php settings_fields( 'sircus-viewer-option-group-tag' ); ?>
    <?php do_settings_sections( 'sircus-viewer-option-group-tag' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'Discover Menu - Tag Filters', SIRCUS_VIEWER_TEXT_DOMAIN ); ?></th>
            <td>
                <textarea cols="80" name="sircus_tag_list" ><?php echo get_option('sircus_tag_list'); ?></textarea>
                <p class="description">
                    <?php
                    _e(
                        "Enter a comma separated list of tags, without the #. " .
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