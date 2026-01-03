<?php get_header(); ?>
<main class="single-work">
    <div class="p-single-work__inner inner">

        <div class="u-bcn">
            <?php if (function_exists('bcn_display')) : ?>
                <?php bcn_display(); ?>
            <?php endif; ?>
        </div>

        <h2 class="c-section__head js-in-view fade-in-up">
            <span class="c-section__head-main">Works</span>
            <span class="c-section__head-sub">実績紹介</span>
        </h2>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <h2 class="p-single-work__detail"><?php the_field("work-title"); ?></h2>

                <div class="p-single-work">
                    <div class="p-single-work__img">
                        <img src="<?php the_field('work-img'); ?>" alt="">
                    </div>
                    <div class="p-single-work__wrapper">
                        <div class="p-single-work__wrap">
                            <div class="p-single-work__overview">
                                <div class="p-single-work__tag">制作概要</div>
                                <p class="p-single-work__text"><?php echo nl2br(get_field('work-detail')) ?></p>
                            </div>
                            <div class="p-single-work__overview">
                                <div class="p-single-work__tag">制作期間</div>
                                <p class="p-single-work__text"><?php the_field('work-time') ?></p>
                            </div>
                            <div class="p-single-work__overview">
                                <div class="p-single-work__tag">制作実績URL</div>
                                <p class="p-single-work__text"><a href="<?php echo get_field('work-url') ?>"><?php echo get_field('work-url') ?></a></br>
                                    <?php the_field('work-pass') ?></br>
                                    <?php the_field('work-name') ?></p>
                            </div>
                        </div>

                        <div class="p-single-work__overview">

                            <?php the_content(); ?>
                        </div>
                    </div>
                    <a href="<?php echo get_post_type_archive_link('work'); ?>" class="c-button__backward-button">制作実績一覧に戻る</a>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>

    </div>
</main>
<?php get_footer(); ?>