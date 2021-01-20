<?php

namespace Drupal\timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\timezone\Service\TimezoneLocation;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block with a timezone.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Location block"),
 * )
 */
class TimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * Object for TimezoneLocation Service.
   *
   * @var \Drupal\timezone\Service\TimezoneLocation
   */
  protected $timezoneLocation;

  /**
   * Constructor for TimezoneBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\timezone\Service\TimezoneLocation $timezone_location
   *   A timezome location object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimezoneLocation $timezone_location) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezoneLocation = $timezone_location;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('timezone.location')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $date = $this->timezoneLocation->getDateFromTimezone();
    return [
      '#markup' => $date['time'],
      '#cache' => [
        'tags' => ['config:timezone.config_settings'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
  }

}
