<?php
/*
 *  Author: Sebastian Kobersy
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Functions
\*------------------------------------*/

require_once(get_stylesheet_directory() . '/inc/default-hooks.php');
require_once(get_stylesheet_directory() . '/inc/woocommerce-admin.php');


// HTML5 Blank navigation
function main_nav() {
    $menuParameters = array(
        'theme_location'  => 'header-menu',
        'container'       => false,
        'echo'            => true,
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
    );

    echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
}




// Load scripts (header.php)
function brace_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

      // wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        //wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/min/scripts.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// function boostrap_scripts() {
//     wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
//     wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array( 'jquery' ),'',true );
//     wp_enqueue_script( 'boot3','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array( 'jquery' ),'',true );
// }


function slick_scripts() {
    wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css');
    wp_enqueue_script( 'slick_js','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ),'',true );
}


function modern_jquery() {
    wp_deregister_script( 'jquery' );
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '2.2.4', true); // true will place script in the footer
    wp_enqueue_script( 'jquery' );
}
if(!is_admin()) {
    add_action('wp_enqueue_scripts', 'modern_jquery', 99);
}

// Load conditional scripts based on page
// function brace_conditional_scripts()
// {
//     if (is_page('pagenamehere')) {
//         wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
//         wp_enqueue_script('scriptname'); // Enqueue it!
//     }
// }

// Load styles
function brace_styles()
{
   // wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    //wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('global_styles', get_template_directory_uri() . '/style.css', array(), '1.9', 'all');
    wp_enqueue_style('global_styles'); // Enqueue it!

    wp_register_style('main_styles', get_template_directory_uri() . '/css/min/main.min.css', array(), '2.0', 'all');
    wp_enqueue_style('main_styles'); // Enqueue it!
}

// Register Main Navigation
function register_main_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'sitename'), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Add active to nav items
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


function change_ul_item_classes_in_nav( $classes, $args, $depth ) {
    if ( 0 == $depth ) {
        $classes[] = 'first-level';
    }
    if ( 1 == $depth ) {
        $classes[] = 'second-level';
    }
    // ...
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'change_ul_item_classes_in_nav', 10, 3 );


// custom pagination for index
function customwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}


// disable comments
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// woocommerce theme support
add_theme_support( 'woocommerce' );


add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


//  ACF options page
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
    
}

function remove_pages_from_search() {
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'remove_pages_from_search');

add_filter('woocommerce_show_variation_price', '__return_true');
add_filter( 'woocommerce_get_price_html', 'custom_price_wrapper', 10, 2 );
function custom_price_wrapper($price, $instance){
    $including_tax = wc_get_price_including_tax($instance);
    $excluding_tax = wc_get_price_excluding_tax($instance);

    return "<div class='tax__toggle__data' data-with-tax='" . esc_attr( $including_tax ) . "' data-without-tax='" . esc_attr( $excluding_tax ) . "'>" . $price . "</div>";
}



function woocommerce_template_loop_product_link_open() {
    global $product;

    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

    echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"> <div class="product__loop__interal">';
}


function woocommerce_template_loop_product_link_close() { 
    echo '</div></a>'; 
} 


add_filter( 'woocommerce_get_image_size_single', function( $size ) {
    return array(
        'width'  => 'auto',
        'height' => 'auto',
        'crop'   => 0,
    );
} );


function custom_woocommerce_checkout_must_be_logged_in_message( $var ) { 
        echo 'You need to be a registered customer with CTCUK before you can purchase items from the website'. '<br /> <br /> <a href="' . get_permalink(wc_get_page_id('myaccount')) . '" class="button button--blue">Register</a>'; 
}
add_filter( 'woocommerce_checkout_must_be_logged_in_message', 'custom_woocommerce_checkout_must_be_logged_in_message', 10, 1 );



add_action( 'init', 'woo_hide_prices_when_not_logged_in' );
  
function woo_hide_prices_when_not_logged_in() {   
   if ( ! is_user_logged_in() ) {      
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
      remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
      remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );   
      add_action( 'woocommerce_single_product_summary', 'print_login_to_see', 31 );
      add_action( 'woocommerce_after_shop_loop_item', 'print_login_to_see', 11 );
   }
}
  
function print_login_to_see() {
   echo '<a href="' . get_permalink(wc_get_page_id('myaccount')) . '" class="button button--blue">' . __('Login to see prices', 'theme_name') . '</a>';
}

