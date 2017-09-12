<?php
/*
Plugin Name: ABT Core Page Numbers
Plugin URI: http://www.atlanticbt.com
Description: Show pages numbers instead of "Next page" and "Previous Page".
Version: 1
Author: Mark C
Modified and improved from Jens T&ouml;rnell's WP Page Numbers (http://www.jenst.se) ** Support was dropped. **
*/

function abtcore_page_numbers_stylesheet()
{
	echo '<link rel="stylesheet" href="'. get_bloginfo('template_directory') . '/includes/paging/paging.css" media="screen" />';
}
add_action('wp_head', 'abtcore_page_numbers_stylesheet');

function abtcore_page_numbers_check_num($num)
{
  return ($num%2) ? true : false;
}

function abtcore_page_numbers_page_of_page($max_page, $paged, $page_of_page_text, $page_of_of)
{
	$pagingString = "";
	if ( $max_page > 1)
	{
		$pagingString .= '<p class="page-info">';
		if($page_of_page_text == "")
			$pagingString .= 'Page ';
		else
			$pagingString .= $page_of_page_text . ' ';
		
		if ( $paged != "" )
			$pagingString .= $paged;
		else
			$pagingString .= 1;
		
		if($page_of_of == "")
			$pagingString .= ' of ';
		else
			$pagingString .= ' ' . $page_of_of . ' ';
		$pagingString .= floor($max_page).'</p>';
	}
	return $pagingString;
}

function abtcore_page_numbers_prevpage($paged, $max_page, $prevpage)
{
	$pagingString = "";
	if( $max_page > 1 && $paged > 1 )
		$pagingString = '<li><a href="'.get_pagenum_link($paged-1). '">'.$prevpage.'</a></li>';
	return $pagingString;
}

function abtcore_page_numbers_left_side($max_page, $limit_pages, $paged, $pagingString)
{
	$pagingString = "";
	$page_check_max = false;
	$page_check_min = false;
	if($max_page > 1)
	{
		for($i=1; $i<($max_page+1); $i++)
		{
			if( $i <= $limit_pages )
			{
				if ($paged == $i || ($paged == "" && $i == 1))
					$pagingString .= '<li class="active-page"><a href="'.get_pagenum_link($i). '">'.$i.'</a></li>'."\n";
				else
					$pagingString .= '<li><a href="'.get_pagenum_link($i). '">'.$i.'</a></li>'."\n";
				if ($i == 1)
					$page_check_min = true;
				if ($max_page == $i)
					$page_check_max = true;
			}
		}
		return array($pagingString, $page_check_max, $page_check_min);
	}
}

function abtcore_page_numbers_middle_side($max_page, $paged, $limit_pages_left, $limit_pages_right)
{
	$pagingString = "";
	$page_check_max = false;
	$page_check_min = false;
	for($i=1; $i<($max_page+1); $i++)
	{
		if($paged-$i <= $limit_pages_left && $paged+$limit_pages_right >= $i)
		{
			if ($paged == $i)
				$pagingString .= '<li class="active-page"><a href="'.get_pagenum_link($i). '">'.$i.'</a></li>'."\n";
			else
				$pagingString .= '<li><a href="'.get_pagenum_link($i). '">'.$i.'</a></li>'."\n";
				
			if ($i == 1)
				$page_check_min = true;
			if ($max_page == $i)
				$page_check_max = true;
		}
	}
	return array($pagingString, $page_check_max, $page_check_min);
}

function abtcore_page_numbers_right_side($max_page, $limit_pages, $paged, $pagingString)
{
	$pagingString = "";
	$page_check_max = false;
	$page_check_min = false;
	for($i=1; $i<($max_page+1); $i++)
	{
		if( ($max_page + 1 - $i) <= $limit_pages )
		{
			if ($paged == $i)
				$pagingString .= '<li class="active-page"><a href="'.get_pagenum_link($i). '">'.$i.'</a></li>'."\n";
			else
				$pagingString .= '<li><a href="'.get_pagenum_link($i). '">'.$i.'</a></li>'."\n";
				
			if ($i == 1)
			$page_check_min = true;
		}
		if ($max_page == $i)
			$page_check_max = true;
		
	}
	return array($pagingString, $page_check_max, $page_check_min);
}

