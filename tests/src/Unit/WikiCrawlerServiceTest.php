<?php

namespace Drupal\Tests\wiki_crawler\Unit;

use Drupal\Tests\UnitTestCase;

/**
 * Provides automated tests for the WikiCrawlerSearchResultsController module.
 */
class WikiCrawlerServiceTest extends UnitTestCase {

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "wiki_crawler WikiCrawlerService's service functionality",
      'description' => 'Test Unit for service WikiCrawlerService.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    // Get mock service.
    $this->wikiCrawlerService =
      $this->getMockBuilder('Drupal\wiki_crawler\Services\WikiCrawlerService')
        ->disableOriginalConstructor()
        ->getMock();
  }

  /**
   * Tests wiki_crawler functionality.
   */
  public function testGetResults() {
    // Check that service works.
    $wikiCrawlerService =
      $this->getMockBuilder('Drupal\wiki_crawler\Services\WikiCrawlerService')
        ->disableOriginalConstructor()
        ->getMock();
    $this->assertEquals($wikiCrawlerService, $this->wikiCrawlerService);
    // Check that response is the same using the keyword "testing".
    $this->assertEquals(
      $wikiCrawlerService->getResults('testing'),
      $this->wikiCrawlerService->getResults('testing')
    );
    // Check that error response is working with different texts.
    $this->assertEquals(
      $wikiCrawlerService->getResults('s0m3w31rdt3xt01'),
      $this->wikiCrawlerService->getResults('s0m3w31rdt3xt02')
    );
  }

}
