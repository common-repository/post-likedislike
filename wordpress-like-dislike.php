<?php

/*
Plugin Name:Post Like/Dislike
Plugin URI: https://wordpress.org/plugins/Post-LikeDislike/
Description: Simple Post Like and Dislike
Version: 1.0.0
Author: Pratik Tambekar(Software developer)
Author URI: https://ensivosolutions.com
Text Domain: Post-Like/Dislike
Domain Path: /languages
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/



// if this file called directly , abort
if(!defined('WPINC')){

    die;
}

//constant defined
if(!defined('WPLD_PLUGIN_version')){

    define('WPLD_PLUGIN_version','1.0.0');
}

if(!defined('WPLD_PLUGIN_DIR')){

    define('WPLD_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}

if (! function_exists('wpld_plugin_scripts')){

    function wpld_plugin_scripts()
    {
        wp_enqueue_style('wpld-css', WPLD_PLUGIN_DIR. 'assests/css/mystyle.css');
        //wp_enqueue_script('wpld-js' , WPLD_PLUGIN_DIR. 'assests/js/main.js' , 'JQuery', '1.0.0', true);
        //plugin AJAX JS
        wp_enqueue_script('wpld-ajax' , WPLD_PLUGIN_DIR. 'assests/js/ajax.js' , 'JQuery', '1.0.0', true);

        //wp_localize_script( $handle, $name, $data ) : USE TO CREATE AJAX URL FOR THAT U NEED TO HIT ADMIN-AJAX FILE
        wp_localize_script('wpld-ajax','wpld_ajax_url', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
        //objectname.urlvalue(ex:wpld_ajax_url.ajax_url)

        //1st parameter wpld-js - unique script name
        //2nd parameter wpld-js - Directory name
        //3rd parameter wpld-js - Script dependancy (ex if your script is dependent on jquery or not)
        //4th parameter wpld-js - script load on header or footer(if true then load on footer)
    }
    add_action('wp_enqueue_scripts' , 'wpld_plugin_scripts');
}

//Settings menu and page
require plugin_dir_path(__FILE__).'inc/settings.php';


//create table for plugin
require plugin_dir_path(__FILE__).'inc/db.php';

//create like and dislike buttons using filter.(on front end side on wordpress)
require plugin_dir_path(__FILE__).'inc/like_dislike_btn.php';

//WPLD plugin ajax function
function wpld_like_btn_ajax_action()
{
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "like"; 
    $post_id = sanitize_text_field($_POST['pid']);
    $user_id = sanitize_text_field($_POST['uid']);
    $btn_type = sanitize_text_field($_POST['btn_type']);
    if($btn_type == '1')
    {
        if(isset($post_id) && isset($user_id))
        {
            $dislike_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE user_id = '$user_id' AND post_id = '$post_id' AND dislike_count=1" );
            if($dislike_count > 0)
            {
                $wpdb->delete( ''.$table_name.'', array( 'post_id' => $post_id ), array( '%d' ) );
                $wpdb->insert( 
                            ''.$table_name.'', 
                            array( 
                                'post_id' => $post_id, 
                                'user_id' => $user_id,
                                'like_count' => 1
                            ), 
                            array( 
                                '%d', 
                                '%d',
                                '%d'
                            ) 
                        );
                    if($wpdb->insert_id){
                        echo "thank you for loving it";
                    }

            }else{
                        $like_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE user_id = '$user_id' AND post_id = '$post_id' AND like_count=1" );
                        if($like_count > 0)
                        {
                            echo "Sorry.. you have already liked this post";

                        }else{   
                            $wpdb->insert( 
                                ''.$table_name.'', 
                                array( 
                                    'post_id' => $post_id, 
                                    'user_id' => $user_id,
                                    'like_count' => 1
                                ), 
                                array( 
                                    '%d', 
                                    '%d',
                                    '%d'
                                ) 
                            );
                        if($wpdb->insert_id){
                            echo "thank you for loving it";
                        }
                    }
               }
        }
    }
    if($btn_type == '0')
    {
        if(isset($post_id) && isset($user_id))
        {
            $like_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE user_id = '$user_id' AND post_id = '$post_id' AND like_count=1" );
            if($like_count > 0)
            {
                $wpdb->delete( ''.$table_name.'', array( 'post_id' => $post_id ), array( '%d' ) );
                $wpdb->insert( 
                    ''.$table_name.'', 
                    array( 
                        'post_id' => $post_id, 
                        'user_id' => $user_id,
                        'dislike_count' => 1
                    ), 
                    array( 
                        '%d', 
                        '%d',
                        '%d'
                    ) 
                );
                if($wpdb->insert_id){
                // echo "thank you for loving it";
                }

            }else{
                    $dislike_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE user_id = '$user_id' AND post_id = '$post_id' AND dislike_count=1" );
                    if($dislike_count == 0)
                    {
                   
                            $wpdb->insert( 
                                ''.$table_name.'', 
                                array( 
                                    'post_id' => $post_id, 
                                    'user_id' => $user_id,
                                    'dislike_count' => 1
                                ), 
                                array( 
                                    '%d', 
                                    '%d',
                                    '%d'
                                ) 
                            );
                        if($wpdb->insert_id){
                        // echo "thank you for loving it";
                         }
                    }
                 }


        }


    }

    
    wp_die();
}
//syntax wp_ajax_handler(here handler is function name)
//add_action( 'wp_ajax_foobar', 'my_ajax_foobar_handler' );
add_action('wp_ajax_wpld_like_btn_ajax_action', 'wpld_like_btn_ajax_action');
//This hook is functionally the same as wp_ajax_(action), except the "nopriv" variant is used for handling AJAX requests from unauthenticated users, i.e. when is_user_logged_in() returns false.
add_action('wp_ajax_nopriv_wpld_like_btn_ajax_action', 'wpld_like_btn_ajax_action');


//NOPRIV USE FOE UNAUTHENTICATED USER

function wpld_show_like_count($content){
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $table_name = $wpdb->prefix . "like"; 
    $post_id = get_the_ID();
    if(isset($post_id))
    {
        $show_like_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE  post_id = '$post_id' AND like_count=1" );
        $like_count_result ="<span>This post has been  liked <strong>".$show_like_count." </strong>time(s)</span>";
        $content .= $like_count_result;
        return $content;
    }
}
add_filter('the_content', 'wpld_show_like_count');










// if u want to add submenu under the name tools just write down tools.php if u want add in theme section for that refer wordpress plugin tutorial
// function wpld_register_add_submenu_page()
// {
//     add_theme_page( 'Like-dislike', 'WPLD-Settings', 'manage_options', 'wpld-settings', 'wpld_settings_page_html' , 30);
// }
// add_action('admin_menu', 'wpld_register_add_submenu_page');

//dont use admin_init
//register plugin menu (syntax)
//add_menu_page(page_title, menu_title, capability, menu_slug, function, icon_url,postion);



//refrence site : https://codex.wordpress.org/Plugin_API/Filter_Reference
// tutorial link : https://www.youtube.com/watch?v=A8u--8t3UZI&list=PL6Kd_lvAfBuYzxHmbOdoXjBuW6pFs_xja&index=3
//https://codex.wordpress.org/Creating_Tables_with_Plugins
// on new post it send mail to user
// function email_members($post_ID)  {
//           global $wpdb;
//           $usersarray = $wpdb->get_results("SELECT user_email FROM $wpdb->users;");    
//           $users = implode(",", $usersarray);
//           mail($users, "New WordPress recipe online!", 'A new recipe have been published on http://www.wprecipes.com');
//           return $post_ID;
//       }
      
// add_action('publish_post', 'email_members');

// function like_filter_example( $words)
// {
//           return 10;
// }
// add_filter('excerpt_length', 'like_filter_example');


// //Defines the more string at the end of the excerpt.
// function like_filter_example_2( $more)
// {
//           $more = '<a href="'.get_the_permalink().'">More</a>';
//           return $more;
// }
// add_filter('excerpt_more', 'like_filter_example_2');
  



?>
