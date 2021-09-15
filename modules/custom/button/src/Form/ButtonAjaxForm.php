<?php

namespace Drupal\button\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Our simple form class.
 */
class ButtonAjaxForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_button_ajax_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Click Me Now!'),
      '#ajax' => [
        'callback' => '::setMessage',
      ]
    ];

    return $form;
  }

  public function setMessage(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    $response->addCommand(
      new HtmlCommand(
        '.result_message',
        '<div class="my_top_message">' . $this->t('The result is @result', ['@result' => ($form_state->getValue('number_1') + $form_state->getValue('number_2'))])
        )
    );

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
