<?php if ($user_login){ ?>
<p class="loggedin"><?php _e('Logged in as '); echo '<strong>' .$user_identity. '</strong>';?> &nbsp; <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Logout'); ?>"><i class="fa fa-sign-out"></i> <?php _e('Logout'); ?></a></p>
<p>This is content that is only available to logged in users!</p>
<h4>Check out my other projects on <a href="https://github.com/dcooney">Github</a></h4>
<ul>
	<li><a href="https://github.com/dcooney/wordpress-ajax-load-more"><strong>WordPress Ajax load More</strong></a><br/>A simple solution for lazy loading WordPress posts</li>
	<li><a href="https://github.com/dcooney/flexpanel"><strong>Flexpanel</strong></a><br/>A responsive scrolling panel navigation for mobile and desktop
</li>
</ul>
<?php } ?>