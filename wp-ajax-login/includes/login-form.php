<div class="wp-ajax-login-container">
	<form id="wp-ajax-login" class="wp-ajax-login" action="login" method="post" autocomplete="off">
	
		<div class="item">
			<h3><?php _e('Website Login'); ?></h3>
			<p><?php _e('Enter your username and password - <strong>demo</strong> | <strong>demo</strong>'); ?></p>
		</div>		
							
		<div class="item">					
			<label for="username" class="offscreen"><?php _e('Username'); ?></label>
			<i class="fa fa-user"></i>
			<input id="username" type="text" name="username" placeholder="username">	
		</div>
		
		<div class="item">
			<label for="password" class="offscreen"><?php _e('Password'); ?></label>
			<i class="fa fa-key"></i>
			<input id="password" type="password" name="password" placeholder="password">	
			<span class="toggle-password"><a href="#"><?php _e('Show password?');?></a></span>
		</div>
		
		<div class="status">
   		<div class="loading"></div>
   		<p></p>
		</div>		
		
		<div class="item">			
			<button class="ajax_login_btn" type="submit" name="submit"><?php _e('Login');?></button>
			<div class="checkbox-wrap">
				<input type="checkbox" name="rememberme" id="rememberme" value="forever">	
				<label for="rememberme"><?php _e('Remember Me'); ?></label>			
			</div>	
		</div>	
		
		<div class="item">
			<p class="lost-password"><a class="lost" href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Forgot your password?');?></a></p>
		</div>		
				
		<?php wp_nonce_field( 'wordpress-ajax-login-nonce', 'security' ); ?>	
				
	</form>	
</div>
