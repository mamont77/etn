<?php
// $Id: pagebreak.inc,v 1.1.2.1 2007/05/27 20:17:42 quicksketch Exp $
/** 
 * function _webform_edit_pagebreak
 * Create a set of form items to be displayed on the form for editing this component.
 * Use care naming the form items, as this correlates directly to the database schema.
 * The component "Name" and "Description" fields are added to every component type and
 * are not necessary to specify here (although they may be overridden if desired).
 * @returns An array of form items to be displayed on the edit component page
 **/
function _webform_edit_pagebreak($currfield) {
  $form = array();
  # no description
  $form['extra']['description'] = array(
      '#type' => 'hidden',
      '#value' => '',
  );
  # force the parent to always be root
  $form['parent'] = array(
      '#type' => 'hidden',
      '#value' => '0',
  );
  # never mandatory
  $form['mandatory'] = array(
      '#type' => 'hidden',
      '#value' => '',
  );
  return $form;
}

/** 
 * function _webform_help_textfield
 * Module specific instance of hook_help
 **/
function _webform_help_pagebreak($section) {
  switch ($section) {
    case 'admin/settings/webform#pagebreak_description':
      $output = t("Break up a multi-page form.");
      break;
  }
  return $output;
}

function _webform_render_pagebreak($currfield) {
  return '';
}
