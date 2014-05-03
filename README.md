wordpress-ajax-login
====================

A simple solution for WordPress logins

View a live example at http://cnkt.ca/wordpress-ajax-login/


##Shortcode Example
```
[wordpress_ajax_login redirect_url="/" loading_msg="Authenticating..." error_msg="Authentication Failed..." redirect_msg="You are being redirected" toggle_password=true]
```

##Shortcode Attributes
This shortcode accepts a number of attributes so you can modify the output of the login form.
- 'redirect_url' = URL to send the user after a successful login (Default = get_permalink()).
- 'redirect_msg' = Message to user after successful authetication (Default = 'Success! We are redirecting you now.').
- 'loading_msg' = Message to user as we attempt to authenticate (Default = 'Authenticating user...').
- 'error_msg' = Message to user on authentication error (Default = 'Authentication failed. Wrong username or password.').
- 'toggle_password' = Display the Show Password toggle button (Default = true | false).

##Dependencies
- WordPress :)
- jQuery

##Notes
* /wordpress-ajax-login should be placed inside your theme directory

##Changelog

May 3, 2014
* Initial commit