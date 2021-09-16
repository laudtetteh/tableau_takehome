<?php
/**
@file
Contains \Drupal\accessibility\Controller\AccessibilityController.
*/
namespace Drupal\accessibility\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Laud's Custom Accessibility Controller
 */
class AccessibilityController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $build = [
      '#markup' => $this->t(''),
    ];
    return $build;
  }

}
