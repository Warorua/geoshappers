<?php 

if ( function_exists('icl_object_id') ) {
	do_action('wpml_add_language_selector');
} else { ?>
	<a href="#"><span class="flag"></span><span>En</span></a>
	<ul class="tm-dummy-flag bdt-display-inline-block bdt-margin-remove">
		<li class="active"><a href="#"><span class="flag"></span></a></li>
		<li><a href="#"><span class="flag"></span></a></li>
		<li><a href="#"><span class="flag"></span></a></li>
	</ul>
<?php } ?>
