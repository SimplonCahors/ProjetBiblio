<?php
/*
  Plugin Name: Captcha Bank
  Plugin URI: http://captcha-bank.tech-banker.com
  Description: This plugin allows you to implement security captcha form into web forms to prevent spam.
  Author: Tech Banker
  Author URI: http://captcha-bank.tech-banker.com
  Version: 4.0.17
  License: GPLv3
  Text Domain: captcha-bank
  Domain Path: /languages
 */

if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
/* Constant Declaration */
if (!defined("CAPTCHA_BANK_FILE")) {
   define("CAPTCHA_BANK_FILE", plugin_basename(__FILE__));
}
if (!defined("CAPTCHA_BANK_DIR_PATH")) {
   define("CAPTCHA_BANK_DIR_PATH", plugin_dir_path(__FILE__));
}
if (!defined("CAPTCHA_BANK_PLUGIN_DIRNAME")) {
   define("CAPTCHA_BANK_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
}

if (!defined("CAPTCHA_BANK_LOCAL_TIME")) {
   define("CAPTCHA_BANK_LOCAL_TIME", strtotime(date_i18n("Y-m-d H:i:s")));
}
if (is_ssl()) {
   if (!defined("tech_banker_url")) {
      define("tech_banker_url", "https://tech-banker.com");
   }
   if (!defined("tech_banker_beta_url")) {
      define("tech_banker_beta_url", "https://captcha-bank.tech-banker.com/");
   }
   if (!defined("tech_banker_services_url")) {
      define("tech_banker_services_url", "https://tech-banker-services.org");
   }
} else {
   if (!defined("tech_banker_url")) {
      define("tech_banker_url", "http://tech-banker.com");
   }
   if (!defined("tech_banker_beta_url")) {
      define("tech_banker_beta_url", "https://captcha-bank.tech-banker.com/");
   }
   if (!defined("tech_banker_services_url")) {
      define("tech_banker_services_url", "http://tech-banker-services.org");
   }
}
if (!defined("tech_banker_stats_url")) {
   define("tech_banker_stats_url", "http://stats.tech-banker-services.org");
}
if (!defined("captcha_bank_version_number")) {
   define("captcha_bank_version_number", "4.0.17");
}

$memory_limit_captcha_bank = intval(ini_get("memory_limit"));
if (!extension_loaded('suhosin') && $memory_limit_captcha_bank < 512) {
   @ini_set("memory_limit", "512M");
}

@ini_set("max_execution_time", 6000);
@ini_set("max_input_vars", 10000);

/*
  Function Name: install_script_for_captcha_bank
  Parameters: No
  Description: This function is used to create Tables in Database.
  Created On: 25-08-2016 09:43
  Created By: Tech Banker Team
 */
function install_script_for_captcha_bank() {
   global $wpdb;
   if (is_multisite()) {
      $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
      foreach ($blog_ids as $blog_id) {
         switch_to_blog($blog_id);
         $version = get_option("captcha-bank-version-number");
         if ($version < "4.0.1") {
            if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/install-script.php")) {
               include CAPTCHA_BANK_DIR_PATH . "lib/install-script.php";
            }
         }
         restore_current_blog();
      }
   } else {
      $version = get_option("captcha-bank-version-number");
      if ($version < "4.0.1") {
         if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/install-script.php")) {
            include_once CAPTCHA_BANK_DIR_PATH . "lib/install-script.php";
         }
      }
   }
}
/*
  Function Name: captcha_bank_parent
  Parameter: No
  Description: This function is used to return Parent Table name with prefix.
  Created On: 25-08-2016 10:07
  Created By: Tech Banker Team
 */
function captcha_bank_parent() {
   global $wpdb;
   return $wpdb->prefix . "captcha_bank";
}
/*
  Function Name: captcha_bank_meta
  Parameter: No
  Description: This function is used to return Meta Table name with prefix.
  Created On: 25-08-2016 10:12
  Created By: Tech Banker Team
 */
function captcha_bank_meta() {
   global $wpdb;
   return $wpdb->prefix . "captcha_bank_meta";
}
/*
  Function Name: check_user_roles_captcha_bank
  Parameters: No
  Description: This function is used for checking roles of different users.
  Created On: 9-10-2016 17:32
  Created By: Tech Banker Team
 */
function check_user_roles_captcha_bank() {
   global $current_user;
   $user = $current_user ? new WP_User($current_user) : wp_get_current_user();
   return $user->roles ? $user->roles[0] : false;
}
/*
  Function Name: get_others_capabilities_captcha_bank
  Parameters: No
  Description: This function is used to get all the roles available in WordPress
  Created On: 22-10-2016 10:43
  Created By: Tech Banker Team
 */
function get_others_capabilities_captcha_bank() {
   $user_capabilities = array();
   if (function_exists("get_editable_roles")) {
      foreach (get_editable_roles() as $role_name => $role_info) {
         foreach ($role_info["capabilities"] as $capability => $values) {
            if (!in_array($capability, $user_capabilities)) {
               array_push($user_capabilities, $capability);
            }
         }
      }
   } else {
      $user_capabilities = array(
          "manage_options",
          "edit_plugins",
          "edit_posts",
          "publish_posts",
          "publish_pages",
          "edit_pages",
          "read"
      );
   }
   return $user_capabilities;
}
/*
  Function Name: captcha_bank_bank_action_links
  Parameters: Yes
  Description: This function is used to create link for Pro Editions.
  Created On: 11-04-2017 18:06
  Created By: Tech Banker Team
 */
function captcha_bank_action_links($plugin_link) {
   $plugin_link[] = "<a href=\"https://captcha-bank.tech-banker.com/\" style=\"color: red; font-weight: bold;\" target=\"_blank\">Go Pro!</a>";
   return $plugin_link;
}
/*
  Function Name: captcha_bank_settings_action_links
  Parameters: Yes($action)
  Description: This function is used to create link for Plugin Settings.
  Created On: 03-05-2017 17:30
  Created By: Tech Banker Team
 */
function captcha_bank_settings_action_links($action) {
   global $wpdb;
   $user_role_permission = get_users_capabilities_captcha_bank();
   $settings_link = '<a href = "' . admin_url('admin.php?page=captcha_bank') . '">' . "Settings" . '</a>';
   array_unshift($action, $settings_link);
   return $action;
}

function long2ip_captcha_bank($long) {
     // Valid range: 0.0.0.0 -> 255.255.255.255
     if ($long < 0 || $long > 4294967295) return false;
     $ip = "";
     for ($i=3;$i>=0;$i--) {
         $ip .= (int)($long / pow(256,$i));
         $long -= (int)($long / pow(256,$i))*pow(256,$i);
         if ($i>0) $ip .= ".";
     }
     return $ip;
 }
 
