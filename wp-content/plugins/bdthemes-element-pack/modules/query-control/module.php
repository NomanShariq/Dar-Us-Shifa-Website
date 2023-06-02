<?php
    
    namespace ElementPack\Modules\QueryControl;
    
    use Elementor\Controls_Manager;
    use Elementor\Utils;
    use ElementPack\Base\Module_Base;
    use Elementor\Core\Common\Modules\Ajax\Module as Ajax;
    use ElementPack\Base\Element_Pack_Module_Base;
    use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;
    use ElementPack\Modules\QueryControl\Controls\Query;
    use ElementPack\Element_Pack_Loader;
    use Exception;
    use WP_Query;
    use WP_Term;
    use WP_User_Query;

    if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class Module extends Element_Pack_Module_Base {
        
        const QUERY_CONTROL_ID = 'query';
        
        public function __construct() {
            parent::__construct();
            
            $this->add_actions();
        }
        
        public function get_name() {
            return 'query-control';
        }
        
        public function ajax_posts_control_value_titles($request) {
            $ids = (array)$request['id'];
            
            $results = [];
            
            switch ($request['filter_type']) {
                case 'taxonomy':
                    $terms = get_terms(
                        [
                            'include'    => $ids,
                            'hide_empty' => false,
                        ]
                    );
                    
                    foreach ( $terms as $term ) {
                        $results[$term->term_id] = $term->name;
                    }
                    break;
                
                case 'by_id':
                case 'post':
                    $query = new WP_Query(
                        [
                            'post_type'      => 'any',
                            'post__in'       => $ids,
                            'posts_per_page' => -1,
                        ]
                    );
                    
                    foreach ( $query->posts as $post ) {
                        $results[$post->ID] = $post->post_title;
                    }
                    break;
                
                case 'author':
                    $query_params = [
                        'who'                 => 'authors',
                        'has_published_posts' => true,
                        'fields'              => [
                            'ID',
                            'display_name',
                        ],
                        'include'             => $ids,
                    ];
                    
                    $user_query = new WP_User_Query( $query_params );
                    
                    foreach ( $user_query->get_results() as $author ) {
                        $results[$author->ID] = $author->display_name;
                    }
                    break;
                default:
                    $results = apply_filters( 'elementor/query/get_value_titles/' . $request['filter_type'], [], $request );
            }
            
            return $results;
        }
        
        
        public function ajax_posts_filter_autocomplete(array $data) {
            if ( empty( $data['filter_type'] ) || empty( $data['q'] ) ) {
                throw new Exception( 'Bad Request' );
            }
            
            $results = [];
            
            switch ($data['filter_type']) {
                case 'taxonomy':
                    $query_params = [
                        'taxonomy'   => $this->extract_post_type( $data ),
                        'search'     => $data['q'],
                        'hide_empty' => false,
                    ];
                    
                    $terms = get_terms( $query_params );
                    
                    global $wp_taxonomies;
                    
                    foreach ( $terms as $term ) {
                        $term_name = $this->get_term_name_with_parents( $term );
                        if ( !empty( $data['include_type'] ) ) {
                            $text = $wp_taxonomies[$term->taxonomy]->labels->singular_name . ': ' . $term_name;
                        } else {
                            $text = $term_name;
                        }
                        
                        $results[] = [
                            'id'   => $term->term_id,
                            'text' => $text,
                        ];
                    }
                    
                    break;
                
                case 'by_id':
                case 'post':
                    $query_params = [
                        'post_type'      => $this->extract_post_type( $data ),
                        's'              => $data['q'],
                        'posts_per_page' => -1,
                    ];
                    
                    if ( 'attachment' === $query_params['post_type'] ) {
                        $query_params['post_status'] = 'inherit';
                    }
                    
                    $query = new WP_Query( $query_params );
                    
                    foreach ( $query->posts as $post ) {
                        $post_type_obj = get_post_type_object( $post->post_type );
                        if ( !empty( $data['include_type'] ) ) {
                            $text = $post_type_obj->labels->singular_name . ': ' . $post->post_title;
                        } else {
                            $text = ( $post_type_obj->hierarchical ) ? $this->get_post_name_with_parents( $post ) : $post->post_title;
                        }
                        
                        $results[] = [
                            'id'   => $post->ID,
                            'text' => $text,
                        ];
                    }
                    break;
                
                case 'author':
                    $query_params = [
                        'who'                 => 'authors',
                        'has_published_posts' => true,
                        'fields'              => [
                            'ID',
                            'display_name',
                        ],
                        'search'              => '*' . $data['q'] . '*',
                        'search_columns'      => [
                            'user_login',
                            'user_nicename',
                        ],
                    ];
                    
                    $user_query = new WP_User_Query( $query_params );
                    
                    foreach ( $user_query->get_results() as $author ) {
                        $results[] = [
                            'id'   => $author->ID,
                            'text' => $author->display_name,
                        ];
                    }
                    break;
                default:
                    $results = apply_filters( 'elementor/query/get_autocomplete/' . $data['filter_type'], [], $data );
            } // End switch().
            
            return [
                'results' => $results,
            ];
        }
    
        private function get_term_name_with_parents( WP_Term $term, $max = 3 ) {
            if ( 0 === $term->parent ) {
                return $term->name;
            }
            $separator = is_rtl() ? ' < ' : ' > ';
            $test_term = $term;
            $names = [];
            while ( $test_term->parent > 0 ) {
                $test_term = get_term( $test_term->parent );
                if ( ! $test_term ) {
                    break;
                }
                $names[] = $test_term->name;
            }
        
            $names = array_reverse( $names );
            if ( count( $names ) < ( $max ) ) {
                return implode( $separator, $names ) . $separator . $term->name;
            }
        
            $name_string = '';
            for ( $i = 0; $i < ( $max - 1 ); $i++ ) {
                $name_string .= $names[ $i ] . $separator;
            }
            return $name_string . '...' . $separator . $term->name;
        }
        
        public function register_controls() {
            $controls_manager = Element_Pack_Loader::elementor()->controls_manager;
            
            $controls_manager->add_group_control( Group_Control_Posts::get_type(), new Group_Control_Posts() );
            
            $controls_manager->register_control( self::QUERY_CONTROL_ID, new Query() );
	
        }
        
        public static function get_query_args($control_id, $settings) {
            $defaults = [
                $control_id . '_post_type' => 'post',
                $control_id . '_posts_ids' => [],
                'orderby'                  => 'date',
                'order'                    => 'desc',
                'posts_per_page'           => 3,
                'offset'                   => 0,
            ];
            
            
            $settings = wp_parse_args( $settings, $defaults );
            
            $post_type = $settings[$control_id . '_post_type'];
            
            if ( get_query_var( 'paged' ) ) {
                $paged = get_query_var( 'paged' );
            } elseif ( get_query_var( 'page' ) ) {
                $paged = get_query_var( 'page' );
            } else {
                $paged = 1;
            }
            
            $query_args = [
                'orderby'             => $settings['orderby'],
                'order'               => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status'         => 'publish', // Hide drafts/private posts for admins
                'paged'               => $paged
            ];
            
            if ( 'by_id' === $post_type ) {
                $query_args['post_type'] = 'any';
                $query_args['post__in'] = $settings[$control_id . '_posts_ids'];
                
                if ( empty( $query_args['post__in'] ) ) {
                    // If no selection - return an empty query
                    $query_args['post__in'] = [0];
                }
            } else {
                $query_args['post_type'] = $post_type;
                $query_args['posts_per_page'] = $settings['posts_per_page'];
                $query_args['tax_query'] = [];
                
                if ( 0 < $settings['offset'] ) {
                    $query_args['offset_to_fix'] = $settings['offset'];
                }
                
                $taxonomies = get_object_taxonomies( $post_type, 'objects' );
                
                foreach ( $taxonomies as $object ) {
                    $setting_key = $control_id . '_' . $object->name . '_ids';
                    
                    if ( !empty( $settings[$setting_key] ) ) {
                        $query_args['tax_query'][] = [
                            'taxonomy' => $object->name,
                            'field'    => 'term_id',
                            'terms'    => $settings[$setting_key],
                        ];
                    }
                }
            }
            
            return $query_args;
        }
        
        private function get_post_name_with_parents($post, $max = 3) {
            if ( 0 === $post->post_parent ) {
                return $post->post_title;
            }
            $separator = is_rtl() ? ' < ' : ' > ';
            $test_post = $post;
            $names = [];
            while ( $test_post->post_parent > 0 ) {
                $test_post = get_post( $test_post->post_parent );
                if ( !$test_post ) {
                    break;
                }
                $names[] = $test_post->post_title;
            }
            
            $names = array_reverse( $names );
            if ( count( $names ) < ( $max ) ) {
                return implode( $separator, $names ) . $separator . $post->post_title;
            }
            
            $name_string = '';
            for ( $i = 0; $i < ( $max - 1 ); $i++ ) {
                $name_string .= $names[$i] . $separator;
            }
            return $name_string . '...' . $separator . $post->post_title;
        }
        
        private function extract_post_type($data) {
            
            if ( !empty( $data['query'] ) && !empty( $data['query']['post_type'] ) ) {
                return $data['query']['post_type'];
            }
            
            return $data['object_type'];
        }
        
        /**
         * @param WP_Query $query
         */
        function fix_query_offset(&$query) {
            if ( !empty( $query->query_vars['offset_to_fix'] ) ) {
                if ( $query->is_paged ) {
                    $query->query_vars['offset'] = $query->query_vars['offset_to_fix'] + ( ( $query->query_vars['paged'] - 1 ) * $query->query_vars['posts_per_page'] );
                } else {
                    $query->query_vars['offset'] = $query->query_vars['offset_to_fix'];
                }
            }
        }
        
        /**
         * @param int $found_posts
         * @param WP_Query $query
         *
         * @return mixed
         */
        function fix_query_found_posts($found_posts, $query) {
            $offset_to_fix = $query->get( 'fix_pagination_offset' );
            
            if ( $offset_to_fix ) {
                $found_posts -= $offset_to_fix;
            }
            
            return $found_posts;
        }
        
        public function register_ajax_actions($ajax_manager) {
            $ajax_manager->register_ajax_action( 'query_control_value_titles', [$this, 'ajax_posts_control_value_titles'] );
            $ajax_manager->register_ajax_action( 'pro_panel_posts_control_filter_autocomplete', [$this, 'ajax_posts_filter_autocomplete'] );
        }
        
        
        protected function add_actions() {
            add_action( 'elementor/ajax/register_actions', [$this, 'register_ajax_actions'] );
            add_action( 'elementor/controls/controls_registered', [$this, 'register_controls'] );
            add_action( 'pre_get_posts', [$this, 'fix_query_offset'], 1 );
            add_filter( 'found_posts', [$this, 'fix_query_found_posts'], 1, 2 );
        }
    }

