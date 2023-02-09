<?php
if( is_active_sidebar('footer1') && !( is_active_sidebar('footer2') ) && !( is_active_sidebar('footer3') ) ){
	echo '<div class="col-sm-12">';
		dynamic_sidebar('footer1');
	echo '</div>';
}
	
if( is_active_sidebar('footer2') && !( is_active_sidebar('footer3') ) ){
	echo '<div class="col-md-6 col-sm-12">';
		dynamic_sidebar('footer1');
	echo '</div><div class="col-md-6 col-sm-12">';
		dynamic_sidebar('footer2');
	echo '</div><div class="clear"></div>';
}
	
if( is_active_sidebar('footer3') ){
	echo '<div class="col-md-4 col-sm-12">';
		dynamic_sidebar('footer1');
	echo '</div><div class="col-md-4 col-sm-12">';
		dynamic_sidebar('footer2');
	echo '</div><div class="col-md-4 col-sm-12">';
		dynamic_sidebar('footer3');
	echo '</div><div class="clear"></div>';
}