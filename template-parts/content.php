<article class="post card bg-white shadow-sm border-0 <?php if (get_option('argon_enable_into_article_animation') == 'true'){echo 'post-preview';} ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header text-center<?php if (has_post_thumbnail()){echo " post-header-with-thumbnail";}?>">
		<?php
			if (has_post_thumbnail()){
				$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full")[0];
				echo "<img class='post-thumbnail' src='" . $thumbnail_url . "' alt='thumbnail'></img>";
				echo "<div class='post-header-text-container'>";
			}
		?>
		<a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<div class="post-meta">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<div class="post-meta-detail post-meta-detail-words">
					<i class="fa fa-thumb-tack" aria-hidden="true"></i>
					置顶
				</div>
				<div class="post-meta-devide">|</div>
			<?php endif; ?>
			<?php if (post_password_required()) { ?>
				<div class="post-meta-detail post-meta-detail-needpassword">
					<i class="fa fa-lock" aria-hidden="true"></i>
					需要密码
				</div>
				<div class="post-meta-devide">|</div>
			<?php } ?>
			<div class="post-meta-detail post-meta-detail-time">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<time title="<?php echo '发布于 ' . get_the_time('Y-n-d G:i:s') . ' | 修改于 ' . get_the_modified_time('Y-n-d G:i:s'); ?>">
					<?php the_time('Y-n-d G:i'); ?>
				</time>
			</div>
			<div class="post-meta-devide">|</div>
			<div class="post-meta-detail post-meta-detail-views">
				<i class="fa fa-eye" aria-hidden="true"></i>
				<?php get_post_views(get_the_ID()); ?>
			</div>
			<div class="post-meta-devide">|</div>
			<div class="post-meta-detail post-meta-detail-comments">
				<i class="fa fa-comments-o" aria-hidden="true"></i>
				<?php echo get_post(get_the_ID())->comment_count; ?>
			</div>
			<div class="post-meta-devide">|</div>
			<div class="post-meta-detail post-meta-detail-catagories">
				<i class="fa fa-bookmark-o" aria-hidden="true"></i>
				<?php
					$categories = get_the_category();
					foreach ($categories as $index => $category){
						echo "<a href='" . get_category_link($category -> term_id) . "' target='_blank' class='post-meta-detail-catagory-link'>" . $category -> cat_name . "</a>";
						if ($index != count($categories) - 1){
							echo "<span class='post-meta-detail-catagory-space'>,</span>";
						}
					}
				?>
			</div>
			<?php if (get_option("argon_show_author") == "true") { ?>
				<div class="post-meta-devide">|</div>
				<div class="post-meta-detail post-meta-detail-author">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i>
					<?php
						global $authordata;
						echo "<a href='" . get_author_posts_url($authordata -> ID, $authordata -> user_nicename) . "' target='_blank'>" . get_the_author() . "</a>";
					?>
				</div>
			<?php } ?>
			<?php if (!post_password_required() && get_option("argon_show_readingtime") != "false" && is_readingtime_meta_hidden() == False) { ?>
				</br>
				<div class="post-meta-detail post-meta-detail-words">
					<i class="fa fa-file-word-o" aria-hidden="true"></i>
					<?php
						echo get_article_words(get_the_content()) . " 字";
					?>
				</div>
				<div class="post-meta-devide">|</div>
				<div class="post-meta-detail post-meta-detail-words">
					<i class="fa fa-hourglass-end" aria-hidden="true"></i>
					<?php
						echo get_reading_time(get_article_words(get_the_content()));
					?>
				</div>
			<?php } ?>
		</div>
		<?php
			if (has_post_thumbnail()){
				echo "</div>";
			}
		?>
	</header>

	<div class="post-content">
		<?php
			if (get_option("argon_hide_shortcode_in_preview") == 'true'){
				$preview = wp_trim_words(do_shortcode(get_the_content()), 175);
			}else{
				$preview = wp_trim_words(get_the_content(), 175);
			}
			if (post_password_required()){
				$preview = "这篇文章受密码保护，输入密码才能阅读";
			}
			if ($preview == ""){
				$preview = "这篇文章没有摘要";
			}
			if ($post -> post_excerpt){
				$preview = $post -> post_excerpt;
			}
			echo $preview;
		?>
	</div>

	<?php if (has_tag()) { ?>
		<div class="post-tags">
			<i class="fa fa-tags" aria-hidden="true"></i>
			<?php
				$tags = get_the_tags();
				foreach ($tags as $tag) {
					echo "<a href='" . get_category_link($tag -> term_id) . "' target='_blank' class='tag badge badge-secondary post-meta-detail-tag'>" . $tag -> name . "</a>";
				}
			?>
		</div>
	<?php } ?>
</article>