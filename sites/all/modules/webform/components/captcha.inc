<?php
// $Id: captcha.inc,v 1.11.2.2 2007/05/29 03:00:32 quicksketch Exp $
/** 
 * function webform_edit_captcha
 * Create a set of form items to be displayed on the form for editing this component.
 * Use care naming the form items, as this correlates directly to the database schema.
 * The component "Name" and "Description" fields are added to every component type and
 * are not necessary to specify here (although they may be overridden if desired).
 * @returns An array of form items to be displayed on the edit component page
 **/
function _webform_edit_captcha($currfield) {
  if (!module_exists("captcha")) {
    drupal_set_message(t("Using captcha components in webform requires the <a href='http://drupal.org/project/captcha'>Captcha</a> and <a href='http://drupal.org/node/52349'>Textimage</a> modules."), "error");
  }
  
  $edit_fields = array();
  $edit_fields['value'] = array();
  $edit_fields['mandatory'] = array(
    '#type' => 'hidden',
    '#value' => 1,
  );
  $edit_fields['mandatory-display'] = array(
    '#type' => 'checkbox',
    '#title' => t("Mandatory"),
    '#default_value' => TRUE,
    '#attributes' => array('disabled' => 'disabled'),
    '#description' => t('Captchas are always mandatory'),
    '#weight' => 2,
  );
  return $edit_fields;
}

/** 
 * function webform_render_captcha
 * Build a form item array containing all the properties of this component
 * @param $component An array of information describing the component, directly correlating to the webform_component database schema
 * @returns An array of a form item to be displayed on the client-side webform
 **/
function _webform_render_captcha($component) {
  if (module_exists("captcha")) {
    // Create a dummy form to pass to the captcha function
    $dummy_form = array();
    // Pass the form to the captcha rendering function
    $captcha_type = variable_get("captcha_type", 'captcha');
    
    // Recursively check if captcha has already been answered in the POST array:
    if (isset($_POST['edit']['submitted'])) {
      $captcha_correct = _webform_render_captcha_check($component['cid'], $_POST['edit']['submitted']);
    }
    else {
      $captcha_correct = false;
    }
    
    if ($captcha_correct) {
      return array(); // Do not render the captcha at all
    }
    else {
      if (module_hook($captcha_type, 'captchachallenge')) {
        call_user_func_array($captcha_type .'_captchachallenge', array(&$dummy_form, &$_SESSION['captcha']));   
      }
    }
    // Set a custom validation function (defined below)
    $dummy_form['captcha_response']['#validate'] = array("_webform_validate_captcha" => array());
    // Extract the created captcha into formItem to be returned to webform
    $form_item = $dummy_form['captcha_response'];
    $form_item['#weight'] = $component['weight']; 
    
    // Override the default title if not the default math question (which is used as the title)
    if ($captcha_type != 'captcha') {
      $form_item['#title'] = htmlspecialchars($component['name'], ENT_QUOTES);
    }
    // Override the default captcha description if the user has defined something different
    if (strlen(trim($component['extra']['description'])) > 0) {
      $form_item['#description'] = _webform_filtervalues($component['extra']['description']);
    }
    
    // Wrap in a div
    $form_item['#prefix'] = '<div class="webform-component-'. $component['type'] .'" id="webform-component-'. $component['form_key'] .'">'. $form_item['#prefix'];
    $form_item['#suffix'] .= "</div>";
  }
  else {
    drupal_set_message(t("Unable to render captcha field because the captcha module is not available."), "error");
  }
  return $form_item;
}
/**
 * Helper function for rendering the captcha. The standard captcha module always places
 * the captcha on the root level of the form, since we can place captcha inside any
 * fieldset in webform, we need to do a recursive check for the field, see if was answered
 * correctly and return the result.
 *
 * @param string $captcha_field_name
 * @param array $fieldset
 * @return boolean 
 */
function _webform_render_captcha_check($captcha_field_name, $fieldset) {
  foreach ($fieldset as $key => $value) {
    if ($key == $captcha_field_name) {
      return _webform_validate_captcha($value);
    }
    if (is_array($value)) {
      _webform_render_captcha_check($captcha_field_name, $value);
    }
  }
  return true; // No captcha at all in the array
}

function _webform_validate_captcha($captcha_response) {
  // This function copied directly from the captcha module.
  // The below line is commented out to require every submission to use a captcha,
  // no caching correct answers allowed, lest one real user enter the captcha
  // and then send a bot to churn out spam.

  //if ($_SESSION['captcha_correct']) return TRUE; // Potentially Dangerous
  if (is_array($captcha_response)) $captcha_response = $captcha_response['#value'];
  if (trim($captcha_response) == '') return FALSE;

  global $user;
  $captcha_type = variable_get("captcha_type", NULL);
  $trigger = NULL;

  if (module_hook($captcha_type, 'captchavalidate')) {
    call_user_func_array($captcha_type .'_captchavalidate', array(&$captcha_response, &$_SESSION['captcha_correct']));
  }
  
  return $_SESSION['captcha_correct'];
}

function _webform_help_captcha($section) {
  switch ($section) {
    case 'admin/settings/webform#captcha_description':
      $output = t("Require a question to prove the user is human. Requires <a href='http://drupal.org/project/captcha'>Captcha</a> module.");
      break;
  }
  return $output;
}

/** 
 * function _webform_submission_display_captcha
 * Display the result of a captcha submission. The output of this function will be displayed under the "results" tab then "submissions"
 * @param $data An array of information containing the submission result, directly correlating to the webform_submitted_data database schema
 * @param $component An array of information describing the component, directly correlating to the webform_component database schema
 * @returns Textual output formatted for human reading.
 **/
function _webform_submission_display_captcha($component, $data) {
  $form_item = array();
  return $form_item;
}
