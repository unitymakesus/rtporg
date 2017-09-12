<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

	global $post;
	$slug = get_post( $post )->post_name;
	$theme_dir = get_stylesheet_directory_uri();
?>

<table class="directory">
    <thead>
        <tr>
            <th class="col-category">Category</th>
            <th class="col-title">Title</th>
            <th class="col-adr">Address 1</th>
            <th class="col-city">City</th>
            <th class="col-zip">Zip</th>
        </tr>
    </thead>
    <tbody>
    <?php while ( have_posts() ) : the_post(); ?>

    	<?php
            $address1  = types_render_field("location-address-line-1", array("raw"=>"true"));
            $address2  = types_render_field("location-address-line-2", array("raw"=>"true"));
            $city      = types_render_field("location-city", array("raw"=>"true"));
            $zip       = types_render_field("location-zip-code", array("raw"=>"true"));
            $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
            $thumb_url = ($thumb['0'] != null) ? 'style="background-image: url(' . $thumb["0"] . ');"' : '';
    	?>
        <tr>
            <td><?php echo get_the_term_list( $post->ID, 'location-category', '', '<br />' ); ?></td>
            <td><?php the_title(); ?></td>
            <td><?php echo $address1; ?><br /><?php echo $address2; ?></td>
            <td><?php echo $city; ?></td>
            <td><?php echo $zip; ?></td>
        </tr>

    <?php endwhile; ?>
    </tbody>
</table>

<?php if (function_exists("pagination")) {
	pagination($additional_loop->max_num_pages);
} ?>
