<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 19/09/16
 * Time: 15:59
 */

namespace NewsletterSignup;


class Frontend
{

    public function run()
    {
        add_shortcode('newsletter_signup', function () {
            return $this->getSignupForm();
        });
    }

    private function getSignupForm()
    {
        $templateLoader = new TemplateLoader();
        ob_start();
        $templateLoader->getTemplate('signupForm.php');
        return ob_get_clean();
    }
}