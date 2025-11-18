<?php
/**
 * Template Name: 沿革ページ
 * Description: カタヤマの歴史・沿革を表示するタイムラインページ
 */

get_header();
?>

<main id="primary" class="site-main history-page">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero Section -->
        <section class="history-hero">
            <?php
            $hero_image = get_field('hero_image');
            if ($hero_image) :
            ?>
                <div class="history-hero__image" style="background-image: url('<?php echo esc_url($hero_image['url']); ?>');">
                    <div class="history-hero__overlay"></div>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="history-hero__content">
                    <h1 class="history-hero__title">
                        <?php
                        $hero_title = get_field('hero_title');
                        echo $hero_title ? esc_html($hero_title) : 'カタヤマの歩み';
                        ?>
                    </h1>

                    <?php
                    $hero_subtitle = get_field('hero_subtitle');
                    if ($hero_subtitle) :
                    ?>
                        <div class="history-hero__subtitle">
                            <?php echo nl2br(esc_html($hero_subtitle)); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="history-timeline">
            <div class="container">
                <?php
                $timeline = get_field('timeline');
                if ($timeline) :
                ?>
                    <div class="timeline">
                        <div class="timeline__line"></div>

                        <?php foreach ($timeline as $index => $event) : ?>
                            <div class="timeline__item <?php echo $event['milestone'] ? 'timeline__item--milestone' : ''; ?>"
                                 data-aos="fade-up"
                                 data-aos-delay="<?php echo ($index % 5) * 100; ?>">

                                <div class="timeline__date">
                                    <span class="timeline__year"><?php echo esc_html($event['year']); ?></span>
                                    <?php if (!empty($event['month'])) : ?>
                                        <span class="timeline__month"><?php echo esc_html($event['month']); ?>月</span>
                                    <?php endif; ?>
                                </div>

                                <div class="timeline__dot <?php echo $event['milestone'] ? 'timeline__dot--milestone' : ''; ?>">
                                    <?php if ($event['milestone']) : ?>
                                        <span class="timeline__star">⭐</span>
                                    <?php endif; ?>
                                </div>

                                <div class="timeline__content">
                                    <h3 class="timeline__title"><?php echo esc_html($event['event_title']); ?></h3>

                                    <?php if (!empty($event['event_description'])) : ?>
                                        <div class="timeline__description">
                                            <?php echo nl2br(esc_html($event['event_description'])); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($event['event_image'])) : ?>
                                        <div class="timeline__image">
                                            <img src="<?php echo esc_url($event['event_image']['sizes']['medium']); ?>"
                                                 alt="<?php echo esc_attr($event['event_image']['alt']); ?>"
                                                 loading="lazy">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="no-timeline">沿革データがまだ登録されていません。</p>
                <?php endif; ?>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php
get_footer();
