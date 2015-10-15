					<footer class="footer bg-dark" role="contentinfo">
						 <div class="row clearfix">
			           		<div class="columns medium-6 medium-push-6">
				           		<div class="right">
				                	<?php SLAM::get_social_links(); ?>
				                </div>
								
			            

			                </div> 
			           		<div id="footer-contact-info" class="columns medium-6 medium-pull-6">
			                	<?php
			                		if (get_theme_mod('address')) {
			                			$fulladdress = get_theme_mod('address') . ', ' . get_theme_mod('city');
			                			$addressURL = urlencode($fulladdress);
				                		echo '<a class="address icon-location" target="_blank" href="http://maps.google.com/?q=' . $addressURL . '"><i class="fi-marker"></i>' . $fulladdress . '</a>';
				                	}
			                		
			                		if (get_theme_mod('email')) {
				                		echo '<br/><a class="email icon-mail-alt" href="mailto:' . get_theme_mod('email') . '"><i class="fi-mail"></i>' . get_theme_mod('email') . '</a>';
				                	}
				                	if (get_theme_mod('phone')) {
				                		echo '<br/><a class="phone icon-phone" href="tel:' . get_theme_mod('phone') . '"><i class="fi-telephone"></i>' . get_theme_mod('phone') . '</a>';
				                	}
				                	if (get_theme_mod('fax')) {
				                		echo '<br/><a class="phone icon-phone" href="tel:' . get_theme_mod('fax') . '"><i class="fi-print"></i>' . get_theme_mod('fax') . '</a>';
				                	}
			                		
			                	?>
			                </div> 
			                			                
		                
		                </div>
						<div id="inner-footer" class="row">
							<div class="large-12 medium-12 columns">
								<nav role="navigation">
		    						<?php joints_footer_links(); ?>
		    					</nav>
		    				</div>
			        		<div class="large-12 medium-12 columns">
								<p class="source-org right copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
							</div>
						</div> <!-- end #inner-footer -->
					</footer> <!-- end .footer -->
				</div> <!-- end #container -->
			</div> <!-- end .inner-wrap -->
		</div> <!-- end .off-canvas-wrap -->

						<div id="contact-modal" class="reveal-modal medium" data-reveal>
		               		<h3>Contact us</h3>
		               		<?php echo do_shortcode( get_theme_mod('contact_form') ); ?>
		               		<a class="close-reveal-modal">&#215;</a>
		               	</div>

		<!-- all js scripts are loaded in library/joints.php -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->