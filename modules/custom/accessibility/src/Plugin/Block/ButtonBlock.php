<?php
/**
@file
Contains \Drupal\accessibility\Plugin\Block;
*/
namespace Drupal\accessibility\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'Button' Block.
 *
 * @Block(
 *   id = "ajax_button",
 *   admin_label = @Translation("Ajax Button"),
 *   category = @Translation("Ajax Button"),
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
