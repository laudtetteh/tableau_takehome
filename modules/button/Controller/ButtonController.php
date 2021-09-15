<?php

namespace Drupal\button\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Laud's Custom Button Controller
 */
class ButtonController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $build = [
      '#markup' => $this->t('<a class="button">Click Me!</a>'),
    ];
    return $build;
  }

}
