<?php
//Settings page html
function wpld_settings_page_html()
{
    //wrap is wordpress class
    //normal user can't access it directly(if it is not admin u cant use it)
    if(!is_admin())
    {
        return;
    }
    ?>

        <div class="wrap"> 
        <h1 style="padding:10px;background:#D3D3D3;color:#fff;"><?=esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
        <?php
            settings_fields('wpld-settings'); //pass group name while passes at the time of register_settings
            do_settings_sections('wpld-settings'); //pass slug_name
            submit_button('Save Changes');
        ?>
        </form>

    <?php


}

function wpld_register_add_menu_page()
{
    add_menu_page('Like-dislike', 'WPLD-Settings', 'manage_options', 'wpld-settings', 'wpld_settings_page_html' ,'dashicons-thumbs-up' ,30);
}
add_action('admin_menu', 'wpld_register_add_menu_page');

//for adding in sub menus
// function wpld_register_add_submenu_page()
// {
//     add_submenu_page('tools.php', 'Like-dislike', 'WPLD-Settings', 'manage_options', 'wpld-settings', 'wpld_settings_page_html' , 30);
// }
// add_action('admin_menu', 'wpld_register_add_submenu_page');


function wpld_plugin_settings()
{
    //register_setting(option_group, option_name, sanitize_callback);
    //wpld-settings slug name
    register_setting('wpld-settings', 'wpld_like_btn_label');
    register_setting('wpld-settings', 'wpld_dislike_btn_label');

    //add_settings_section(id, title, callback, page);
    add_settings_section('wpld_label_settings_section', 'WPLD Button labels', 'wpld_plugin_settings_section_cb', 'wpld-settings');

    //add_settings_field(id, title,  callback, page, section, args);
    add_settings_field('wpld_like_label_field', 'Like Button Label', 'wpld_like_label_field_cb', 'wpld-settings', 'wpld_label_settings_section');

    add_settings_field('wpld_dislike_label_field', 'Dislike Button Label', 'wpld_dislike_label_field_cb', 'wpld-settings', 'wpld_label_settings_section');
}
add_action('admin_init', 'wpld_plugin_settings');
// when dashboard initialize this function call automatically(admin_init)

function wpld_plugin_settings_section_cb()
{
    echo '<p>Define Button Labels</p>';
}

function wpld_like_label_field_cb()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpld_like_btn_label');
    //output the field
    ?>
    <input type="text" name="wpld_like_btn_label" value="<?php echo isset($setting)?esc_attr($setting):'';?>">
    <?php
    
}

function wpld_dislike_label_field_cb()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('wpld_dislike_btn_label');
    //output the field
    ?>
    <input type="text" name="wpld_dislike_btn_label" value="<?php echo isset($setting)?esc_attr($setting):'';?>">
    <?php
    
}