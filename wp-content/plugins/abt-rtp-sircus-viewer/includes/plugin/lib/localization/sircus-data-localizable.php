<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 9:51 AM
 * To change this template use File | Settings | File Templates.
 *
 * This is an object that's acting as a static data repo
 * which can be localized (converted to json data by wordpress)
 * for use in the sircus viewer angular app.
 *
 * Creates a number of important public data members.
 *
 *
 */
class SircusDataLocalizable extends WordPressLocalizable
{
    /**
     *
     */
    const PAGE_LIMIT_MOBILE_DEFAULT = 24;
    /**
     *
     */
    const PAGE_LIMIT_DESKTOP_DEFAULT = 50;

    /**
     *
     */
    const DOMAIN_QUERY_VAR_DEFAULT      = 'd';

    /**
     *
     */
    const DOMAIN_PAGE_QUERY_VAR_DEFAULT = 'dp';

    /**
     *
     */
    const SEARCH_QUERY_VAR_DEFAULT = 's';

    /**
     * @var string
     */
    protected $domain_query_var = self::DOMAIN_QUERY_VAR_DEFAULT;

    /**
     * @var string
     */
    protected $domain_page_query_var = self::DOMAIN_PAGE_QUERY_VAR_DEFAULT;

    /**
     * @var string
     */
    protected $search_query_var = self::SEARCH_QUERY_VAR_DEFAULT;

    /**
     * @var int
     */
    protected $page_limit_mobile  = self::PAGE_LIMIT_MOBILE_DEFAULT;
    /**
     * @var int
     */
    protected $page_limit_desktop = self::PAGE_LIMIT_DESKTOP_DEFAULT;

    /**
     * @param string $domain_page_query_var
     */
    public function setDomainPageQueryVar( $domain_page_query_var = self::DOMAIN_PAGE_QUERY_VAR_DEFAULT )
    {
        $this->domain_page_query_var = $domain_page_query_var;
    }

    /**
     * @return string
     */
    public function getDomainPageQueryVar()
    {
        return $this->domain_page_query_var;
    }

    /**
     * @param string $domain_query_var
     */
    public function setDomainQueryVar( $domain_query_var = self::DOMAIN_QUERY_VAR_DEFAULT )
    {
        $this->domain_query_var = $domain_query_var;
    }

    /**
     * @return string
     */
    public function getDomainQueryVar()
    {
        return $this->domain_query_var;
    }

    /**
     * @param int $page_limit_desktop
     */
    public function setPageLimitDesktop($page_limit_desktop = self::PAGE_LIMIT_DESKTOP_DEFAULT)
    {
        $this->page_limit_desktop = $page_limit_desktop;
    }

    /**
     * @return int
     */
    public function getPageLimitDesktop()
    {
        return $this->page_limit_desktop;
    }

    /**
     * @param int $page_limit_mobile
     */
    public function setPageLimitMobile($page_limit_mobile = self::PAGE_LIMIT_MOBILE_DEFAULT)
    {
        $this->page_limit_mobile = $page_limit_mobile;
    }

    /**
     * @return int
     */
    public function getPageLimitMobile()
    {
        return $this->page_limit_mobile;
    }

    /**
     * @param string $search_query_var
     */
    public function setSearchQueryVar($search_query_var)
    {
        $this->search_query_var = $search_query_var;
    }

    /**
     * @return string
     */
    public function getSearchQueryVar()
    {
        return $this->search_query_var;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->_init();
    }

    /**
     * This needs special handling because the data members are assigned
     * when this object is instantiated. Since some item values are populated
     * from or based on the configuration data, then whenever the config reader
     * changes, we'll need to re-initialize this object
     *
     */
    public function setConfigReader( $config_reader )
    {
        $this->_config_reader = $config_reader;
        $this->_init();
    }

    /**
     *
     */
    private function _init()
    {
        $this->_initUrls();
        $this->_initI18n();
        $this->_initSettings();
        $this->_pageLimit();

    }

    /**
     * Collects important Urls & information
     *
     * This info
     */
    private function _initUrls()
    {
        $this->site_url     = site_url();
        $this->theme_url    = get_stylesheet_directory_uri();
        $this->plugin_url   = plugins_url( '', SIRCUS_VIEWER_BASE );
        $this->ajax_url     = admin_url( 'admin-ajax.php' );
        $this->partials_url = plugins_url( '/js/plugin/app/partials', SIRCUS_VIEWER_BASE );

        if ( $this->getConfigReader() )
            $this->api_url = $this->getConfigReader()->get_config( 'sircus_endpoint_items' );

        if ( $this->getConfigReader() )
            $this->api_key = $this->getConfigReader()->get_config( 'sircus_api_key' );

        $this->page  = get_query_var( $this->getDomainPageQueryVar() ) ? get_query_var( $this->getDomainPageQueryVar() ) : 1;
        $this->query = get_query_var( $this->getSearchQueryVar() ) ? get_query_var( $this->getSearchQueryVar() ) : '';
        $this->limit = get_option('posts_per_page', 10);
    }

    /**
     * Sets up translations (i18n) for partials vocabulary
     */
    private function _initI18n()
    {
        $this->i18n =
            array(
                'Play Video'   => $this->_getTranslation( 'Play Video' ),
                'Favorite'     => $this->_getTranslation( 'Favorite' ),
                'Likes'        => $this->_getTranslation( 'Likes' ),
                'Like'         => $this->_getTranslation( 'Like' ),
                'You Liked'    => $this->_getTranslation( 'You Liked' ),
                'Share'        => $this->_getTranslation( 'Share' ),
                'Source'       => $this->_getTranslation( 'Source' ),
                'View Source'  => $this->_getTranslation( 'View Source' ),
                'Author'       => $this->_getTranslation( 'Author' ),
                'Expand'       => $this->_getTranslation( 'Author' ),
                'Collapse'     => $this->_getTranslation( 'Author' ),
                'Discover'     => $this->_getTranslation( 'Discover' ),
                'See More'     => $this->_getTranslation( 'See More' ),
                'Loading'      => $this->_getTranslation( 'Loading' ),
                'Clear Filter' => $this->_getTranslation( 'Clear Filter' ),
                "Actually, we couldn't find anything. Try searching again."
                    => $this->_getTranslation( "Actually, we couldn't find anything. Try searching again." )

            );
    }

    /**
     * @param string $text
     * @return string|void
     */
    private function _getTranslation( $text )
    {
        return __( $text, 'abt-rtp-sircus-viewer' );
    }

    /**
     * Init other settings
     */
    private function _initSettings()
    {
        if ( $this->getConfigReader() ) {
            // Build out tag array - assumes tags are
            // stored as comma separated list
            $this->tags = array();
            $tags = $this->getConfigReader()->get_config( 'sircus_tag_list' );
            $tags = explode(',',$tags);
            foreach ( $tags as $tag ) {
                array_push($this->tags, strip_tags( stripslashes( trim( $tag ) ) ) );
            }
        }
    }

    /**
     * Get page limit for current browser.
     * uses wp_is_mobile detection
     * @return int
     */
    private function _pageLimit() {
        if ( wp_is_mobile() )
            return $this->page_limit = $this->getPageLimitMobile();
        else
            return $this->page_limit = $this->getPageLimitDesktop();
    }
}