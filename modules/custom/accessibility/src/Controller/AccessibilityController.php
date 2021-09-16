<?php
/**
@file
Contains \Drupal\accessibility\Controller\AccessibilityController.
*/
namespace Drupal\accessibility\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Controller\ControllerBase;

/**
* Laud's Accessibility Controller
*/
class AccessibilityController extends ControllerBase {

  /**
  * Handles the get request for `/api/accessibility`
  */
  public function get( Request $request ) {

    $cloudfunctions_url = 'https://us-central1-api-project-30183362591.cloudfunctions.net/axe-puppeteer-test';
    $node_url = 'https://dev-tech-homework.pantheonsite.io/node/1';
    $request_url = $cloudfunctions_url . '/?url=' . $node_url;

    $curl = curl_init($request_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'x-tableau-auth: AOaxT3DBGfyXtR68PgFzcZma4bfzLeuLFaLuX9jGHC',
      'Content-Type: application/json',
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response, true);

    return new JsonResponse( $response );
  }

}
