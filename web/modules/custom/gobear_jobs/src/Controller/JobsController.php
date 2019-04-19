<?php

/**
 * @file
 * Contains \Drupal\gobear_jobs\Controller\LikeController.
 */

namespace Drupal\gobear_jobs\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;

/**
 * Class LikeController.
 *
 * @package Drupal\gobear_jobs\Controller
 */
class JobsController extends ControllerBase {

  public function jobsListing() {

    /*$storage = \Drupal::getContainer()->get('entity_type.manager')->getStorage('node');
    $nids = $storage->getQuery()->condition('type', 'article')
      ->pager(10)
      ->sort('changed', 'DESC')
      ->execute();

    $items = [];
    foreach ($nids as $nid) {
      $node_load = Node::load($nid);
      $items[] = [
        'title' => Link::fromTextAndUrl(t($node_load->getTitle()), Url::fromUri('internal:/node/' . $nid)),
        'body' => text_summary($node_load->body->value),
      ];
    }

    $render[] =  [
      '#items' => $items,
      '#theme' => 'recent_article',
      '#attached' => [
        'library' => [
          'recent/recent',
        ],
      ],
    ];

    $render[] = [
      '#type' => 'pager',
    ];*/

  $uri = "https://jobs.github.com/positions.json?location=new+york";
   try {
      $response = \Drupal::httpClient()->get($uri, array('headers' => array('Accept' => 'application/json')));
      $data = (string) $response->getBody();
      if (empty($data)) {
        return FALSE;
      }else{
        $jobs = Json::decode($data);

        $render[] =  [
          '#items' => $jobs,
          '#theme' => 'jobs_listing',
          '#attached' => [
            'library' => [
              'gobear_jobs/jobs',
            ],
          ],
        ];
        return $render;
        //ksm($json);
      }
    }
    catch (RequestException $e) {
        return FALSE;
    }

    return FALSE;
  }

}
