<?php

declare(strict_types=1);

namespace Drupal\bhcc_webform\Form;

use Drupal\config\Form\ConfigSingleImportForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\WebformInterface;

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
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    parent::validateForm($form, $form_state);
    
    $import_data = $form_state->getValue('import');

    if (!empty($import_data)) {
      $definition = $this->entityTypeManager->getDefinition($form_state->getValue('config_type'));
      
      $valid_config = [
        'webform',
        'webform_option',
      ];
      if (!in_array($definition->getProvider(), $valid_config)) {
        $form_state->setErrorByName('import', $this->t('Only webform configurations can be imported.'));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    parent::submitForm($form, $form_state);
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

}
