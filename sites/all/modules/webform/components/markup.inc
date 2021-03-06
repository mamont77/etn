<?php
// $Id: markup.inc,v 1.3.2.2 2007/05/29 03:00:32 quicksketch Exp $
/** 
 * function webform_edit_markup
 * Create a set of form items to be displayed on the form for editing this component.
 * Use care naming the form items, as this correlates directly to the database schema.
 * The component "Name" and "Description" fields are added to every component type and
 * are not necessary to specify here (although they may be overridden if desired).
 * @returns An array of form items to be displayed on the edit component page
 **/
function _webform_edit_markup($currfield) {
  $edit_fields = array();
  $edit_fields['mandatory'] = array(); // Do not render the mandatory checkbox
  $edit_fields['value'] = array(
    '#type' => 'textarea',
    '#title' => t("Value"),
    '#default_value' => $currfield['default'],
    '#description' => t('Markup allows you to enter custom HTML or PHP logic into your form.') .'<br />'. webform_help('webform/helptext#variables'),
    '#weight' => -1,
  );
  // Add the filter form
  $edit_fields['extra']['filter'] = filter_form($currfield['extra']['format'], 0, array('field', 'extra', 'format'));

  // No description for markup
  $edit_fields['extra']['description'] = array();

  return $edit_fields;
}

/** 
 * function webform_render_markup
 * Build a form item array containing all the properties of this component
 * @param $component An array of information describing the component, directly correlating to the webform_component database schema
 * @returns An array of a form item to be displayed on the client-side webform
 **/
function _webform_render_markup($component) {
  // We don't want users to be able to execute filters outside of their permissions on preview
  if ($_POST['op'] == t('Preview')) {
    $check_filter = true;
  }
  else {
    $check_filter = false;
  }
  
  $form_item = array(
    '#type'   => 'markup',
    '#weight' => $component['weight'],
    '#value'  => _webform_filtervalues(check_markup($component['value'], $component['extra']['format'], $check_filter), FALSE),
    '#prefix' => '<div class="webform-component-'. $component['type'] .'" id="webform-component-'. $component['form_key'] .'">',
    '#suffix' => '</div>',
  );
  return $form_item;
}

/** 
 * function _webform_submission_data_markup
 * Display the markup  in the results. The output of this function will be displayed under the "results" tab then "submissions"
 * @param $data An array of information containing the submission result, directly correlating to the webform_submitted_data database schema
 * @param $component An array of information describing the component, directly correlating to the webform_component database schema
 * @returns Textual output formatted for human reading.
 **/
function _webform_submission_display_markup($data, $component) {
  $form_item = _webform_render_markup($component);
  return $form_item;
}

/** 
 * function _webform_help_markup
 * Module specific instance of hook_help
 **/
function _webform_help_markup($section) {
  switch ($section) {
    case 'admin/settings/webform#markup_description':
      $output = t("Presents a markup area of text. Does not render a field.");
      break;
  }
  return $output;
}
