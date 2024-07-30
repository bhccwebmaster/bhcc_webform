<?php

declare(strict_types=1);

namespace Drupal\bhcc_webform\Form;

use Drupal\config\Form\ConfigSingleImportForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a BHCC Webform form.
 */
final class WebformConfigImport extends ConfigSingleImportForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
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
      'webform_option' => $this->t('Webform Options'),
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
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    // Redirect back to importer form.
    // @todo Try to redirect to form build page.
    $form_state->setRedirect('bhcc_webform.webform_config_import');
  }

}
