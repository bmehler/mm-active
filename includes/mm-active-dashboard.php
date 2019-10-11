<?php

namespace MM\Active;

function active_plugins_widget() {
    global $wp_meta_boxes;
    add_meta_box('activated_plugins_widget', __('Activated and deactivated Plugins', 'mm-active'), 'MM\Active\custom_dashboard_activated_plugins', 'dashboard', 'side', 'high');
}
   
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
    $legend = '<p style="color:black">' . __('activated', 'mm-active') . '|<span style="color:lightgrey">' . __('deactivated', 'mm-active') . '</span></p>';
    echo $legend;
}