<?php
class Environment_Model extends Core_Model{
  function __construct() {
    parent::__construct('environment', 'eid');
  }
  function get_env($pid = 0) {
    $db_results = $this->get('*', array('pid' => $pid));
    $result = array();
    foreach ($db_results as $db_result) {
      $result[$db_result['env_name']] = $db_result['env_value'];
    }
    if (count($result) === 0) {
      $field_array = array(
        'email_expiration_time',
        'email_background_image',
        'email_background_color',
        'email_foreground_color',
        'email_new_user_title',
        'email_new_user_message',
        'email_new_role_title',
        'email_new_role_message',
        'email_invitation_title',
        'email_invitation_message',
        'email_heading_color',
        'email_button_color',
        'email_button_text_color',
        'email_logo_size',
        'email_invitation_subject',
        'email_new_user_subject',
        'email_logo',
        'admin_logo',
        'admin_color_primary',
        'admin_color_secondary',
        'admin_logo_size',
        'website_logo',
        'website_logo_size',
        'website_color_primary',
        'website_color_secondary',
        'about_image',
        'about_video',
        'about_content',
      );

      foreach ($field_array as $field) {
        $this->create(
          array(
            'env_name' => $field,
            'pid' => $pid,
          )
        );
        $result[$field] = '';
      }
    }
    return $result;
  }

  function update_env($new_data, $pid = 0) {
    $this->begin_transaction();
    $success = true;
    foreach ($new_data as $key => $record) {
      $success = $this->update(array('env_value' => $record), array('env_name' => $key, 'pid' => $pid));
      if ($success === false) {
        break;
      }
    }
    if ($success === true) {
      $this->trans_commit();
      return true;
    }

    $this->trans_rollback();
    return false;
  }
}
