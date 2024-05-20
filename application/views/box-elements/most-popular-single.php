<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Infinite Loop
 *
 * Displays all of the Infinite Loop right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
$box = $this->themes->get('most-popular-single');


$value = json_decode($box->meta_value);
?>
<div class="box-big-loop" itemscope itemtype="http://schema.org/Article">
	<div class="block-box">
		<h3 class="featured-heading"> <?php echo $box->meta_name ?> </h3> 
		<div class="line"></div>
	</div>
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->most_viewer($value->limit, 0) as $key => $post) :
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
<?php
/* End of file default-loop.php */
/* Location: ./application/views/box-elements/default-loop.php */