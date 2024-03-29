<?php

namespace Drupal\bhcc_webform\Element;

use Drupal\Component\Utility\Html;
use Drupal\webform\Element\WebformCompositeBase;

/**
 * Provides a 'bhcc_webform_uk_address'.
 *
 * Webform composites contain a group of sub-elements.
 *
 *
 * IMPORTANT:
 * Webform composite can not contain multiple value elements (i.e. checkboxes)
 * or composites (i.e. webform_address)
 *
 * @FormElement("bhcc_webform_uk_address")
 *
 * @see \Drupal\webform\Element\WebformCompositeBase
 * @see \Drupal\webform_example_composite\Element\WebformExampleComposite
 */
class BHCCWebformUKAddress extends WebformCompositeBase {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return parent::getInfo() + ['#theme' => 'bhcc_webform_uk_address'];
  }

  /**
   * {@inheritdoc}
   */
  public static function getCompositeElements(array $element) {
    // Generate a unique ID that can be used by #states.
    $html_id = Html::getUniqueId('bhcc_webform_uk_address');

    $elements = [];
    $elements['address_1'] = [
      '#type' => 'textfield',
      '#title' => t('Address 1'),
      '#attributes' => [
        'data-webform-composite-id' => $html_id . '--address_1',
        // Add a namespaced class for setting the address fields
        // from addresslookup - see DRUP-1184.
        'class' => [
          'bhcc-webform-uk-address--address-1',
          'js-bhcc-webform-uk-address--address-1',
        ],
      ],
    ];
    $elements['address_2'] = [
      '#type' => 'textfield',
      '#title' => t('Address 2'),
      '#attributes' => [
        'data-webform-composite-id' => $html_id . '--address_2',
        // Add a namespaced class for setting the address fields
        // from addresslookup - see DRUP-1184.
        'class' => [
          'bhcc-webform-uk-address--address-2',
          'js-bhcc-webform-uk-address--address-2',
        ],
      ],
    ];
    $elements['town_city'] = [
      '#type' => 'textfield',
      '#title' => t('Town/City'),
      '#attributes' => [
        'data-webform-composite-id' => $html_id . '--town_city',
        // Add a namespaced class for setting the address fields
        // from addresslookup - see DRUP-1184.
        'class' => [
          'bhcc-webform-uk-address--town-city',
          'js-bhcc-webform-uk-address--town-city',
        ],
      ],
    ];
    $elements['postcode'] = [
      '#type' => 'textfield',
      '#title' => t('Postcode'),
      '#attributes' => [
        'data-webform-composite-id' => $html_id . '--postcode',
        // Add a namespaced class for setting the address fields
        // from addresslookup - see DRUP-1184.
        'class' => [
          'bhcc-webform-uk-address--postcode',
          'js-bhcc-webform-uk-address--postcode',
        ],
      ],
    ];
    return $elements;
  }

}