add_action( 'woocommerce_register_form', 'add_register_form_field' );
 
function add_register_form_field(){
 
    woocommerce_form_field(
        'full_company_name',
        array(
            'type'        => 'text',
            'required'    => true, // just adds an "*"
            'label'       => 'Full Company Name',
            'class' => array( 'woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide' ),
        ),
        ( isset($_POST['full_company_name']) ? $_POST['full_company_name'] : '' )
    );

     woocommerce_form_field(
        'your_current_account_code',
        array(
            'type'        => 'text',
            'required'    => true, // just adds an "*"
            'label'       => 'Your current account code',
            'class' => array( 'woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide' ),
        ),
        ( isset($_POST['your_current_account_code']) ? $_POST['your_current_account_code'] : '' )
    );
 
}


add_action( 'woocommerce_register_post', 'validate_fields', 10, 3 );
 
function validate_fields( $username, $email, $errors ) {
 
    if ( empty( $_POST['full_company_name'] ) ) {
        $errors->add( 'full_company_name_error', 'Full company name is required' );
    }

    if ( empty( $_POST['your_current_account_code'] ) ) {
        $errors->add( 'your_current_account_error', 'Your current account code is required' );
    }
 
}



add_action( 'woocommerce_created_customer', 'save_register_fields' );
 
function save_register_fields( $customer_id ){
 
    if ( isset( $_POST['full_company_name'] ) ) {
        update_user_meta( $customer_id, 'full_company_name', wc_clean( $_POST['full_company_name'] ) );
    }

    if ( isset( $_POST['your_current_account_code'] ) ) {
        update_user_meta( $customer_id, 'your_current_account_code', wc_clean( $_POST['your_current_account_code'] ) );
    }
 
}


add_action( 'woocommerce_before_password_change_fields', 'add_register_form_field', 10 );


add_action( 'woocommerce_save_account_details', 'save_extra_account_details', 12, 1 );
function save_extra_account_details( $customer_id ) {
    
    if ( isset( $_POST['full_company_name'] ) ) {
        update_user_meta( $customer_id, 'full_company_name', wc_clean( $_POST['full_company_name'] ) );
    }

     if ( isset( $_POST['your_current_account_code'] ) ) {
        update_user_meta( $customer_id, 'your_current_account_code', wc_clean( $_POST['your_current_account_code'] ) );
    }
}


function new_modify_user_table( $column ) {
    $column['full_company_name'] = 'Full Company Name';
    $column['your_current_account_code'] = 'Your Current Account Code';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'full_company_name' :
            return get_the_author_meta( 'full_company_name', $user_id );
        case 'your_current_account_code' :
            return get_the_author_meta( 'your_current_account_code', $user_id );
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );



add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Company Information", "blank"); ?></h3>

<table class="form-table">
    <tr>
        <th><label for="companyname"><?php _e("Full Company Name"); ?></label></th>
        <td>
            <input type="text" name="companyname" id="companyname"
                value="<?php echo esc_attr( get_the_author_meta( 'full_company_name', $user->ID ) ); ?>"
                class="regular-text" /><br />
            <span class="description"><?php _e("Please enter the company name."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="accountcode"><?php _e("Your Current Account Code"); ?></label></th>
        <td>
            <input type="text" name="accountcode" id="accountcode"
                value="<?php echo esc_attr( get_the_author_meta( 'your_current_account_code', $user->ID ) ); ?>"
                class="regular-text" /><br />
            <span class="description"><?php _e("Please enter the current account code."); ?></span>
        </td>
    </tr>
</table>
<?php }



add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'full_company_name', $_POST['companyname'] );
    update_user_meta( $user_id, 'your_current_account_code', $_POST['accountcode'] );
}


/*------------------------------------*\
    Actions + Filters
\*------------------------------------*/


define('FS_METHOD','direct');

// Add Actions
add_action('init', 'brace_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'brace_conditional_scripts'); // Add Conditional Page Scripts
// add_action('wp_enqueue_scripts', 'boostrap_scripts'); // Boostrap
add_action('wp_enqueue_scripts', 'brace_styles'); // Add Theme Stylesheet
add_action('init', 'register_main_menu'); // Add Main Menu
add_action('wp_enqueue_scripts', 'slick_scripts'); // Slick

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

?>