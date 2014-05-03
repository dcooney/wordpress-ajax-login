/*
 * WordPress Ajax Login
 * https://github.com/dcooney/wordpress-ajax-login
 *
 * Copyright 2014 Connekt Media - http://cnkt.ca/wordpress-ajax-login/
 * Free to use under the GPLv2 license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Author: Darren Cooney
 * Twitter: @KaptonKaos
 */

jQuery(function ($) {
    "use strict";

    var is_validating = false, // Flag to prevent multiple submissions.
    	btn = $('#wp-ajax-login button.ajax_login_btn'),
    	toggle_field = $('#wp-ajax-login input#password'),
    	toggle_btn = $('#wp-ajax-login .toggle-password a'),
    	toggle_password = wp_ajax_login.toggle_password;

    // Form Submission #wp-ajax-login
    $('form#wp-ajax-login').submit(function(e){ // On submit
        var $el = $(this),
            $remember = '';
        
        if ($('#rememberme').is(':checked')) $remember = 'forever'; //Check Remember Me value

        $('.loading', $el).fadeIn(100, function () {
            $('.status p', $el).text(wp_ajax_login.loading_msg).fadeIn(150);
        });
		
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: wp_ajax_login.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('#username', $el).val(),
                'password': $('#password', $el).val(),
                'remember': $remember,
                'security': $('#security', $el).val()
            },
            success: function (data) {
                $('.loading', $el).delay(250).fadeOut(250, function () {
                    if (data.loggedin == true) { // If authentication 
                        $('.status p', $el).text(wp_ajax_login.redirect_msg).addClass('success');
                        document.location.href = wp_ajax_login.redirect_url;
                        is_validating = false;
                    } else { // Authentication failed 
                        $('.status p', $el).addClass('error').text(wp_ajax_login.error_msg).delay(2500).slideUp(250, function () {
                            $('.status p', $el).removeClass('error');
                            is_validating = false;
                            btn.removeClass('disabled');
                        });
                    }
                });
            }
        });
        e.preventDefault();
    });
    
    
    btn.click(function (e) { // Login button click
        e.preventDefault();
        if (!is_validating) {
        	btn.addClass('disabled');
            is_validating = true;
            $('form#wp-ajax-login').submit();
        }
    });
    
    if(toggle_password == 'false') toggle_btn.parent('span').hide(); //Show/Hide password toggle
    
    $(toggle_btn).click(function (e) { // Show password toggle
    	e.preventDefault();
        if (toggle_btn.hasClass('active')) {
        	toggle_btn.removeClass('active');
            toggle_field.attr('type', 'password');
        } else {
        	toggle_btn.addClass('active');
            toggle_field.attr('type', 'text');
        }
    });
    
});