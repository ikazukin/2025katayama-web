<?php
/**
 * Template Name: 沿革ページ
 * Description: カタヤマの歴史・沿革を表示するタイムラインページ
 */

get_header();
?>

<main id="primary" class="site-main history-page">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero Section - Rebita Minimal Style -->
        <section class="history-hero-rebita">
            <div class="history-hero-rebita__container">
                <div class="history-hero-rebita__content">
                    <?php
                    $hero_title = get_field('hero_title');
                    $hero_subtitle = get_field('hero_subtitle');
                    ?>

                    <!-- 年号を大きく表示 -->
                    <div class="history-hero-rebita__year" data-aos="fade-up">
                        <span class="year-start">1985</span>
                        <span class="year-separator">—</span>
                        <span class="year-current">2025</span>
                    </div>

                    <!-- メインタイトル -->
                    <h1 class="history-hero-rebita__title" data-aos="fade-up" data-aos-delay="200">
                        <?php echo $hero_title ? esc_html($hero_title) : 'カタヤマの歩み'; ?>
                    </h1>

                    <!-- サブタイトル -->
                    <?php if ($hero_subtitle) : ?>
                        <div class="history-hero-rebita__subtitle" data-aos="fade-up" data-aos-delay="400">
                            <?php echo nl2br(esc_html($hero_subtitle)); ?>
                        </div>
                    <?php endif; ?>

                    <!-- スクロールダウンヒント -->
                    <div class="history-hero-rebita__scroll" data-aos="fade-up" data-aos-delay="600">
                        <span class="scroll-text">SCROLL</span>
                        <span class="scroll-line"></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Timeline Section - Rebita Style -->
        <section class="history-timeline-rebita">
            <div class="container-rebita">
                <?php
                $timeline = get_field('timeline');
                if ($timeline) :
                    // 年ごとにグループ化
                    $grouped_timeline = [];
                    foreach ($timeline as $event) {
                        $year = $event['year'];
                        if (!isset($grouped_timeline[$year])) {
                            $grouped_timeline[$year] = [];
                        }
                        $grouped_timeline[$year][] = $event;
                    }
                ?>
                    <div class="timeline-rebita">
                        <?php
                        $year_index = 0;
                        foreach ($grouped_timeline as $year => $events) :
                            $is_even = ($year_index % 2 === 0);
                            $year_index++;
                        ?>
                            <div class="timeline-rebita__year-group <?php echo $is_even ? 'layout-left' : 'layout-right'; ?>"
                                 data-year="<?php echo esc_attr($year); ?>">

                                <!-- 年の表示とイベントタイトル -->
                                <div class="timeline-rebita__year-label"
                                     data-aos="<?php echo $is_even ? 'fade-right' : 'fade-left'; ?>"
                                     data-aos-duration="800">
                                    <h2 class="year-number"><?php echo esc_html($year); ?></h2>

                                    <!-- イベントタイトルと説明リスト（年号の下） -->
                                    <div class="event-titles-list">
                                        <?php foreach ($events as $event) : ?>
                                            <div class="event-title-item <?php echo $event['milestone'] ? 'is-milestone' : ''; ?>">
                                                <div class="event-header">
                                                    <?php if (!empty($event['month'])) : ?>
                                                        <span class="event-month-inline"><?php echo esc_html($event['month']); ?>月</span>
                                                    <?php endif; ?>
                                                    <span class="event-title-text"><?php echo esc_html($event['event_title']); ?></span>
                                                </div>
                                                <?php if (!empty($event['event_description'])) : ?>
                                                    <div class="event-description-inline">
                                                        <?php echo nl2br(esc_html($event['event_description'])); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- 中央：タイムライン線 -->
                                <div class="timeline-rebita__line"></div>

                                <!-- 画像のみ -->
                                <div class="timeline-rebita__events">
                                    <?php foreach ($events as $index => $event) : ?>
                                        <div class="timeline-rebita__event <?php echo $event['milestone'] ? 'is-milestone' : ''; ?>"
                                             data-aos="fade-up"
                                             data-aos-delay="<?php echo $index * 100; ?>"
                                             data-aos-duration="600">

                                            <?php
                                            // 画像表示（大きく表示）
                                            $event_gallery = !empty($event['event_gallery']) ? $event['event_gallery'] : [];
                                            $event_grid_gallery = !empty($event['event_grid_gallery']) ? $event['event_grid_gallery'] : [];
                                            $event_image = !empty($event['event_image']) ? $event['event_image'] : null;

                                            // プレースホルダー画像URL（画像がない場合のデフォルト）
                                            $placeholder_image = 'https://picsum.photos/1200/800?random=' . $event['year'];

                                            // 画像IDから画像URLを取得する関数
                                            if ($event_image && is_numeric($event_image)) {
                                                $event_image = wp_get_attachment_image_src($event_image, 'full');
                                                $event_image_url = $event_image ? $event_image[0] : null;
                                            } elseif (is_array($event_image) && isset($event_image['url'])) {
                                                $event_image_url = $event_image['url'];
                                            } else {
                                                $event_image_url = null;
                                            }

                                            // 3列グリッド表示
                                            if (!empty($event_grid_gallery)) :
                                            ?>
                                                <div class="event-image-large event-grid-gallery">
                                                    <?php foreach ($event_grid_gallery as $image) : ?>
                                                        <div class="grid-item">
                                                            <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                                                                 alt="<?php echo esc_attr($image['alt']); ?>"
                                                                 loading="lazy"
                                                                 class="glightbox"
                                                                 data-gallery="event-<?php echo esc_attr($event['year']); ?>">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php elseif (!empty($event_gallery) && count($event_gallery) > 1) : ?>
                                                <!-- 複数画像：Swiperカルーセル -->
                                                <div class="event-image-large event-carousel swiper">
                                                    <div class="swiper-wrapper">
                                                        <?php foreach ($event_gallery as $image) : ?>
                                                            <div class="swiper-slide">
                                                                <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                                                                     alt="<?php echo esc_attr($image['alt']); ?>"
                                                                     loading="lazy">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="swiper-pagination"></div>
                                                    <div class="swiper-button-prev"></div>
                                                    <div class="swiper-button-next"></div>
                                                </div>
                                            <?php elseif (!empty($event_gallery) && count($event_gallery) === 1) : ?>
                                                <!-- 単一画像（ギャラリーに1枚） -->
                                                <div class="event-image-large">
                                                    <img src="<?php echo esc_url($event_gallery[0]['url']); ?>"
                                                         alt="<?php echo esc_attr($event_gallery[0]['alt']); ?>"
                                                         loading="lazy">
                                                </div>
                                            <?php elseif ($event_image_url) : ?>
                                                <!-- 単一画像（IDまたは配列） -->
                                                <div class="event-image-large">
                                                    <img src="<?php echo esc_url($event_image_url); ?>"
                                                         alt="<?php echo esc_attr($event['event_title']); ?>"
                                                         loading="lazy">
                                                </div>
                                            <?php elseif ($event['milestone']) : ?>
                                                <!-- マイルストーンイベントにはプレースホルダー画像を表示 -->
                                                <div class="event-image-large event-image--placeholder">
                                                    <img src="<?php echo esc_url($placeholder_image); ?>"
                                                         alt="<?php echo esc_attr($event['event_title']); ?>"
                                                         loading="lazy">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
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