function abtcore_page_numbers_nextpage($paged, $max_page, $nextpage)
{
	$pagingString = "";
	if( $paged != "" && $paged < $max_page)
		$pagingString = '<li><a href="'.get_pagenum_link($paged+1). '">'.$nextpage.'</a></li>'."\n";
	return $pagingString;
}

function abtcore_page_numbers($start = "", $end = "")
{
	global $wp_query;
	global $max_page;
	global $paged;
	$pagingMiddleString = '';
	if ( !$max_page ) { $max_page = $wp_query->max_num_pages; }
	if ( !$paged ) { $paged = 1; }
	
	$settings = get_option('abtcore_page_numbers_array');
	$page_of_page = $settings["page_of_page"];
	$page_of_page_text = $settings["page_of_page_text"];
	$page_of_of = $settings["page_of_of"];
	
	$next_prev_text = $settings["next_prev_text"];
	$show_start_end_numbers = $settings["show_start_end_numbers"];
	$show_page_numbers = $settings["show_page_numbers"];
	
	$limit_pages = $settings["limit_pages"];
	$nextpage = $settings["nextpage"];
	$prevpage = $settings["prevpage"];
	$startspace = $settings["startspace"];
	$endspace = $settings["endspace"];
	
	if( $nextpage == "" ) { $nextpage = "&gt;"; }
	if( $prevpage == "" ) { $prevpage = "&lt;"; }
	if( $startspace == "" ) { $startspace = "..."; }
	if( $endspace == "" ) { $endspace = "..."; }
	
	if($limit_pages == "") { $limit_pages = "10"; }
	elseif ( $limit_pages == "0" ) { $limit_pages = $max_page; }
	
	if(abtcore_page_numbers_check_num($limit_pages) == true)
	{
		$limit_pages_left = ($limit_pages-1)/2;
		$limit_pages_right = ($limit_pages-1)/2;
	}
	else
	{
		$limit_pages_left = $limit_pages/2;
		$limit_pages_right = ($limit_pages/2)-1;
	}
	
	if( $max_page <= $limit_pages ) { $limit_pages = $max_page; }
	
	$pagingString = "<div class=\"abtcore-paging\">\n";
	if($page_of_page != "off")
		$pagingString .= abtcore_page_numbers_page_of_page($max_page, $paged, $page_of_page_text, $page_of_of);
	
	$pagingString .= '<ul>';
	
	if( ($paged) <= $limit_pages_left )
	{
		list ($value1, $value2, $page_check_min) = abtcore_page_numbers_left_side($max_page, $limit_pages, $paged, $pagingString);
		$pagingMiddleString .= $value1;
	}
	elseif( ($max_page+1 - $paged) <= $limit_pages_right )
	{
		list ($value1, $value2, $page_check_min) = abtcore_page_numbers_right_side($max_page, $limit_pages, $paged, $pagingString);
		$pagingMiddleString .= $value1;
	}
	else
	{
		list ($value1, $value2, $page_check_min) = abtcore_page_numbers_middle_side($max_page, $paged, $limit_pages_left, $limit_pages_right);
		$pagingMiddleString .= $value1;
	}
	if($next_prev_text != "off")
		$pagingString .= abtcore_page_numbers_prevpage($paged, $max_page, $prevpage);

		if ($page_check_min == false && $show_start_end_numbers != "off")
		{
			$pagingString .= "<li class=\"bookend-num\">";
			$pagingString .= "<a href=\"" . get_pagenum_link(1) . "\">1</a>";
			$pagingString .= "</li>\n<li  class=\"space\">".$startspace."</li>\n";
		}
	
	if($show_page_numbers != "off")
		$pagingString .= $pagingMiddleString;
	
		if ($value2 == false && $show_start_end_numbers != "off")
		{
			$pagingString .= "<li class=\"space\">".$endspace."</li>\n";
			$pagingString .= "<li class=\"bookend-num\">";
			$pagingString .= "<a href=\"" . get_pagenum_link($max_page) . "\">" . $max_page . "</a>";
			$pagingString .= "</li>\n";
		}
	
	if($next_prev_text != "on")
		$pagingString .= abtcore_page_numbers_nextpage($paged, $max_page, $nextpage);
	
	$pagingString .= "</ul>\n";
	
	$pagingString .= "<div class=\"clear\"></div>\n";
	$pagingString .= "</div>\n";
	
	if($max_page > 1)
		echo $start . $pagingString . $end;
}

