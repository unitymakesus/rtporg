<?php
if( function_exists('acf_add_local_field_group') ):

/**
 * RTP Directory Spaces Fields
 */

acf_add_local_field_group(array(
	'key' => 'group_5ad659ff6bb07',
	'title' => 'Spaces Fields',
	'fields' => array(
		array(
			'key' => 'field_5ad65b09daa9c',
			'label' => 'Is this space located within a larger facility?',
			'name' => 'within_facility',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
		),
		array(
			'key' => 'field_5ad65a80daa9b',
			'label' => 'Related Facility',
			'name' => 'related_facility',
			'type' => 'relationship',
			'instructions' => 'Select the facility in which this space is located.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5ad65b09daa9c',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'rtp-facility',
			),
			'taxonomy' => array(
			),
			'filters' => array(
				0 => 'taxonomy',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'id',
		),
		array(
			'key' => 'field_5ad65b4edaa9d',
			'label' => 'Coordinates',
			'name' => 'coords',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5ad65b09daa9c',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '35.8985119',
			'center_lng' => '-78.8678052',
			'zoom' => 13,
			'height' => '',
		),
		array(
			'key' => 'field_5ad65b95daa9f',
			'label' => 'Street Address',
			'name' => 'street_address',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5ad65b77daa9e',
			'label' => 'Sqft',
			'name' => 'sqft',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5ad65b9fdaaa0',
			'label' => 'Contact Company',
			'name' => 'contact_company',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5ad65ba8daaa1',
			'label' => 'Contact Person',
			'name' => 'contact_person',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 1,
			'max' => 0,
			'layout' => 'table',
			'button_label' => 'Add Contact',
			'sub_fields' => array(
				array(
					'key' => 'field_5ad65be8daaa4',
					'label' => 'Name',
					'name' => 'name',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5ad65bf0daaa5',
					'label' => 'Phone',
					'name' => 'phone',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5ad65bfedaaa6',
					'label' => 'Email',
					'name' => 'email',
					'type' => 'email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
			),
		),
		array(
			'key' => 'field_5ad65c1bdaaa7',
			'label' => 'Link',
			'name' => 'link',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'rtp-space',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

/**
 * RTP Directory Facilities Fields
 */

 if( function_exists('acf_add_local_field_group') ):

 acf_add_local_field_group(array(
 	'key' => 'group_5ad65d598e65b',
 	'title' => 'Facilities Fields',
 	'fields' => array(
 		array(
 			'key' => 'field_5ad65d7b276ed',
 			'label' => 'Geometry Type',
 			'name' => 'geometry_type',
 			'type' => 'radio',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'choices' => array(
 				'Polygon' => 'Polygon',
 				'LineString' => 'LineString',
 				'Point' => 'Point',
 			),
 			'allow_null' => 0,
 			'other_choice' => 0,
 			'save_other_choice' => 0,
 			'default_value' => '',
 			'layout' => 'vertical',
 			'return_format' => 'value',
 		),
 		array(
 			'key' => 'field_5ad65ddb276ee',
 			'label' => 'Coordinates',
 			'name' => 'coordinates_long',
 			'type' => 'textarea',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => array(
 				array(
 					array(
 						'field' => 'field_5ad65d7b276ed',
 						'operator' => '!=',
 						'value' => 'Point',
 					),
 				),
 			),
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'maxlength' => '',
 			'rows' => '',
 			'new_lines' => '',
 		),
 		array(
 			'key' => 'field_5ad65e1c276ef',
 			'label' => 'Coordinates',
 			'name' => 'coordinates',
 			'type' => 'google_map',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => array(
 				array(
 					array(
 						'field' => 'field_5ad65d7b276ed',
 						'operator' => '==',
 						'value' => 'Point',
 					),
 				),
 			),
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
			'center_lat' => '35.8985119',
			'center_lng' => '-78.8678052',
			'zoom' => 13,
 			'height' => '',
 		),
 		array(
 			'key' => 'field_5ad660ab0943b',
 			'label' => 'Street Address',
 			'name' => 'street_address',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array(
 			'key' => 'field_5ad660b40943c',
 			'label' => 'PO Box Number',
 			'name' => 'po_box',
 			'type' => 'number',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'min' => '',
 			'max' => '',
 			'step' => '',
 		),
 		array(
 			'key' => 'field_5ad65e4e276f0',
 			'label' => 'Facility Ownership',
 			'name' => 'facility_ownership',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array(
 			'key' => 'field_5ad65e65276f1',
 			'label' => 'Contact Person',
 			'name' => 'contact_person',
 			'type' => 'repeater',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'collapsed' => '',
 			'min' => 1,
 			'max' => 0,
 			'layout' => 'table',
 			'button_label' => 'Add Contact',
 			'sub_fields' => array(
 				array(
 					'key' => 'field_5ad65e7c276f2',
 					'label' => 'Name',
 					'name' => 'name',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 				array(
 					'key' => 'field_5ad65ea8276f5',
 					'label' => 'Title',
 					'name' => 'title',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 				array(
 					'key' => 'field_5ad65e82276f3',
 					'label' => 'Phone',
 					'name' => 'phone',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 				array(
 					'key' => 'field_5ad65e86276f4',
 					'label' => 'Email',
 					'name' => 'email',
 					'type' => 'email',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 				),
 			),
 		),
 		array(
 			'key' => 'field_5ad65eb5276f6',
 			'label' => 'PR/Marketing Contact',
 			'name' => 'prmarketing_contact',
 			'type' => 'repeater',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'collapsed' => '',
 			'min' => 1,
 			'max' => 0,
 			'layout' => 'table',
 			'button_label' => 'Add Contact',
 			'sub_fields' => array(
 				array(
 					'key' => 'field_5ad65ec5276f7',
 					'label' => 'Name',
 					'name' => 'name',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 				array(
 					'key' => 'field_5ad65eca276f8',
 					'label' => 'Email',
 					'name' => 'email',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 			),
 		),
 		array(
 			'key' => 'field_5ad65ed8276f9',
 			'label' => 'Twitter Handle',
 			'name' => 'twitter_handle',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '@',
 			'append' => '',
 			'maxlength' => '',
 		),
 	),
 	'location' => array(
 		array(
 			array(
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'rtp-facility',
 			),
 		),
 	),
 	'menu_order' => 0,
 	'position' => 'normal',
 	'style' => 'default',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 	'active' => 1,
 	'description' => '',
 ));

 endif;
