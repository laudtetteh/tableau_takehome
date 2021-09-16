<?php

namespace Drupal\accessibility\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Our simple form class.
 */
class AccessibilityAjaxForm extends FormBase {

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


    // $form['massage'] = [
    //   '#type' => 'markup',
    //   '#markup' => '<div class="result_message"></div>',
    // ];

    // $form['number_1'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('First number'),
    // ];

    // $form['number_2'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Second number'),
    // ];

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Click Me!'),
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
        '<div class="my_top_message">' . $this->t('The result is @result...')
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
