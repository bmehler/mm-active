# Active Plugins

Folgende Schritt waren notwendig um aktiviert und deaktiviert Plugins im Dashboard anzuzeigen:

>!!!Hinweis
> Der Ordername und der Name der PHP Datei müssen gleich sein.

```
Ordnername: mm_active_plugins
Dateiname: mm_active_plugins.php
```

Zunächst der Header in der Plugin Datei

```
<?php
/**
* Plugin Name: Active Plugins
* Plugin URI: http://www.mehler-medial.de
* Description: Dieses Plugin zeigt alle aktivierten und deaktiverten Plugins der jeweiligen Installation.
* Version: 0.0.1
* Author: Bernhard Mehler
* Author URI: http://www.mainwp.com
* License: GPL2
*/
```

Die plugin File wird geladen

```
if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
```

Fontawesome 4 wird eingebunden

```
add_action( 'admin_enqueue_scripts', 'register_plugin_styles' );

function register_plugin_styles() {
  wp_register_style( 'font-awesome-css', plugins_url('mm_active_plugins/assets/font-awesome/css/font-awesome.css'));
	wp_enqueue_style( 'font-awesome-css' );
}
```
Das Dashboard Widget wird definiert

```
add_action('wp_dashboard_setup', 'active_plugins_widget');
  
function active_plugins_widget() {
  global $wp_meta_boxes;
 
  #wp_add_dashboard_widget('activated_plugins_widget', 'Aktivierte und deaktiviert Plugins', 'custom_dashboard_activated_plugins');
  add_meta_box('activated_plugins_widget', 'Aktivierte und deaktiviert Plugins', 'custom_dashboard_activated_plugins', 'dashboard', 'side', 'high');
}
```
Die einzelnen Plugins werden auf aktiviert oder deaktiviert geprüft

```
function custom_dashboard_activated_plugins() {

  $all_plugins = get_plugins();
  $keys = array_keys($all_plugins);

  $output = '';

  foreach($keys as $index => $values) {
    if(is_plugin_active($values)) {;
      $output .= '<span style="color:black"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>  ' . $all_plugins[$values]['Name'] . '<br/>';
    } else {
      $output .= '<span style="color:lightgrey"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>  ' . $all_plugins[$values]['Name'] . '<br/>';
    }
  }

  echo $output;
  echo $legend = '';
  $legend = '<p style="color:black">*aktiviert <span style="color:lightgrey">*deaktiviert</span></p>';
  echo $legend;
}
```