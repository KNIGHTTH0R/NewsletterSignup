/**
 * Created by joakimcarlsten on 19/09/16.
 */

jQuery(document).ready(function($){
    'use strict';
    //Subscribe to newsletter

    var $subscribeButton = $('#subscribe-to-newsletter-button'),
        $loader = $('<div class="cover loader"><i class="fa fa-refresh fa-spin"></i></div>'),
        regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if ($subscribeButton.length > 0) {
        $subscribeButton.on('click', handleSubscription);
    }

    function noop(event) {
        event.preventDefault();
        event.stopPropagation();

        return false;
    }

    function handleSubscription (e) {
        e.preventDefault();
        var $el = $(e.target);
        $el.blur();
        $el.append($loader);
        $el.off('click', handleSubscription);
        $el.on('click', noop);

        var $newsletterEmail = $('#newsletterEmail');

        //remove warnings and help-blocks
        $newsletterEmail.parent().removeClass('has-warning').find('.help-block').remove();

        //Check if empty email
        //TODO: Verify email address
        if (0 === $newsletterEmail.val().length || !regex.test($newsletterEmail.val())) {
            $newsletterEmail.parent().addClass('has-warning');
            $newsletterEmail.after('<span class="help-block">' + ajax_object.supply_email+ '</span>');

        } else {
            $.ajax( {
                method: 'post',
                url: ajax_object.ajax_url,
                dataType: 'json',
                data: {
                    action: 'subscriberSubmit',
                    email: $newsletterEmail.val()
                }
            }).done(function (result) {
                $(result.modal).modal();
                //re-enable event handlers
                $subscribeButton.off('click', noop);
                $subscribeButton.on('click', handleSubscription);
                $el.find($loader).remove();
                $newsletterEmail.val("");
            });
        }

    }

});