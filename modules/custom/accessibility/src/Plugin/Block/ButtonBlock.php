<?php

namespace Drupal\accessibility\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'Button' Block.
 *
 * @Block(
 *   id = "button",
 *   admin_label = @Translation("Button"),
 *   category = @Translation("Button"),
 * )
 */
class ButtonBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Call the button form
    $form = \Drupal::formBuilder()->getForm('Drupal\accessibility\Form\AccessibilityAjaxForm');

    return $form;
  }

}
