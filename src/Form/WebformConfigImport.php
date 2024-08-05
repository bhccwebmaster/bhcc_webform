<?php

declare(strict_types=1);

namespace Drupal\bhcc_webform\Form;

use Drupal\config\Form\ConfigSingleImportForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a BHCC Webform form.
 */
final class WebformConfigImport extends ConfigSingleImportForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    // Return the unique ID for this form.
    return 'bhcc_webform_webform_config_import';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form = parent::buildForm($form, $form_state);

    // Set the configuration options.
    $configuration_type_options = [
      'webform' => $this->t('Webform'),
      'webform_options' => $this->t('Webform Options'),
    ];

    if (isset($form['config_type'])) {
      $form['config_type']['#options'] = $configuration_type_options;
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {

    parent::submitForm($form, $form_state);

    if (!empty($this->data['import'])) {

      $import = $this->data['import'];
      $id = $import['id'];

      // Determine the redirection route along with the specified parameters
      // based on whether we're importing webform config or webform_options.
      if ($this->data['config_type'] == 'webform') {
        // Route name is the redirect to the import form builder page.
        // Parameters are the webform ids relating to the redirect.
        $route_name = 'entity.webform.edit_form';
        $parameters = ['webform' => $id];
      }
      else {
        // Route name is the redirect to the options edit page.
        // Parameters are the webform option id.
        $route_name = 'entity.webform_options.edit_form';
        $parameters = ['webform_options' => $id];
      }

      // Set a redirect response after the form has been submitted.
      $form_state->setRedirect($route_name, $parameters);
    }
  }

}
