<?php
/*
Plugin Name: LWS Affiliation
Plugin URI: https://affiliation.lws-hosting.com
Description: Plugin permettant d'intégrer les bannières et Widgets d'affiliation LWS
Version: 0.1
Author: LWS
Author URI: https://www.lws.fr
*/
class LWSAffiliation_Plugin
{
    public function install() {
        // do not generate any output here
        if (is_writable(__DIR__.'/data')) {
            file_put_contents(__DIR__.'/data/'.'config', serialize(array()));
        } else {
            deactivate_plugins( basename( __FILE__ ) );
            wp_die('<p>The Folder is not writeable</p>','Plugin Activation Error',  array( 'response'=>200, 'back_link'=>TRUE ) );
        }
    }
    public function __construct()
    {
        // À l'activation du plugin
        register_activation_hook( __FILE__, array($this, 'install') );
        
        // Ajoute le style à l'admin
        add_action( 'admin_enqueue_scripts', array($this, 'add_admin_style') );
        
        // Ajoute une balise script permettant de déinir l'URL du plugin Wordpress
        add_action( 'admin_print_scripts', array($this, 'script_admin') );
        
        // Ajoute une page d'option du plugin
        add_action('admin_menu', array($this, 'menu'));
        
        // Ajout d'une alerte lorsqu'aucun identifiant affilié n'a été renseigné
        add_action( 'admin_notices', array($this, 'check_username') );
        
        // Affichage du Widget
        add_filter( 'the_content', array($this, 'add_widget'), 20 );
        
        //Chargement plugin TinyMCE pour l'admin
        $configLWS = unserialize(file_get_contents(__DIR__.'/data/'.'config'));
        if (isset($configLWS['username']) && !empty($configLWS['username'])) {
            add_filter('mce_buttons', array($this, 'register_buttons'));
            add_filter('mce_external_plugins', array($this, 'register_tinymce_javascript'));
        }
    }
    
    // Ajoute le Widget
    public function add_widget($content) {
        $configLWS = unserialize(file_get_contents(__DIR__.'/data/'.'config'));
        if (!isset($configLWS['username']) || empty($configLWS['username'])) {
            $configLWS['username'] = 1;
        }
        $widget = '<div id="widgetaffiliationlws"></div>
<script>
var widgetlwscontainer = "#widgetaffiliationlws";
var script=document.createElement("script");script.src="http://affiliation.lws-hosting.com/banners/widget/83/%d/%s/%s/%s/%s";document.getElementsByTagName("body")[0].appendChild(script);
</script>';
        $content = str_replace('<div class="widgetDomainNameContainer"></div>', '', $content);
        $matches = array();
        preg_match("'<div class=\"widgetDomainNameContainer\">(.*?)</div>'si",$content, $matches);
        if (isset($matches[1])) {
            $widgetString = $matches[1];
            if (strpos($widgetString, 'divWidgetAffiliationLWS') !== FALSE) {
                $extension = "com";
                $theme = "default";
                $txtbutton = "Commander";
                $cible = "blank";
                
                //recup extension par défaut
                preg_match('/data-extension="(.*?)"/',$widgetString, $matchext);
                $extension = $matchext[1] != '' ? $matchext[1] : $extension;
                
                //recup theme par défaut
                preg_match('/data-theme="(.*?)"/',$widgetString, $matchtheme);
                $theme = $matchtheme[1] != '' ? $matchtheme[1] : $extension;
                
                //recup txtbutton par défaut
                preg_match('/data-txtbutton="(.*?)"/',$widgetString, $matchtxt);
                $txtbutton = $matchtxt[1] != '' ? $matchtxt[1] : $extension;
                
                //recup txtbutton par défaut
                preg_match('/data-cible="(.*?)"/',$widgetString, $matchcible);
                $cible = $matchcible[1] != '' ? $matchcible[1] : $extension;
                
                $widget = sprintf($widget, $configLWS['username'], $extension, $theme, $txtbutton, $cible);
                
                $content = str_replace($matches[0], $widget, $content);
            }
        }
        
        
        
        return $content;
    }
    
    // Ajoute la feuille de style pour l'admin
    public function add_admin_style($editor) {
        wp_register_style( 'LWSAffiliationAdminStyle', plugins_url('/css/admin/style.css',__FILE__), false, '1.0.0' );
        wp_enqueue_style( 'LWSAffiliationAdminStyle' );
        return $editor;
    }
    
    //Charge le plugin TinyMce
    public function register_tinymce_javascript($plugin_array) {
        $plugin_array['example'] = plugins_url('/js/admin/tinymce-plugin.js',__FILE__);
        $plugin_array['noneditable'] = plugins_url('/js/admin/noneditable/plugin.min.js',__FILE__);
        return $plugin_array;
    }
    
    // Ajoute une balise script
    public function script_admin() {
        echo "<script type='text/javascript'>\n";
	echo 'var affiliationConfigWidget = "'.plugins_url('/view/admin/configWidget.html',__FILE__).'"';
	echo "\n</script>";
    }
    
    //Ajoute le bouton
    public function register_buttons($buttons) {
        array_push($buttons, 'example');
        return $buttons;
    }
    
    //page menu
    public function menu() {
        add_plugins_page('LWS Affiliation configuration', 'LWS Affiliation', 'read', 'lws-affiliation-settings', array($this, 'setup'));
    }
    
    // Verifie si l'identifiant affilié à été renseigné
    public function check_username() {
        if (strstr($_SERVER['QUERY_STRING'],'page=lws-affiliation-settings') === FALSE) {
            $configLWS = unserialize(file_get_contents(__DIR__.'/data/'.'config'));
            if (!isset($configLWS['username']) || empty($configLWS['username'])) {
                include __DIR__ . '/view/admin/notice/usernamenotdefined.php';
            }
        }
    }
    
    //setup
    public function setup() {
        $configLWS = unserialize(file_get_contents(__DIR__.'/data/'.'config'));
        if (isset($_POST['validate-config-aff-lws'])) {
            if (!empty($_POST['username-aff-lws'])) {
                if (is_numeric($_POST['username-aff-lws'])) {
                    $configLWS['username'] = $_POST['username-aff-lws'];
                    file_put_contents(__DIR__.'/data/'.'config', serialize($configLWS));
                    $formSuccess = true;
                } else {
                    $formError = 'Votre identifiant Affiliation LWS ne doit contenir que des chiffres.';
                }
            } else {
                $formError = 'Merci de renseigner votre identifiant affilié.';
            }
        }
        include __DIR__ . '/view/admin/setup.php';
    }
    
    //alerte lorsque le username n'est pas un chiffre
    public function error_config_username() {
        $message = 'Votre identifiant Affiliation LWS ne doit contenir que des chiffres.';
        $class = 'error';
        include __DIR__ . '/view/admin/notice/alertform.php';
    }
    
    //alerte lorsque le username n'est pas un chiffre
    public function error_config_username_empty() {
        $message = 'Merci de renseigner ce champ.';
        $class = 'error';
        include __DIR__ . '/view/admin/notice/alertform.php';
    }
} 
new LWSAffiliation_Plugin();