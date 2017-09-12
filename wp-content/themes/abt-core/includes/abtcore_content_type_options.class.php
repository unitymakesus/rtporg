<?php


class ABTCore_Content_Type_Options {

	protected $slug, $for_type, $page_title, $menu_title;
	protected $settings = array();
	
	/**
	 * return given setting
	 */
	public function settings($key){
		return $this->settings[$key];
	}
	
	/**
	 * formatted html field name
	 */
	public function fieldname($name){
		return esc_attr( $this->slug . "[$name]" );
	}
	/**
	 * formatted html field id
	 */
	public function fieldid($id){
		return esc_attr( $this->slug . "-$id" );
	}
	
	public function __construct($slug, $for_type, $page_title, $menu_title) {
		$this->slug = $slug;
		$this->for_type = $for_type;
		$this->page_title = __($page_title, 'abtcore');
		$this->menu_title = __($menu_title, 'abtcore');
		
		add_action('admin_init', array(&$this, 'register_settings'));
		add_action('admin_menu', array(&$this, 'add_option_page'));
		
		$this->settings = get_option($this->slug);
	}


	function register_settings() {
		//one setting for all options
		register_setting( $this->slug, $this->slug );
	}

	function add_option_page() {
		add_submenu_page('edit.php?post_type=' . $this->for_type, $this->page_title, $this->menu_title, 'manage_options', $this->slug, array(&$this, '_options'));
	}

	
	
	public function addbox($title, $inside){
		$this->_option_fields []= array('title'=>$title, 'inside'=>$inside);
	}
	
	private $_option_fields = array();
	
	/**
	 * loop through options as set
	 */
	public function options(){
		foreach($this->_option_fields as $field){
		?>
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br /></div>
			<h3 class="hndle"><?php _e($field['title'], 'abtcore'); ?></h3>
			<div class="inside">
				<?php echo $field['inside']; ?>
			</div>
		</div>
		<?php
		}
	}
	
	
	function _options() {
	?>
		<div class="wrap">

			<div id="icon-abtcore-options" class="icon32-<?php echo esc_attr($this->slug); ?> icon32"><br /></div>
			<h2><?php echo $this->page_title; ?></h2>
			<form action="options.php" method="post">
			
			<div id="poststuff" class="metabox-holder">
					<div id="post-body">
						<div id="post-body-content">
				
				
				
					<?php
		
					settings_errors();	//for displaying update and fail messages
		
					// do the magic
					settings_fields($this->slug);
					do_settings_sections( $this->slug );
		
					// call rest from child theme
					$this->options($this->settings);
					?>
					
					
						
						<input type="hidden" name="info-fields" value="" />
						<div class="abtcore-buttons">
							<input type="submit" class="button-primary" value="<?php _e("Save changes", "abtcore");?>" />
						</div>
					
					</div>
				</div>
			</div>
			
			</form>
			
		</div>
		
	<?php
	}
}///---	class	ABTCore_Content_Type_Options

/**
* Get the preformatted common options as array
* @see Settings Panel
*/
function abtcore_get_option_preformatted($content_type) {
	$options = array();
	
	$fields = split(",", get_option($content_type . '-info-fields'));
	foreach ($fields as $field):
		if (trim($field) != '')
			$options[strtolower(str_replace(' ', '_', $field))] = $field;
	endforeach;
	
	return $options;
}