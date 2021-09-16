<?php

namespace Drupal\accessibility\Form;

use Drupal\Core\Site\Settings;
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
      '#value' => $this->t('Click Me!!'),
      '#ajax' => [
        'callback' => '::printResults',
        'wrapper' => 'print-output', // This element is updated with this AJAX callback.
        'method' => 'replace',
        'effect' => 'fade',
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Getting results...'),
        ],
      ],
    ];

    $form['results'] = [
      '#type' => 'markup',
      '#markup' => '<div id="print-output"></div>',
    ];

    return $form;
  }

  /**
  * Prints the results per category
  */
  public function printResults(array &$form, FormStateInterface $form_state) {
    $getResults = $this->getResults();
    $resultsMessage = $getResults['timestamp'];
    $markup = "<h1>$resultsMessage</h1>";

    $output = "<div id='print-output'>$markup</div>";

    // Return the HTML markup we built above in a render array.
    return ['#markup' => $output];
  }

  /**
  * Gets the results per category
  */
  public function getResults() {
    $site_url = Settings::get('local_site_url', 'http://localhost:8888/tableau_takehome');
    $internal_api_endpoint = 'api/accessibility';
    $request_url = $site_url . '/' . $internal_api_endpoint;

    $curl = curl_init($request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    $payload = json_decode($response, true);

    return $payload;
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }
}
