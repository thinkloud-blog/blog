<?php
/**
 * Custom Widget for displaying breadcrumbs
 */

class Breadcrumbs_Widget extends WP_Widget {
	/**
	 * Constructor.
	 *
	 * @return Breadcrumbs_Widget
	 */
	public function __construct() {
		parent::__construct( 'breadcrumbs1', __( 'Breadcrumbs', 'bootstrap-basic' ), array(
			'classname'   => 'breadcrumbs',
			'description' => __( 'Use this widget to add breadcrumbs.', 'bootstrap-basic' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {
		echo '<ol class="breadcrumb"><li><a href="' .get_option('home') .'"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>';

		if(is_category()) {
			$current	= get_query_var('cat');
			$catlist	= get_category_parents($current, TRUE, '||' );
			$categories = array_filter(explode('||', $catlist));
			$last		= end($categories);

			foreach ($categories as $cat) {
				if($cat == $last) {
					$category = get_category($current);
					echo '<li class="active">' . $category->name . '</li>';
					break;
				} else {
					echo '<li>' . $cat . '</li>';
				}
			}
		} else {
			if (is_single()) {
				$post_cats	= get_the_category(get_the_ID());
				$hierarchy	= get_category_parents( $post_cats[0]->cat_ID, TRUE, '||');

				foreach (array_filter(explode('||', $hierarchy)) as $cat) {
					echo '<li>' . $cat . '</li>';
				}
			}

			the_title('<li class="active">', '</li>');
		}
		echo '</ol>';
	}
	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = empty( $new_instance['number'] ) ? 2 : absint( $new_instance['number'] );
		if ( in_array( $new_instance['format'], $this->formats ) ) {
			$instance['format'] = $new_instance['format'];
		}

		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$number = empty( $instance['number'] ) ? 2 : absint( $instance['number'] );
		$format = isset( $instance['format'] ) && in_array( $instance['format'], $this->formats ) ? $instance['format'] : 'aside';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'twentyfourteen' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'twentyfourteen' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'format' ) ); ?>"><?php _e( 'Post format to show:', 'twentyfourteen' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'format' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'format' ) ); ?>">
				<?php foreach ( $this->formats as $slug ) : ?>
				<option value="<?php echo esc_attr( $slug ); ?>"<?php selected( $format, $slug ); ?>><?php echo get_post_format_string( $slug ); ?></option>
				<?php endforeach; ?>
			</select>
		<?php
	}
}
add_action( 'widgets_init', function(){
     register_widget( 'Breadcrumbs_Widget' );
});


/**
 * Custom Widget for displaying subcategories
 */

class Subcategories_Widget extends WP_Widget {
	/**
	 * Constructor.
	 *
	 * @return Subcategories_Widget
	 */
	public function __construct() {
		parent::__construct( 'subcat1', __( 'Subcategories', 'bootstrap-basic' ), array(
			'classname'   => 'subcategories',
			'description' => __( 'Use this widget to add subcategories.', 'bootstrap-basic' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget($args, $instance) {
		$category = get_category( get_query_var( 'cat' ) );
		$cat = $category->cat_ID;

		if($cat) {
			$c = ! empty( $instance['count'] ) ? '1' : '0';
			$title = ! empty( $instance['title'] ) ? $instance['title'] : false;
			$cat_args = array('orderby' => 'name', 'pad_count' => $c, 'hierarchical' => 0, 'child_of'=> $cat);
			the_subcategories($cat, $cat_args, array('title'=>$title, 'count'=>$c));
		}
	}
	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		return $instance;
	}

	/**
	 * Display the form for this widget on the Subcategories page of the Admin area.
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'bootstrap-basic' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> /></p>

		<?php
	}
}
add_action( 'widgets_init', function(){
     register_widget( 'Subcategories_Widget' );
});
