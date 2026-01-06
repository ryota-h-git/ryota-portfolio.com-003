<?php get_header(); ?>
<div class="l-inner">
    <header class="l-header">
    </header>
    <div class="p-fv">
        <div class="p-fv__heading-wrap">
            <h1 class="p-fv__heading animation__text2 is-target">
                <span>Ryota's</span></br>
                <span class="p-fv__heading-accent">portfolio</span>
            </h1>
        </div>
        <div class="p-fv__whale">
            <?php get_template_part('template-parts/whale-main-svg'); ?>
        </div>
        <div class="p-fv__dots"></div>
    </div>
    <!-- ------works------ -->
    <section class="c-section p-works" id="works">
        <div class="p-works__inner">
            <h2 class="c-section__head js-in-view u-fade-in-up works__heading">
                <span class="c-section__head-main">Works</span>
                <span class="c-section__head-sub">実績紹介</span>
            </h2>
            <div class="p-works__contents">
                <ul class="p-works__list">
                    <?php
                    $args = array(
                        'post_type' => 'work',
                        'posts_per_page' => 6,
                        'post_status' => 'publish',
                    );

                    $news_query = new WP_Query($args);

                    if ($news_query->have_posts()) :
                        while ($news_query->have_posts()) : $news_query->the_post();
                    ?>
                            <a href="<?php the_permalink() ?>" class="c-works__item-link">
                                <li class="c-works-item js-in-view u-fade-in-up">
                                    <h3 class="c-works-item__name"><?php the_field('work-title'); ?></h3>
                                    <div class="c-works-item__img"><?php the_post_thumbnail(); ?></div>

                                    <div class="c-work-label__wrap">
                                        <p class="c-work-label"><?php the_field('work-range'); ?></p>
                                        <?php if (get_field('work-range2')) : ?>
                                            <p class="c-work-label"><?php the_field('work-range2'); ?></p>
                                        <?php endif; ?>
                                        <?php if (get_field('work-range3')) : ?>
                                            <p class="c-work-label"><?php the_field('work-range3'); ?></p>
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
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
            </div>

            <a href="<?php echo get_post_type_archive_link('work'); ?>" class="c-section__detail">制作実績一覧へ</a>
        </div>
    </section>

    <!-- service -->
    <section class="c-section service" id="service">
        <h2 class="c-section__head js-in-view u-fade-in-up">
            <span class="c-section__head-main">Service</span>
            <span class="c-section__head-sub">提供サービス</span>
        </h2>
        <p class="c-section__lead-text js-in-view u-fade-in-up">提供可能なサービスです。HP制作や既存のWebサイトの修正などWEBに関する相談は全般的に承っております。
            <br />お気軽にお問い合わせください。
        </p>
        <div class="p-service__contents">
            <ul class="p-service__list">
                <li class="p-service__item js-in-view u-fade-in-up">
                    <div class="p-service__item-img"><img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/service-pc.jpg" alt=""></div>
                    <h3 class="p-service__item-name">コーディング</h3>
                    <p class="p-service__item-text">お客様のご要望に応えられるようヒアリングをしながら柔軟に対応させていただきます。<br />
                        ピクセルパーフェクトを意識した丁寧なコーディングとデザインカンプを忠実に再現します</p>
                </li>
                <li class="p-service__item js-in-view u-fade-in-up">
                    <div class="p-service__item-img"><img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/service-pc2.jpg" alt=""></div>
                    <h3 class="p-service__item-name">ホームページ修正</h3>
                    <p class="p-service__item-text">テキストの簡単な変更からスマホ対応する為のレスポンシブ化やHTMLからWordPress化などHPの些細なお困りごとでも対応します。</p>
                </li>
                <li class="p-service__item js-in-view u-fade-in-up">
                    <div class="p-service__item-img"><img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/service-pc3.jpg" alt=""></div>
                    <h3 class="p-service__item-name">ホームページ相談</h3>
                    <p class="p-service__item-text">HPに関するご相談を無料にてお受けしております。些細な事でもお気軽にお問い合わせください。</p>
                </li>
            </ul>
        </div>

        <!-- swiper -->

        <h2 class="c-section__head js-in-view u-fade-in-up skill">
            <span class="c-section__head-main">skill</span>
            <span class="c-section__head-sub">技術・能力</span>
        </h2>
        <div class="work__swiper-container">
            <div class="swiper p-work__swiper">
                <div class="swiper-wrapper p-work__swiper-wrapper">
                    <div class="swiper-slide p-work__swiper-slide">
                        <i class="fa-brands fa-php"></i>
                    </div>
                    <div class="swiper-slide p-work__swiper-slide">
                        <i class="fa-brands fa-sass"></i>
                    </div>
                    <div class="swiper-slide p-work__swiper-slide">
                        <i class="fa-brands fa-js"></i>
                    </div>
                    <div class="swiper-slide p-work__swiper-slide">
                        <i class="fa-brands fa-wordpress"></i>
                    </div>
                    <div class="swiper-slide p-work__swiper-slide">
                        <i class="fa-brands fa-html5"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about -->
    <section class="c-section about" id="about">
        <h2 class="c-section__head js-in-view u-fade-in-up">
            <span class="c-section__head-main">About</span>
            <span class="c-section__head-sub">自己紹介</span>
        </h2>
        <div class="p-about__container js-in-view u-fade-in-up">
            <div class="p-about__img"><img src="<?php echo get_template_directory_uri(); ?>/public/assets/img/profile.jpg" alt=""></div>
            <div class="p-about__text-container">

                <p class="p-about__text">新潟県在住。20年間会社員として働いてきましたが『自分一人で稼ぐ力』を身に付ける為に独学~オンラインスクール「デイトラ」の受講を経て
                    今に至ります。<br />Web上での目に見えない相手に対しても社会人経験で得た【あたり前な報連相】を心掛けております
                </p>
                <p class="p-about__text"> 【集客の出来るHPを作る!】をモットーに案件に取り組んで行きたいと思います。
                </p>
                <p class="p-about__text"> 趣味は釣りと筋トレで釣りと筋トレを題材にしたブログ<a href="https://hirame-blog.com/"
                        target="_blank" class="p-about__text-link">hirameblog</a>運営も行っています。

                </p>
            </div>
        </div>
    </section>


    <!-- message -->
    <section class="c-section message" id="message">
        <div class="c-section__inner">
            <div class="p-message__container">
                <div class="p-message__text-cotntents">
                    <h2 class="c-section__head js-in-view u-fade-in-up">
                        <span class="c-section__head-main">Message</span>
                        <span class="c-section__head-sub">ご依頼をお考えの方へ</span>
                    </h2>
                    <p class="c-section__lead-text">
                        レスポンスを早くする事を心がけ、丁寧な対応でコーディング業務をサポートいたします。<br />デザインカンプからのperfect pixelでコーディングやWordPress対応、細かな修正も即対応します<br />
                        お問い合わせは以下のフォームまたはXのDM、Gmailで受け付けております。
                    </p>
                    <p class="c-section__lead-text p-message-contact">
                        ご連絡お待ちしております
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div class="p-contact-wrap">
        <h2 class="c-section__head c-section__head--center">
            <span class="c-section__head-main c-section__head-main-bottom" id="contact">Contact</span>
            <span class="c-section__head-sub">お問い合わせ</span>
        </h2>
        <div class="p-contact">
            <?php echo do_shortcode('[contact-form-7 id="540419c" title="お問い合わせ"]'); ?>
        </div>

    </div>
</div>
<?php get_footer(); ?>