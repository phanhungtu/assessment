<?php

/**
 * @file
 * Contains \Drupal\gobear_jobs\Controller\LikeController.
 */
namespace Drupal\gobear_jobs\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Controller\ControllerBase;

/**
 * Class LikeController.
 *
 * @package Drupal\gobear_jobs\Controller
 */
class JobsController extends ControllerBase {

  /**
   * @return mixed
   */
  public function jobsListing() {

    $uri = 'https://jobs.github.com/positions.json?location=new+york';
    try {
      $response = \Drupal::httpClient()->get($uri, ['headers' => ['Accept' => 'application/json']]);
      $data = (string) $response->getBody();
      if (empty($data)) {
        return FALSE;
      } else {
        $jobs = Json::decode($data);

        $render[] = [
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
    } catch (RequestException $e) {
      return FALSE;
    }

    return FALSE;
  }
}
