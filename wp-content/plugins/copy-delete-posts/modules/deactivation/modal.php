<?php

  /**
   * Deactivation free help offer module
   *
   * @category Child Plugin
   * @version v0.1.0
   * @since v0.1.0
   * @author iClyde <kontakt@iclyde.pl>
   * @author Artem K
   */

  // Namespace
  namespace Inisev\Subs;

  // Disallow direct access
  if (!defined('ABSPATH')) exit;

?>
<div id="iiev-modal-leave" class="iiev-modal-leave">

  <div class="iiev-modal-leave__body">
    <button type="button" class="iiev-modal-leave__btn-close" id="iiev-modal-leave__closebtn" aria-label="close modal">
      <svg width="10" height="10" viewBox="0 0 11 10">
        <path d="M9.70384 1.96966L6.66078 4.99993L9.70384 8.03006C10.1565 8.48093 10.1565 9.21127 9.70384 9.66213C9.47768 9.88732 9.18117 10 8.8848 10C8.58794 10 8.2914 9.88749 8.06541 9.66213L5.02168 6.63165L1.97818 9.6621C1.75204 9.88729 1.4555 9.99997 1.15887 9.99997C0.86233 9.99997 0.565989 9.88746 0.339654 9.6621C-0.112987 9.21144 -0.112987 8.48107 0.339654 8.03004L3.38264 4.9999L0.339481 1.96966C-0.11316 1.51896 -0.11316 0.788452 0.339481 0.33776C0.792036 -0.112587 1.52528 -0.112587 1.978 0.33776L5.02165 3.36804L8.06506 0.33776C8.51788 -0.112587 9.2512 -0.112587 9.70367 0.33776C10.1565 0.788452 10.1565 1.51896 9.70384 1.96966Z"></path>
      </svg>
    </button>
    <div class="iiev-modal-leave__content">

      <div class="iiev-modal-leave__title-wrap">
        <h1 class="iiev-modal-leave__title">
          <b><span class="iiev-modal-leave-text-primary">Please</span></b> don’t leave us!
        </h1>
      </div>
      <div class="iiev-modal-leave__img-wrap">
        <img src="<?php echo $this->__asset('img/dog.webp') ?>" width="247" height="290" alt="dog with sad eyes">
      </div>

      <div class="iiev-modal-leave__text-content">
        <h2 class="iiev-modal-leave__text-content-title">
          We’re happy to fix the issue, whatever it is! Quickly, and <b><span class="iiev-modal-leave-text-primary">100%
              for free</span></b> :)
        </h2>
        <a href="#" target="_blank" class="iiev-modal-leave__away-link">
          <span class="iiev-modal-leave__away-link-text">Ok, let me ask you</span>
          <svg width="7" height="12" viewBox="0 0 7 12">
            <path d="M6.53033 6.53033C6.82322 6.23744 6.82322 5.76256 6.53033 5.46967L1.75736 0.696699C1.46447 0.403806 0.989592 0.403806 0.696699 0.696699C0.403806 0.989592 0.403806 1.46447 0.696699 1.75736L4.93934 6L0.696699 10.2426C0.403806 10.5355 0.403806 11.0104 0.696699 11.3033C0.989592 11.5962 1.46447 11.5962 1.75736 11.3033L6.53033 6.53033ZM5 6.75H6V5.25H5V6.75Z" fill="white"></path>
          </svg>
        </a>
        <div class="iiev-modal-leave__loggin-trouble">

          <span>Trouble logging in?</span>
          <div class="iiev-modal-leave__info">
            <svg class="iiev-modal-leave__info-icon" width="16" height="16" viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" fill="#2885C0"></circle>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.44813 5.96124C9.43327 5.95864 9.41823 5.95732 9.40314 5.95735H9.35043C9.19253 5.95266 9.03454 5.96281 8.87853 5.98761C8.70752 6.01975 8.53137 6.04738 8.361 6.07374L8.12249 6.11102L7.22241 6.25761L7.08805 6.2801L7.02376 6.29105L6.92733 6.3071L6.75503 6.84456H7.03598H7.12084C7.17623 6.84374 7.23162 6.84633 7.2867 6.85229C7.33498 6.85765 7.37929 6.88156 7.41025 6.919C7.4412 6.95643 7.45637 7.00445 7.45257 7.05288C7.43727 7.20794 7.40736 7.36118 7.36322 7.51061C7.23464 7.96064 7.10155 8.41068 6.97426 8.85299L6.79682 9.46246C6.77175 9.55054 6.74604 9.6386 6.72032 9.72732C6.63996 10.0044 6.55638 10.2905 6.47602 10.5734C6.4227 10.7466 6.39709 10.9271 6.40015 11.1083C6.40419 11.3387 6.49837 11.5585 6.66246 11.7203C6.82256 11.8768 7.03213 11.9728 7.25521 11.9916C7.3071 11.9973 7.35924 12.0001 7.41143 12C7.61553 11.9994 7.8174 11.9574 8.00483 11.8765C8.2435 11.7715 8.46128 11.6243 8.64772 11.4419C8.8778 11.2198 9.08106 10.9714 9.25335 10.702C9.30542 10.6222 9.35556 10.5399 9.40442 10.4609L9.47321 10.3503L9.56065 10.2108L9.08232 9.92921L8.99811 10.0578C8.99297 10.0649 8.9891 10.0713 8.98524 10.0777L8.96596 10.1054L8.87661 10.2339C8.80718 10.3323 8.73516 10.4339 8.66187 10.5309C8.58028 10.6427 8.4848 10.7436 8.37772 10.8312C8.35185 10.8519 8.32301 10.8686 8.2922 10.8807H8.289C8.28474 10.8775 8.28105 10.8736 8.27807 10.8691C8.27469 10.8652 8.27247 10.8604 8.27167 10.8553C8.27088 10.8502 8.27152 10.845 8.27356 10.8402L8.29477 10.7444C8.31855 10.6325 8.34171 10.5271 8.37128 10.423C8.67537 9.36346 8.9859 8.28661 9.28613 7.24511L9.57929 6.22932C9.58379 6.21389 9.58701 6.19909 9.59086 6.18494C9.59472 6.1708 9.59086 6.17275 9.59536 6.16568L9.64037 5.98824L9.45843 5.96701L9.44813 5.96124ZM9.47385 3.28162C9.34609 3.22768 9.2088 3.19994 9.07012 3.2C8.93297 3.20061 8.79733 3.22879 8.67131 3.28291C8.54528 3.33703 8.43144 3.41598 8.33656 3.51501C8.23998 3.61221 8.16371 3.72764 8.11217 3.85459C8.06062 3.98154 8.03486 4.11747 8.03635 4.25448C8.03785 4.39149 8.06658 4.52684 8.12088 4.65264C8.17518 4.77844 8.25397 4.89217 8.35264 4.98724C8.44609 5.08127 8.55715 5.15598 8.67949 5.20706C8.80183 5.25813 8.93303 5.28458 9.06561 5.28491H9.07526C9.31563 5.28393 9.54827 5.1999 9.73377 5.04704C9.91928 4.89418 10.0462 4.68187 10.0931 4.44612C10.1401 4.21038 10.104 3.96566 9.99117 3.75343C9.8783 3.5412 9.69554 3.37452 9.47385 3.28162Z" fill="white"></path>
              <div class="iiev-modal-leave__info-popup">
                Your account on Wordpress.org (where you open a new support thread) is different to the one you
                login to your WordPress
                dashboard (where you are now). If you don't have a WordPress.org account yet, please sign up at the
                top right on the
                Support Forum page, and then scroll down on that page . It only takes a minute:)
                Thank you!
              </div>
          </svg></div>

        </div>
        <p class="iiev-modal-leave__text-hint">
          Just open a new ticket, you don't have to browse through existing ones
        </p>
      </div>

    </div>
    <footer class="iiev-modal-leave__footer">
      <a href="#" class="iiev-modal-leave__deactivated-link">
        I already asked – de-activate it for now
      </a>
    </footer>
  </div>

</div>
