<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix item archive-item'); ?> role="article"> 
	<a href="<?php the_permalink(); ?>">
	<?php the_post_thumbnail('full'); ?>
	</a>	
	<header class="article-header bg-white panel no-margin" >
		
			<h4><a href="<?php the_permalink(); ?>" class="white" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		
	</header> <!-- end article header -->	
	<div class="panel bg-silver">				
		
						
		<section class="entry-content clearfix " itemprop="articleBody">
			<?php get_template_part( 'partials/content', 'byline' ); ?>
				
			<?php the_excerpt(); ?>
		</section> <!-- end article section -->
							
		<footer class="byline">
	    	<?php the_tags('<span class="tags-title">' . __('Tags:', 'jointstheme') . '</span> ', ', ', ''); ?>
		</footer> <!-- end article footer -->
	</div>
						    
		<?php // comments_template(); // uncomment if you want to use them ?>
					
</article> <!-- end article -->