$version = get_option("captcha-bank-version-number");
if ($version >= "4.0.1") {
   /*
     Function Name: backend_js_css_for_captcha_bank
     Parameters: No
     Description: This function is used for including js and css files for backend.
     Created On: 25-08-2016 10:00
     Created By: Tech Banker Team
    */

   if (is_admin()) {

      function backend_js_css_for_captcha_bank() {
         $pages_captcha_bank = array
             (
             "captcha_bank_wizard",
             "captcha_bank",
             "captcha_bank_display_settings",
             "captcha_bank_notifications_setup",
             "captcha_bank_message_settings",
             "captcha_bank_email_templates",
             "captcha_bank_roles_capabilities",
             "captcha_bank_login_logs",
             "captcha_bank_visitor_logs",
             "captcha_bank_live_traffic",
             "captcha_bank_other_settings",
             "captcha_bank_blockage_settings",
             "captcha_bank_block_unblock_ip_addresses",
             "captcha_bank_block_unblock_ip_ranges",
             "captcha_bank_block_unblock_countries",
             "captcha_bank_system_information"
         );
         if (in_array(isset($_REQUEST["page"]) ? esc_attr($_REQUEST["page"]) : "", $pages_captcha_bank)) {
            wp_enqueue_script("jquery");
            wp_enqueue_script("jquery-ui-datepicker");
            wp_enqueue_script("captcha-bank-custom.js", plugins_url("assets/global/plugins/custom/js/custom.js", __FILE__));
            wp_enqueue_script("captcha-bank-validate.js", plugins_url("assets/global/plugins/validation/jquery.validate.js", __FILE__));
            wp_enqueue_script("captcha-bank-datatables.js", plugins_url("assets/global/plugins/datatables/media/js/jquery.datatables.js", __FILE__));
            wp_enqueue_script("captcha-bank-fngetfilterednodes.js", plugins_url("assets/global/plugins/datatables/media/js/fngetfilterednodes.js", __FILE__));
            wp_enqueue_script("captcha-bank-toastr.js", plugins_url("assets/global/plugins/toastr/toastr.js", __FILE__));
            wp_enqueue_script("captcha-bank-colpick.js", plugins_url("assets/global/plugins/colorpicker/colpick.js", __FILE__));
            if (is_ssl()) {
               wp_enqueue_script("captcha-bank-maps_script.js", "https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyC4rVG7IsNk9pKUO_uOZuxQO4FmF6z03Ks");
            } else {
               wp_enqueue_script("captcha-bank-maps_script.js", "http://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyC4rVG7IsNk9pKUO_uOZuxQO4FmF6z03Ks");
            }
            wp_enqueue_style("captcha-bank-simple-line-icons.css", plugins_url("assets/global/plugins/icons/icons.css", __FILE__));
            wp_enqueue_style("captcha-bank-components.css", plugins_url("assets/global/css/components.css", __FILE__));
            wp_enqueue_style("captcha-bank-custom.css", plugins_url("assets/admin/layout/css/captcha-bank-custom.css", __FILE__));
            if (is_rtl()) {
               wp_enqueue_style("captcha-bank-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom-rtl.css", __FILE__));
               wp_enqueue_style("captcha-bank-layout.css", plugins_url("assets/admin/layout/css/layout-rtl.css", __FILE__));
               wp_enqueue_style("captcha-bank-tech-banker-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom-rtl.css", __FILE__));
            } else {
               wp_enqueue_style("captcha-bank-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom.css", __FILE__));
               wp_enqueue_style("captcha-bank-layout.css", plugins_url("assets/admin/layout/css/layout.css", __FILE__));
               wp_enqueue_style("captcha-bank-tech-banker-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom.css", __FILE__));
            }
            wp_enqueue_style("captcha-bank-default.css", plugins_url("assets/admin/layout/css/themes/default.css", __FILE__));
            wp_enqueue_style("captcha-bank-toastr.min.css", plugins_url("assets/global/plugins/toastr/toastr.css", __FILE__));
            wp_enqueue_style("captcha-bank-jquery-ui.css", plugins_url("assets/global/plugins/datepicker/jquery-ui.css", __FILE__), false, "2.0", false);
            wp_enqueue_style("captcha-bank-datatables.foundation.css", plugins_url("assets/global/plugins/datatables/media/css/datatables.foundation.css", __FILE__));
            wp_enqueue_style("captcha-bank-colpick.css", plugins_url("assets/global/plugins/colorpicker/colpick.css", __FILE__));
         }
      }
      add_action("admin_enqueue_scripts", "backend_js_css_for_captcha_bank");
   }

   /*
     Function Name: get_users_capabilities_captcha_bank
     Parameters: No
     Description: This function is used to get users capabilities.
     Created On: 22-10-2016 13:01
     Created By: Tech Banker Team
    */
   function get_users_capabilities_captcha_bank() {
      global $wpdb;
      $capabilities = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . captcha_bank_meta() . "
					WHERE meta_key = %s", "roles_and_capabilities"
          )
      );
      $core_roles = array(
          "manage_options",
          "edit_plugins",
          "edit_posts",
          "publish_posts",
          "publish_pages",
          "edit_pages",
          "read"
      );
      $unserialized_capabilities = maybe_unserialize($capabilities);
      return isset($unserialized_capabilities["capabilities"]) ? $unserialized_capabilities["capabilities"] : $core_roles;
   }
   /*
     Function Name: create_sidebar_menu_for_captcha_bank
     Parameters: No
     Description: This function is used to create Admin Sidebar Menus.
     Created On: 25-08-2016 10:25
     Created By: Tech Banker Team
    */
   function create_sidebar_menu_for_captcha_bank() {
      global $wpdb, $current_user;
      $user_role_permission = get_users_capabilities_captcha_bank();
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
         include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
      }
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/sidebar-menu.php")) {
         include_once CAPTCHA_BANK_DIR_PATH . "lib/sidebar-menu.php";
      }
   }
   /*
     Function name: create_topbar_menu_for_captcha_bank
     Parameters: No
     Description: This function is used to create Topbar Menus.
     Created On: 25-08-2016 16:12
     Created By: Tech Banker Team
    */
   function create_topbar_menu_for_captcha_bank() {
      global $wpdb, $current_user, $wp_admin_bar;
      $roles_and_capabilities = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . captcha_bank_meta() .
              " WHERE meta_key = %s", "roles_and_capabilities"
          )
      );
      $roles_and_capabilities_data = maybe_unserialize($roles_and_capabilities);

      if ($roles_and_capabilities_data["show_captcha_bank_top_bar_menu"] == "enable") {
         $user_role_permission = get_users_capabilities_captcha_bank();
         if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
            include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
         }
         if (get_option("captcha-bank-wizard-set-up")) {
            if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/admin-bar-menu.php")) {
               include_once CAPTCHA_BANK_DIR_PATH . "lib/admin-bar-menu.php";
            }
         }
      }
   }
   /*
     Function Name: helper_file_for_captcha_bank
     Parameters: No
     Description: This function is used to create Class and Functions to perform operations.
     Created On: 25-08-2016 10:20
     Created By: Tech Banker Team
    */
   function helper_file_for_captcha_bank() {
      global $wpdb;
      $user_role_permission = get_users_capabilities_captcha_bank();
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/helper.php")) {
         include_once CAPTCHA_BANK_DIR_PATH . "lib/helper.php";
      }
   }
   /*
     Function Name: ajax_register_for_captcha_bank
     Parameters: No
     Description: This function is used to Register Ajax.
     Created On: 25-08-2016 10:27
     Created By: Tech Banker Team
    */
   function ajax_register_for_captcha_bank() {
      global $wpdb;
      $user_role_permission = get_users_capabilities_captcha_bank();
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
         include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
      }
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/action-library.php")) {
         include_once CAPTCHA_BANK_DIR_PATH . "lib/action-library.php";
      }
   }
   /*
     Function Name: admin_functions_for_captcha_bank
     Parameters: No
     Description: This function is used to call functions on init hook.
     Created On: 25-08-2016 10:30
     Created By: Tech Banker Team
    */
   function admin_functions_for_captcha_bank() {
      install_script_for_captcha_bank();
      helper_file_for_captcha_bank();
   }
   /*
     Function Name: plugin_load_textdomain_captcha_bank
     Parameters: No
     Description: This function is used to Load the plugin’s translated strings.
     Created On: 03-09-2016 12:42
     Created By: Tech Banker Team
    */
   function plugin_load_textdomain_captcha_bank() {
      load_plugin_textdomain("captcha-bank", false, CAPTCHA_BANK_PLUGIN_DIRNAME . "/languages");
   }
   /*
     Function Name: js_frontend_for_captcha_bank
     Parameters: No
     Description: This function is used for including js files for frontend.
     Created On: 30-08-2016 12:36
     Created By: Tech Banker Team
    */
   function js_frontend_for_captcha_bank() {
      wp_enqueue_script("jquery");
      wp_enqueue_script("captcha-bank-front-end-script.js", plugins_url("assets/global/plugins/custom/js/front-end-script.js", __FILE__));
   }
   /*
     Function Name: validate_ip_captcha_bank
     Parameters: No
     description: This function is used for validating ip address.
     Created on: 29-09-2015 10:56
     Created By: Tech Banker Team
    */
   function validate_ip_captcha_bank($ip) {
      if (strtolower($ip) === "unknown") {
         return false;
      }
      $ip = sprintf("%u",ip2long($ip));

      if ($ip !== false && $ip !== -1) {
         $ip = sprintf("%u", $ip);

         if ($ip >= 0 && $ip <= 50331647) {
            return false;
         }
         if ($ip >= 167772160 && $ip <= 184549375) {
            return false;
         }
         if ($ip >= 2130706432 && $ip <= 2147483647) {
            return false;
         }
         if ($ip >= 2851995648 && $ip <= 2852061183) {
            return false;
         }
         if ($ip >= 2886729728 && $ip <= 2887778303) {
            return false;
         }
         if ($ip >= 3221225984 && $ip <= 3221226239) {
            return false;
         }
         if ($ip >= 3232235520 && $ip <= 3232301055) {
            return false;
         }
         if ($ip >= 4294967040) {
            return false;
         }
      }
      return true;
   }
   /*
     Function Name: getIpAddress_for_captcha_bank
     Parameters: No
     Description: This function returns the IP Address of the user.
     Created On: 29-08-2016 17:40
     Created By: Tech Banker Team
    */
   function getIpAddress_for_captcha_bank() {
      static $ip = null;
      if (isset($ip)) {
         return $ip;
      }

      global $wpdb;
      $data = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . captcha_bank_meta() . "
					WHERE meta_key=%s", "other_settings"
          )
      );
      $other_settings_data = maybe_unserialize($data);

      if (isset($other_settings_data["ip_address_fetching_method"])) {
         switch (esc_attr($other_settings_data["ip_address_fetching_method"])) {
            case "REMOTE_ADDR":
               if (isset($_SERVER["REMOTE_ADDR"])) {
                  if (!empty($_SERVER["REMOTE_ADDR"]) && validate_ip_captcha_bank($_SERVER["REMOTE_ADDR"])) {
                     $ip = $_SERVER["REMOTE_ADDR"];
                     return $ip;
                  }
               }
               break;

            case "HTTP_X_FORWARDED_FOR":
               if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                  if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",") !== false) {
                     $iplist = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                     foreach ($iplist as $ip_address) {
                        if (validate_ip_captcha_bank($ip_address)) {
                           $ip = $ip_address;
                           return $ip;
                        }
                     }
                  } else {
                     if (validate_ip_captcha_bank($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                        return $ip;
                     }
                  }
               }
               break;

            case "HTTP_X_REAL_IP":
               if (isset($_SERVER["HTTP_X_REAL_IP"])) {
                  if (!empty($_SERVER["HTTP_X_REAL_IP"]) && validate_ip_captcha_bank($_SERVER["HTTP_X_REAL_IP"])) {
                     $ip = $_SERVER["HTTP_X_REAL_IP"];
                     return $ip;
                  }
               }
               break;

            case "HTTP_CF_CONNECTING_IP":
               if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"]) && validate_ip_captcha_bank($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                     $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
                     return $ip;
                  }
               }
               break;

            default:
               if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                  if (!empty($_SERVER["HTTP_CLIENT_IP"]) && validate_ip_captcha_bank($_SERVER["HTTP_CLIENT_IP"])) {
                     $ip = $_SERVER["HTTP_CLIENT_IP"];
                     return $ip;
                  }
               }
               if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                  if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",") !== false) {
                     $iplist = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                     foreach ($iplist as $ip_address) {
                        if (validate_ip_captcha_bank($ip_address)) {
                           $ip = $ip_address;
                           return $ip;
                        }
                     }
                  } else {
                     if (validate_ip_captcha_bank($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                        return $ip;
                     }
                  }
               }
               if (isset($_SERVER["HTTP_X_FORWARDED"])) {
                  if (!empty($_SERVER["HTTP_X_FORWARDED"]) && validate_ip_captcha_bank($_SERVER["HTTP_X_FORWARDED"])) {
                     $ip = $_SERVER["HTTP_X_FORWARDED"];
                     return $ip;
                  }
               }
               if (isset($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
                  if (!empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) && validate_ip_captcha_bank($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
                     $ip = $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
                     return $ip;
                  }
               }
               if (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
                  if (!empty($_SERVER["HTTP_FORWARDED_FOR"]) && validate_ip_captcha_bank($_SERVER["HTTP_FORWARDED_FOR"])) {
                     $ip = $_SERVER["HTTP_FORWARDED_FOR"];
                     return $ip;
                  }
               }
               if (isset($_SERVER["HTTP_FORWARDED"])) {
                  if (!empty($_SERVER["HTTP_FORWARDED"]) && validate_ip_captcha_bank($_SERVER["HTTP_FORWARDED"])) {
                     $ip = $_SERVER["HTTP_FORWARDED"];
                     return $ip;
                  }
               }
               if (isset($_SERVER["REMOTE_ADDR"])) {
                  if (!empty($_SERVER["REMOTE_ADDR"]) && validate_ip_captcha_bank($_SERVER["REMOTE_ADDR"])) {
                     $ip = $_SERVER["REMOTE_ADDR"];
                     return $ip;
                  }
               }
               break;
         }
      }
      return "127.0.0.1";
   }
   /*
     Function name: get_ip_location_captcha_bank
     Parameters: yes ($ip_address)
     Description: This function returns the location of the IP Address.
     Created On: 27-08-2016 14:43
     Created By: Tech Banker Team
    */
   function get_ip_location_captcha_bank($ip_Address) {
      $core_data = '{"ip":"0.0.0.0","country_code":"","country_name":"","region_code":"","region_name":"","city":"","latitude":0,"longitude":0}';
      $apiCall = tech_banker_services_url . "/api/getipaddress.php?ip_address=" . $ip_Address;
      $jsonData = @file_get_contents($apiCall);
      return json_decode($jsonData);
   }
   /*
     Function Name: blocking_visitors_captcha_bank
     Parameters: no
     Description: This function is used to Block IP Address.
     Created On: 03-09-2016 09:10
     Created By: Tech Banker Team
    */
   function blocking_visitors_captcha_bank() {
      global $wpdb;
      $count_ip = 0;
      $flag = 0;
      $ip_address = getIpAddress_for_captcha_bank() == "::1" ? sprintf("%u",ip2long("127.0.0.1")) : sprintf("%u",ip2long(getIpAddress_for_captcha_bank()));
      $location = get_ip_location_captcha_bank(long2ip_captcha_bank($ip_address));

      $error_message_data = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key = %s", "error_message"
          )
      );
      $error_message_unserialized_data = maybe_unserialize($error_message_data);

      $meta_values_ip_blocks = $wpdb->get_results
          (
          $wpdb->prepare
              (
              "SELECT meta_key,meta_value FROM " . captcha_bank_meta() .
              " WHERE meta_key IN(%s,%s)", "block_ip_address", "block_ip_range"
          )
      );
      foreach ($meta_values_ip_blocks as $data) {
         $ip_address_data_array = maybe_unserialize($data->meta_value);
         if ($data->meta_key == "block_ip_address") {
            if ($ip_address_data_array["ip_address"] == $ip_address) {
               $count_ip = 1;
               break;
            }
         } else {
            $ip_range_address = explode(",", $ip_address_data_array["ip_range"]);
            if ($ip_address >= $ip_range_address[0] && $ip_address <= $ip_range_address[1]) {
               $flag = 1;
               break;
            }
         }
      }
      if ($count_ip == 1 || $flag == 1) {
         if ($count_ip == 1) {
            $replace_address_data = str_replace("[ip_address]", long2ip_captcha_bank($ip_address), $error_message_unserialized_data["for_blocked_ip_address_error"]);
            wp_die($replace_address_data);
         } else {
            $replace_range = str_replace("[ip_range]", long2ip_captcha_bank($ip_range_address[0]) . "-" . long2ip_captcha_bank($ip_range_address[1]), $error_message_unserialized_data["for_blocked_ip_range_error"]);
            wp_die($replace_range);
         }
      }
   }
   /*
     Function Name: wp_schedule_captcha_bank
     Parameters: Yes($cron_name,$blocked_time)
     Description: This function is used to Create Schedules.
     Created On: 27-08-2016 14:50
     Created By: Tech Banker Team
    */
   function wp_schedule_captcha_bank($cron_name, $blocked_time) {
      if (!wp_next_scheduled($cron_name)) {
         switch ($blocked_time) {
            case "1Hour":
               $this_time = 60 * 60;
               break;

            case "12Hour":
               $this_time = 12 * 60 * 60;
               break;

            case "24hours":
               $this_time = 24 * 60 * 60;
               break;

            case "48hours":
               $this_time = 2 * 24 * 60 * 60;
               break;

            case "week":
               $this_time = 7 * 24 * 60 * 60;
               break;

            case "month":
               $this_time = 30 * 24 * 60 * 60;
               break;

            default:
               $this_time = 60 * 60;
               break;
         }
      }
      wp_schedule_event(time() + $this_time, $blocked_time, $cron_name);
   }
   $scheulers = _get_cron_array();
   $current_scheduler = array();

   foreach ($scheulers as $value => $key) {
      $arr_key = array_keys($key);
      foreach ($arr_key as $value) {
         array_push($current_scheduler, $value);
      }
   }

   if (isset($current_scheduler[0])) {
      if (!defined("scheduler_name")) {
         define("scheduler_name", $current_scheduler[0]);
      }

      if (strstr($current_scheduler[0], "ip_address_unblocker_")) {
         add_action($current_scheduler[0], "unblock_script_captcha_bank");
      } elseif (strstr($current_scheduler[0], "ip_range_unblocker_")) {
         add_action($current_scheduler[0], "unblock_script_captcha_bank");
      }
   }

   /*
     Function Name: unblock_script_captcha_bank
     Parameters: no
     Description: This function is used to Unblock IP Address.
     Created On: 30-08-2016 14:20
     Created By: Tech Banker Team
    */
   function unblock_script_captcha_bank() {
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/unblock-script.php")) {
         $nonce_unblock_script = wp_create_nonce("unblock_script");
         global $wpdb;
         include_once CAPTCHA_BANK_DIR_PATH . "lib/unblock-script.php";
      }
   }
   /*
     Function Name: wp_unschedule_captcha_bank
     Parameters: Yes($cron_name)
     Description: This function is used to Unschedule a previously scheduled cron job.
     Created On: 27-08-2016 15:50
     Created By: Tech Banker Team
    */
   function wp_unschedule_captcha_bank($cron_name) {
      if (wp_next_scheduled($cron_name)) {
         $db_cron = wp_next_scheduled($cron_name);
         wp_unschedule_event($db_cron, $cron_name);
      }
   }
   /*
     Function name: captcha_bank_visitor_logs_data
     Parameters:no
     Description: This function is used to insert Visitor Logs data.
     Created On: 29-08-2016 17:45
     Created By: Tech Banker Team
    */
   function captcha_bank_visitor_logs_data() {
      if (!is_admin() && !defined("DOING_CRON")) {
         if (!captcha_bank_smart_ip_detect_crawler()) {
            global $wpdb, $current_user;
            $username = $current_user->user_login;
            $parent_id = $wpdb->get_var
                (
                $wpdb->prepare
                    (
                    "SELECT id FROM " . captcha_bank_parent() . "
                                                   WHERE type = %s", "logs"
                )
            );
            $ip = getIpAddress_for_captcha_bank();
            $ip_address = $ip == "::1" ? sprintf("%u",ip2long("127.0.0.1")) : sprintf("%u",ip2long($ip));
            $get_ip = get_ip_location_captcha_bank(long2ip_captcha_bank($ip_address));

            $insert_live_traffic = array();
            $insert_live_traffic["type"] = "visitor_logs";
            $insert_live_traffic["parent_id"] = intval($parent_id);
            $wpdb->insert(captcha_bank_parent(), $insert_live_traffic);

            $last_id = $wpdb->insert_id;

            $insert_live_traffic = array();
            $insert_live_traffic["username"] = $username;
            $insert_live_traffic["user_ip_address"] = $ip_address;
            $insert_live_traffic["resources"] = isset($_SERVER["REQUEST_URI"]) ? esc_attr($_SERVER["REQUEST_URI"]) : "";
            $insert_live_traffic["http_user_agent"] = isset($_SERVER["HTTP_USER_AGENT"]) ? esc_attr($_SERVER["HTTP_USER_AGENT"]) : "";
            $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;
            $insert_live_traffic["location"] = $location;
            $insert_live_traffic["latitude"] = $get_ip->latitude;
            $insert_live_traffic["longitude"] = $get_ip->longitude;
            $insert_live_traffic["date_time"] = CAPTCHA_BANK_LOCAL_TIME;
            $insert_live_traffic["meta_id"] = $last_id;

            $insert_data = array();
            $insert_data["meta_id"] = $last_id;
            $insert_data["meta_key"] = "visitor_logs_data";
            $insert_data["meta_value"] = serialize($insert_live_traffic);
            $wpdb->insert(captcha_bank_meta(), $insert_data);
         }
      }
   }
   if (!function_exists("captcha_bank_smart_ip_detect_crawler")) {
      function captcha_bank_smart_ip_detect_crawler() {
         $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
         // A list of some common words used only for bots and crawlers.
         $bot_identifiers = array(
             'bot',
             'slurp',
             'crawler',
             'spider',
             'curl',
             'facebook',
             'fetch',
             'scoutjet',
             'bingbot',
             'AhrefsBot',
             'spbot',
             'robot'
         );
         // See if one of the identifiers is in the UA string.
         foreach ($bot_identifiers as $identifier) {
            if (strpos($user_agent, $identifier) !== FALSE) {
               return TRUE;
            }
         }
         return FALSE;
      }
   }
   /*
     Function Name: cron_scheduler_for_intervals_captcha_bank
     Parameters: Yes($schedules)
     Description: This function is used to cron scheduler for intervals.
     Created On: 07-09-2016 18:00
     Created By: Tech Banker Team
    */
   function cron_scheduler_for_intervals_captcha_bank($schedules) {
      $schedules["1Hour"] = array("interval" => 60 * 60, "display" => "Every 1 Hour");
      $schedules["12Hour"] = array("interval" => 60 * 60 * 12, "display" => "Every 12 Hours");
      $schedules["Daily"] = array("interval" => 60 * 60 * 24, "display" => "Daily");
      $schedules["24hours"] = array("interval" => 60 * 60 * 24, "display" => "Every 24 Hours");
      $schedules["48hours"] = array("interval" => 60 * 60 * 48, "display" => "Every 48 Hours");
      $schedules["week"] = array("interval" => 60 * 60 * 24 * 7, "display" => "Every 1 Week");
      $schedules["month"] = array("interval" => 60 * 60 * 24 * 30, "display" => "Every 1 Month");
      return $schedules;
   }
   /*
     Function name:call_captcha_bank
     Parameter: no
     Description: This function is used to Manage Captcha Settings for frontend.
     Created On: 30-08-2016 16:20
     Created By: Tech Banker Team
    */
   function call_captcha_bank() {
      global $wpdb;
      $captcha_type = $wpdb->get_results
          (
          $wpdb->prepare
              (
              "SELECT * FROM " . captcha_bank_meta() . "
					WHERE meta_key = %s", "captcha_type"
          )
      );
      $captcha_array = array();
      foreach ($captcha_type as $row) {
         $captcha_array = maybe_unserialize($row->meta_value);
      }
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/common-functions.php")) {
         include_once CAPTCHA_BANK_DIR_PATH . "includes/common-functions.php";
      }
      if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations-frontend.php")) {
         include CAPTCHA_BANK_DIR_PATH . "includes/translations-frontend.php";
      }
      if (esc_attr($captcha_array["captcha_type_text_logical"]) == "logical_captcha") {
         if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/logical-captcha.php")) {
            include_once CAPTCHA_BANK_DIR_PATH . "includes/logical-captcha.php";
         }
      } elseif (esc_attr($captcha_array["captcha_type_text_logical"]) == "text_captcha") {
         if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/text-captcha.php")) {
            include_once CAPTCHA_BANK_DIR_PATH . "includes/text-captcha.php";
         }
         if (isset($_REQUEST["captcha_code"])) {
            if (file_exists(CAPTCHA_BANK_DIR_PATH . "/includes/captcha-generate-code.php")) {
               include_once CAPTCHA_BANK_DIR_PATH . "/includes/captcha-generate-code.php";
               die();
            }
         }
      }
   }
   /*
     Function Name: captcha_bank_UrlEncode
     Parameters:Yes($string)
     Description: This function is used to return the encoded string.
     Created On: 01-09-2016 09:42
     Created By: Tech Banker Team
    */
   function captcha_bank_UrlEncode($string) {
      $entities = array("%21", "%2A", "%27", "%28", "%29", "%3B", "%3A", "%40", "%26", "%3D", "%2B", "%24", "%2C", "%2F", "%3F", "%25", "%23", "%5B", "%5D");
      $replacements = array("!", "*", "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
      return str_replace($entities, $replacements, urlencode($string));
   }
   /*
     Function Name: user_functions_for_captcha_bank
     Parameters: No
     Description: This function is used to call functions on init hook.
     Created On: 29-08-2016 17:51
     Created By: Tech Banker Team
    */
   function user_functions_for_captcha_bank() {
      js_frontend_for_captcha_bank();
      blocking_visitors_captcha_bank();
      plugin_load_textdomain_captcha_bank();
      global $wpdb;
      $other_settings_data = $wpdb->get_var
          (
          $wpdb->prepare
              (
              "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key=%s", "other_settings"
          )
      );
      $other_settings_unserialized_data = maybe_unserialize($other_settings_data);
      if (esc_attr($other_settings_unserialized_data["visitor_logs_monitoring"]) == "enable" || esc_attr($other_settings_unserialized_data["live_traffic_monitoring"]) == "enable") {
         captcha_bank_visitor_logs_data();
      }
   }
   /*
     Function Name: deactivation_function_for_captcha_bank
     Description: This function is used for executing the code on deactivation.
     Parameters: No
     Created On: 11-04-2017 11:40
     Created By: Tech Banker Team
    */
   function deactivation_function_for_captcha_bank() {
      delete_option("captcha-bank-wizard-set-up");
   }
   /* Hooks */
   /*
     Add action for admin_functions_for_captcha_bank
     Description: This hook contains all admin_init functions.
     Created On: 25-08-2016 10:38
     Created By: Tech Banker Team
    */

   add_action("admin_init", "admin_functions_for_captcha_bank");

   /*
     Function name:call_captcha_bank
     Parameter: no
     Description: This function is used to Manage Captcha Settings for frontend.
     Created On: 07-11-2016 10:09
     Created By: Tech Banker Team
    */

   call_captcha_bank();

   /*
     Add action for ajax_register_for_captcha_bank
     Description: This hook is used to calling the function of ajax register.
     Created On: 25-08-2016 10:59
     Created By: Tech Banker Team
    */

   add_action("wp_ajax_captcha_bank_action_library", "ajax_register_for_captcha_bank");

   /*
     add_action for create_sidebar_menu_for_captcha_bank
     Description: This hook is used for calling the function of sidebar menu in multisite case.
     Created On: 25-08-2016 10:41
     Created By: Tech Banker Team
    */

   add_action("network_admin_menu", "create_sidebar_menu_for_captcha_bank");

   /* Add action for create_sidebar_menu_for_captcha_bank
     Description: This hook is used for calling the function of sidebar menus.
     Created On: 25-08-2016 10:43
     Created By: Tech Banker Team
    */

   add_action("admin_menu", "create_sidebar_menu_for_captcha_bank");

   /* Add action for create_topbar_menu_for_captcha_bank
     Description: This hook is used for calling the function of top bar menu.
     Created On: 25-08-2016 16:16
     Created By: Tech Banker Team
    */

   add_action("admin_bar_menu", "create_topbar_menu_for_captcha_bank", 100);


   /* add_action for user_functions_for_captcha_bank
     Description: This hook calling that function which contains function of init hook.
     Created On: 29-08-2016 17:54
     Created By: Tech Banker Team
    */

   add_action("init", "user_functions_for_captcha_bank");

   /*
     Add Filter for cron schedules
     Description: This hook is used for calling the function of cron schedulers jobs.
     Created On Date: 07-09-2016 18:01
     Created By: Tech Banker Team
    */

   add_filter("cron_schedules", "cron_scheduler_for_intervals_captcha_bank");

   /* register_deactivation_hook
     Description: This hook is used to sets the deactivation hook for a plugin.
     Created On: 11-04-2017 12:10
     Created by: Tech Banker Team
    */

   register_deactivation_hook(__FILE__, "deactivation_function_for_captcha_bank");
}

