<?php
	
	namespace ElementPack\Modules\TwitterSlider\Widgets;
	
	use ElementPack\Base\Module_Base;
	use Elementor\Controls_Manager;
	use Elementor\Group_Control_Typography;
	use Elementor\Group_Control_Border;
	use Elementor\Group_Control_Box_Shadow;
	use Elementor\Group_Control_Css_Filter;
	
	use ElementPack\Traits\Global_Swiper_Controls;
	use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;
	use TwitterOAuth;
	
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	} // Exit if accessed directly
	
	class Twitter_Slider extends Module_Base {

		use Global_Swiper_Controls;
		
		private $_query = null;
		
		public function get_name() {
			return 'bdt-twitter-slider';
		}
		
		public function get_title() {
			return BDTEP . __( 'Twitter Slider', 'bdthemes-element-pack' );
		}
		
		public function get_icon() {
			return 'bdt-wi-twitter-slider';
		}
		
		public function get_categories() {
			return [ 'element-pack' ];
		}
		
		public function get_keywords() {
			return [ 'twitter', 'slider' ];
		}
		
		public function get_style_depends() {
			if ( $this->ep_is_edit_mode() ) {
				return [ 'ep-all-styles' ];
			} else {
				return [ 'element-pack-font', 'ep-twitter-slider' ];
			}
		}
		
		public function on_import( $element ) {
			if ( ! get_post_type_object( $element['settings']['posts_post_type'] ) ) {
				$element['settings']['posts_post_type'] = 'post';
			}
			
			return $element;
		}
		
		public function on_export( $element ) {
			$element = Group_Control_Posts::on_export_remove_setting_from_element( $element, 'posts' );
			
			return $element;
		}
		
		public function get_query() {
			return $this->_query;
		}
		
		public function get_custom_help_url() {
			return 'https://youtu.be/Bd3I7ipqMms';
		}
		
		protected function _register_controls() {
			$this->register_query_section_controls();
		}
		
		private function register_query_section_controls() {
			$this->start_controls_section(
				'section_carousel_layout',
				[
					'label' => __( 'Layout', 'bdthemes-element-pack' ),
				]
			);
			
			$this->add_control(
				'num_tweets',
				[
					'label'   => __( 'Limit', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 6,
				]
			);
			
			$this->add_control(
				'cache_time',
				[
					'label'   => __( 'Cache Time(m)', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 60,
				]
			);
			
			$this->add_control(
				'show_avatar',
				[
					'label'   => __( 'Show Avatar', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			
			$this->add_control(
				'avatar_link',
				[
					'label'     => __( 'Avatar Link', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SWITCHER,
					'condition' => [
						'show_avatar' => 'yes'
					]
				]
			);
			
			$this->add_control(
				'show_time',
				[
					'label'   => __( 'Show Time', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			
			$this->add_control(
				'long_time_format',
				[
					'label'     => __( 'Long Time Format', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => [
						'show_time' => 'yes',
					]
				]
			);
			
			
			$this->add_control(
				'show_meta_button',
				[
					'label' => __( 'Execute Buttons', 'bdthemes-element-pack' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			
			$this->add_control(
				'exclude_replies',
				[
					'label' => __( 'Exclude Replies', 'bdthemes-element-pack' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			
			$this->add_control(
				'strip_emoji',
				[
					'label' => __( 'Strip Emoji', 'bdthemes-element-pack' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			
			$this->end_controls_section();
			
			//Navigation Controls
			$this->start_controls_section(
				'section_content_navigation',
				[
					'label' => __( 'Navigation', 'bdthemes-element-pack' ),
				]
			);

			//Global Navigation Controls
			$this->register_navigation_controls();

			$this->end_controls_section();
			
			$this->start_controls_section(
				'section_content_slider_settins',
				[
					'label' => esc_html__( 'Slider Settings', 'bdthemes-element-pack' ),
				]
			);
			
			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Auto Play', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			
			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5000,
					'condition' => [
						'autoplay' => 'yes',
					],
				]
			);
			
			$this->add_control(
				'pauseonhover',
				[
					'label' => esc_html__( 'Pause on Hover', 'bdthemes-element-pack' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			
			$this->add_control(
				'speed',
				[
					'label'   => __( 'Animation Speed (ms)', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => 500,
					],
					'range'   => [
						'px' => [
							'min'  => 100,
							'max'  => 5000,
							'step' => 50,
						],
					],
				]
			);
			
			$this->add_control(
				'loop',
				[
					'label'   => esc_html__( 'Loop', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			
			$this->add_control(
				'transition',
				[
					'label'   => esc_html__( 'Transition', 'bdthemes-element-pack' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'slide',
					'options' => [
						'slide'     => esc_html__( 'Slide', 'bdthemes-element-pack' ),
						'fade'      => esc_html__( 'Fade', 'bdthemes-element-pack' ),
						'cube'      => esc_html__( 'Cube', 'bdthemes-element-pack' ),
						'coverflow' => esc_html__( 'Coverflow', 'bdthemes-element-pack' ),
						'flip'      => esc_html__( 'Flip', 'bdthemes-element-pack' ),
					],
				]
			);
			
			$this->end_controls_section();
			
			$this->start_controls_section(
				'section_style_layout',
				[
					'label' => __( 'Items', 'bdthemes-element-pack' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			
			$this->add_control(
				'item_color',
				[
					'label'     => __( 'Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-slider-item .bdt-twitter-text,
					{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-slider-item .bdt-twitter-text *' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'item_background_color',
				[
					'label'     => __( 'Background', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-slider-item .bdt-card-body' => 'background-color: {{VALUE}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'item_padding',
				[
					'label'      => __( 'Padding', 'bdthemes-element-pack' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);
			
			$this->add_control(
				'alignment',
				[
					'label'     => __( 'Alignment', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options'   => [
						'left'   => [
							'title' => __( 'Left', 'bdthemes-element-pack' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'bdthemes-element-pack' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'bdthemes-element-pack' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-slider-item .bdt-card-body' => 'text-align: {{VALUE}};',
					],
				]
			);
			
			$this->end_controls_section();
			
			$this->start_controls_section(
				'section_style_avatar',
				[
					'label'     => __( 'Avatar', 'bdthemes-element-pack' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_avatar' => 'yes',
					],
				]
			);
			
			$this->add_control(
				'avatar_width',
				[
					'label'     => __( 'Size', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 48,
							'min' => 15,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			
			$this->add_control(
				'avatar_align',
				[
					'label'     => __( 'Alignment', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'   => [
							'title' => __( 'Left', 'bdthemes-element-pack' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'bdthemes-element-pack' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'bdthemes-element-pack' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb' => 'text-align: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'avatar_background',
				[
					'label'     => __( 'Background', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper' => 'background-color: {{VALUE}};',
					],
				]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'avatar_border',
					'label'       => __( 'Border', 'bdthemes-element-pack' ),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper',
				]
			);
			
			$this->add_responsive_control(
				'avatar_border_radius',
				[
					'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper, {{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
					],
				]
			);
			
			$this->add_responsive_control(
				'avatar_padding',
				[
					'label'      => __( 'Padding', 'bdthemes-element-pack' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);
			
			$this->add_responsive_control(
				'avatar_margin',
				[
					'label'      => __( 'Margin', 'bdthemes-element-pack' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);
			
			$this->add_control(
				'avatar_opacity',
				[
					'label'     => __( 'Opacity (%)', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 1,
					],
					'range'     => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper img' => 'opacity: {{SIZE}};',
					],
				]
			);
			
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'avatar_shadow',
					'selector' => '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper',
				]
			);
			
			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name'     => 'avatar_css_filters',
					'selector' => '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper',
				]
			);
			
			$this->end_controls_section();
			
			$this->start_controls_section(
				'section_style_meta',
				[
					'label'     => __( 'Execute Buttons', 'bdthemes-element-pack' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_meta_button' => 'yes',
					],
				]
			);
			
			$this->add_control(
				'meta_color',
				[
					'label'     => __( 'Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-button > a' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'meta_hover_color',
				[
					'label'     => __( 'Hover Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-button > a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->end_controls_section();
			
			$this->start_controls_section(
				'section_style_time',
				[
					'label'     => __( 'Time', 'bdthemes-element-pack' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_time' => 'yes',
					],
				]
			);
			
			$this->add_control(
				'time_color',
				[
					'label'     => __( 'Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-wrapper a.bdt-twitter-time-link' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'time_hover_color',
				[
					'label'     => __( 'Hover Color', 'bdthemes-element-pack' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-wrapper a.bdt-twitter-time-link:hover' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->end_controls_section();

			//Navigation Style
			$this->start_controls_section(
				'section_style_navigation',
				[
					'label'      => __( 'Navigation', 'bdthemes-element-pack' ),
					'tab'        => Controls_Manager::TAB_STYLE,
					'conditions' => [
						'relation' => 'or',
						'terms'    => [
							[
								'name'     => 'navigation',
								'operator' => '!=',
								'value'    => 'none',
							],
							[
								'name'  => 'show_scrollbar',
								'value' => 'yes',
							],
						],
					],
				]
			);
			
			//Global Navigation Style Controls
            $this->register_navigation_style_controls( 'twitter-slider');

			$this->end_controls_section();
		}
		
		public function render_loop_twitter( $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $twitter_name ) {
			$settings = $this->get_settings_for_display();
			
			$name            = $twitter_name;
			$exclude_replies = ( 'yes' === $settings['exclude_replies'] ) ? true : false;
			$transName       = 'bdt-tweets-' . $name;  // Name of value in database. [added $name for multiple account use]
			$backupName      = $transName . '-backup'; // Name of backup value in database.
			
			
			if ( false === ( $tweets = get_transient( $name ) ) ) :
				
				$connection = new TwitterOAuth( $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret );
				
				// If excluding replies, we need to fetch more than requested as the
				// total is fetched first, and then replies removed.
				$totalToFetch = ( $exclude_replies ) ? max( 50, $settings['num_tweets'] * 3 ) : $settings['num_tweets'];
				
				$fetchedTweets = $connection->get(
					'statuses/user_timeline',
					array(
						'screen_name'     => $name,
						'count'           => $totalToFetch,
						'exclude_replies' => $exclude_replies
					)
				);
				
				// Did the fetch fail?
				if ( $connection->http_code != 200 ) :
					$tweets = get_option( $backupName ); // False if there has never been data saved.
				else :
					// Fetch succeeded.
					// Now update the array to store just what we need.
					// (Done here instead of PHP doing this for every page load)
					$limitToDisplay = min( $settings['num_tweets'], count( $fetchedTweets ) );
					
					for ( $i = 0; $i < $limitToDisplay; $i ++ ) :
						$tweet = $fetchedTweets[ $i ];
						
						// Core info.
						$name = $tweet->user->name;
						// COMMUNITY REQUEST !!!!!! (2)
						$screen_name = $tweet->user->screen_name;
						$permalink   = 'https://twitter.com/' . $screen_name . '/status/' . $tweet->id_str;
						$tweet_id    = $tweet->id_str;
						
						/* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
						//  Check for SSL via protocol https then display relevant image - thanks SO - this should do
						if ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) {
							// $protocol = 'https://';
							$image = $tweet->user->profile_image_url_https;
						} else {
							// $protocol = 'http://';
							$image = $tweet->user->profile_image_url;
						}
						
						// Process Tweets - Use Twitter entities for correct URL, hash and mentions
						$text = element_pack_twitter_process_links( $tweet );
						
						// lets strip 4-byte emojis
						if ( $settings['strip_emoji'] == 'yes' ) {
							$text = element_pack_strip_emoji( $text );
						}
						
						// Need to get time in Unix format.
						$time  = $tweet->created_at;
						$time  = date_parse( $time );
						$uTime = mktime( $time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year'] );
						
						// Now make the new array.
						$tweets[] = array(
							'text'      => $text,
							'name'      => $name,
							'permalink' => $permalink,
							'image'     => $image,
							'time'      => $uTime,
							'tweet_id'  => $tweet_id
						);
					endfor;
					
					set_transient( $transName, $tweets, 60 * $settings['cache_time'] );
					update_option( $backupName, $tweets );
				endif;
			endif;
			
			?>
			
			<?php
			
			// Now display the tweets, if we can.
			if ( $tweets ) : ?>
				<?php foreach ( (array) $tweets as $t ) : // casting array to array just in case it's empty - then prevents PHP warning ?>
                    <div class="bdt-twitter-slider-item swiper-slide">
                        <div class="bdt-card">
                            <div class="bdt-card-body">
								<?php if ( 'yes' === $settings['show_avatar'] ) : ?>
									
									<?php if ( 'yes' === $settings['avatar_link'] ) : ?>
                                        <a href="https://twitter.com/<?php echo esc_attr( $name ); ?>">
									<?php endif; ?>

                                    <div class="bdt-twitter-thumb">
                                        <div class="bdt-twitter-thumb-wrapper">
                                            <img src="<?php echo esc_url( $t['image'] ); ?>"
                                                 alt="<?php echo esc_html( $t['name'] ); ?>"/>
                                        </div>
                                    </div>
									
									<?php if ( 'yes' === $settings['avatar_link'] ) : ?>
                                        </a>
									<?php endif; ?>
								
								<?php endif; ?>

                                <div class="bdt-twitter-text bdt-clearfix">
									<?php echo wp_kses_post( $t['text'] ); ?>
                                </div>

                                <div class="bdt-twitter-meta-wrapper">
									
									<?php if ( 'yes' === $settings['show_time'] ) : ?>
                                        <a href="<?php echo esc_url( $t['permalink'] ); ?>" target="_blank"
                                           class="bdt-twitter-time-link">
											<?php
												// Original - long time ref: hours...
												if ( 'yes' === $settings['long_time_format'] ) {
													// New - short Twitter style time ref: h...
													$timeDisplay = human_time_diff( $t['time'], current_time( 'timestamp' ) );
												} else {
													$timeDisplay = element_pack_time_diff( $t['time'], current_time( 'timestamp' ) );
												}
												$displayAgo = _x( 'ago', 'leading space is required', 'bdthemes-element-pack' );
												// Use to make il8n compliant
												printf( __( '%1$s %2$s', 'bdthemes-element-pack' ), $timeDisplay, $displayAgo );
											?>
                                        </a>
									<?php endif; ?>
									
									
									<?php if ( 'yes' === $settings['show_meta_button'] ) : ?>
                                        <div class="bdt-twitter-meta-button">
                                            <a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo esc_url( $t['tweet_id'] ); ?>"
                                               data-lang="en" class="bdt-tmb-reply"
                                               title="<?php _e( 'Reply', 'bdthemes-element-pack' ); ?>" target="_blank">
                                                <i class="ep-icon-reply" aria-hidden="true"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/retweet?tweet_id=<?php echo esc_url( $t['tweet_id'] ); ?>"
                                               data-lang="en" class="bdt-tmb-retweet"
                                               title="<?php _e( 'Retweet', 'bdthemes-element-pack' ); ?>"
                                               target="_blank">
                                                <i class="ep-icon-refresh" aria-hidden="true"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/favorite?tweet_id=<?php echo esc_url( $t['tweet_id'] ); ?>"
                                               data-lang="en" class="bdt-tmb-favorite"
                                               title="<?php _e( 'Favourite', 'bdthemes-element-pack' ); ?>"
                                               target="_blank">
                                                <i class="ep-icon-star" aria-hidden="true"></i>
                                            </a>
                                        </div>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endforeach;
			endif;
		}
		
		public function render() {
			
			if ( ! class_exists( 'TwitterOAuth' ) ) {
				include BDTEP_PATH . 'includes/twitteroauth/twitteroauth.php';
			}
			
			$settings = $this->get_settings_for_display();
			$options  = get_option( 'element_pack_api_settings' );
			
			$consumerKey       = ( ! empty( $options['twitter_consumer_key'] ) ) ? $options['twitter_consumer_key'] : '';
			$consumerSecret    = ( ! empty( $options['twitter_consumer_secret'] ) ) ? $options['twitter_consumer_secret'] : '';
			$accessToken       = ( ! empty( $options['twitter_access_token'] ) ) ? $options['twitter_access_token'] : '';
			$accessTokenSecret = ( ! empty( $options['twitter_access_token_secret'] ) ) ? $options['twitter_access_token_secret'] : '';
			$twitter_name      = ( ! empty( $options['twitter_name'] ) ) ? $options['twitter_name'] : '';
			
			$this->render_loop_header();
			
			if ( $consumerKey and $consumerSecret and $accessToken and $accessTokenSecret ) {
				$this->render_loop_twitter( $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $twitter_name );
			} else {
				?>
                <div class="bdt-alert-warning" bdt-alert>
                    <a class="bdt-alert-close" bdt-close></a>
					<?php $ep_setting_url = esc_url( admin_url( 'admin.php?page=element_pack_options#element_pack_api_settings' ) ); ?>
                    <p><?php printf( __( 'Please set your twitter API settings from here <a href="%s">element pack settings</a> to show your map correctly.', 'bdthemes-element-pack' ), $ep_setting_url ); ?></p>
                </div>
				<?php
			}
			
			$this->render_footer();
		}
		
		protected function render_loop_header() {
			$id       = 'bdt-twitter-slider-' . $this->get_id();
			$settings = $this->get_settings_for_display();
			
			$this->add_render_attribute( 'slider', 'id', $id );
			$this->add_render_attribute( 'slider', 'class', 'bdt-twitter-slider bdt-carousel' );
			
			if ( 'arrows' == $settings['navigation'] ) {
				$this->add_render_attribute( 'slider', 'class', 'bdt-arrows-align-' . $settings['arrows_position'] );
			} elseif ( 'dots' == $settings['navigation'] ) {
				$this->add_render_attribute( 'slider', 'class', 'bdt-dots-align-' . $settings['dots_position'] );
			} elseif ( 'both' == $settings['navigation'] ) {
				$this->add_render_attribute( 'slider', 'class', 'bdt-arrows-dots-align-' . $settings['both_position'] );
			} elseif ( 'arrows-fraction' == $settings['navigation'] ) {
				$this->add_render_attribute( 'slider', 'class', 'bdt-arrows-dots-align-' . $settings['arrows_fraction_position'] );
			}
			
			if ( 'arrows-fraction' == $settings['navigation'] ) {
				$pagination_type = 'fraction';
			} elseif ( 'both' == $settings['navigation'] or 'dots' == $settings['navigation'] ) {
				$pagination_type = 'bullets';
			} elseif ( 'progressbar' == $settings['navigation'] ) {
				$pagination_type = 'progressbar';
			} else {
				$pagination_type = '';
			}
			
			$this->add_render_attribute(
				[
					'slider' => [
						'data-settings' => [
							wp_json_encode( array_filter( [
								'autoplay'     => ( 'yes' == $settings['autoplay'] ) ? [ 'delay' => $settings['autoplay_speed'] ] : false,
								'loop'         => ( $settings['loop'] == 'yes' ) ? true : false,
								'speed'        => $settings['speed']['size'],
								'pauseOnHover' => ( 'yes' == $settings['pauseonhover'] ) ? true : false,
								'effect'       => $settings['transition'],
								'navigation'   => [
									'nextEl' => '#' . $id . ' .bdt-navigation-next',
									'prevEl' => '#' . $id . ' .bdt-navigation-prev',
								],
								"pagination"   => [
									"el"             => "#" . $id . " .swiper-pagination",
									"type"           => $pagination_type,
									"clickable"      => "true",
									'autoHeight'     => true,
									'dynamicBullets' => ( "yes" == $settings["dynamic_bullets"] ) ? true : false,
								],
								"scrollbar"    => [
									"el"   => "#" . $id . " .swiper-scrollbar",
									"hide" => "true",
								],
							] ) )
						]
					]
				]
			);
			
			?>
            <div <?php echo $this->get_render_attribute_string( 'slider' ); ?>>
            <div class="swiper-container">
            <div class="swiper-wrapper">
			<?php
		}
		
	}
