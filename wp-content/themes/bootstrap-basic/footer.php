<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
?>
			<?php
			/* JLE : add content below widget zone */
			if (is_active_sidebar('content-below')) { ?>
				<hr class="clearfix" />
				<div><?php dynamic_sidebar('content-below'); ?>
				<hr class="clearfix" />
			<?php } // endif JLE; ?>
			</div><!--.site-content-->
		</div>
		</div><!--.container page-container-->
		</div><!-- body > div-->

		<footer id="site-footer" class="container-fluid" role="contentinfo">
			<div id="footer-row" class="col-md-offset-1 site-footer">

			<?php
				/* JLE : add footer top widget zone */
				if (is_active_sidebar('footer-top')) { ?>
					<div><?php dynamic_sidebar('footer-top'); ?>
					<hr class="clearfix" />
			<?php } // endif JLE; ?>

				<div class="col-md-6 footer-left">
					<?php
					if (!dynamic_sidebar('footer-left')) {
						printf(__('Powered by %s', 'bootstrap-basic'), 'WordPress');
						echo ' | ';
						printf(__('Theme: %s', 'bootstrap-basic'), '<a href="http://okvee.net">Bootstrap Basic</a>');
					}
					?>
				</div>
				<div class="col-md-6 footer-right text-right">
					<?php dynamic_sidebar('footer-right'); ?>
				</div>
				<?php
					/* JLE : add footer below widget zone */
					if (is_active_sidebar('footer-below')) { ?>
						<hr class="clearfix" />
						<div><?php dynamic_sidebar('footer-below'); ?>
				<?php } // endif JLE; ?>
			</div>
		</footer>


		<!--wordpress footer-->
		<?php wp_footer(); ?>
		<p id="cookies">
En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies.
Pour en savoir plus <a href="/mentions-legales">cliquez ici</a>.
		</p>
	</body>
</html>
