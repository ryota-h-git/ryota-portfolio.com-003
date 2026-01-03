<?php get_header(); ?>

<div class="p-single-work__inner">
    <div class="u-bcn">
        <?php if (function_exists('bcn_display')) : ?>
            <?php bcn_display(); ?>
        <?php endif; ?>
    </div>
    <h2 class="c-section__head js-in-view fade-in-up">
        <span class="c-section__head-main">Works</span>
        <span class="c-section__head-sub">実績一覧</span>
    </h2>
    <div class="p-works__contents">
        <ul class="p-works__list">
            <?php
            $args = array(
                'post_type' => 'work', // カスタム投稿タイプのスラッグ
                'posts_per_page' => 6, // 表示件数
                'post_status' => 'publish', // 公開済みの投稿だけ
            );

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
            ?>
                    <a href="<?php the_permalink() ?>" class="works__item-link">
                        <li class="c-works-item js-in-view fade-in-up">
                            <h3 class="c-works-item__name"><?php the_field('work-title'); ?></h3>
                            <div class="c-works-item__img"><?php the_post_thumbnail(); ?></div>

                            <div class="c-work-label__wrap">
                                <p class="c-work-label"><?php the_field('work-range'); ?></p>
                                <?php if (get_field('work-range2')) : ?>
                                    <p class="c-work-label"><?php the_field('work-range2'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="c-works-item__arrow-text">
                                Learn more
                                <div class="c-works-item__arrow-button">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="c-works-item__arrow-button-bg"></div>
                            </div>

                        </li>
                    </a>
            <?php
                endwhile;
                wp_reset_postdata(); // メインループに戻す
            endif;
            ?>
        </ul>
    </div>
    <a href="<?php echo home_url(); ?>" class="c-section__detail archive-detail">topへ</a>
</div>
<?php get_footer(); ?>