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
        'wrapper' => 'print-output',
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
    $violations = $this->getViolationCounts();
    $html = '';

    if( !empty($violations) ) {
      $html .= '<ul>';

      foreach( $violations as $violation => $count ) {
        $html .= "<li>$violation: $count</li>";
      }

      $html .= '</ul>';
    }

    $output = "<div id='print-output'>$html</div>";

    // Return the HTML markup we built above in a render array.
    return ['#markup' => $output];
  }

  public function getViolationCounts() {
    $nodeResults = $this->fetchNodeResults();
    $violations = $nodeResults['violations'];
    $counts = [];

    foreach( $violations as $violation ) {

      $category = $violation['id'];

      if( isset($counts[$category]) ) {

        $counts[$category]++;

      } else {

        $counts[$category] = 1;

      }
    }

    return $counts;
  }

  /**
  * Gets the results for current node
  */
  public function fetchNodeResults() {

    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = 1;

    if ($node instanceof \Drupal\node\NodeInterface) {
      // Get node id
      $nid = $node->id();
    }

    $site_url = Settings::get('local_site_url', 'http://localhost:8888/tableau_takehome');
    $internal_api_endpoint = "/api/accessibility/?nid=$nid";
    $request_url = "$site_url$internal_api_endpoint";

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
