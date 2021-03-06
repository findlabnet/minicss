<?php
/**
 * @file
 * Theme settings file
 */

$theme_default = config_get('system.core', 'theme_default');

$form['minicss'] = array(
  '#type' => 'vertical_tabs',
  '#weight' => -10,
);

$form['sticky'] = array(
  '#type' => 'fieldset',
  '#title' => t('Header and Footer'),
  '#group' => 'minicss',
);
$form['sticky']['sticky_header'] = array(
  '#prefix' => '<p>' . t("Make your site's header and/or footer sticky by selecting options below.") . '</p>',
  '#type' => 'checkbox',
  '#title' => t('Sticky header (at the top of the browser viewport)'),
  '#default_value' => theme_get_setting('sticky_header', $theme_default),
);
$form['sticky']['sticky_footer'] = array(
  '#type' => 'checkbox',
  '#title' => t('Sticky footer (at the bottom of the browser viewport)'),
  '#default_value' => theme_get_setting('sticky_footer', $theme_default),
);

$form['main_menu'] = array(
  '#type' => 'fieldset',
  '#title' => t('Main navigation menu'),
  '#group' => 'minicss',
);
$menus = menu_get_menus($all = TRUE);
$form['main_menu']['top_right'] = array(
  '#type' => 'select',
  '#title' => t('Main navigation menu'),
  '#default_value' => theme_get_setting('top_right', $theme_default),
  '#description' => t('Select which one of menus should be used as main navigation (opens by top right "hamburger" icon).'),
  '#options' => $menus,
);

$form['flavors'] = array(
  '#type' => 'fieldset',
  '#title' => t('Color schemes'),
  '#group' => 'minicss',
);
$form['flavors']['flavor'] = array(
  '#title' => t('Select your flavor'),
  '#type' => 'select',
  '#default_value' => theme_get_setting('flavor', $theme_default),
  '#options' => array(
    'default' => t('Default'),
    'dark' => t('Dark'),
    'nord' => t('Nord'),
  ),
  '#suffix' => '<p><b>mini.css </b>' . t('comes with a few prebuild flavors out of the box, so you can get started without having to finetune every little aspect of your CSS framework') . '</p>',
);

$form['cdn_and_minification'] = array(
  '#type' => 'fieldset',
  '#title' => t('CDN and minification'),
  '#group' => 'minicss',
);
$form['cdn_and_minification']['cdn'] = array(
  '#type' => 'checkbox',
  '#title' => t('Use stylesheet files from CDN (Content Delivery Network).'),
  '#default_value' => theme_get_setting('cdn', $theme_default),
);
$form['cdn_and_minification']['cdn_base_url'] = array(
  '#type' => 'textfield',
  '#title' => t('Base URL for CDN directory'),
  '#default_value' => theme_get_setting('cdn_base_url', $theme_default),
  '#description' => t('You can change Base URL to another, for example: "https://cdn.rawgit.com/Chalarangelo/mini.css/v3.0.1/dist/"'),
  '#states' => array(
    'invisible' => array(
    ':input[name="cdn"]' => array('checked' => FALSE),
    ),
  ),
);
$form['cdn_and_minification']['minification'] = array(
  '#type' => 'checkbox',
  '#title' => t('Use minified (compressed) version of stylesheet files.'),
  '#default_value' => theme_get_setting('minification', $theme_default),
);

$form['breadcrumbs_divider'] = array(
  '#type' => 'fieldset',
  '#title' => t('Breadcrumbs divider'),
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  '#group' => 'minicss',
);
$form['breadcrumbs_divider']['breadcrumbs_divider'] = array(
  '#type' => 'textfield',
  '#title' => t('Breadcrumbs divider (in other words separator of breadcrumbs items)'),
  '#default_value' => theme_get_setting('breadcrumbs_divider', $theme_default),
  '#size' => 30,
  '#maxlength' => 48,
  '#description' => t('Place here any symbol(s) or HTML entity code, so for example: <b>»</b> or <b>&amp;raquo;</b> or <b>&amp;#187;</b> will provide the same result.'),
);

$form['debug'] = array(
  '#type' => 'fieldset',
  '#title' => t('Theme debugging'),
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  '#group' => 'minicss',
);
$form['debug']['enable'] = array(
  '#type' => 'checkbox',
  '#title' => t('Enable theme debugging output'),
  '#default_value' => config_get('system.core', 'theme_debug'),
  '#element_validate' => array('_theme_debug_settings'),
  '#description' => t('Output theme debugging information to source code of page - do not forget to disable this on a live site!'),
);

function _theme_debug_settings($element) {
  config_set('system.core', 'theme_debug', $element['#value']);
}
