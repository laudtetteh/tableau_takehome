<?php

namespace Drupal\accessibility\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Click Me!'),
      '#ajax' => [
        'callback' => '::printResults',
      ]
    ];

    return $form;
  }

  /**
  * Prints the results per category
  */
  public function printResults(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $getResults = $this->getResults();

    $response->addCommand(
      new HtmlCommand(
        '.result_message',
        '<div class="my_top_message">' . $this->t('The result is @result...: ' . $getResults['data']['message'])
        )
    );

    return $response;
  }

  public function getResults() {
    $url = 'http://localhost:8888/tableau_takehome/api/accessibility';

    return json_decode($url);
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
