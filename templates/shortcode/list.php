<?php
$elem_id   = wp_generate_uuid4();
$post_type = get_option('bentral_import_type') ?: 'page';
if ($post_type === 'custom') {
    $post_type = get_option('bentral_custom_import_type');
}
$query = new WP_Query(array(
    'post_type'      => $post_type,
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => 'bentral_unit_id',
            'compare' => 'IS NOT NULL'
        )
    )
));
$list  = [];
foreach ($query->posts as $post) {
    $list[] = '<a href="' . get_post_permalink($post) . '"><span style="font-size: 14pt;"><span style="font-family: verdana, geneva, sans-serif;">' . $post->post_title . '</span></span></a>';
}
?>
<style><?php echo wp_unslash(get_option('bentral_card_style')); ?></style>
<table style="border-collapse: collapse; width: 100%;">
    <tbody>
    <tr>
        <td style="width: 100%; text-align: center;">
            <?= implode('<br>', $list); ?>
        </td>
    </tr>
    </tbody>
</table>
