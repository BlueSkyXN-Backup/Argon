<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			if (get_option("argon_show_sharebtn") != 'false') {
				get_template_part( 'template-parts/share' );
			}

			if (comments_open() || get_comments_number()) {
				comments_template();
			}

			if ( is_singular( 'post' ) ) {
				if (get_previous_post() || get_next_post()){
					echo '<div class="post-navigation card shadow-sm">';
					if (get_previous_post()){ 
						previous_post_link('<div class="post-navigation-item post-navigation-pre"><span class="page-navigation-extra-text"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>上一篇 </span>%link</div>' , '%title');
					}else{
						echo '<div class="post-navigation-item post-navigation-pre"></div>';
					}
					if (get_next_post()){
						next_post_link('<div class="post-navigation-item post-navigation-next"><span class="page-navigation-extra-text">下一篇 <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></span>%link</div>' , '%title');
					}else{
						echo '<div class="post-navigation-item post-navigation-next"></div>';
					}
					echo '</div>';
				}
			}
		endwhile;
		?>

<?php get_footer(); ?>
