<?php if ( count( get_the_category() ) ) : ?>
	<span class="cat-links">
	    <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'abtcore' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
	</span>
	<span class="meta-sep">|</span>
<?php endif; ?>

<?php
    $tags_list = get_the_tag_list( '', ', ' );
    if ( $tags_list ):
?>
	<span class="tag-links">
	    <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'abtcore' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
	</span>
	<span class="meta-sep">|</span>
<?php endif; ?>