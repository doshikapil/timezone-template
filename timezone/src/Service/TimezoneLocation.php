<?php

namespace Drupal\timezone\Service;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use \Drupal\Core\Datetime\DrupalDateTime;
/**
 * 
 */
class TimezoneLocation
{
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
   * @param \Drupal\pfizer_ugc_pmap\KeyRepository $key_repo
   *   KeyRepository Object.
   * @param \Drupal\pfizer_ugc_pmap\Settings $hub_settings
   *   Settings Object.
   * @param \Drupal\Core\Logger\LoggerChannelFactory $logger_factory
   *   Logger channel.
   */
  public function __construct(
    ConfigFactoryInterface $config) {
    $this->config = $config->get('timezone.config_settings');
  }


	public function getDateFromTimezone() {
	  //$tz = new DrupalDateTime(time(), 'GMT');
	  $date = new DrupalDateTime();
	  $date->setTimezone(new \DateTimeZone($this->config->get('timezone')));
	  $current_date = $date->format('dS M Y - g:i a');
	  $location_details = ['city' => $this->config->get('timezone'),
	  'country' => $this->config->get('country'), 'time' => $current_date];
      return $location_details;
	}

}


