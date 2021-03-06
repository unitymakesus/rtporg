<?php

if(function_exists('sbug')):
#	throw new Exception('function sbug already created before '.__LINE__.' in '.__FILE__);
else:
/**
 * Debug function - return HTML-formatted debug output
 */
function sbug(&$args, $is_dump = false) {
	if( ! WP_DEBUG || ! WP_DEBUG_DISPLAY ) return;
	
	$s = '<div class="debug collapsible" data-title="Debug [' . (is_scalar($args[0]) ? esc_attr($args[0]) : date('H:i:s')) . ']"><hr />';
	
	foreach($args as $value) {
		//flat value or no newlines
		if( (is_scalar($value) OR $value === NULL) AND ( false === strpos($value, "\n") ) ) {
			$s .= '<span>';
			if($is_dump){
				ob_start();
					var_dump($value);
				$s .= ob_get_clean();
			}
			else{
				$s .= print_r($value, true);
			}
			$s .= "</span> <b>&amp;</b> \n";
		}
		else {
			$s .= '<pre class="code">'. ($is_dump ? var_export($value, true) : print_r($value, true)) . '</pre>';
		}
	}
	
	$s .= "</div>\n";

	return $s;
}//-----	function sbug
endif;

if(function_exists('pdump')):
#	throw new Exception('function pdump already created before '.__LINE__.' in '.__FILE__);
else:
/**
 * Debug function - dump variables
 */
function pdump(){
	$args = func_get_args();
	echo sbug($args, true);
}//-----	function pdump
endif;


function myprint_r($data, $depth = 0){
	# echo str_repeat("\t", $depth);
	echo '{', gettype($data), "}: ";
	if( ! is_scalar( $data ) ) {
		echo "\n";
		foreach( $data as $key => $value ){
			echo str_repeat("\t", $depth+1);
			echo "'$key' => ", myprint_r($value, $depth+1);
		}
	}
	else {
		echo htmlspecialchars($data), "\n";
	}
}//--	fn	myprint_r

if( ! function_exists('mybug_render') ) :
/**
 * Print Debug output - rendering function
 * @param $title {optional} if first argument starts with '--' or '__' or '|', it'll print as a title
 * @param mixed $etc the rest of the things to print
 */
function mybug_render($args, $attr){
	static $debug_counter;
	echo sprintf($attr['#wrapper_open'], ++$debug_counter);
	
	#region ---------------- source -----------------
	/* so we can find where we put the pbug */
	
	echo '<small style="float:right;">';
	$backtrace = debug_backtrace( /* 1, 1 */ );
	// pop the current function off
	array_shift($backtrace);
	if( isset($attr['backtrace']) && 'all' === $attr['backtrace'] ) {
		print_r($backtrace);
	}
	else {
		echo 'LINE['
			, $backtrace[0]['line'], '] of FILE{'
			, $backtrace[0]['file'], '}'
			/*
			, ' -- fn ', $backtrace[0]['function'],'('
			, implode(', ', $backtrace[0]['args']), ')'
			*/
			;
	}
	echo '</small>';
	#endregion ---------------- source -----------------

	// optional title
	if(  -1 === $args[0] ) {
		// get rid of the placeholder
		array_shift($args);
		/*
		// now pull off the title
		$title = array_shift($args);
		*/
		// use the calling function
		$title = $backtrace[1]['function'];
	}
	elseif( is_string($args[0]) && (
			0 === strpos($args[0], '--') || 0 === strpos($args[0], '__')  || 0 === strpos($args[0], '|') )
		) {
		$title = substr( array_shift($args), 2);
	}
	else {
		$title = 'Debug ' . $debug_counter;
	}
	echo sprintf($attr['#title'], $title);
	
	
	foreach($args as $arg) {
		echo $attr['#item_open'];
		if( isset( $attr['style'] ) && 'print_r' == $attr['style'] ){
			print_r($arg);
		}
		elseif( isset( $attr['style'] ) && 'myprint_r' == $attr['style'] ){
			myprint_r($arg);
		}
		else {
			echo var_export($arg);
		}
		echo $attr['#item_close'];
	}
	echo $attr['#wrapper_close'];
}
endif;


if( ! function_exists('pbug') ) :
/**
 * Print Debug output - as pre
 * @param $title {optional} if first argument starts with '--' or '__' or '|', it'll print as a title
 * @param mixed $etc the rest of the things to print
 */
function pbug(){
	$args = func_get_args();
	
	mybug_render($args, array(
		'#wrapper_open' => "\n<div class=\"debug\" id=\"debug-%s\">\n",
		'#wrapper_close' => "\n</div>\n",
		'#title' => "\n	<h2>%s</h2>\n",
		'#item_open' => "\n	<pre>\n",
		'#item_close' => "\n	</pre>\n",
		#'style' => 'print_r' | 'var_export' | 'myprint_r'
		'style' => 'print_r'
	));	
}//--	fn	pbug
endif;



if( ! function_exists('hbug') ) :
/**
 * Print Debug output - in HTML comment
 * @param $title {optional} if first argument starts with '--' or '__' or '|', it'll print as a title
 * @param mixed $etc the rest of the things to print
 */
function hbug(){
	$args = func_get_args();

	mybug_render($args, array(
		'#wrapper_open' => "\n<!-- debug-%s \n",
		'#wrapper_close' => "\n -->\n",
		'#title' => "\n	--- %s ---\n",
		'#item_open' => "\n	------------\n",
		'#item_close' => "\n	------------\n",
		#'style' => 'print_r' | 'var_export' | 'myprint_r'
		'style' => 'myprint_r'
	));
}//--	fn	hbug
endif;

/**
 * Helpful methods for debugging
 */
class abt_debug {
	
	/**
	 * Get the name of the calling file, from a certain depth
	 * 
	 * Get the name of the preceding files calling this one, for a given depth
	 * 
	 * @param int $depth {default 0} how many files up the tree from the current file to check, +1 (since we want the calling file)
	 * 
	 * @return the name of the calling file
	 */
	static function calling_file($depth = 0){
		$backtrace = debug_backtrace( $depth+1 );
		
		return $backtrace[$depth+1]['file'];
	}//--	fn	calling_file
	
	
	
}///---	class	abt_debug
?>