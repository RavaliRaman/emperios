<div id="footer">
	<div class="container">
		<ul class="widgets">
			<?php dynamic_sidebar('site-footer') ?>
		</ul>
		<div class="clear"></div>
		
		<div id="footer-copyright">
			<?php echo apply_filters( 'snapshot_footer_attribution', '<div class="designer">' . sprintf( __('Theme by <a href="%s">SiteOrigin</a>', 'snapshot'), 'https://siteorigin.com') . '</div>' ) ?>

			<div class="owner">
				<?php
					print str_replace(
						array('{sitename}', '{year}'),
						array(get_bloginfo('name'), date('Y')),
						siteorigin_setting('general_copyright')
					);
				?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php wp_footer() ?>
</body>
</html>