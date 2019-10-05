<?php

namespace Drupal\wiki_crawler\Services;

use Drupal\Component\Serialization\Json;

/**
 * Class WikiCrawlerService.
 */
class WikiCrawlerService {

  /**
   * The guzzle http client.
   *
   * @var Guzzleclient
   */
  protected $client;

  /**
   * Constructs a new WikiCrawlerService object.
   */
  public function __construct() {
    $this->client = \Drupal::service('http_client_factory')->fromOptions([
      'base_uri' => 'https://en.wikipedia.org/w/',
    ]);
  }

  /**
   * Get results from wikipedia for the given parameter.
   *
   * @var String $param
   *   The parameter or keyword for the wikipedia search.
   */
  public function getResults(String $param) {
    // Guzzle http client.
    $client = $this->client;
    // Add query parameters to the request.
    $response = $client->get('api.php', [
      'query' => [
        'action' => 'opensearch',
        'search' => $param,
        'format' => 'json',
        'rvprop' => 'content',
      ],
    ]);
    // Parse the results into a php array.
    $results = Json::decode($response->getBody());
    // Check if results are empty.
    // [0] = string containing the keyword or parameter.
    // [1] = array containing the result titles.
    // [2] = array containing the result texts.
    // [3] = array containing the result urls.
    if (!empty($results[1])) {
      // Organize data into a friendlier array.
      foreach ($results[1] as $key => $item) {
        $results['data'][] = [
          'title' => $results[1][$key],
          'text' => $results[2][$key],
          'url' => $results[3][$key],
        ];
      }
      return $results;
    }
    else {
      // If there are no results return an error message.
      return [
        'error' => 'No search resluts were found for the input "' . $param . '",
                    please check your input and try again.',
      ];
    }
  }

}