/*
  register_activation_hook
  Description: This hook is used for calling the function of install script
  Created On: 25-08-2016 09:57
  Created By: Tech Banker Team
 */
register_activation_hook(__FILE__, "install_script_for_captcha_bank");

/* Add action for install_script_for_captcha_bank
  Description: This hook used for calling the function of install script
  Created On: 27-04-2017 09:48
  Created By: Tech Banker Team
 */
add_action("admin_init", "install_script_for_captcha_bank");

/* add_filter create Go Pro link for Captcha Bank
  Description: This hook is used for create link for premium Editions.
  Created On: 03-05-2017 17:34
  Created by: Tech Banker Team
 */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), "captcha_bank_action_links");

/* add_filter create Settings link for Captcha Bank
  Description: This hook is used for create link for Plugin Settings.
  Created On: 03-05-2017 17:40
  Created by: tech-banker Team
 */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), "captcha_bank_settings_action_links", 10, 2);


/*
  Function Name: plugin_activate_captcha_bank
  Description: This function is used to add option.
  Parameters: No
  Created On: 27-04-2017 09:48
  Created By: Tech Banker Team
 */
function plugin_activate_captcha_bank() {
   add_option("captcha_bank_do_activation_redirect", true);
}
/*
  Function Name: captcha_bank_redirect
  Description: This function is used to redirect page.
  Parameters: No
  Created On: 27-04-2017 09:48
  Created By: Tech Banker Team
 */
