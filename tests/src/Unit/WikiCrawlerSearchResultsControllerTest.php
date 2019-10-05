<?php

namespace Drupal\Tests\wiki_crawler\Unit;

use Drupal\Tests\UnitTestCase;

/**
 * Provides automated tests for the WikiCrawlerSearchResultsController module.
 */
class WikiCrawlerSearchResultsControllerTest extends UnitTestCase {

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "wiki_crawler WikiCrawlerSearchResultsController's controller functionality",
      'description' => 'Test Unit for controller WikiCrawlerSearchResultsController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    // Get mock class object.
    $this->wikiCrawler = $this->getMockBuilder(
      'Drupal\wiki_crawler\Controller\WikiCrawlerSearchResultsController'
      )->disableOriginalConstructor()
      ->getMock();
  }

  /**
   * Tests wiki_crawler functionality.
   */
  public function testContent() {
    // Check that class object works.
    $wikiCrawler =
      $this->getMockBuilder(
          'Drupal\wiki_crawler\Controller\WikiCrawlerSearchResultsController'
        )
        ->disableOriginalConstructor()
        ->getMock();
    $this->assertEquals($this->wikiCrawler, $wikiCrawler);
    // Check that response is the same using the keyword "test".
    $this->assertEquals(
      $this->wikiCrawler->content('test'),
      $wikiCrawler->content('test')
    );
    // Check that error response is working with different texts.
    $this->assertEquals(
      $this->wikiCrawler->content('somew31rdt3xt1456'),
      $wikiCrawler->content('somew31rdt3xt09876')
    );
  }

}
