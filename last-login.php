<?php
/*
Plugin Name: Last Login
Plugin URI: http://yourdomain.com/
Description: Records logins and provides a shortcode to display the timestamp. 
Version: 1.1
Author: Don Kukral
Author URI: http://yourdomain.com
License: GPL
*/

add_action('wp_login', 'last_login_record_login');
add_action('wp_logout', 'last_login_record_logout');

add_action('admin_menu', 'last_login_admin_menu');

function last_login_admin_menu() {
    add_options_page('Last Login', 'Last Login', 'administrator',
        'last-login', 'last_login_settings_page');
}

function last_login_record_login($login) {
    $user = get_userdatabylogin($login);
    update_user_meta($user->ID, 'last_login_lastlogintime', time());
}

function last_login_record_logout() {
    $user = wp_get_current_user();
    update_user_meta($user->ID, 'last_login_lastlogouttime', time());
}

function last_login_settings_page() {
        global $wpdb;
    ?>
    <div>
    <h3 style="padding-top: 10px;">Last Login Options</h3>

    <form method="post" action="options.php">
    <?php wp_nonce_field('update-options'); ?>

    <table width="710" style="padding-top: 15px;">
    <tr valign="top">
    <th width="120" scope="row">Online Timeout</th>
    <td width="406">
    <input type="text" name="last_login_online_timeout" value="<?php echo get_option('last_login_online_timeout', 0); ?>"/>
    </td>
    </tr>
    <tr>
    <td></td>
    <td>
    <em>Amount of time (in minutes) to show a logged in user as "online"<br/>
    Use <strong>0</strong> to disable</em>
    </td>
    </tr>
    <tr>
    <td></td>
    <td><br/><input type="submit" value="<?php _e('Save Changes') ?>" /></td>
    </tr>
    </table>

    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="last_login_online_timeout" />

    </form>
    </div>
    <?php
}

function get_last_login_status($user_id) {
    $lastlogin = get_user_meta($user_id, 'last_login_lastlogintime', true);
    $lastlogout = get_user_meta($user_id, 'last_login_lastlogouttime', true);
    $onlinetime = time() - get_option('last_login_online_timeout', 0) * 60;
    if ($onlinetime) {
        if (($lastlogin > $onlinetime) && ($lastlogin > $lastlogout)) { 
            return true;
        }
    }
    return false;
}

function get_last_login_status_current_user() {
    $current_user = wp_get_current_user();
    return get_last_login_status($current_user->ID);
}

function get_last_login($user_id, $format='%c') {
    $user = get_userdata($user_id);
    $lastlogin = get_user_meta($user->ID, 'last_login_lastlogintime', true);
    if ($lastlogin) {
        $t = strftime($format, $lastlogin);
    } else {
        $t = "";
    }
    
    return $t;
}

function get_last_login_current_user($format='%c') {
    $current_user = wp_get_current_user();
    return last_login_time($current_user->ID, $format);    
}

function check_last_login($user_id) {
    $user = get_userdata($user_id);
    $lastlogin = get_user_meta($user->ID, 'last_login_lastlogintime', true);
    if ($lastlogin) {
        return true;
    } else {
        return false;
    }
}

function check_last_login_current_user() {
    $user = wp_get_current_user();
    return check_last_login($user->ID);
}


?>
