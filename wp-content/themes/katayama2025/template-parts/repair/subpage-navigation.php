<?php
/**
 * Template Part: Subpage Navigation
 * サブページ間のナビゲーション
 */

$current_page = get_post();
$parent_id = $current_page->post_parent;

// 親ページが存在しない場合は表示しない
if (!$parent_id) return;

$parent_page = get_post($parent_id);
$siblings = get_pages([
    'child_of' => $parent_id,
    'parent' => $parent_id,
    'sort_column' => 'menu_order',
]);

if (empty($siblings)) return;
?>

<!-- サブページナビゲーション -->
<nav class="subpage-navigation bg-gray-100 border-b border-gray-200 py-3 sticky top-20 z-40">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <!-- 親ページへのリンク -->
            <a href="<?php echo esc_url(get_permalink($parent_id)); ?>" class="text-katayama-blue hover:text-katayama-blue-dark font-semibold flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <?php echo esc_html($parent_page->post_title); ?>
            </a>

            <!-- サブページリンク -->
            <div class="flex flex-wrap gap-2">
                <?php foreach ($siblings as $sibling): ?>
                    <?php
                    $is_current = ($sibling->ID === $current_page->ID);
                    $link_class = $is_current
                        ? 'bg-katayama-blue text-white px-4 py-2 rounded font-semibold'
                        : 'bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300';
                    ?>
                    <a href="<?php echo esc_url(get_permalink($sibling->ID)); ?>" class="<?php echo $link_class; ?>">
                        <?php echo esc_html($sibling->post_title); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>
