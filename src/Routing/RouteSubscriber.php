<?php

namespace Drupal\bhcc_webform\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * BHCC Webform export form route subscriber.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritDoc}
   */
  public function alterRoutes(RouteCollection $collection) {

    // Get the route name of the export form.
    if ($route = $collection->get('entity.webform.export_form')) {

      // Set a new permission for the form route.
      $route->setRequirement('_permission', 'access webform export form');
    }
  }

}
