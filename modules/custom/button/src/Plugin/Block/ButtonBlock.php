<?php

namespace Drupal\button\Plugin\Block;

use Drupal\Core\Block\BlockBase;

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
    return [
      '#markup' => $this->t('<a href="#" class="button">Click Me!</a>'),
    ];
  }

}
