<?php
/**
 * Created by PhpStorm.
 * User: xuantruong
 * Date: 6/14/16
 * Time: 2:56 PM
 */

if( !function_exists( 'zs_recent_news_func' ) ) {
    function zs_recent_news_func( $atts, $content ) {
        extract( shortcode_atts( [
            'rn_num_post' => 2,
            'rn_categories' => '',
            'rn_title' => 'Recent News'
        ], $atts ) );
        $params = [
            'post_type' => 'post',
            'posts_per_page' => $rn_num_post
        ];
        $rn_categories !== 0
        and $params['cat'] = $rn_categories;
        $recent_news = new WP_Query( $params );
        ob_start();
?>
        <div class="vc-recent-news">
            <h1 class="vc-recent-news-title"><?php echo $rn_title; ?></h1>
            <?php if( $recent_news->post_count ) { ?>
            <ul class="vc-recent-news-list-news">
                <?php while ($recent_news->have_posts() ) {
                        $recent_news->the_post();
                        $image_thumb = wp_get_attachment_image_url( get_post_thumbnail_id(), 'thumbnail' );
                    ?>
                    <li>
                        <img class="alignleft size-full" src="<?php echo $image_thumb;?>" style="text-align: left" alt="">
                        <h2><?php the_title();?></h2>
                        <span class="vc-recent-news-date">
                            <?php echo the_date()?>
                        </span>
                        <div class="clearfix"></div>
                        <p class="vc-recent-news-excerpt">
                            <?php the_excerpt( ); ?>
                        </p>
                        <p style="text-align: right">
                            <a class="vc-recent-news-read-more" href="<?php the_permalink() ;?>"><?php _e( 'Read more', 'zamil-steel' );?></a>
                        </p>
                        <div class="clearfix"></div>
                    </li>
                <?php }
                wp_reset_postdata();
                ?>
            </ul>
            <?php } ?>
        </div>

<?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    add_shortcode( 'zs_recent_news', 'zs_recent_news_func' );
}
