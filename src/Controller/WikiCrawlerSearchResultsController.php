<?php

namespace Drupal\wiki_crawler\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\wiki_crawler\Services\WikiCrawlerService;
use Drupal\Core\Form\FormBuilderInterface;

/**
 * Class WikiCrawlerSearchResultsController.
 */
class WikiCrawlerSearchResultsController extends ControllerBase {

  /**
   * The service for the search results.
   *
   * @var Drupal\wiki_crawler\Services\WikiCrawlerService
   */
  protected $wikiCrawlerService;

  /**
   * Constructs a new WikiCrawler object.
   */
  public function __construct(WikiCrawlerService $wikiCrawlerService, FormBuilderInterface $form_builder) {
    $this->wikiCrawlerService = $wikiCrawlerService;
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wiki_crawler.crawler_service'),
      $container->get('form_builder')
    );
  }

  /**
   * Content.
   *
   * @return array
   *   Return search results.
   */
  public function content(String $param) {
    // Get the results for the given parameter.
    $results = $this->wikiCrawlerService->getResults($param);
    // Check for errors.
    if (array_key_exists('error', $results)) {
      // Return error message and and redirect to search form.
      \Drupal::messenger()->addError($results['error']);
      return $this->redirect('wiki_crawler.cfr_wiki_form');
    }
    else {
      // Return search results.
      // Delete all unwanted messages.
      \Drupal::messenger()->deleteAll();
      // Add success message.
      \Drupal::messenger()->addMessage(
        'These are the results for the search on "' . $param . '"'
      );
      // Get the class for the search form.
      $form_class = '\Drupal\wiki_crawler\Form\WikiCrawlerForm';
      // Build the search form.
      $form_build['form'] = \Drupal::formBuilder()->getForm($form_class);
      // Delete the description from the form.
      unset($form_build['form']['wiki_form_field_description']);
      // Return an array with the information requested.
      return [
        '#theme' => 'wiki_crawler_results',
        '#data' => $results['data'],
        '#form' => $form_build,
        '#param' => $param,
      ];
    }
  }

}
