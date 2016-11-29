<?php
//
// Agregate CSS into one file
//
function THEME_css_alter(&$css) {

  // drupal_sort_css_js https://api.drupal.org/api/drupal/includes!common.inc/function/drupal_sort_css_js/7.x
  uasort($css, 'drupal_sort_css_js');
  
  $print = array();
  $weight = 0;
  foreach ($css as $name => $style) {
    // check conditional css
    if ($css[$name]['browsers']['!IE']) {
      $css[$name]['group'] = 0;
      $css[$name]['weight'] = ++$weight;
      $css[$name]['every_page'] = 1;
    }

    // check for print media
    if ($css[$name]['media'] == 'print') {
      // remove and add to a new array
      $print[$name] = $css[$name];
      unset($css[$name]);
    }
  }
  $css = array_merge($css, $print);
}

//
// Agregate JS into one file
//
function THEME_js_alter(&$js) {
  // drupal_sort_css_js https://api.drupal.org/api/drupal/includes!common.inc/function/drupal_sort_css_js/7.x
  uasort($js, 'drupal_sort_css_js');

  $weight = 0;
  foreach ($js as $name => $javascript) {
    $js[$name]['group'] = -100;
    $js[$name]['weight'] = ++$weight;
    $js[$name]['every_page'] = 1;
  }
}
?>