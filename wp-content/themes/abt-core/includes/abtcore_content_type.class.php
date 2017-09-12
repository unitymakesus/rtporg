<?php

/**
 * Generic helper for custom post types
 * @author jeremys
 *
 */
class ABTCore_Content_Type {

	/**
	 * the unique identifier for this content type
	 */
	private $type_name;
	/**
	 * Public accessor to $type_name
	 */
	public function getType(){
		return $this->type_name;
	}//--	fn	getType
	
	/**
	 * Stored content-type settings
	 */
	private $settings;
	/**
	 * Get indicated setting (from `get_option()`)
	 * @return the indicated option
	 */
	public function setting( $key = NULL ) {
		return $this->settings[$key]; 
	}//--	fn	setting
	/**
	 * Get all settings
	 * @return all settings
	 */
	public function settings(){
		return $this->settings;
	}//--	fn	settings
	
	/**
	 * Constructor
	 * @param string $type_name the unique identifier for this content type
	 */
	function __construct( $type_name ){
		$this->type_name = strtolower( $type_name );
		$this->settings = get_option( $this->type_name . '_type_options' );
		
		$this->slug = ( isset( $this->settings['slug'] ) ? $this->settings['slug'] : $this->type_name );
	}//--	fn	construct
	
	
	#region ============================= CREATE & SETTINGS & REGISTER =======================
	
	/**
	 * Internal storage for post type settings, used in registering
	 */
	private $post_type_args = array();
	
	/**
	 * flag to allow registration
	 */
	private $_can_register = false;
	
	private $slug;
	
	private $singular, $plural;
	public function getSingular(){
		return $this->singular;
	}
	public function getPlural(){
		return $this->plural;
	}
	
	
	/**
	 * Create the new content type with labels, args - must call $this->register afterwards to save the post type
	 * @param string $plural the plural form of the content type - also the default name
	 * @param string $singular the singular form of the content type
	 * @param array $args {optional} additional options, if you want to override defaults
	 * @param array $labels {optional} specify other labels, otherwise uses $singular and $plural to create defaults
	 */
	public function create( $plural, $singular, $args = array(), $labels = array() ){
		$this->singular = $singular;
		$this->plural   = $plural;
		
		$default_labels = array(
			'name'					=> __( $plural, 'abtcore' ),
			'singular_name' 		=> __( $singular, 'abtcore' ),
			'add_new'				=> __( "Add $singular", 'abtcore' ),
			'add_new_item'			=> __( "Add New $singular", 'abtcore' ),
			'new_item'				=> __( "Add New $singular", 'abtcore' ),
			'view_item'				=> __( "View $singular", 'abtcore' ),
			'search_items' 			=> __( "Search $plural", 'abtcore' ), 
			'edit_item' 			=> __( "Edit $singular", 'abtcore' ),
			'all_items'				=> __( "All $plural", 'abtcore' ),
			'not_found'				=> __( "No $plural found", 'abtcore' ),
			'not_found_in_trash'	=> __( "No $plural found in Trash", 'abtcore' )
		);
		$labels = wp_parse_args( $labels, $default_labels );
		
		$default_args = array(
			#'taxonomies'		=> array('people-categories'),
			'public'			=> true,
			'show_ui'			=> true,
			'capability_type'	=> 'post',
			'rewrite'			=> array('slug' => __( $this->slug, 'abtcore' ), 'with_front'=>false ),
			'hierarchical'		=> false,
			#'menu_position'		=> 20,
			'menu_icon'			=> ABTCORE_URL . "/plugins/{$this->type_name}/images/i_posttype.png",
			'supports'			=> array( 'title','editor','thumbnail','page-attributes','excerpt' )
		);
		$args = wp_parse_args( $args, $default_args );
		$args['labels'] = $labels;
		
		$this->post_type_args = $args;
		
		//allow registration
		$this->_can_register = true;
		
		return $this;
	}//--	fn	register
	
