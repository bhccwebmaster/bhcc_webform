<?php

/**
 * @file
 * Contains Drupal\bhcc_webform\EventSubscriber\WebformCacheHeaderKernelSubscriber.
 */

namespace Drupal\bhcc_webform\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Url;

/**
 * Class Webform Cache Header kernel subcriber
 *
 * Set a Cache-Control: no-store header for any webforms.
 *
 * @package Drupal\bhcc_webform\EventSubscriber
 */
class WebformCacheHeaderKernelSubscriber implements EventSubscriberInterface {

   /**
   * Executes actions on the response event.
   *
   * @param \Symfony\Component\HttpKernel\Event\ResponseEvent $event
   *   Filter Response Event object.
   */
  public function onKernelResponse(ResponseEvent $event) {
    $request = $event->getRequest();
    $response = $event->getResponse();

    // Get the path and url.
    $path = $request->getRequestUri();
    $url = Url::fromUserInput($path);

    // If the url is a routed url.
    if ($url->isRouted()) {
      $route_name = $url->getRouteName();

      // Only apply Cache-Control: no-store to webform pages.
      if ($route_name == 'entity.webform.canonical') {
        $cache_control = $response->headers->get('Cache-Control');
        
        // Add to the cache-control header string.
        $cache_control = trim($cache_control . ', no-store', ', ');
        $response->headers->set('Cache-Control', $cache_control);
      }
    }

    // Output the response headers.
    $event->setResponse($response);
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['onKernelResponse'];
    return $events;
  }

}
