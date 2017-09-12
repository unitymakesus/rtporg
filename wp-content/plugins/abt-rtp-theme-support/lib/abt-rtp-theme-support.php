<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 7/7/14
 * Time: 4:11 PM
 * To change this template use File | Settings | File Templates.
 */
class AbtRtpThemeSupport
{

    public function initialize()
    {
        if ( is_admin() ){
            // admin actions


        } else {
            add_action( 'wp_enqueue_scripts', array( $this, 'include_scripts_styles' ) );
        }
    }


    /**
     * Register & enqueue basic scripts and styles that will be needed for all calculators.
     *
     */
    public function include_scripts_styles()
    {
        wp_register_script(
            'disqus-library',
            plugins_url( '/js/disqus-support.js', ABT_RTP_THEME_SUPPORT_BASE ),
            null,
            '1.2014.07.07.19',
            false
        );

        wp_enqueue_script( 'jquery' );

        wp_register_script(
            'abt-rtp-theme-support-init',
            plugins_url( '/js/init.js', ABT_RTP_THEME_SUPPORT_BASE ),
            array( 'jquery', 'disqus-library' ),
            '1.2014.07.07.19',
            false
        );

        wp_enqueue_script( 'abt-rtp-theme-support-init' );

        $disqus_data =
            array(
                'i18n' =>
                array(
                    'Comments' => __( 'Comments', 'abt-rtp-theme-support' ),
                    'Comment'  => __( 'Comment', 'abt-rtp-theme-support' ),
                )
            );

        wp_localize_script( 'disqus-library', 'disqus_data', $disqus_data );
    }
}