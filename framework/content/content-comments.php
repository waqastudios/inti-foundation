<?php
/**
 * Content - Comments
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Post/Page footer comments link 
 * Adds a link to the post and page footers with a link that shows the number
 * of comments and takes the user to the #respond area when clicked
 * 
 * @since 1.0.0
 */
function inti_do_post_page_footer_comments_link() {
	$system = get_inti_option('commenting_system', 'inti_commenting_options');

	if (!is_front_page()) :
		echo inti_get_post_page_footer_comments_link();
	endif;
}

// add to post footers
add_action('inti_hook_post_footer', 'inti_do_post_page_footer_comments_link', 3);

// add to page footers only if comments are activated on pages
if ( get_inti_option('comments_on_pages', 'inti_commenting_options') == "1" ) {
	add_action('inti_hook_page_footer', 'inti_do_post_page_footer_comments_link', 3);
}


/**
 * Comments area
 * Adds a comment area to the end of posts and pages
 * 
 * @since 1.0.0
 */
function inti_do_post_page_comments() {  
	$system = get_inti_option('commenting_system', 'inti_commenting_options');

	if ( comments_open() || '0' != get_comments_number() ) :
		switch ( $system ) { 
			case 'wordpress' : 
				comments_template('', true);
			break; 
			case 'disqus' : 
				$lang = get_inti_option('fbcomments_lang', 'inti_commenting_options');
				?>
				<section id="comments">
					<div id="disqus_thread"></div>
					<script type="text/javascript">
						/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						var disqus_shortname = '<?php echo get_inti_option('disqus_shortname', 'inti_commenting_options'); ?>';
						var disqus_config = function () {
							this.page.identifier = 'post-<?php the_ID(); ?>';
						};
	
						(function() {
							var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
							dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
							(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						})();
						
						(function () {
							var s = document.createElement('script'); s.async = true;
							s.type = 'text/javascript';
							s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
							this.page.identifier = '/december-2010/the-best-day-of-my-life/';
							(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
						}());
					</script>
					<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				</section><!-- #comments -->
				<?php
			break; 
			case 'facebook' : 
				$lang = get_inti_option('fbcomments_lang', 'inti_commenting_options');
				$appid = get_inti_option('fbcomments_appid', 'inti_commenting_options');
				$amount = get_inti_option('fbcomments_amount', 'inti_commenting_options');
				$width = get_inti_option('fbcomments_width', 'inti_commenting_options');
				$scheme = get_inti_option('fbcomments_colorscheme', 'inti_commenting_options');
			?>
				<section id="comments">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/<?php echo $lang; ?>/sdk.js#xfbml=1&appId=<?php echo $appid; ?>&version=v2.3";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<fb:comments href="<?php the_permalink(); ?>" num_posts="<?php echo $amount ?>" width="<?php echo $width ?>" colorscheme="<?php echo $scheme ?>"></fb:comments>
				</section><!-- #comments -->
				<?php
			break; 
			case 'google' : ?>
				<section id="comments">
					<script src="https://apis.google.com/js/plusone.js">
					</script>
					<div class="g-comments"
						data-href = window.location
						data-width = "650"
						data-first_party_property = "BLOGGER"
						data-view_type = "FILTERED_POSTMOD">
					</div>
				</section><!-- #comments -->
				<?php 
			break; 
		}
	endif;

}

// add to all posts
add_action('inti_hook_post_after', 'inti_do_post_page_comments', 2);

// add to pages only if comments are activated on pages
if ( get_inti_option('comments_on_pages', 'inti_commenting_options') == "1" ) {
	add_action('inti_hook_page_after', 'inti_do_post_page_comments', 2);
}


?>