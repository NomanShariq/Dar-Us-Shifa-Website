<?php
//Add/Edit Counter Save
if (!empty($_POST['customize-counter-save']) && $_POST['customize-counter-save'] == 'Save') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc_6310_nonce_add_edit_counter')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $counterId = $_POST['counterid'];
        if($counterId){
            $counterId = implode(',', $counterId);
        }
        $wpdb->query($wpdb->prepare("UPDATE $style_table SET counterids = %s WHERE id = %d", $counterId, $_POST['add_edit_counter_id']));
    }
}

//Rearrange Counter Save
if (!empty($_POST['rearrange-counter-save']) && $_POST['rearrange-counter-save'] == 'Save') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc_6310_nonce_rearrange_counter')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $counterId = $_POST['rearrange_counter_list'];
        $wpdb->query($wpdb->prepare("UPDATE $style_table SET counterids = %s WHERE id = %d", $counterId, $_POST['rearrange_counter_id']));
    }
}


