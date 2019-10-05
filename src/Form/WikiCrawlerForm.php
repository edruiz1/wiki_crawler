<?php

namespace Drupal\wiki_crawler\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WikiCrawlerForm.
 */
class WikiCrawlerForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cfr_wiki_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#title'] = 'Wiki Search Form';
    $form['wiki_form_field_description'] = [
      '#type' => 'item',
      '#markup' => '<p>This page displays search results for the value input in
                    the search field below.</p>
                    <p><hr></p>
                    <p>Developed by Eduardo Ruiz</p>',
    ];
    $form['wiki_form_field_search'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search'),
      '#description' => $this->t('Input url parameter or keyword (term) to'),
      '#maxlength' => 255,
      '#size' => 64,
      '#weight' => '0',
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Redirect to search page.
    $form_state
      ->setRedirect(
        'wiki_crawler.wiki_crawler_search_results_controller_content',
        [
          'param' => $form_state->getValues()['wiki_form_field_search'],
        ]
      );
  }

}
