<?php
/*
 * Created by Artureanec
*/

$search_rand = mt_rand(0, 999);
?>

<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="helpo_search_form" id="search-<?php echo esc_attr($search_rand); ?>">
    <input type="text" name="s" value="" placeholder="<?php echo esc_attr__('Search', 'helpo'); ?>" title="<?php esc_html_e('Search the site...', 'helpo'); ?>" class="form__field">
    <input type="submit" value="">
    <span class="helpo_icon_search">
        <i class="fa fa-search"></i>
    </span>
    <div class="clear"></div>
</form>
