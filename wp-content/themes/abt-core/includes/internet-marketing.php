<?php

#region ------------------- google analytics --------------------

function asynchronous_google_analytics($google_ua_id) {
?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?php echo $google_ua_id ?>']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
})();
</script>
<?php
}

function abtcore_googleanalytics() {	 
	$options = abtcore_get_option();
  
  	// only add if given
  	if( isset($options['google_analytics_id']) && !empty($options['google_analytics_id']) ):
		asynchronous_google_analytics($options['google_analytics_id']);
  	endif;
}

// add script to the site head
if ( !is_admin() ) {
	add_action('wp_head', 'abtcore_googleanalytics');
}

#endregion ------------------- google analytics --------------------

/**
 * ABTCore Google Adwords Conversion
 *
 * @param id = Account ID, like "1010518255" (required)
 * @param label = Tracking label, like "HK7hCMLklQIQ5pHt4QM" (required)
 * @param conversion_value = $ amount (optional)
 * @param lang = language code, like "en" (default "en")
 * @param format = conversion format, like "3" (default "3")
 * @param color = conversion color, like "ffffff" (default "ffffff") [note: no # required]
 *
 * @since ABT Core v0.9.3
 */
function abtcore_google_adwords_conversion( $id, $label, $lang = 'en', $format = 3, $color = 'ffffff', $conversion_value = false ) {

?>
<!-- Google Code for Thank You Page Conversion Page -->
<?php // note that the CDATA ( <![CDATA[ ... ]]> ) comment closing is screwed up by WP, use HTML comment in the meantime? http://wordpress.org/support/topic/the_content-breaking-inline-javascript ?>
<script type="text/javascript">
/* <!-- */
var google_conversion_id = <?=$id?>;
var google_conversion_language = "<?=$lang?>";
var google_conversion_format = "<?=$format?>";
var google_conversion_color = "<?=$color?>";
var google_conversion_label = "<?=$label?>";
var google_conversion_value = 0;
<?php if( $conversion_value !== false ): ?>
if (<?=$conversion_value?>) {
  google_conversion_value = <?=$conversion_value?>;
}
<?php endif; // $conversion_value !== false ?>
/* --> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/<?=$id?>/?<?php
	if( $conversion_value !== false ):
		?>value=<?=$conversion_value?>&amp;<?php
	endif; //$conversion_value check
	?>label=<?=$label?>&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php
}

?>