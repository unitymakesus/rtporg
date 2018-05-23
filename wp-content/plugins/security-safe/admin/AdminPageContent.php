<?php

namespace SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'WPINC' ) ) { die; }

/**
 * Class AdminPageContent
 * @package SecuritySafe
 * @since  0.2.0
 */
class AdminPageContent extends AdminPage {


    /**
     * This sets the variables for the page.
     * @since  0.1.0
     */  
    protected function set_page() {

        $this->slug = 'security-safe-content';
        $this->title = 'Content Protection';
        $this->description = 'Deter unauthorized users from modifying or stealing your content.';

        $this->tabs[] = array(
            'id' => 'settings',
            'label' => 'Settings',
            'title' => 'Content Settings',
            'heading' => false,
            'intro' => false,
            'content_callback' => 'tab_settings',
        );

    } // set_page()

    /**
     * This tab displays file settings.
     * @since  0.2.0
     */ 
    function tab_settings() {

        global $wp_version;

        $html = '';

        // Shutoff Switch
        $rows = $this->form_select( $this->settings, 'Content Policies', 'on', array( '0' => 'Disabled', '1' => 'Enabled' ), 'If you experience a problem, you may want to temporarily turn off all content policies at once to troubleshoot the issue. Be sure to clear your cache as well.' );
        $html .= $this->form_table( $rows );

        // Copyright Protection
        $html .= $this->form_section( 'Copyright Protection', 'Copyright protection is meant deter the majority of users from copying your content. These settings do not affect the admin area.' );
        $rows = $this->form_checkbox( $this->settings, 'Highlight Text', 'disable_text_highlight', 'Disable Text Highlighting', 'Prevent users from highlighting your content text.' );
        $rows .= $this->form_checkbox( $this->settings, 'Right Click', 'disable_right_click', 'Disable Right Click', 'Prevent users from right clicking on your site to save images or copy text.' );
        $html .= $this->form_table( $rows );

        $html .= '<p><b>NOTICE:</b> Be sure to clear your cache after changing these settings.</p>';

        // Save Button
        $html .= $this->button( 'Save Settings' );

        // Memory Cleanup
        unset ( $rows );

        return $html;

    } // tab_settings()


} // AdminPageContent()
