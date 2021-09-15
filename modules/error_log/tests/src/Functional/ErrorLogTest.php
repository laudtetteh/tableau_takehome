<?php

namespace Drupal\Tests\error_log\Functional;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Tests\BrowserTestBase;

/**
 * Tests Error Log module.
 *
 * @group error_log
 */
class ErrorLogTest extends BrowserTestBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = ['error_log'];

  /**
   * Tests Error Log module.
   */
  public function testErrorLog() {
    $admin_user = $this->drupalCreateUser(['administer site configuration']);
    $this->drupalLogin($admin_user);
    $this->drupalGet('admin/config/development/logging');
    $this->submitForm([], $this->t('Save configuration'));
    $log = file(DRUPAL_ROOT . '/' . $this->siteDirectory . '/error.log');
    $this->assertSame(1, count($log));
    $this->assertSame(1, preg_match('/\[.*\] \[notice\] \[user\] .* Session opened for /', $log[0]));
  }

}
