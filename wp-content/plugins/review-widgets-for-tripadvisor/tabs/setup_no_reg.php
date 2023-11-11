<?php include(plugin_dir_path(__FILE__ ) . 'setup_no_reg_header.php'); ?>
<ul class="ti-free-steps">
<li class="<?php echo !$trustindex_pm_tripadvisor->is_noreg_linked() ? 'active' : 'done'; ?><?php if ($currentStep === 1): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=1">
<span>1</span>
<?php echo TrustindexPlugin_tripadvisor::___('Connect %s platform', [ 'Tripadvisor' ]); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $styleId ? 'done' : ($trustindex_pm_tripadvisor->is_noreg_linked() ? "active" : ""); ?><?php if ($currentStep === 2): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=2">
<span>2</span>
<?php echo TrustindexPlugin_tripadvisor::___('Select Layout'); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $scssSet ? 'done' : ($styleId ? 'active' : ""); ?><?php if ($currentStep === 3): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=3">
<span>3</span>
<?php echo TrustindexPlugin_tripadvisor::___('Select Style'); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $widgetSettedUp ? 'done' : ($scssSet ? 'active' : ""); ?><?php if ($currentStep === 4): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=4">
<span>4</span>
<?php echo TrustindexPlugin_tripadvisor::___('Set up widget'); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $widgetSettedUp ? 'active' : ""; ?><?php if ($currentStep === 5): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=5">
<span>5</span>
<?php echo TrustindexPlugin_tripadvisor::___('Insert code'); ?>
</li>
</ul>
<?php if ($trustindex_pm_tripadvisor->is_trustindex_connected() && in_array($selectedTab, [ 'setup_no_reg', 'my_reviews' ])): ?>
<div class="ti-notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___("You have connected your Trustindex account, so you can find premium functionality under the \"%s\" tab. You no longer need this tab unless you choose the limited but forever free mode.", [ 'Trustindex admin' ]); ?>
</p>
</div>
<?php endif; ?>
<?php if ($isReviewDownloadInProgress === 'error'): ?>
<div class="ti-notice notice-error" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('While downloading the reviews, we noticed that your connected page is not found.<br />If it really exists, please contact us to resolve the issue or try connect it again.'); ?><br />
</p>
</div>
<?php elseif ($isReviewDownloadInProgress && ($trustindex_pm_tripadvisor->is_review_manual_download() || !in_array('tripadvisor', [ 'facebook', 'google' ]))): ?>
<div class="ti-notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('Your reviews are being downloaded.'); ?>
<?php if (!in_array('tripadvisor', [ 'facebook', 'google' ])): ?>
<?php echo ' ' . TrustindexPlugin_tripadvisor::___('This process should only take a few minutes.'); ?>
<?php endif; ?>
<?php if (!count($reviews)): ?>
<br />
<?php echo TrustindexPlugin_tripadvisor::___('While you wait, you can start the widget setup with some review templates.'); ?>
<?php endif; ?>
<?php if ($trustindex_pm_tripadvisor->is_review_manual_download()): ?>
<br />
<a href="#" id="review-manual-download" data-nonce="<?php echo wp_create_nonce('ti-download-reviews'); ?>" class="button button-primary ti-tooltip" style="margin-top: 10px">
<?php echo TrustindexPlugin_tripadvisor::___('Manual download') ;?>
<span class="ti-tooltip-message">
<?php echo TrustindexPlugin_tripadvisor::___('Your reviews are being downloaded.'); ?>
<?php if (!in_array('tripadvisor', [ 'facebook', 'google' ])): ?>
<?php echo ' ' . TrustindexPlugin_tripadvisor::___('This process should only take a few minutes.'); ?>
<?php endif; ?>
</span>
</a>
<?php endif; ?>
</p>
</div>
<?php endif; ?>
<?php if (TrustindexPlugin_tripadvisor::is_amp_active() && !get_option($trustindex_pm_tripadvisor->get_option_name('amp-hidden-notification'), 0)): ?>
<div class="ti-notice notice-warning is-dismissible" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('Free plugin features are unavailable with AMP plugin.'); ?>
<?php if ($trustindex_pm_tripadvisor->is_trustindex_connected()): ?>
 <a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_trustindex_join">Trustindex admin</a>
<?php else: ?>
 <a href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-amp" target="_blank"><?php echo TrustindexPlugin_tripadvisor::___('Try premium features (like AMP) for free'); ?></a>
