<?php get_header(); ?>
<div class="works__archive-body">
    <div class="works__archive-inner">

        <div class="bcn">
            <?php if (function_exists('bcn_display')) : ?>
                <?php bcn_display(); ?>
            <?php endif; ?>
        </div>

        <h2 class="section__head js-in-view fade-in-up">
            <span class="section__head-main">Works</span>
            <span class="section__head-sub">スクール課題</span>
        </h2>
        <div class="works__contents">
            <ul class="works__list">
                <?php
                $args = array(
                    'post_type' => 'work', // カスタム投稿タイプのスラッグ
                    'posts_per_page' => 6, // 表示件数
                    'post_status' => 'publish', // 公開済みの投稿だけ
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'genle',   // タクソノミースラッグ
                            'field'    => 'slug',       // 'slug' または 'term_id'
                            'terms'    => 'shcool',         // 絞り込みたいタームのスラッグ
                        ),
                    ),
                );

                $news_query = new WP_Query($args);

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                        <a href="<?php the_permalink() ?>" class="works__item-link">
                            <li class="works__item js-in-view fade-in-up">
                                <h3 class="works__item-name"><?php the_field('work-title'); ?></h3>
                                <div class="works__item-img"><?php the_post_thumbnail(); ?></div>

                                <div class="work-label-wrap">
                                    <p class="work__label"><?php the_field('work-range'); ?></p>
                                    <?php if (get_field('work-range2')) : ?>
                                        <p class="work__label"><?php the_field('work-range2'); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="works__item-arrow-text">
                                    Learn more
                                    <div class="works__item-arrow-button">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="works__item-arrow-button-bg"></div>
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

        <a href="<?php echo home_url(); ?>" class="section__detail archive-detail">topへ</a>
    </div>
</div>
<?php get_footer(); ?>