<div class="ti-preview-boxes-container">
<div class="ti-full-width">
<div class="ti-box ti-preview-boxes">
<div class="ti-box-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin_tripadvisor::___('Example Widget'); ?>:
<strong><?php echo esc_html(TrustindexPlugin_tripadvisor::___(TrustindexPlugin_tripadvisor::$widget_templates['templates'][4]['name'])); ?></strong>
 (<?php echo esc_html(TrustindexPlugin_tripadvisor::___(TrustindexPlugin_tripadvisor::$widget_styles['light-background']['name'])); ?>)
</span>
</div>
<div class="preview"><?php echo $trustindex_pm_tripadvisor->get_trustindex_widget('4d1942c1993d76d394824aa58'); ?></div>
</div>
</div>
<?php
$demoList = [
5 => 'light-minimal',
36 => 'ligth-border',
34 => 'drop-shadow',
13 => 'dark-background',
15 => 'drop-shadow',
37 => 'ligth-border',
33 => 'light-minimal',
16 => 'drop-shadow',
31 => 'soft',
54 => 'light-background',
6 => 'light-background',
18 => 'light-background',
8 => 'light-background',
27 => 'ligth-border',
26 => 'ligth-border',
29 => 'drop-shadow',
30 => 'dark-background',
60 => 'light-background',
25 => 'light-background',
32 => 'dark-background',
22 => 'light-background',
23 => 'ligth-border',
55 => 'light-minimal',
11 => 'drop-shadow',
12 => 'light-minimal'
];
foreach ($demoList as $layout => $style): ?>
<?php
$template = TrustindexPlugin_tripadvisor::$widget_templates['templates'][ $layout ];
$className = 'ti-full-width';
if (in_array($template['type'], [ 'badge', 'button', 'floating', 'popup', 'sidebar' ])) {
$className = 'ti-half-width';
}
?>
<div class="<?php echo esc_attr($className); ?>">
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($layout); ?>" data-set-id="<?php echo esc_attr($style); ?>">
<div class="ti-box-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin_tripadvisor::___('Example Widget'); ?>:
<strong><?php echo esc_html(TrustindexPlugin_tripadvisor::___($template['name'])); ?></strong>
 (<?php echo esc_html(TrustindexPlugin_tripadvisor::___(TrustindexPlugin_tripadvisor::$widget_styles[ $style ]['name'])); ?>)
</span>
</div>
<div class="preview">
<?php echo $trustindex_pm_tripadvisor->get_noreg_list_reviews(null, true, $layout, $style, true, true, true); ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>