<?php endif; ?>
</p>
<button type="button" class="notice-dismiss" data-command="save-amp-notice-hide"></button>
</div>
<?php endif; ?>
<?php if ($currentStep === 1 || !$trustindex_pm_tripadvisor->is_noreg_linked()): ?>
<h1 class="ti-free-title">
1. <?php echo TrustindexPlugin_tripadvisor::___('Connect %s platform', [ 'Tripadvisor' ]); ?>
</h1>
<?php if ($trustindex_pm_tripadvisor->is_noreg_linked()): ?>
<?php $page_details = get_option($trustindex_pm_tripadvisor->get_option_name('page-details')); ?>
<div class="ti-source-box">
<?php if (isset($page_details['avatar_url'])): ?>
<img src="<?php echo esc_url($page_details['avatar_url']); ?>" />
<?php endif; ?>
<div class="ti-source-info">
<?php if (isset($page_details['name'])): ?>
<strong><?php echo esc_html($page_details['name']); ?></strong><br />
<?php endif; ?>
<?php if (isset($page_details['address']) && $page_details['address']): ?>
<?php echo esc_html($page_details['address']); ?><br />
<?php endif; ?>
<a href="<?php echo esc_url($trustindex_pm_tripadvisor->getPageUrl()); ?>" target="_blank"><?php echo esc_url($trustindex_pm_tripadvisor->getPageUrl()); ?></a>
</div>
<a href="<?php echo wp_nonce_url('?page='. esc_attr($_GET['page']) .'&tab=setup_no_reg&command=delete-page', 'ti-delete-page'); ?>"><button class="btn btn-text btn-refresh"><?php echo TrustindexPlugin_tripadvisor::___('Disconnect') ;?></button></a>
<div class="clear"></div>
</div>
<?php else: ?>
<div class="ti-box">
<form method="post" action="" data-platform="tripadvisor" id="submit-form">
<input type="hidden" name="command" value="save-page" />
<?php wp_nonce_field('ti-save-page'); ?>
<input
type="hidden"
name="page_details"
class="form-control"
required="required"
id="ti-noreg-page_details"
value=""
/>
<?php
$reviewDownloadToken = get_option($trustindex_pm_tripadvisor->get_option_name('review-download-token'));
if (!$reviewDownloadToken) {
$reviewDownloadToken = wp_create_nonce('ti-noreg-connect-token');
update_option($trustindex_pm_tripadvisor->get_option_name('review-download-token'), $reviewDownloadToken, false);
}
?>
<input type="hidden" id="ti-noreg-connect-token" name="ti-noreg-connect-token" value="<?php echo $reviewDownloadToken; ?>" />
<input type="hidden" id="ti-noreg-webhook-url" value="<?php echo $trustindex_pm_tripadvisor->get_webhook_url(); ?>" />
<input type="hidden" id="ti-noreg-email" value="<?php echo get_option('admin_email'); ?>" />
<input type="hidden" id="ti-noreg-version" value="10.9.1" />
<input type="hidden" id="ti-noreg-review-download" name="review_download" value="0" />
<input type="hidden" id="ti-noreg-review-request-id" name="review_request_id" value="" />
<input type="hidden" id="ti-noreg-manual-download" name="manual_download" value=0 />
<input type="hidden" id="ti-noreg-page-id" value="" />
<div class="autocomplete">
<?php include(plugin_dir_path(__FILE__ ) . 'setup_no_reg_platform.php'); ?>
</div>
<div class="ti-selected-source">
<label class="ti-left-label"><?php echo TrustindexPlugin_tripadvisor::___('Source'); ?>:</label>
<div class="ti-source-box ti-original-source-box">
<img />
<div class="ti-source-info"></div>
<button class="btn btn-text btn-connect"><?php echo TrustindexPlugin_tripadvisor::___('Connect') ;?></button>
</div>
<div class="clear"></div>
</div>
<div class="ti-notice notice-warning" style="margin: 20px 0; margin-bottom: 0; display: none" id="ti-connect-info">
<p><?php echo TrustindexPlugin_tripadvisor::___("A popup window should be appear! Please, go to there and continue the steps! (If there is no popup window, you can check the the browser's popup blocker)"); ?></p>
</div>
</form>
</div>
<?php endif; ?>
<h1 class="ti-free-subtitle"><?php echo TrustindexPlugin_tripadvisor::___('Check some %s widget layouts and styles', [ 'Tripadvisor reviews' ]); ?></h1>
<?php include(plugin_dir_path(__FILE__ ) . 'demo_widgets.php'); ?>
<?php elseif ($currentStep === 2 || !$styleId): ?>
<h1 class="ti-free-title">
2. <?php echo TrustindexPlugin_tripadvisor::___('Select Layout'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=1" class="ti-back-icon"><?php echo TrustindexPlugin_tripadvisor::___('Back'); ?></a>
</h1>
<?php if (!count($reviews) && !$isReviewDownloadInProgress): ?>
<div class="ti-notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('There are no reviews on your %s platform.', [ 'Tripadvisor' ]); ?>
</p>
</div>
<?php endif; ?>
<div class="ti-filter-row">
<label><?php echo TrustindexPlugin_tripadvisor::___('Layout'); ?>:</label>
<span class="ti-checkbox">
<input type="radio" name="layout-select" value="" data-ids="" checked>
<label><?php echo TrustindexPlugin_tripadvisor::___('All'); ?></label>
</span>
<?php foreach (TrustindexPlugin_tripadvisor::$widget_templates['categories'] as $category => $ids): ?>
<span class="ti-checkbox">
<input type="radio" name="layout-select" value="<?php echo esc_attr($category); ?>" data-ids="<?php echo esc_attr($ids); ?>">
<label><?php echo esc_html(TrustindexPlugin_tripadvisor::___(ucfirst($category))); ?></label>
</span>
<?php endforeach; ?>
</div>
<div class="ti-preview-boxes-container">
<?php foreach (TrustindexPlugin_tripadvisor::$widget_templates['templates'] as $id => $template): ?>
<?php
$className = 'ti-full-width';
if (in_array($template['type'], [ 'badge', 'button', 'floating', 'popup', 'sidebar' ])) {
$className = 'ti-half-width';
}
$set = 'light-background';
if (in_array($template['type'], [ 'badge', 'button' ])) {
$set = 'drop-shadow';
}
if (!isset($template['is-active']) || $template['is-active']):
?>
<div class="<?php echo esc_attr($className); ?>">
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($id); ?>" data-set-id="<?php echo $set; ?>">
<div class="ti-box-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin_tripadvisor::___('Layout'); ?>:
<strong><?php echo esc_html(TrustindexPlugin_tripadvisor::___($template['name'])); ?></strong>
</span>
<a href="<?php echo wp_nonce_url('?page='. esc_attr($_GET['page']) .'&tab=setup_no_reg&command=save-style&style_id='. esc_attr(urlencode($id)), 'ti-save-style'); ?>" class="btn-text btn-refresh ti-pull-right"><?php echo TrustindexPlugin_tripadvisor::___('Select') ;?></a>
<div class="clear"></div>
</div>
<div class="preview">
<?php echo str_replace('ti-widget ti-disabled', 'ti-widget', $trustindex_pm_tripadvisor->get_noreg_list_reviews(null, true, $id, $set, true, true)); ?>
</div>
</div>
</div>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php elseif ($currentStep === 3 || !$scssSet): ?>
<h1 class="ti-free-title">
3. <?php echo TrustindexPlugin_tripadvisor::___('Select Style'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=2" class="ti-back-icon"><?php echo TrustindexPlugin_tripadvisor::___('Back'); ?></a>
</h1>
<?php if (!count($reviews) && !$isReviewDownloadInProgress): ?>
<div class="ti-notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('There are no reviews on your %s platform.', [ 'Tripadvisor' ]); ?>
</p>
</div>
<?php endif; ?>
<?php
$className = 'ti-full-width';
if (in_array(TrustindexPlugin_tripadvisor::$widget_templates['templates'][ $styleId ]['type'], [ 'badge', 'button', 'floating', 'popup', 'sidebar' ])) {
$className = 'ti-half-width';
}
?>
<div class="ti-preview-boxes-container">
<?php foreach (TrustindexPlugin_tripadvisor::$widget_styles as $id => $style): ?>
<?php if (!isset($style['is-active']) || $style['is-active']): ?>
<div class="<?php echo esc_attr($className); ?>">
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($styleId); ?>" data-set-id="<?php echo esc_attr($id); ?>">
<div class="ti-box-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin_tripadvisor::___('Style'); ?>:
<strong><?php echo TrustindexPlugin_tripadvisor::___($style['name']); ?></strong>
</span>
<a href="<?php echo wp_nonce_url('?page='. esc_attr($_GET['page']) .'&tab=setup_no_reg&command=save-set&set_id='. esc_attr(urlencode($id)), 'ti-save-set'); ?>" class="btn-text btn-refresh ti-pull-right"><?php echo TrustindexPlugin_tripadvisor::___('Select') ;?></a>
<div class="clear"></div>
</div>
<div class="preview">
<?php echo $trustindex_pm_tripadvisor->get_noreg_list_reviews(null, true, $styleId, $id, true, true); ?>
</div>
</div>
</div>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php elseif ($currentStep === 4 || !$widgetSettedUp): ?>
<?php
$widgetType = TrustindexPlugin_tripadvisor::$widget_templates[ 'templates' ][ $styleId ]['type'];
$widgetHasReviews = !in_array($widgetType, [ 'button', 'badge' ]) || in_array($styleId, [ 23, 30, 32 ]);
?>
<h1 class="ti-free-title">
4. <?php echo TrustindexPlugin_tripadvisor::___('Set up widget'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=3" class="ti-back-icon"><?php echo TrustindexPlugin_tripadvisor::___('Back'); ?></a>
</h1>
<?php if (!count($reviews) && !$isReviewDownloadInProgress): ?>
<div class="ti-notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('There are no reviews on your %s platform.', [ 'Tripadvisor' ]); ?>
</p>
</div>
<?php endif; ?>
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($styleId); ?>" data-set-id="<?php echo esc_attr($scssSet); ?>">
<div class="ti-box-header">
<?php echo TrustindexPlugin_tripadvisor::___('Widget Preview'); ?>
<?php if (!in_array($styleId, [ 17, 21, 52, 53 ])): ?>
<span class="ti-header-layout-text ti-pull-right">
<?php echo TrustindexPlugin_tripadvisor::___('Style'); ?>:
<strong><?php echo esc_html(TrustindexPlugin_tripadvisor::___(TrustindexPlugin_tripadvisor::$widget_styles[ $scssSet ]['name'])); ?></strong>
</span>
<?php endif; ?>
<span class="ti-header-layout-text ti-pull-right">
<?php echo TrustindexPlugin_tripadvisor::___('Layout'); ?>:
<strong><?php echo esc_html(TrustindexPlugin_tripadvisor::___(TrustindexPlugin_tripadvisor::$widget_templates['templates'][ $styleId ]['name'])); ?></strong>
</span>
</div>
<div class="preview">
<div id="ti-review-list"><?php echo $trustindex_pm_tripadvisor->get_noreg_list_reviews(null, true, null, null, false, true); ?></div>
<div style="display: none; text-align: center">
<?php echo TrustindexPlugin_tripadvisor::___('You do not have reviews with the current filters. <br />Change your filters if you would like to display reviews on your page!'); ?>
</div>
</div>
</div>
<div class="ti-box">
<div class="ti-box-header"><?php echo TrustindexPlugin_tripadvisor::___('Widget Settings'); ?></div>
<div class="ti-left-block">
<?php if ($widgetHasReviews): ?>
<div id="ti-filter" class="ti-input-row">
<label><?php echo TrustindexPlugin_tripadvisor::___('Filter your ratings'); ?></label>
<div class="ti-select" id="show-star" data-platform="tripadvisor" data-nonce="<?php echo wp_create_nonce('ti-save-filter'); ?>">
<font></font>
<ul>
<li data-value="1,2,3,4,5" <?php echo count($filter['stars']) > 2 ? 'class="selected"' : ''; ?>><?php echo TrustindexPlugin_tripadvisor::___('Show all'); ?></li>
<li data-value="4,5" <?php echo count($filter['stars']) == 2 ? 'class="selected"' : ''; ?>>&starf;&starf;&starf;&starf; - &starf;&starf;&starf;&starf;&starf;</li>
<li data-value="5" <?php echo count($filter['stars']) == 1 ? 'class="selected"' : ''; ?>><?php echo TrustindexPlugin_tripadvisor::___('only'); ?> &starf;&starf;&starf;&starf;&starf;</li>
</ul>
</div>
</div>
<?php endif; ?>
<div class="ti-input-row">
<label><?php echo TrustindexPlugin_tripadvisor::___('Select language'); ?></label>
<form method="post" action="">
<input type="hidden" name="command" value="save-language" />
<?php wp_nonce_field('ti-save-language'); ?>
<select class="form-control" name="lang" id="ti-lang-id">
<?php foreach (TrustindexPlugin_tripadvisor::$widget_languages as $id => $name): ?>
<option value="<?php echo esc_attr($id); ?>" <?php echo $lang == $id ? 'selected' : ''; ?>><?php echo esc_html($name); ?></option>
<?php endforeach; ?>
</select>
</form>
</div>
<?php if ($widgetHasReviews): ?>
<div class="ti-input-row">
<label><?php echo TrustindexPlugin_tripadvisor::___('Select date format'); ?></label>
<form method="post" action="">
<input type="hidden" name="command" value="save-dateformat" />
<?php wp_nonce_field('ti-save-dateformat'); ?>
<select class="form-control" name="dateformat" id="ti-dateformat-id">
<?php foreach (TrustindexPlugin_tripadvisor::$widget_dateformats as $format): ?>
<option value="<?php echo esc_attr($format); ?>" <?php echo $dateformat == $format ? 'selected' : ''; ?>><?php
switch ($format) {
case 'modern':
$lang = substr(get_locale(), 0, 2);
if (!in_array($lang, array_keys(TrustindexPlugin_tripadvisor::$widget_date_format_locales))) {
$lang = 'en';
}
$tmp = explode('|', TrustindexPlugin_tripadvisor::$widget_date_format_locales[ $lang ]);
echo str_replace([ '%d', '%s' ], [ 2, $tmp[3] ], $tmp[0]);
break;
case 'hide':
echo TrustindexPlugin_tripadvisor::___('Hide');
break;
default:
echo date($format);
break;
}
?></option>
<?php endforeach; ?>
</select>
</form>
</div>
<?php if (!in_array($styleId, [ 17, 21, 52, 53 ])): ?>
<div class="ti-input-row">
<label><?php echo TrustindexPlugin_tripadvisor::___('Align'); ?></label>
<form method="post" action="">
<input type="hidden" name="command" value="save-align" />
<?php wp_nonce_field('ti-save-align'); ?>
<select class="form-control" name="align" id="ti-align-id">
<?php foreach ([ 'left', 'center', 'right', 'justify' ] as $alignType): ?>
<option value="<?php echo esc_attr($alignType); ?>" <?php echo $alignType == $align ? 'selected' : ''; ?>><?php echo TrustindexPlugin_tripadvisor::___($alignType); ?></option>
<?php endforeach; ?>
</select>
</form>
</div>
<div class="ti-input-row">
<label><?php echo TrustindexPlugin_tripadvisor::___('Review text'); ?></label>
<form method="post" action="">
<input type="hidden" name="command" value="save-review-text-mode" />
<?php wp_nonce_field('ti-save-review-text-mode'); ?>
<select class="form-control" name="review_text_mode" id="ti-review-text-mode-id">
<?php foreach ([
'scroll' => 'Scroll',
'readmore' => 'Read more',
'truncated' => 'Truncated'
] as $type => $translated): ?>
<option value="<?php echo esc_attr($type); ?>" <?php echo $type == $reviewTextMode ? 'selected' : ''; ?>><?php echo TrustindexPlugin_tripadvisor::___($translated); ?></option>
<?php endforeach; ?>
</select>
</form>
</div>
<?php endif; ?>
<?php endif; ?>
</div>
<div class="ti-right-block">
<form method="post" action="" id="ti-widget-options">
<input type="hidden" name="command" value="save-options" />
<?php wp_nonce_field('ti-save-options'); ?>
<?php if ($widgetHasReviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" id="ti-filter-only-ratings" class="no-form-update" name="only-ratings" value="1" <?php if ($filter['only-ratings']): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Hide reviews without comments'); ?></label>
</span>
<?php endif; ?>
<?php if (in_array($styleId, [ 4, 6, 7, 15, 16, 19, 31, 33, 36, 37, 38, 39, 44 ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="no-rating-text" value="1" <?php if ($noRatingText): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Hide rating text'); ?></label>
</span>
<?php endif; ?>
<?php if ($widgetHasReviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="footer-filter-text" value="1" <?php if ($footerFilterText): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show minimum review filter condition'); ?></label>
</span>
<?php endif; ?>
<?php if (in_array($styleId, [ 8, 10, 13 ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-header-button" value="1" <?php if ($showHeaderButton): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show write review button'); ?></label>
</span>
<?php endif; ?>
<?php if (in_array($styleId, [ 8, 16, 18, 31, 33 ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="reviews-load-more" value="1" <?php if ($reviewsLoadMore): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show "Load more" button'); ?></label>
</span>
<?php endif; ?>
<?php if ($widgetHasReviews && in_array(ucfirst($trustindex_pm_tripadvisor->shortname), TrustindexPlugin_tripadvisor::$verified_platforms)): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="verified-icon" value="1" <?php if ($verifiedIcon): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show verified review icon'); ?></label>
</span>
<?php endif; ?>
<?php if (in_array($widgetType, [ 'slider', 'sidebar' ]) && !in_array($styleId, [ 8, 9, 10, 18, 19, 37, 54 ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-arrows" value="1" <?php if ($showArrows): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show navigation arrows'); ?></label>
</span>
<?php endif; ?>
<?php if ($widgetHasReviews && $styleId != 52): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-reviewers-photo" value="1" <?php if ($showReviewersPhoto): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___("Show reviewers' photo"); ?></label>
</span>
<span class="ti-checkbox row disabled">
<input type="checkbox" value="1" disabled>
<label class="ti-tooltip">
<?php echo TrustindexPlugin_tripadvisor::___("Show reviewers' photos locally, from a single image (less requests)"); ?>
<span class="ti-tooltip-message"><?php echo TrustindexPlugin_tripadvisor::___('Paid package feature'); ?></span>
</label>
</span>
<?php endif; ?>
<?php if (!in_array($widgetType, [ 'floating' ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="enable-animation" value="1" <?php if ($enableAnimation): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Enable mouseover animation'); ?></label>
</span>
<?php endif; ?>
<span class="ti-checkbox row">
<input type="checkbox" name="disable-font" value="1" <?php if ($disableFont): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___("Use site's font"); ?></label>
</span>
<?php if ($widgetHasReviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-logos" value="1" <?php if ($showLogos): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show platform logos'); ?></label>
</span>
<?php if(!$trustindex_pm_tripadvisor->is_ten_scale_rating_platform()): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-stars" value="1" <?php if ($showStars): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin_tripadvisor::___('Show platform stars'); ?></label>
</span>
<?php endif; ?>
<?php endif; ?>
</form>
</div>
<div class="clear"></div>
<div class="ti-box-footer">
<a href="<?php echo wp_nonce_url('?page='. esc_attr($_GET['page']) .'&tab=setup_no_reg&setup_widget', 'ti-setup-widget'); ?>" class="btn-text btn-refresh ti-pull-right"><?php echo TrustindexPlugin_tripadvisor::___('Save and get code') ;?></a>
<div class="clear"></div>
</div>
</div>
<?php else: ?>
<h1 class="ti-free-title">
5. <?php echo TrustindexPlugin_tripadvisor::___('Insert code'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=4" class="ti-back-icon"><?php echo TrustindexPlugin_tripadvisor::___('Back'); ?></a>
</h1>
<?php if (!count($reviews) && !$isReviewDownloadInProgress): ?>
<div class="ti-notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin_tripadvisor::___('There are no reviews on your %s platform.', [ 'Tripadvisor' ]); ?>
</p>
</div>
<?php endif; ?>
<div class="ti-box">
<div class="ti-box-header"><?php echo TrustindexPlugin_tripadvisor::___('Insert this shortcode into your website'); ?></div>
<div class="ti-input-row" style="margin-bottom: 2px">
<label>Shortcode</label>
<code class="code-shortcode">[<?php echo $trustindex_pm_tripadvisor->get_shortcode_name(); ?> no-registration=tripadvisor]</code>
<a href=".code-shortcode" class="btn-text btn-copy2clipboard ti-tooltip toggle-tooltip ti-tooltip-left">
<?php echo TrustindexPlugin_tripadvisor::___('Copy to clipboard') ;?>
<span class="ti-tooltip-message">
<span style="color: #00ff00; margin-right: 2px">✓</span>
<?php echo TrustindexPlugin_tripadvisor::___('Copied'); ?>
</span>
</a>
</div>
<?php echo TrustindexPlugin_tripadvisor::___('Copy and paste this shortcode into post, page or widget.'); ?>
</div>
<?php if (!get_option($trustindex_pm_tripadvisor->get_option_name('rate-us-feedback'), 0)): ?>
<?php include(plugin_dir_path(__FILE__ ) . '_rate_us_feedback.php'); ?>
<?php endif; ?>
<?php
$ti_campaign1 = 'wp-tripadvisor-1';
$ti_campaign2 = 'wp-tripadvisor-2';
include(plugin_dir_path(__FILE__ ) . '_get_more_customers.php');
?>
<?php endif; ?>