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

    $response['data'] = ['message' => 'Some test data to return'];
    $response['method'] = 'GET';

    return new JsonResponse( $response );
  }

  /**
  * Handles the post request for `/api/accessibility`
  */
  public function post( Request $request ) {
    if ( 0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' ) ) {
      $data = json_decode( $request->getContent(), TRUE );
      $request->request->replace( is_array( $data ) ? $data : [] );
    }

    $response['data'] = 'Some test data to return';
    $response['method'] = 'POST';

    return new JsonResponse( $response );
  }
}
