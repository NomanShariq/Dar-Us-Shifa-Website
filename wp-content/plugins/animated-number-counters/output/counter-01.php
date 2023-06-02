<div class="anc-6310-row">
  <?php
  foreach ($allCounters as $allCounter) {
    $numbersPosition = ['', ''];
    if ($allCounter['commons'] != '') {
      $numbersPosition = explode('###|||###', $allCounter['commons']);
    }
  ?>
    <div class="anc-6310-col-<?php echo $cssData['item_per_row'] ?>">
      <div class="anc-6310-counter-<?php echo $ids ?>">
        <div class="anc-6310-counter-<?php echo $ids ?>-top-container" style="background-image: url('<?php echo $allCounter['image'] ?>');">
          <div class="anc-6310-counter-<?php echo $ids ?>-top-inner-wrap">
            <div class="anc-6310-counter-<?php echo $ids ?>-count-title"><?php echo anc_6310_special_character_remove($allCounter['title']) ?></div>
          </div>
        </div>
        <div class="anc-6310-counter-<?php echo $ids ?>-bottom-container">
          <div class="anc-6310-counter-<?php echo $ids ?>-count-content">
            <div class="anc-6310-counter-<?php echo $ids ?>-count-content-inner">
            <div 
                class="anc-6310-counter-<?php echo $ids ?>-count-number anc-6310-counter-number" 
                id="anc-6310-<?php echo "{$ids}-{$allCounter['id']}" ?>"
                data-anc-6310-start="0" 
                data-anc-6310-end="<?php echo $allCounter['numbers']; ?>" 
                data-anc-6310-decimal="<?php echo anc_6310_number_format($allCounter['numbers']); ?>" 
                data-anc-6310-duration=".5" 
                data-anc-6310-thousands-separator=","
              >
                0
              </div>
            </div>
          </div>

          <div class="anc-6310-counter-<?php echo $ids ?>-count-subtitle"> <?php echo anc_6310_special_character_remove($allCounter['description']) ?></div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>

<?php
include anc_6310_plugin_url . "output/css/_css-01.php";
include anc_6310_plugin_url . "output/common-output-css.php";
?>