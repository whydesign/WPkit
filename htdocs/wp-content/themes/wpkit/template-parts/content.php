<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpkit
 */

?>

<article class="<?= (is_active_sidebar( 'sidebar-1' ) ? ' uk-article uk-width-expand@m' : ' uk-width-1-2@m') ?>" <?php //post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php
    if ( is_singular() ) :
        the_title( '<h1 class="uk-article-title">', '</h1>' );
    else :
        the_title( '<h2 class="uk-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="uk-link-reset">', '</a></h2>' );
    endif;
    ?>

    <?php if ( 'post' === get_post_type() ) : ?>
    <p class="uk-article-meta">
        <?php
        wpkit_posted_on();
        wpkit_posted_by();
        ?>
    </p><!-- .entry-meta -->
    <?php endif; ?>

    <?php wpkit_post_thumbnail(); ?>

    <?php
    $text_leader = get_post_meta( $post->ID, '_uk_textleader_meta_key', true );

    if ( $text_leader ) :
    ?>
    <p class="uk-text-lead"><?= $text_leader ?></p>
    <?php endif; ?>

    <?php
    if ( has_excerpt() ) :
        the_excerpt();
    else :
        the_content();
    endif;

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wpkit' ),
            'after'  => '</div>',
        )
    );
    ?>

    <hr class="uk-margin-medium-top">

    <footer class="entry-footer uk-grid-small uk-child-width-auto" uk-grid>
        <?php wpkit_entry_footer(); ?>
    </footer>

    <hr class="uk-box-shadow-medium">
</article><!-- #post-<?php the_ID(); ?> -->