function captcha_bank_redirect() {
   if (get_option("captcha_bank_do_activation_redirect", false)) {
      delete_option("captcha_bank_do_activation_redirect");
      wp_redirect(admin_url("admin.php?page=captcha_bank"));
      exit;
   }
}
/*
  register_activation_hook
  Description: This hook is used for calling the function plugin_activate_captcha_bank
  Created On: 27-04-2017 09:48
  Created By: Tech Banker Team
 */

register_activation_hook(__FILE__, "plugin_activate_captcha_bank");

/*
  add_action for captcha_bank_redirect
  Description: This hook is used for calling the function captcha_bank_redirect
  Created On: 27-04-2017 09:48
  Created By: Tech Banker Team
 */

add_action("admin_init", "captcha_bank_redirect");

/*
  Function Name:captcha_bank_admin_notice_class
  Parameter: No
  Description: This function is used to create the object of admin notices.
  Created On: 08-22-2017 16:16
  Created By: Tech Banker Team
 */
function captcha_bank_admin_notice_class() {
   global $wpdb;
   class captcha_bank_admin_notices {
      protected $promo_link = '';
      public $config;
      public $notice_spam = 0;
      public $notice_spam_max = 2;
      // Basic actions to run
      public function __construct($config = array()) {
         // Runs the admin notice ignore function incase a dismiss button has been clicked
         add_action('admin_init', array($this, 'cpb_admin_notice_ignore'));
         // Runs the admin notice temp ignore function incase a temp dismiss link has been clicked
         add_action('admin_init', array($this, 'cpb_admin_notice_temp_ignore'));
         add_action('admin_notices', array($this, 'cpb_display_admin_notices'));
      }
      // Checks to ensure notices aren't disabled and the user has the correct permissions.
      public function cpb_admin_notices() {
         $settings = get_option('cpb_admin_notice');
         if (!isset($settings['disable_admin_notices']) || ( isset($settings['disable_admin_notices']) && $settings['disable_admin_notices'] == 0 )) {
            if (current_user_can('manage_options')) {
               return true;
            }
         }
         return false;
      }
      // Primary notice function that can be called from an outside function sending necessary variables
      public function change_admin_notice_captcha_bank($admin_notices) {
         // Check options
         if (!$this->cpb_admin_notices()) {
            return false;
         }
         foreach ($admin_notices as $slug => $admin_notice) {
            // Call for spam protection
            if ($this->cpb_anti_notice_spam()) {
               return false;
            }

            // Check for proper page to display on
            if (isset($admin_notices[$slug]['pages']) && is_array($admin_notices[$slug]['pages'])) {
               if (!$this->cpb_admin_notice_pages($admin_notices[$slug]['pages'])) {
                  return false;
               }
            }

            // Check for required fields
            if (!$this->cpb_required_fields($admin_notices[$slug])) {

               // Get the current date then set start date to either passed value or current date value and add interval
               $current_date = current_time("m/d/Y");
               $start = ( isset($admin_notices[$slug]['start']) ? $admin_notices[$slug]['start'] : $current_date );
               $start = date("m/d/Y");
               $date_array = explode('/', $start);
               $interval = ( isset($admin_notices[$slug]['int']) ? $admin_notices[$slug]['int'] : 0 );

               $date_array[1] += $interval;
               $start = date("m/d/Y", mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));

               // This is the main notices storage option
               $admin_notices_option = get_option('cpb_admin_notice', array());
               // Check if the message is already stored and if so just grab the key otherwise store the message and its associated date information
               if (!array_key_exists($slug, $admin_notices_option)) {
                  $admin_notices_option[$slug]['start'] = date("m/d/Y");
                  $admin_notices_option[$slug]['int'] = $interval;
                  update_option('cpb_admin_notice', $admin_notices_option);
               }

               // Sanity check to ensure we have accurate information
               // New date information will not overwrite old date information
               $admin_display_check = ( isset($admin_notices_option[$slug]['dismissed']) ? $admin_notices_option[$slug]['dismissed'] : 0 );
               $admin_display_start = ( isset($admin_notices_option[$slug]['start']) ? $admin_notices_option[$slug]['start'] : $start );
               $admin_display_interval = ( isset($admin_notices_option[$slug]['int']) ? $admin_notices_option[$slug]['int'] : $interval );
               $admin_display_msg = ( isset($admin_notices[$slug]['msg']) ? $admin_notices[$slug]['msg'] : '' );
               $admin_display_title = ( isset($admin_notices[$slug]['title']) ? $admin_notices[$slug]['title'] : '' );
               $admin_display_link = ( isset($admin_notices[$slug]['link']) ? $admin_notices[$slug]['link'] : '' );
               $output_css = false;

               // Ensure the notice hasn't been hidden and that the current date is after the start date
               if ($admin_display_check == 0 && strtotime($admin_display_start) <= strtotime($current_date)) {

                  // Get remaining query string
                  $query_str = ( isset($admin_notices[$slug]['later_link']) ? $admin_notices[$slug]['later_link'] : esc_url(add_query_arg('cpb_admin_notice_ignore', $slug)) );
                  if (strpos($slug, 'promo') === FALSE) {
                     // Admin notice display output
                     echo '<div class="update-nag cpb-admin-notice" style="width:95%!important;">
                               <div></div>
                                <strong><p>' . $admin_display_title . '</p></strong>
                                <strong><p style="font-size:14px !important">' . $admin_display_msg . '</p></strong>
                                <strong><ul>' . $admin_display_link . '</ul></strong>
                              </div>';
                  } else {
                     echo '<div class="admin-notice-promo">';
                     echo $admin_display_msg;
                     echo '<ul class="notice-body-promo blue">
                                    ' . $admin_display_link . '
                                  </ul>';
                     echo '</div>';
                  }
                  $this->notice_spam += 1;
                  $output_css = true;
               }
            }
         }
      }
      // Spam protection check
      public function cpb_anti_notice_spam() {
         if ($this->notice_spam >= $this->notice_spam_max) {
            return true;
         }
         return false;
      }
      // Ignore function that gets ran at admin init to ensure any messages that were dismissed get marked
      public function cpb_admin_notice_ignore() {
         // If user clicks to ignore the notice, update the option to not show it again
         if (isset($_GET['cpb_admin_notice_ignore'])) {
            $admin_notices_option = get_option('cpb_admin_notice', array());
            $admin_notices_option[$_GET['cpb_admin_notice_ignore']]['dismissed'] = 1;
            update_option('cpb_admin_notice', $admin_notices_option);
            $query_str = remove_query_arg('cpb_admin_notice_ignore');
            wp_redirect($query_str);
            exit;
         }
      }
      // Temp Ignore function that gets ran at admin init to ensure any messages that were temp dismissed get their start date changed
      public function cpb_admin_notice_temp_ignore() {
         // If user clicks to temp ignore the notice, update the option to change the start date - default interval of 14 days
         if (isset($_GET['cpb_admin_notice_temp_ignore'])) {
            $admin_notices_option = get_option('cpb_admin_notice', array());
            $current_date = current_time("m/d/Y");
            $date_array = explode('/', $current_date);
            $interval = (isset($_GET['cpb_int']) ? $_GET['cpb_int'] : 7);
            $date_array[1] += $interval;
            $new_start = date("m/d/Y", mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));

            $admin_notices_option[$_GET['cpb_admin_notice_temp_ignore']]['start'] = $new_start;
            $admin_notices_option[$_GET['cpb_admin_notice_temp_ignore']]['dismissed'] = 0;
            update_option('cpb_admin_notice', $admin_notices_option);
            $query_str = remove_query_arg(array('cpb_admin_notice_temp_ignore', 'cpb_int'));
            wp_redirect($query_str);
            exit;
         }
      }
      public function cpb_admin_notice_pages($pages) {
         foreach ($pages as $key => $page) {
            if (is_array($page)) {
               if (isset($_GET['page']) && $_GET['page'] == $page[0] && isset($_GET['tab']) && $_GET['tab'] == $page[1]) {
                  return true;
               }
            } else {
               if ($page == 'all') {
                  return true;
               }
               if (get_current_screen()->id === $page) {
                  return true;
               }
               if (isset($_GET['page']) && $_GET['page'] == $page) {
                  return true;
               }
            }
            return false;
         }
      }
      // Required fields check
      public function cpb_required_fields($fields) {
         if (!isset($fields['msg']) || ( isset($fields['msg']) && empty($fields['msg']) )) {
            return true;
         }
         if (!isset($fields['title']) || ( isset($fields['title']) && empty($fields['title']) )) {
            return true;
         }
         return false;
      }
      public function cpb_display_admin_notices() {
         $two_week_review_ignore = add_query_arg(array('cpb_admin_notice_ignore' => 'two_week_review'));
         $two_week_review_temp = add_query_arg(array('cpb_admin_notice_temp_ignore' => 'two_week_review', 'int' => 7));

         $notices['two_week_review'] = array(
             'title' => __('Leave A Captcha Bank Review?'),
             'msg' => 'We love and care about you. Captcha Bank Team is putting our maximum efforts to provide you the best functionalities.<br> We would really appreciate if you could spend a couple of seconds to give a Nice Review to the plugin for motivating us!',
             'link' => '<span class="dashicons dashicons-external captcha-bank-admin-notice"></span><span class="captcha-bank-admin-notice"><a href="https://wordpress.org/support/plugin/captcha-bank/reviews/?filter=5" target="_blank" class="captcha-bank-admin-notice-link">' . __('Sure! I\'d love to!', 'cpb') . '</a></span>
                        <span class="dashicons dashicons-smiley captcha-bank-admin-notice"></span><span class="captcha-bank-admin-notice"><a href="' . $two_week_review_ignore . '" class="captcha-bank-admin-notice-link"> ' . __('I\'ve already left a review', 'cpb') . '</a></span>
                        <span class="dashicons dashicons-calendar-alt captcha-bank-admin-notice"></span><span class="captcha-bank-admin-notice"><a href="' . $two_week_review_temp . '" class="captcha-bank-admin-notice-link">' . __('Maybe Later', 'cpb') . '</a></span>',
             'later_link' => $two_week_review_temp,
             'int' => 7
         );

         $this->change_admin_notice_captcha_bank($notices);
      }
   }
   $plugin_info_captcha_bank = new captcha_bank_admin_notices();
}
add_action("init", "captcha_bank_admin_notice_class");
function add_popup_on_deactivation_captcha_bank()
{
    global $wpdb;
    class captcha_bank_deactivation_form
    {
        function __construct() {
            add_action("wp_ajax_post_user_feedback_captcha_bank", array($this,"post_user_feedback_captcha_bank"));
            global $pagenow;
            if ("plugins.php" === $pagenow ) {
                    add_action("admin_enqueue_scripts",array($this,"feedback_form_js_captcha_bank"));
                    add_action("admin_head",array($this,"add_form_layout_captcha_bank"));
                    add_action("admin_footer",array($this,"add_deactivation_dialog_form_captcha_bank"));
            }
	}
        function feedback_form_js_captcha_bank() {
            wp_enqueue_style("wp-jquery-ui-dialog");
            wp_register_script("post-feedback",plugins_url("assets/global/plugins/deactivation/deactivate-popup.js", __FILE__ ), array('jquery','jquery-ui-core','jquery-ui-dialog'), false, true);
            wp_localize_script("post-feedback","post_feedback", array("admin_ajax" => admin_url("admin-ajax.php")));
            wp_enqueue_script("post-feedback");
	}
	function post_user_feedback_captcha_bank() 
        {
            $captcha_bank_deactivation_reason = $_POST['reason'];
            $type = get_option("captcha-bank-wizard-set-up");
            $user_admin_email = get_option("captcha-bank-admin-email");
            $plugin_info_captcha_bank = new plugin_info_captcha_bank();
            global $wp_version, $wpdb;
            $url = tech_banker_stats_url . "/wp-admin/admin-ajax.php";
            $theme_details = array();

            if ($wp_version >= 3.4) {
               $active_theme = wp_get_theme();
               $theme_details["theme_name"] = strip_tags($active_theme->Name);
               $theme_details["theme_version"] = strip_tags($active_theme->Version);
               $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
            }

            $plugin_stat_data = array();
            $plugin_stat_data["plugin_slug"] = "captcha-bank";
            $plugin_stat_data["reason"] = $captcha_bank_deactivation_reason;
            $plugin_stat_data["type"] = "standard_edition";
            $plugin_stat_data["version_number"] = captcha_bank_version_number;
            $plugin_stat_data["status"] = $type;
            $plugin_stat_data["event"] = "de-activate";
            $plugin_stat_data["domain_url"] = site_url();
            $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();
            $plugin_stat_data["email"] = $user_admin_email != "" ? $user_admin_email : get_option("admin_email");
            $plugin_stat_data["wp_version"] = $wp_version;
            $plugin_stat_data["php_version"] = esc_html(phpversion());
            $plugin_stat_data["mysql_version"] = $wpdb->db_version();
            $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
            $plugin_stat_data["operating_system"] = PHP_OS . "  (" . PHP_INT_SIZE * 8 . ") BIT";
            $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit") ? ini_get("memory_limit") : "N/A";
            $plugin_stat_data["extensions"] = get_loaded_extensions();
            $plugin_stat_data["plugins"] = $plugin_info_captcha_bank->get_plugin_info_captcha_bank();
            $plugin_stat_data["themes"] = $theme_details;

            $response = wp_safe_remote_post($url, array
                (
                "method" => "POST",
                "timeout" => 45,
                "redirection" => 5,
                "httpversion" => "1.0",
                "blocking" => true,
                "headers" => array(),
                "body" => array("data" => serialize($plugin_stat_data), "site_id" => get_option("cpb_tech_banker_site_id") != "" ? get_option("cpb_tech_banker_site_id") : "", "action" => "plugin_analysis_data")
            ));

            if (!is_wp_error($response)) {
               $response["body"] != "" ? update_option("cpb_tech_banker_site_id", $response["body"]) : "";
            }
            die( 'success' );
	}
	function add_form_layout_captcha_bank() 
        {
            ?>
            <style type="text/css">
                    .captcha-bank-feedback-form .ui-dialog-buttonset {
                        float: none !important;
                    }
                    #captcha-bank-feedback-dialog-continue,#captcha-bank-feedback-dialog-skip {
                        float: right;
                    }
                    #captcha-bank-feedback-cancel{
                        float: left;
                    }
                    #captcha-bank-feedback-content p {
                        font-size: 1.1em;
                    }
                    .captcha-bank-feedback-form .ui-icon {
                        display: none;
                    }
                    #captcha-bank-feedback-dialog-continue.captcha-bank-ajax-progress .ui-icon {
                        text-indent: inherit;
                        display: inline-block !important;
                        vertical-align: middle;
                        animation: rotate 2s infinite linear;
                    }
                    #captcha-bank-feedback-dialog-continue.captcha-bank-ajax-progress .ui-button-text {
                        vertical-align: middle;
                    }			
                    @keyframes rotate {
                      0%    { transform: rotate(0deg); }
                      100%  { transform: rotate(360deg); }
                    }			
            </style>
	    <?php
	}
	function add_deactivation_dialog_form_captcha_bank() {
		?>
		<div id="captcha-bank-feedback-content" style="display: none;">
			<p style="margin-top:-5px">We feel guilty when anyone stop using Captcha Bank.</p>
                        <p>If Captcha Bank isn't working for you, others also may not.</p>
                        <p>We would love to hear your feedback about what went wrong.</p>
                        <p>We would like to help you in fixing the issue.</p>
			<form>
				<?php wp_nonce_field(); ?>
				<ul id="captcha-bank-deactivate-reasons">
					<li class="captcha-bank-reason">
						<label>
							<span><input value="0" type="radio" name="reason" checked/></span>
							<span>The Plugin didn't work</span>
						</label>					
					</li>				
					<li class="captcha-bank-reason captcha-bank-custom-input">
						<label>
							<span><input value="1" type="radio" name="reason" /></span>
							<span>I found a better Plugin</span>
						</label>				
					</li>
					<li class="captcha-bank-reason captcha-bank-custom-input">
						<label>
							<span><input value="2" type="radio" name="reason" /></span>
							<span>It's a temporary deactivation. I'm just debugging an issue.</span>
						</label>					
					</li>					
					<li class="captcha-bank-reason captcha-bank-custom-input">
						<label>
							<span><input value="3" type="radio" name="reason" /></span>
                                                        <span>Open a <a href="https://wordpress.org/support/plugin/captcha-bank" target="_blank">Support Ticket</a> for me.</span>
						</label>
					</li>
				</ul>
			</form>
		</div>
	    <?php
	}
    }
    $plugin_deactivation_details = new captcha_bank_deactivation_form();
}
add_action("plugins_loaded","add_popup_on_deactivation_captcha_bank");
function insert_deactivate_link_id_captcha_bank($links) {
    $links['deactivate'] = str_replace( '<a', '<a id="captcha-bank-plugin-disable-link"', $links['deactivate'] );
    return $links;
}
add_filter("plugin_action_links_" . plugin_basename( __FILE__ ),"insert_deactivate_link_id_captcha_bank" ,10,2 );