<?php
$hiilite_options = Hii::$hiiwp->get_options();
if($hiilite_options['portfolio_template'] == 'split') {
	get_template_part('templates/portfolio-content-split', 'loop');
}
else {
	get_template_part('templates/portfolio-content-default', 'loop');
}										
?>