function abtcore_page_numbers_save($id) {
		
		/*$N = 'abtcore_page-numbers';
		
		if(!isset($_POST[$N])){
			return $id;
		}
		
		$meta = $_POST[$N];
		
		if (!wp_verify_nonce($_POST["$N-nonce"],"$N-nonce")) return $id; //nonce
		
		update_post_meta($id, $N, $meta);*/
}

function abtcore_page_numbers_settings()
{
	if(isset($_POST['submit']))
	{
	
		
		$settings = array (
			"page_of_page"						=> v($_POST["page_of_page"], ""),
			"page_of_page_text"					=> v($_POST["page_of_page_text"], ""),
			"page_of_of"						=> v($_POST["page_of_of"], ""),
			"next_prev_text"					=> v($_POST["next_prev_text"], ""),
			"show_start_end_numbers"			=> v($_POST["show_start_end_numbers"], ""),
			"show_page_numbers"					=> v($_POST["show_page_numbers"], ""),
			"limit_pages"						=> v($_POST["limit_pages"], ""),
			"nextpage"							=> v($_POST["nextpage"], ""),
			"prevpage"							=> v($_POST["prevpage"], ""),
			"startspace"						=> v($_POST["startspace"], ""),
			"endspace"							=> v($_POST["endspace"], "")
		);
		update_option('abtcore_page_numbers_array', $settings);
		
		echo "<div id=\"message\" class=\"updated fade\"><p><strong>Paging Options Updated.</strong></p></div>";
    } else {
	
		/*if ( !isset($_POST["page_of_page"]) )
			$_POST["page_of_page"] = "";
		if ( !isset($_POST["next_prev_text"]) )
			$_POST["next_prev_text"] = "";
		if( !isset($_POST["show_start_end_numbers"]) )
			$_POST["show_start_end_numbers"] = "";
		if( !isset($_POST["show_page_numbers"]) )
			$_POST["show_page_numbers"] = "";*/

		$settings = get_option('abtcore_page_numbers_array');
	
	}
	
	
	$page_of_page = $settings["page_of_page"];
	$page_of_page_text = $settings["page_of_page_text"];
	$page_of_of = $settings["page_of_of"];
	
	$next_prev_text = $settings["next_prev_text"];
	$show_start_end_numbers = $settings["show_start_end_numbers"];
	$show_page_numbers = $settings["show_page_numbers"];
	
	$limit_pages = $settings["limit_pages"];
	
	$nextpage = $settings["nextpage"];
	$prevpage = $settings["prevpage"];
	$startspace = $settings["startspace"];
	$endspace = $settings["endspace"];

    ?>
	
<div class="wrap">

	<div id="icon-abtcore-options" class="icon32-paging-options icon32"><br /></div>
	<h2>ABT Core Paging</h2>
	<form method="post">
		<?php wp_nonce_field('abtcore-page-numbers_nonce', 'abtcore-page-numbers_nonce'); ?>
	
		<div id="poststuff" class="metabox-holder">
			<div id="post-body">
				<div id="post-body-content">
					
					<div class="postbox">
						<h3 class="hndle"><span>Display Settings</span></h3>
						<div class="inside">
							<div class="field">
								<input type="checkbox" name="page_of_page" id="page_of_page" class="checkbox" value="off" <?php if ($page_of_page == "off"): echo 'checked="checked"'; endif; ?> />
								<label for="page_of_page">Hide Page Info</label>
								<em class="summary">For example: Page 3 of 5</em>
							</div>
							<div class="field">
								<input type="checkbox" name="next_prev_text" id="next_prev_text" class="checkbox" value="off" <?php if ($next_prev_text == "off"): echo 'checked="checked"'; endif; ?> />
								<label for="next_prev_text">Hide Next/Previous Text</label>
								<em class="summary">For example: &lt; and &gt;</em>
							</div>
							<div class="field">
								<input type="checkbox" name="show_start_end_numbers" id="show_start_end_numbers" class="checkbox" value="off" <?php if ($show_start_end_numbers == "off"): echo 'checked="checked"'; endif; ?> />
								<label for="show_start_end_numbers">Hide Start/End #</label>
								<em class="summary">For example: 1... ...5</em>
							</div>
							<div class="field">
								<input type="checkbox" name="show_page_numbers" id="show_page_numbers" class="checkbox" value="off" <?php if ($show_page_numbers == "off"): echo 'checked="checked"'; endif; ?> />
								<label for="show_page_numbers">Hide Page #</label>
								<em class="summary">For example: 3 4 5 6 7</em>
							</div>
							
						</div>
					</div>
					
					<div class="postbox">
						<h3 class="hndle"><span>Text Settings</span></h3>
						<div class="inside">							
							<p class="abtcore-option-message">You can change the default text and symbols used for paging below.</p>
							<div class="field">
								<label for="page_of_page_text">Text "Page"</label>
								<input name="page_of_page_text" id="page_of_page_text" type="text" value="<?php echo $page_of_page_text; ?>" />
								<em class="summary">Used in "Page of Page". Default is "Page".</em>
							</div>
							<div class="field">
								<label for="page_of_of">Text "of"</label>
								<input name="page_of_of" id="page_of_of" type="text" value="<?php echo $page_of_of; ?>" />
								<em class="summary">Used in "Page of Page". Default is "of".</em>
							</div>
							<div class="field">
								<label for="prevpage">Previous Page Symbol</label>
								<input name="prevpage" id="prevpage" type="text" value="<?php echo $prevpage; ?>" class="short-text" />
								<em class="summary">Default is "&lt;"</em>
							</div>
							<div class="field">
								<label for="startspace">Starting Space</label>
								<input name="startspace" id="startspace" type="text" value="<?php echo $startspace; ?>" class="short-text" />
								<em class="summary">Default is "..."</em>
							</div>
							<div class="field">
								<label for="endspace">Ending Space</label>
								<input name="endspace" id="endspace" type="text" value="<?php echo $endspace; ?>" class="short-text" />
								<em class="summary">Default is "..."</em>
							</div>
							<div class="field">
								<label for="nextpage">Next Page Symbol</label>
								<input name="nextpage" id="nextpage" type="text" value="<?php echo $nextpage; ?>" class="short-text" />
								<em class="summary">Default is "&gt;"</em>
							</div>
						</div>
					</div>
					
					<div class="postbox">
						<h3 class="hndle"><span>Misc Settings</span></h3>
						<div class="inside">
							<div class="field">
								<label for="limit_pages">Number of Pages Limit</label>
								<input name="limit_pages" id="limit_pages" type="text" value="<?php echo $limit_pages; ?>" class="short-text" />
								<em class="summary">For example: 10. Enter 0 for unlimited (default).</em>
							</div>
						</div>
					</div>
					

							<div class="abtcore-buttons">
								<input type="submit" id="submit" name="submit" value="Save Options" class="button-primary" />
							</div>
					
					
				</div>
			</div>
		</div>
	</form>
</div>

<?php 
}

function abtcore_page_numbers_add_to_menu() {
    add_submenu_page('abtcore-options', 'Paging Options', 'Paging Options', 'manage_options', 'abtcore-page-numbers', 'abtcore_page_numbers_settings');
}
add_action('admin_menu', 'abtcore_page_numbers_add_to_menu');
//add_action('save_post', 'abtcore_page_numbers_save');
?>