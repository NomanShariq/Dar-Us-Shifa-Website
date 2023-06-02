<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="anc-6310-6310">
   <h1>Product License Activation</h1>
   <p>Activate your copy to get direct plugin updates and official support.</p>
   <?php
      if (!empty($_POST['save'])) {
         $nonce = $_REQUEST['_wpnonce'];
         if (!wp_verify_nonce($nonce, 'anc-6310-nonce-field-license')) {
            die('You do not have sufficient permissions to access this page.');
         } else {
            anc_6310_check_license($_POST['license']);
         }
      }
   ?>
   <form action="" method="post" style="width: 600px">
   <?php
        echo wp_nonce_field("anc-6310-nonce-field-license"); 
   ?>
      <table>
         <tr>
            <td>License Key:</td>
            <td>
               <input type="text" name="license"  class="anc-6310-form-input" >
            </td>
         </tr>
         <tr>
            <td></td>
            <td>
               <br />
               <input type="submit" name="save" class="anc-6310-btn-primary">
            </td>
         </tr>
      </table>
   </form>
</div>