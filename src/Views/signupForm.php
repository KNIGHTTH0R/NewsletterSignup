<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 19/09/16
 * Time: 16:10
 */

?>
<div class="section newsletter-form" id="newsletter">
    <div class="container">

        <form class="form-horizontal">
            <div class="form-group">
                <label for="newsletterEmail" class="col-sm-12 col-md-3 col-lg-3 text-uppercase"><?php _e('Subscribe to our newsletter','ecd');?></label>
                <div class="col-sm-8 col-md-6 col-lg-7">
                    <div class="margin-bottom">
                        <input type="email" class="form-control input-lg" id="newsletterEmail" placeholder="<?= __('Email', 'ecd'); ?>">
                    </div>
                </div>
                <div class="col-sm-4 col-md-3 col-lg-2">
                    <div class="margin-bottom">
                        <button id="subscribe-to-newsletter-button" class="btn btn-primary btn-lg"><?php _e('Subscribe', 'ecd');?></button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>