	/**
	 * Change post type argument (only useful if called before $this->register)
	 * @param string $property argument key as used in `register_post_type`
	 * @param mixed $value whatever to change it to
	 * 
	 * @returns $this (chaining)
	 */
	public function change_property( $property, $value ){
		$this->post_type_args[$property] = $value;
		return $this;
	}
	/**
	 * Change post type label (only useful if called before $this->register)
	 * @param string $property argument key as used in `register_post_type`
	 * @param mixed $value whatever to change it to
	 * 
	 * @returns $this (chaining)
	 */
	public function change_label( $property, $value ){
		$this->post_type_args['labels'][$property] = $value;
		return $this;
	}
	
	/**
	 * Actually perform the content type registration
	 * 
	 * @returns $this (chaining)
	 */
	public function register(){
		if( ! $this->_can_register ) {
			wp_die( 'Cannot register new post type [' . $this->type_name . ']: must initialize first.' );
		}
		
		// register new content type
		register_post_type( $this->type_name, $this->post_type_args );
		
		// toggle rewrites
		$this->rewrites();

		// bind save action - hooking here even if no meta details
		add_action( 'save_post', array( &$this, '_save_post' ) );

		return $this;
	}//--	fn	register
	
	private function rewrites(){
		// handle slug rewrites
		abtcore_include( 'abtcore_content_type_rewriter.class.php' );
		$rewriter = ABTCore_Content_Type_Rewriter::instance();
		$rewriter->register( $this->type_name );
	}
	
	

	#endregion ============================= CREATE & SETTINGS & REGISTER =======================
	
	
	
	
	
	#region ============================= TAXONOMIES =======================
	
	/**
	 * Create and attach taxonomy
	 * @param string $plural the plural form of the taxonomy - also used to create the type_name, if not explicityl given in $args
	 * @param string $singular the singular form of the taxonomy
	 * @param array $args {optional} override default arguments; give [type_name] here to 
	 * 
	 * @returns $this (chaining)
	 */
	public function add_taxonomy( $plural, $singular, $args = array() ){
		if ( isset( $args['type_name'] ) ){
			$type_name = $args['type_name'];
			unset( $args['type_name'] );
		}
		else {
			$type_name = $this->type_name . '-' . strtolower( str_replace( ' ', '-', $plural ) );
		}
		
		$default_args = array(
			'hierarchical'		=> true,
			'show_ui'			=> true,
			'rewrite'			=> array( 'slug' => __( $this->slug . '/' . $type_name ) ),
			'labels'			=> array(
					'name' 							=> $plural,
					'singular_name'					=> $singular,
					'search_items' 					=> __( "Search $plural", 'abtcore' ),
					'popular_items'					=> __( "Popular $plural", 'abtcore' ),
					'all_items'						=> __( "All $plural", 'abtcore' ),
					'parent_item'					=> __( "Parent $singular", 'abtcore' ),
					'parent_item_colon'				=> __( "Parent $singular", 'abtcore' ),
					'edit_item'						=> __( "Edit $singular", 'abtcore' ), 
					'update_item'					=> __( "Update $singular", 'abtcore' ),
					'add_new_item'					=> __( "Add New $singular", 'abtcore' ),
					'new_item_name'					=> __( "New $singular", 'abtcore' ),
					'separate_items_with_commas'	=> __( "Separate $plural with commas", 'abtcore' ),
					'add_or_remove_items' 			=> __( "Add or remove $plural", 'abtcore' ),
					'choose_from_most_used' 		=> __( "Choose from the most used $plural", 'abtcore' )
					)
		);
		$args = wp_parse_args( $args, $default_args );
		
		register_taxonomy( $type_name, $this->type_name, $args );
		
		return $this;
	}//--	fn	add_taxonomy
	
