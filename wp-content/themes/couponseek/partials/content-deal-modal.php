<?php if ( couponseek_get_field('discount_code') ) : ?>
<div class="modal fade" id="external-product-modal-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?php echo get_the_ID(); ?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h5>
				<?php 
				if ( has_post_thumbnail() ) :
					$featured_image_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'couponseek_landscape_medium');
					if ( $featured_image_src ) :
					$featured_image_url = $featured_image_src[0];
					?>
					<div class="bg-image modal-deal-image" data-bg-image="<?php echo esc_url($featured_image_url); ?>"></div>
					<?php endif; ?>
				<?php
				endif;
				?>
			</div>
			<div class="modal-body">
				<div class="modal-deal-code">
					<?php 
					if ( couponseek_get_field('discount_code') ) {
						echo wp_kses_post(couponseek_get_field('discount_code'));
					}
					?>
				</div>
			</div>
			<div class="modal-footer is-clipboard-success">
				<p><?php esc_html_e('Code is copied', 'couponseek') ?></p>

				<?php 
				if ( couponseek_woocommerce() ) :
					$product = wc_get_product($post->ID);
					if($product instanceof WC_Product_External) {
						if ( $product->get_product_url() ) {
							$external_url = $product->get_product_url();
							$button_text = $product->get_button_text() ? $product->get_button_text() : esc_html__('Buy Product', 'couponseek');
						}
					 		
						if ( isset($external_url) ) : ?>
						<a href="<?php echo esc_url($external_url); ?>" target="_blank" class="btn btn-color"><?php echo esc_html( $button_text ); ?></a>
						<?php endif;
					}
					
				endif; ?>
			</div>
			<div class="modal-footer is-clipboard-error">
				<p><?php esc_html_e('Please copy the following code.', 'couponseek') ?></p>
				<?php if ( couponseek_woocommerce() && isset($external_url) ) : ?>
				<a href="<?php echo esc_url($external_url); ?>" target="_blank" class="btn btn-color"><?php echo esc_html( $button_text ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div><!-- end modal -->
<?php endif; ?>