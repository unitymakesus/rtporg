<?php
/**
 * This function adds media/editor/insert/popup button for adding image uploads or new media buttons above the editor or inline media buttons.
 * @params $props is the array of button properties
 * 	'selector' => 'abtcore_popup' . $abtcore_insert_button_counter, // Unique wrapper id, if not specified it takes care of itself.
 * 	'width' => 450,	// Optional popup width
 * 	'title' => 'Add', // Title for the popup window.
 * 	'img' => '', // Image src url
 * 	'i18n' => 'abtcore', // Optional translation context source
 * 	'popup_callback' => '', // REQUIRED. Name of callback function that generates popup form HTML. Follows same name as add_fillter/apply_filters
 * 	'inline_target' => false, // Option for using inline buttons instead of inserting button above the_editor/wp_editor. This is the jQuery/CSS selector for the value to be changed.
 * 	'insert_override' => false // Optional specified as true. If true, you must manually set the target's value in your popup callback function.
 *
 * @return 
 */
function abtcore_add_insert_button( $props ) {
	static $abtcore_insert_button_counter;
	if (!isset($abtcore_insert_button_counter)) $abtcore_insert_button_counter = 0;
	else $abtcore_insert_button_counter++;
	
	$defaults = array(
		'selector' => 'abtcore_popup' . $abtcore_insert_button_counter, // Unique wrapper id, if not specified it takes care of itself.
		'width' => 450,	// Optional popup width
		'title' => 'Add', // Title for the popup window.
		'img' => '', // Image src url
		'i18n' => 'abtcore', // Optional translation context source
		'popup_callback' => '', // REQUIRED. Name of callback function that generates popup form HTML. Follows same name as add_fillter/apply_filters
		'inline_target' => false, // Option for using inline buttons instead of inserting button above the_editor/wp_editor. This is the jQuery/CSS selector for the value to be changed.
		'insert_override' => false // Optional specified as true. If true, you must manually set the target's value in your popup callback function.
	);
	
	$defaults = apply_filters('abtcore_add_insert_button', $defaults);
	$props = array_merge($defaults, $props);
	$all_props = &abtcore_static('abtcore_add_insert_button', array() ); // handle strange parameter passing
	$all_props[$abtcore_insert_button_counter] = $props;
	
	if ($props['inline_target']):
		echo _abtcore_overlay_button($props);
	else:
		add_action('media_buttons_context', 'abtcore_overlay_button');
	endif;
	add_action('admin_footer', 'abtcore_popup_form');

}

/**
 * Workhorse to create button HTML for media/editor/insert/popup button
 * @params $props is the array of button properties
 *
 * @return link HTML
 */
function _abtcore_overlay_button(&$props) {
	$img = $props['img'];
	$title = __($props['title'], $props['i18n']);
	return '<a href="#TB_inline?width=' . $props['width'] . '&inlineId=' . $props['selector'] . '_form" class="thickbox" id="' . $props['selector'] . '_button" title="' . $title . '"><img src="' . $img . '" alt="' . $title . '" /></a>';
}

/**
 * Callback to create button HTML for media/editor/insert/popup button
 * @params $context is media editor from existing WP call
 *
 * @return all links HTML
 */
function abtcore_overlay_button($context){
	$all_props = &abtcore_static('abtcore_add_insert_button', array() ); // handle strange parameter passing
	
	foreach( $all_props as $props ):
		if ($props['inline_target']) continue; // skip
		$context .= _abtcore_overlay_button($props);
	endforeach;
   
	return $context;
}

function abtcore_popup_form(){
	$all_props = &abtcore_static('abtcore_add_insert_button', array() ); // handle strange parameter passing
	
	foreach( $all_props as $props ):
		/*$option_name = $props['option']; 
		$list_option = get_option($option_name);*/
		
		?>
		<div id="<?php echo $props['selector']; ?>_form" style="display: none;">
			<div class="<?php echo $props['selector']; ?>_form_wrap">
		<?php
		$callback = $props['popup_callback'];
		unset($props['popup_callback']);
		// like add_filter/apply_filters
		if( is_array($callback) ) {
			call_user_func_array($callback, array($props)); // use as function
		} else {
			$callback($props); // use as function
		}
		
		?>
			</div>
		</div>
		
		<script>
			function <?php echo $props['selector']; ?>_form(){
				<?php /*var people_lists_user_selection_list_value = jQuery("#<?php echo $props['selector']; ?>_selection option:selected").attr('value');
				if (people_lists_user_selection_list_value == "dropdown-first-option"){
					alert("<?php _e('Please select a list.','people-list');?>");
					return;
				}*/ ?>
				<?php echo 'insert_value = ', $props['selector']; ?>_get_value();
				
				<?php if (!$props['inline_target']): ?>
					var win = window.dialogArguments || opener || parent || top;
					win.send_to_editor(insert_value<?php /*echo '"', sprintf($props['insert_format'], '" + insert_value + "'), '"'; /*[people-lists list=" + people_lists_user_selection_list_value + "]" */ ?>);
				<?php else: 
					// assuming a regular text input. if insert_override is declared as an option, then the insert values are done in fn_get_value() above.
					if ( false === $props['insert_override'] ):
					?>
					jQuery('<?php echo $props['inline_target']; ?>').val(insert_value);
					<?php endif; ?>
					tb_remove();
				<?php endif; ?>
			}
		</script>
	
		<?php 
		
		
		/*<div id="people_lists_select_list_form" style="display:none;">
			<div class="people_lists_select_list_form_wrap">
				<?php if(empty($list_option['lists'] )) : ?>
					<div id="message" class="updated below-h2 clear"><p><?php _e('You currently have no lists. Go ahead and create one! Click','people-list');?> <a href="/wp-admin/options-general.php?page=people_lists"><?php _e('here','people-list');?></a>.</p></div>
				<?php else: ?>
				<div style="padding:15px 15px 0 15px;">
					<h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;"><?php _e("Insert A People List",'people-list');?></h3>
					<span>
						<?php _e("Select a list from the dropdown below to add it to your post or page.",'people-list');?>
					</span>
				</div>
				<div style="padding:15px 15px 0 15px;">
					<select id="people_lists_dropdown_selection">
						<option value="dropdown-first-option">  <?php _e("Select a Form",'people-list');?>  </option>
						<?php if( is_array($list_option['lists']) ):
							 foreach ($list_option['lists'] as $index =>$list_name): ?>
								<option value="<?php echo $list_name['slug']; ?>"><?php echo esc_html($list_name['title']); ?></option>
						<?php endforeach; 
						endif; ?>
					</select> <br/>
	
				</div>
				<div style="padding:15px;">
					<input type="button" class="button-primary" value="<?php _e('Insert People List','people-list');?>" onclick="people_lists_insert_overlay_form();"/>&nbsp;&nbsp;&nbsp;
					<a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php _e("Cancel"); ?></a>
				</div>
				
				<?php endif; ?>
				
			</div>
		</div>
		<?php */
	
	
	endforeach;
	
}