	/**
	 * Attach existing taxonomy to this content type
	 * @param string $taxonomy the taxonomy name
	 * 
	 * @returns $this (chaining)
	 */
	public function attach_taxonomy( $taxonomy ) {
		register_taxonomy_for_object_type( $taxonomy, $this->type_name );
		return $this;
	}//--	fn	add_taxonomy
	
	#endregion ============================= TAXONOMIES =======================
	
	
	
	
	
	#region ============================= METABOXES =======================

	/**
	 * Return the rendered HTML field id, based on the given field keys
	 * @param variable $key provide a list of keys
	 * @param variable $key2 second key, etc
	 * 
	 * @return string the HTML id attribute for fields
	 */
	function fieldid() {
		$key = func_get_args();
		return sprintf( '%s-%s', self::$instance->getType(), implode( '-', (array)$key ) );
	}
	/**
	 * Return the rendered HTML field name, based on the given field keys
	 * @param variable $key provide a list of keys
	 * @param variable $key2 second key, etc
	 * 
	 * @return string the HTML name attribute for fields
	 */
	function fieldname( $key ) {
		$key = func_get_args();
		return sprintf( '%s[%s]', self::$instance->getType(), implode( '][', (array)$key ) );
	}
	/**
	 * Return the post meta for the given post ID - must be of this content type
	 * @param int $postID the post to query
	 * @param string $key {optional} if provided, a subkey for the specific meta field (otherwise, returns an array)
	 * 
	 * @param array/string the requested meta detail
	 */
	function meta( $postID, $key = NULL ){
		$metas = get_post_meta( $postID, self::$instance->getType(), true );
		if( NULL === $key ) return $metas;
		
		//otherwise, get the subkey
		return ( isset( $metas[$key] ) ? $metas[$key] : NULL );
	}

	/**
	 * Add meta box - using callback function of same name (must be defined somewhere)
	 * @param object $self self-reference from child class
	 * @param string $id unique identifier (html id) of section
	 * @param string $title the metabox title
	 * @param string $position where to show on page
	 * @param string $priority order to show in $position
	 * @param mixed $args {optional} if given, will be passed into meta box callback
	 */
	public function add_meta_box( $id, $title, $position = 'normal', $priority = 'default', $args = NULL ){
		
		add_meta_box(
			$id	//identifier
			, __( $title, 'abtcore' )	// title
			, array( &$this, 'metabox_'.$id )	//callback
			, $this->type_name	//page, or post_type on which to appear
			, $position	//context
			, $priority	//priority
			, $args	// callback args
			);
		
		return $this;
	}//--	fn	add_meta_box
	
	/**
	 * Hook for saving metabox
	 * @param $id the post id
	 */
	public function _save_post( $id ){
		//nothing to do?
		if ( !isset( $_POST[$this->type_name] ) ) {
			return $id;
		}
		
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( !wp_verify_nonce( $_POST[$this->type_name . "-nonce"], $this->type_name . "-nonce" ) ) return $id; //nonce

		// verify if this is an auto save routine. 
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $id;
		
		// make sure we're the right post type?
		if( $this->type_name != $_POST['post_type'] )
			return $id;
		
		// OK, we're authenticated: we need to find and save the data
		
		$meta = $_POST[$this->type_name];
		
		// regular post meta data
		update_post_meta( $id, $this->type_name, $meta );
		
		// allow hooks
		do_action( 'abtcore_' . $this->type_name . '_save_post', $id, $_POST );
		
	}//--	fn	_save_post
	
	/**
	 * Turn a metabox section cloneable
	 * @param string $container_selector the metabox's selector (usually the jQuery id as defined in metabox, including #)
	 * @param string the add button's selector (usually the jQuery id of the button as defined in metabox, including #)
	 */
	public function _meta_box_clonable( $container_selector, $add_button_selector ){
		self::clonable_meta_box( $container_selector, $add_button_selector );
	}
	
