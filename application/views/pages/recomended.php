<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the index page
 *
 * Displays all of the index Recomended element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$adsleft = $this->themes->get('ads-120x600-left', 'top-index');

$asdtop = $this->themes->get('ads-980x90', 'top-index');
?>	
	<div class="container content-wrapper">
        <?php
        if( $asdtop->status == 'yes' ) :
        ?>
        <div class="col-xs-12 text-center">
        	<div class="adsvertising">
        		<?php echo $asdtop->meta_value; ?>
        	</div>
        </div>
        <?php endif; 
        if( $adsleft == 'yes') : ?>
		<div class="ads-left">
			<?php echo $adsleft->meta_value ?>
		</div>
		<?php endif; ?>
		<div class="col-xs-8">
			<div class="content-breadcrumb">
			<?php  
			/**
			 * Displayed Breadcrumbs
			 *
			 * @return string
			 **/
			echo $this->breadcrumbs->show();
			?>
			</div>
			<section class="page-cetegory">
				<h1 class="heding-page"><?php echo $title; ?></h1>
			</section>
			<?php
			/**
			 * The template for displaying the Headline News
			 *
			 * Displays all of the New News right element.
			 *
			 * @package Codeigniter
			 * @subpackage Tamtv Template
			 * @since Tamtv 1.0
			 */
			$box = $this->themes->get('thumbnail-new');

			$value = json_decode($box->meta_value);


			?>
			<div class="clearfix"></div>
			<div class="box-thumbnail">
				<?php  
				/**
				 * Get Post By Type
				 *
				 * @param String (post_type)
				 * @param Integer (limit)
				 * @param Integer (offset)
				 **/
				foreach(array_slice($contents, 0, 6) as $key => $post) :
					if( $key % 3 == 0)
						echo '<div class="clearfix"></div>';
				?>
				<div class="box-category-1 c3">
					<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
						<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
					</a>
					<div class="item-featured">
						<h4 class="item-heading">
							<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
								<?php echo $post->post_title; ?>
							</a>
						</h4>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="clearfix"></div>
			<?php
			/**
			 * The template for displaying the Infinite Loop
			 *
			 * Displays all of the Infinite Loop right element.
			 *
			 * @package Codeigniter
			 * @subpackage Tamtv Template
			 * @since Tamtv 1.0
			 */
			?>
			<div class="col-xs-12"><hr></div>
			<div class="box-big-loop" itemscope itemtype="http://schema.org/Article">
				<?php  
				/**
				 * Get Latest Post
				 *
				 * @param String (post_type)
				 * @param Integer (limit)
				 * @param Integer (offset)
				 **/
				foreach( array_slice($contents, ++$key, $this->per_page) as $key => $post) :
				?>
				<div class="big-loop-item">
					<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
						<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
					</a>
					<div class="item-content">
					<?php  
					/**
					 * Get Post Categories
					 *
					 * @param String (category_id)
					 **/
					$category = $this->posts->get_post_category($post->ID);

					if( $category ) 
						echo anchor(
								base_url("kategori/{$category->slug}"), 
								'<span class="category-title">'.$category->name.'</span>', 
								array('titel' => $category->name)
							);
					?>
						<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
						<h4 class="item-heading">
							<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
								<?php if($this->posts->getmeta('video', $post->ID)) echo '<i class="fa fa-play-circle-o"></i> '; echo $post->post_title; ?>
							</a>
						</h4>
						<p><?php echo strip_tags(word_limiter($post->post_content, 10)) ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="text-center">
				<?php if($contents) echo $this->pagination->create_links(); ?>
			</div>
		</div>
<?php

/* End of file recomended.php */
/* Location: ./application/views/pages/recomended.php */