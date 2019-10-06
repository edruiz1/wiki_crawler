# Wiki Crawler Module

This is a code challenge developed by Eduardo Ruiz.
This Drupal 8 module searches for a keyword in the wikipedia pages and returns
the results to a page /wiki, also the user may add a parameter to the url to
search for a keyword /wiki/{parameter}.

## Setup instructions

### Step #1: Clone this repository using git or use composer

It is assumed that you have a functional Drupal 8 working environment. If not please refer to the [Drupal 8 site](https://www.drupal.org/).

To clone this repository use the command line in your computer and input the command that suits you the most:

**Clone this repository**

```
git clone git@github.com:edruiz1/wiki_crawler.git
```
**Use composer to download**
```
composer require edruiz/wiki_crawler
```

### Step #2: Enable the module

It is assumed that you have a functional Drupal 8 working environment. If not please refer to the [Drupal 8 site](https://www.drupal.org/).

**Use Drush to enable the module**

```
drush en -y wiki_crawler
```

**Use the Drupal 8 admin interface to enable the module**
1. Log into your site using an administrator account.
2. Go to the "Extend" tab.
3. Search for wiki_crawler.
4. Click on the checkbox next to "wiki_crawler".
5. Click on the "Install" button at the end of the page.

### Step #3: Use the module
This module exposes 2 routes within Drupal 8 "/wiki" and "/wiki/param", this module also has unit tests.

**/wiki**

This route shows a short description of what this module was made for and a form
where a user can input a keyword to search for.

When the search button is clicked the form will validate that the input is not empty and then proceed to search for the keyword using Wikipedia's API, if the
input keyword has results then the user will be redirected to /wiki/{parameter}.

**/wiki/{parameter}**

In this route the {parameter} is replaced for the keyword the user input into
the search form, it will then show the search form again and display any results
for the keyword.

**Unit testing**

It is assumed that you have functional phpunit in your environment, if you don't please reffer to this page [Getting started with PHPUnit 7](https://phpunit.de/getting-started/phpunit-7.html).

Run the following command for unit testing from the root of your drupal site:
```
vendor/bin/phpunit -c core {path to wiki_crawler module}
```

Note that you need to replace "{path to wiki_crawler module}" with the path to where the module is installed, commonly modules/custom/wiki_crawler.
