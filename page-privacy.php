<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="p-privacy__inner">
            <div class="p-privacy__wrapper">
                <?php the_content(); ?>
            </div>
            <a href="<?php echo home_url(); ?>" class="c-section__detail archive-detail">topへ</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>