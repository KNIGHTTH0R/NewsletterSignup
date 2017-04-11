<?php

/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 19/09/16
 * Time: 10:35
 */

namespace NewsletterSignup\Admin;

use DrewM\MailChimp\MailChimp;

class SettingsPage extends AbstractSettingsPage
{

    public function render_settings_page()
    {
        $option_name = $this->settings_page_properties['option_name'];
        $option_group = $this->settings_page_properties['option_group'];
        $settings_data = $this->get_settings_data();

        $lists = [];
        $error = '';
        if (!empty($settings_data['mailchimp_api_key'])) {
            try {
                $MailChimp = new MailChimp($settings_data['mailchimp_api_key']);
                $lists = $MailChimp->get('lists');
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                settings_fields($option_group);

                if (!empty($error)) :
                    ?>
                    <div class="alert"><?= $error; ?></div>
                    <?php
                endif;
                ?>
                <h2>Mailchimp</h2>

                <label for="mailchimp_api_key">Mailchimp API key</label>
                <input type="text" id="mailchimp_api_key"
                       name="<?php echo esc_attr($option_name . "[mailchimp_api_key]"); ?>"
                       value="<?php echo esc_attr($settings_data['mailchimp_api_key']); ?>"/>


                <?php if (!empty($lists)) : ?>
                <p>
                    <label style="padding-right:5px;" for="newsletterSubscriptionListId">Choose Mailchimp
                        subscriberlist</label>
                    <select name="<?= esc_attr($option_name . "[newsletterSubscriptionListId]"); ?>"
                            id="newsletterSubscriptionListId">
                        <option value="">- None -</option>
                        <?php
                        foreach ($lists['lists'] as $list) {
                            if ($list['id'] == $settings_data['newsletterSubscriptionListId']):
                                $selected = ' selected';
                            else:
                                $selected = '';
                            endif;
                            echo '<option value="' . $list['id'] . '"' . $selected . '>' . $list['name'] . '</option>';
                        }
                        ?>
                    </select>
                <p>
                    <?php endif; ?>
                <hr>

                <p>
                    <label>Title for subscription succeeded</label><br>
                    <input
                            type="text"
                            size="50"
                            name="<?php echo esc_attr($option_name . "[mailchimp_success_title]"); ?>"
                            value="<?php echo esc_attr($settings_data['mailchimp_success_title']); ?>"
                    >
                </p>

                <p>
                    <label>Message for subscription succeeded</label><br>
                    <textarea
                            name="<?php echo esc_attr($option_name . "[mailchimp_success_message]"); ?>"
                            cols="60"
                            rows="5"><?= esc_attr($settings_data['mailchimp_success_message']); ?>
                    </textarea>
                </p>

                <p>
                    <label>Title for subscription failed</label><br>
                    <input
                            type="text"
                            size="50"
                            name="<?php echo esc_attr($option_name . "[mailchimp_failed_title]"); ?>"
                            value="<?php echo esc_attr($settings_data['mailchimp_failed_title']); ?>"
                    >
                </p>

                <p>
                    <label>Message for subscription failed</label><br>
                    <textarea
                            name="<?php echo esc_attr($option_name . "[mailchimp_failed_message]"); ?>"
                            cols="60"
                            rows="5"><?= esc_attr($settings_data['mailchimp_failed_message']); ?>
                    </textarea>
                </p>


                <hr>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Options">
            </form>
        </div>
        <?php
    }

    public function get_default_settings_data()
    {
        $defaults = [
            'mailchimp_api_key' => '',
            'mailchimp_success_title' => 'Cheers!',
            'mailchimp_success_message' => 'You have now signed up to receive the newsletter',
            'mailchimp_failed_title' => 'Ooops! Something went wrong',
            'mailchimp_failed_message' => 'Please contact us via mail. Last error was: %s'
        ];


        return $defaults;
    }
}