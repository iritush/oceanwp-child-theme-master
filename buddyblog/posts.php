<?php
/**
 * This file is used for listing the posts on profile
 *
 * @package buddyblog
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$user_id       = bp_displayed_user_id();
$is_my_profile = bp_is_my_profile();
?>
<?php if ( buddyblog_user_has_posted( $user_id, $is_my_profile ) ): ?>
<?php
    //let us build the post query
    if ( $is_my_profile || is_super_admin() ) {
 		$status = 'any';
	} else {
		$status = 'publish';
	}
	
    $paged = bp_action_variable( 1 );
    $paged = $paged ? $paged : 1;
    
	$query_args = array(
		'author'        => $user_id,
		'post_type'     => buddyblog_get_posttype(),
		'post_status'   => $status,
		'paged'         => intval( $paged ),
        'orderby' => 'title',
        'order'   => 'ASC'
    );
	//do the query
    query_posts( $query_args );
	?>
    
	<?php if ( have_posts() ): ?>
		
		<?php while ( have_posts() ): the_post();
			global $post;
		?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="youzify-post-content">
                    
                    <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ):?>
                        
                        <div class="post-featured-image">
                            <?php  the_post_thumbnail();?>
                        </div>

                    <?php endif;?>
                    <h2 class="youzify-post-title"> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'buddyblog' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a> </h2>
    
                </div>

			</div>
                   
        <?php endwhile;?>
            <div class="youzify-pagination">
                <?php buddyblog_paginate(); ?>
            </div>
    <?php else: ?>
            <p><?php _e( 'There are no posts by this user at the moment. Please check back later!', 'buddyblog' );?></p>
    <?php endif; ?>

    <?php 
       wp_reset_postdata();
       wp_reset_query();
    ?>

<?php elseif ( bp_is_my_profile() && buddyblog_user_can_post( get_current_user_id() ) ): ?>
    <p> <?php _e( "You haven't posted anything yet.", 'buddyblog' );?> <a href="<?php echo buddyblog_get_new_url();?>"> <?php _e( 'New Post', 'buddyblog' );?></a></p>

<?php elseif ( bp_is_user() ): ?>
    <?php echo sprintf( "<p>%s haven't posted anything yet.</p>", bp_get_displayed_user_fullname() );?>

<?php endif; ?>
