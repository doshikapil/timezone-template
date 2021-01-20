<?php

namespace Drupal\timezone\Service;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Configure timezone location service for this module.
 */
class TimezoneLocation {
  /**
   * Logger channel.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactory
   */
  private $logger;

  /**
   * Pfizer PMAP Settings constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config
   *   Config Factory object.
   */
  public function __construct(
    ConfigFactoryInterface $config) {
    $this->config = $config->get('timezone.config_settings');
  }

  /**
   * Function to get the Date as per timezone.
   *
   * @return array
   *   An array of the timezone information.
   */
  public function getDateFromTimezone() {
    // $tz = new DrupalDateTime(time(), 'GMT');
    $date = new DrupalDateTime();
    $date->setTimezone(new \DateTimeZone($this->config->get('timezone')));
    $current_date = $date->format('dS M Y - g:i a');
    $location_details = [
      'city' => $this->config->get('timezone'),
      'country' => $this->config->get('country'),
      'time' => $current_date,
    ];
    return $location_details;
  }

}
