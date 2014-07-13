<?php
/**
 * Bootstrap Basic theme
 *
 * @package bootstrap-basic
 */


/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
	$content_width = 1170;
}


/**
 * Setup theme and register support wp features.
 */
function bootstrapBasicSetup()
{
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 *
	 * copy from underscores theme
	 */
	load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

	// add theme support post and comment automatic feed links
	add_theme_support('automatic-feed-links');

	// enable support for post thumbnail or feature image on posts and pages
	add_theme_support('post-thumbnails');

	// add support menu
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'bootstrap-basic'),
	));

	// add post formats support
	add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

	// add support custom background
	add_theme_support(
		'custom-background',
		apply_filters(
			'bootstrap_basic_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => ''
			)
		)
	);
}// bootstrapBasicSetup
add_action('after_setup_theme', 'bootstrapBasicSetup');


/**
 * Register widget areas
 */
function bootstrapBasicWidgetsInit()
{
	register_sidebar(array(
		'name'          => __('Header right', 'bootstrap-basic'),
		'id'            => 'header-right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));

	register_sidebar(array(
		'name'          => __('Navigation bar right', 'bootstrap-basic'),
		'id'            => 'navbar-right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));
	/* JLE add breadcrumbs zone
	 */
	register_sidebar(array(
		'name'          => __('Navigation bar below', 'bootstrap-basic'),
		'id'            => 'navbar-below',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));
	/* END breadcrumbs zone */
	register_sidebar(array(
		'name'          => __('Sidebar left', 'bootstrap-basic'),
		'id'            => 'sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));

	register_sidebar(array(
		'name'          => __('Sidebar right', 'bootstrap-basic'),
		'id'            => 'sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));

	/* JLE add full-width zone below content
	 */
	register_sidebar(array(
		'name'          => __('Content above', 'bootstrap-basic'),
		'id'            => 'content-above',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));

	/* JLE add full-width zone below content
	 */
	register_sidebar(array(
		'name'          => __('Content below', 'bootstrap-basic'),
		'id'            => 'content-below',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));
	/* END full-width below content zone */
	/* JLE add full-width zone on top of footer
	 */
	register_sidebar(array(
		'name'          => __('Footer top', 'bootstrap-basic'),
		'id'            => 'footer-top',
		'before_widget' => '<div id="%1$s" class="widget col-md-12 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));
	/* END full-width below content zone */
	register_sidebar(array(
		'name'          => __('Footer left', 'bootstrap-basic'),
		'id'            => 'footer-left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));

	register_sidebar(array(
		'name'          => __('Footer right', 'bootstrap-basic'),
		'id'            => 'footer-right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));
	/* JLE add full-width zone below the footer
	 */
	register_sidebar(array(
		'name'          => __('Footer below', 'bootstrap-basic'),
		'id'            => 'footer-below',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<strong class="widget-title h3">',
		'after_title'   => '</strong>'
	));
}// bootstrapBasicWidgetsInit
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


/**
 * Enqueue scripts & styles
 */
function bootstrapBasicEnqueueScripts()
{
	wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css');
	wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');

	wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js');
	wp_enqueue_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js');
	wp_enqueue_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.js');
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js');
	wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js');
}// bootstrapBasicEnqueueScripts
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';
/* JLE my own widgets */
require get_template_directory() . '/inc/widgets/JLE_widget.php';

/*
 * JLE addon, 22 juin 2014
 * Extends taxonomies with custom fileds, to enable frontoffice titles being different from backoffice titles
 * @source : https://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/
 */
// Add term page
function pippin_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_frontoffice_name]"><?php _e( 'Frontoffice Name', 'pippin' ); ?></label>
		<input type="text" name="term_meta[custom_frontoffice_name]" id="term_meta[custom_frontoffice_name]" value="null">
		<p class="description"><?php _e( 'Enter a custom frontoffice name','pippin' ); ?></p>
	</div>
	<div class="form-field">
		<label for="term_meta[custom_show_subcats]"><?php _e( 'Show subcatgories ?', 'pippin' ); ?></label>
		<input style="width: auto" type="checkbox" name="term_meta[custom_show_subcats]" id="term_meta[custom_show_subcats]"
		value="1" <?php //checked( $term_meta['custom_show_subcats'], 1 ); ?>
		<?php //echo esc_attr( $term_meta['custom_show_subcats'] ) ? esc_attr( $term_meta['custom_show_subcats'] ) : ''; ?>
		/>
		<span class="description"><?php _e( 'Check to show a list of subcategories before the posts list','pippin' ); ?></span>
	</div>
		<div class="form-field">
		<label for="term_meta[custom_subcats_title]"><?php _e( 'Title of subcategories box', 'pippin' ); ?></label>
		<input type="text" name="term_meta[custom_subcats_title]" id="term_meta[custom_subcats_title]" value="null">
		<p class="description"><?php _e( 'Enter a title for the subcategories list','pippin' ); ?></p>
	</div>
<?php
}
// add action to CATEGORIES
add_action( 'category_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );


// Edit term page
function pippin_taxonomy_edit_meta_field($term) {

	// put the term ID into a variable
	$t_id = $term->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_frontoffice_name]"><?php _e( 'Frontoffice Name', 'pippin' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_frontoffice_name]" id="term_meta[custom_frontoffice_name]" value="<?php echo esc_attr( $term_meta['custom_frontoffice_name'] ) ? esc_attr( $term_meta['custom_frontoffice_name'] ) : 'null'; ?>">
			<p class="description"><?php _e( 'Enter a custom frontoffice name','pippin' ); ?></p>
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_show_subcats]"><?php _e( 'Show subcatgories ?', 'pippin' ); ?></label></th>
		<td>
		<input style="width: auto" type="checkbox" name="term_meta[custom_show_subcats]" id="term_meta[custom_show_subcats]"
		<?php checked( $term_meta['custom_show_subcats'], 1 ); ?>
		value="1"
		/>
		<span class="description"><?php _e( 'Check to show a list of subcategories before the posts list','pippin' ); ?></span>
		</td>
	</tr>
		<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_subcats_title]"><?php _e( 'Title of subcategories box', 'pippin' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_subcats_title]" id="term_meta[custom_subcats_title]" value="<?php echo esc_attr( $term_meta['custom_subcats_title'] ) ? esc_attr( $term_meta['custom_subcats_title'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a title for the subcategories list','pippin' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'category_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		if ( ! isset( $_POST['term_meta']['custom_show_subcats'] ) ) {
			$_POST['term_meta']['custom_show_subcats'] = '';
		}
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}
add_action( 'edited_category', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_category', 'save_taxonomy_custom_meta', 10, 2 );

// JLE 23 juin 2014 add the_sistercategories
/*
 * Gets sister categories based on the current menu
 */
function the_subcategories($cat, $args, $params=array()) {

	if($cat) {
		$children = get_categories($args);

		if(count($children) > 0) {
			if(isset($params['title']) && $params['title'] !== false) {
				echo '<h4>'.$params['title'].'</h4>';
			}
			echo '<ol class="subcategories">';
			foreach ($children as $child) {
				$desc = strip_tags($child->description);
				echo '<li class="col-md-3"><div class="thumbnail">';
				if(!empty($child->term_id) && z_taxonomy_image_url($child->term_id) != '') {
					echo '<a href="' . get_category_link($child->cat_ID) . '">' .
					'<img src="' . z_taxonomy_image_url($child->term_id). '" alt="' . $desc.'" /></a>';
				}
				echo '<h2><a href="' . get_category_link($child->cat_ID) . '">' . $child->name ;
				echo '</a></h2>';
				echo '<div>';

				if(isset($params['count']) && $params['count'] == true) {
					echo '<small class="badge">'.$child->count.' posts</small>';
				}
				echo substr_replace($desc, '&hellip;', 70, strlen($desc)). '</div>';
				echo '</div></li>';
			}
			echo '</ol><hr class="clearfix" />';
		}
	}
}


// JLE 23 juin 2014 add the_sistercategories
/*
 * Gets sister categories based on the current menu
 */
function the_sistercategories($cat) {
	if (!is_home() && is_category()) {
		$menu_slug = 'primary';
		$locations = get_nav_menu_locations();
		if (isset($locations[$menu_slug])) {
			$menu = $locations[$menu_slug];
		}

		$args = array(
			'order'                  => 'ASC',
			'orderby'                => 'menu_order',
			'post_type'              => 'nav_menu_item',
			'post_status'            => 'publish',
			'output'                 => ARRAY_A,
			'output_key'             => 'menu_order',
			'nopaging'               => true,
			'update_post_term_cache' => false
		);

		$sisters	= wp_get_nav_menu_items( $menu, $args );

		foreach ($sisters as $i=>$menu_item) {
			if($menu_item->object_id == $cat) {
				break;
			}
		}

		$same_level_sisters = array();
		foreach ($sisters as $item) {
			if($item->post_parent == $menu_item->post_parent) {
				$same_level_sisters[] = $item;
			}
			if($item->object_id == $menu_item->object_id) {
				$current = count($same_level_sisters) -1;
			}
		}

		echo '<p class="btn-toolbar prevnext">';
		if($same_level_sisters[$current -1]) {
			echo '<a href="' . $same_level_sisters[$current -1]->url . '" title="" class="btn btn-default">'.
			'<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' . $same_level_sisters[$current -1]->title . '</a>';
		}
		if($same_level_sisters[$current +1]) {
			echo '<a href="' . $same_level_sisters[$current +1]->url . '" title="" class="btn btn-default pull-right">' .
			$same_level_sisters[$current +1]->title . '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></a>';
		}
		echo '</p>';
	}
}
/*
 * JLE : limit excerpt length to 20 words of content
 * (used only if "excerpt" is not defined)
 */
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
