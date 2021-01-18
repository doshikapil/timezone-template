<?php

namespace Drupal\timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class TimezoneSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['timezone.config_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'timezone_config_form';
  }

  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('timezone.config_settings');

    $form['timezone_settings']['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Your Country'),
      '#description' => $this->t('Country name goes here'),
      '#default_value' => $config->get('country') ? $config->get('country') : '',
    ];

    $form['timezone_settings']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Your City'),
      '#description' => $this->t('City name goes here'),
      '#default_value' => $config->get('city') ? $config->get('city') : '',
    ];
    $requiredOptions = [
      'Select' => 'Select',
      'America/Chicago' => 'America/Chicago',
      'America/New_York' => 'America/New_York', 
      'Asia/Kolkata' => 'Asia/Kolkata', 
      'Asia/Tokyo' => 'Asia/Tokyo',
      'Asia/Dubai' => 'Asia/Dubai', 
      'Europe/Amsterdam' => 'Europe/Amsterdam', 
      'Europe/London' => 'Europe/London', 
      'Europe/Oslo' => 'Europe/Oslo',
    ];

    $form['timezone_settings']['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Enter Your Country'),
      '#description' => $this->t('Country name goes here'),
      '#default_value' => $config->get('timezone') ? $config->get('timezone') : '',
      '#options' => $requiredOptions,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
    * {@inheritdoc}
    */
   public function submitForm(array &$form, FormStateInterface $form_state) {
     $this->config('timezone.config_settings')
       ->set('country', $form_state->getValue('country'))
       ->set('city', $form_state->getValue('city'))
       ->set('timezone', $form_state->getValue('timezone'))
       ->save();

     
     parent::submitForm($form, $form_state);
   }
}

