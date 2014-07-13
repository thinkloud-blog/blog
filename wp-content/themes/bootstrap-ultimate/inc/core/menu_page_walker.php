<?php 
/**
 * Create HTML list of pages.
 *
 * @package WordPress
 * @since 2.1.0
 * @uses Walker
 */
class eo_Walker_Page extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	var $tree_type = 'page';

	/**
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

	/**
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
			// var_dump($output);
			 $parent_clss = explode(" ",$output);
			 $ppcnt = 1;
			 foreach ( $parent_clss as $parent_cl) {
				 $ppcnt++;
				(strpos($parent_cl,"page-item-") !== false ) ? $ppint = preg_replace("/[^0-9]/","",$parent_cl) : $ppint = $ppcnt;
				$ppid = "pgi-page-item-".$ppint;
			 }
		//	 var_dump($ppid);
		$indent = str_repeat("\t", $depth);
	//	var_dump($depth);
	//if($depth == 1 ) $ddmenuclass = 
	$output .= "\n$indent<ul class='children dropdown-menu depth".$depth."' aria-labelledby='".$ppid."'>\n";
	//	if($depth == 1) $output .= "\n$indent<ul class='children dropdown-menu'  aria-labelledby='".$ppid."'>\n";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Page data object.
	 * @param int $depth Depth of page. Used for padding.
	 * @param int $current_page Page ID.
	 * @param array $args
	 */
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);

		if( isset( $args['pages_with_children'][ $page->ID ] ) ) {
				$css_class[] = ' page_item_has_children';	
				if(  $depth == 0 ) $css_class[] .= ' dropdown';	
		}
			

		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		if ( '' === $page->post_title )
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
		$children = count(get_pages('child_of='.$page->ID));
		/** This filter is documented in wp-includes/post-template.php */
		if(  $depth == 1 && $children > 0  ) {
			$css_class = $css_class." dropdown-submenu";
		//	var_dump($css_class);
		//	
		}
		$output .= $indent . '<li class="' . $css_class . ' depth'.$depth.'">';
		//unset($depth);
	//	var_dump($depth);
		
		if(  $depth == 0 && $children > 0 ) {
			
			 (strpos($page->post_title,"[dd-ph]") !== false ) ? $dtoggle = ' data-toggle="dropdown"' :  $dtoggle ='';
			
				(strpos($page->post_title,"[dd-ph]") !== false ) ? $thep_title = str_replace("[dd-ph]","",$page->post_title) : $thep_title = $page->post_title;
				$output .= $link_before .'<a href="' . get_permalink($page->ID) . '" id="pgi-page-item-'.$page->ID.'" class="dropdown-toggle"'.$dtoggle.'>'.apply_filters( 'the_title', $thep_title, $page->ID ) .'<b class="caret"></b>' . $link_after . '</a>';
		}
		else if(  $depth == 1 && $children > 0) {
				(strpos($page->post_title,"[dd-ph]") !== false ) ? $thep_title = str_replace("[dd-ph]","",$page->post_title) : $thep_title = $page->post_title;
				$output .= $link_before .'<a tabindex="-1" href="' . get_permalink($page->ID) . '" id="pgi-page-item-'.$page->ID.'">'.apply_filters( 'the_title', $thep_title, $page->ID ) . $link_after . '</a>';
		}
		else {
			(strpos($page->post_title,"[dd-ph]") !== false ) ? $thep_title = str_replace("[dd-ph]","",$page->post_title) : $thep_title = $page->post_title;
			$output .=  '<a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';	
		}


		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}
	}

	/**
	 * @see Walker::end_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 * @param array $args
	 */
	function end_el( &$output, $page, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

}
?>