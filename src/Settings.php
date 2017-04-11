<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 2017-04-11
 * Time: 11:50
 */

namespace NewsletterSignup;


class Settings
{
    protected $settings_properties;
    protected $settingsData;

    /**
     * Settings constructor.
     * @param $settings_properties
     */
    public function __construct($settings_properties)
    {
        $this->settings_properties = $settings_properties;
    }

    public function getData()
    {
        if (empty($this->settingsData)) {
            $this->settingsData = wp_parse_args(get_option($this->settings_properties['option_name'], $this->getDefaultData()), $this->getDefaultData());
        }
        return $this->settingsData;
    }

    public function getSettingsPageProperties() {
        return $this->settings_properties;
    }

    public function getSuccessTitle()
    {
        return $this->getData()['mailchimp_success_title'];
    }

    public function getSuccessMessage()
    {
        return $this->getData()['mailchimp_success_message'];
    }

    public function getFailedTitle()
    {
        return $this->getData()['mailchimp_failed_title'];
    }

    public function getFailedMessage()
    {
        return $this->getData()['mailchimp_failed_message'];
    }

    private function getDefaultData()
    {
        $defaults = [
            'mailchimp_api_key' => '',
            'newsletterSubscriptionListId' => '',
            'mailchimp_success_title' => 'Cheers!',
            'mailchimp_success_message' => 'You have now signed up to receive the newsletter',
            'mailchimp_failed_title' => 'Ooops! Something went wrong',
            'mailchimp_failed_message' => 'Please contact us via mail. Last error was: %s'
        ];

        return $defaults;
    }

}