	/**
	 * Turn a metabox section cloneable
	 * @param string $container_selector the metabox's selector (usually the jQuery id as defined in metabox, including #)
	 * @param string the add button's selector (usually the jQuery id of the button as defined in metabox, including #)
	 */
	public static function clonable_meta_box( $container_selector, $add_button_selector ){
		?>
		<script>
		(function($) {
			$(function() {
				$('<?php echo $add_button_selector; ?>').click(function(e) {
					
					var $groups = $('<?php echo $container_selector; ?> .fieldgroup')
						, $group = $groups.last()
						, $clone = $group.clone()
						, nth = $group.index() + 1
						, id = $clone.attr('id') + nth;

					$clone.find('label').each(function(i,o) {
						var $o = $(o);
						$o.attr('for', $o.attr('for') + nth );
					});

					// reset the cloned block
					$clone.find(':input').each(function(i,o) {
						var $o = $(o);
						$o.attr('id', $o.attr('id') + nth );
						$o.attr('name', $o.attr('name').replace(/\[[0-9]+\]/, '[' + nth + ']'));
						if ($o.is(':text')) $o.val('');
						if ($o.is('select')) $o.val('');
					});

					// reset the counts for all group inputs to avoid overwriting any options
					// note that $clone is not part of $groups because we retrieved it at the top
					$groups.each(function(groupNum, group){
						$(group).find(':input').each(function(i,o) {
							var $o = $(o);
							$o.attr('name', $o.attr('name').replace(/\[[0-9]+\]/, '[' + groupNum + ']'));
						});
					});

					$clone.attr('id', id);
					$clone.find('a.delete').each(function(i,o) {
						var $o = $(o);
						$o.attr('href', '#'+ id );
					});

					$group.after($clone); // attach the cloned item
					
					e.preventDefault(); // return false's better sibling.
				});

				$('<?php echo $container_selector; ?>').delegate('a.delete', 'click', function(e) {
					var $groups = $('<?php echo $container_selector; ?> .fieldgroup');
					var $group  = $groups.last();
					var nth  = $group.index();
					
					if(nth>0) {
						var $garbage = $( $(this).attr('href') );
						$garbage.empty().remove();
					} else {
						// reset the cloned block
						$group.find(':input').each(function(i,o) {
							var $o = $(o);
							$o.attr('id', $o.attr('id') + nth );
							$o.attr('name', $o.attr('name').replace(/\[[0-9]+\]/, '[' + nth + ']'));
							if ($o.is(':text')) $o.val('');
							if ($o.is('select')) $o.val('');
						});
					}
					
					e.preventDefault(); // return false's better sibling.
				});
			});
		})(jQuery);
		</script>
		<?php
	}//--	fn	_meta_box_clonable
	
	#endregion ============================= METABOXES =======================
	
}///---	class	ABTCore_Content_Type_Rewriter




/**
 * Body class for admin
 * @see http://www.kevinleary.net/customizing-wordpress-admin-css-javascript/
 */
function base_admin_body_class( $classes )
{
	// Current action
	if ( is_admin() && isset($_GET['action']) ) {
		$classes .= ' action-'.$_GET['action'];
	}
	// Current post ID
	if ( is_admin() && isset($_GET['post']) ) {
		$classes .= ' post-'.$_GET['post'];
	}
	// New post type & listing page
	if ( isset($_GET['post_type']) ){
		$post_type = $_GET['post_type'];
	}
	if ( isset($post_type) ) {
		$classes .= ' post-type-'.$post_type;
	}
	// Editting a post type
	if( isset( $_GET['post'] ) ):
		$post_query = $_GET['post'];
		if ( isset($post_query) ) {
			$current_post_edit = get_post( $post_query );
			if ( empty( $current_post_edit) ) return $classes;
			
			$current_post_type = $current_post_edit->post_type;
			if ( !empty($current_post_type) ) {
				$classes .= ' post-type-'.$current_post_type;
			}
		}
	endif;
	
	// Return the $classes string (array for non-admin?)
	return $classes;
}
add_filter( 'admin_body_class', 'base_admin_body_class' );