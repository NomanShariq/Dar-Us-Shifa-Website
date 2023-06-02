<?php

use Elementor\TemplateLibrary\Source_Base;
use ElementPack\Includes\Element_Pack_Template_Manager;


/**
 * Elementor template library remote source.
 *
 * Elementor template library remote source handler class is responsible for
 * handling remote templates from Elementor.com servers.
 */
class Element_Pack_Template_Source extends Source_Base {

	/**
	 * Get element pack prefix
	 * @return string
	 *
	 */
	public function get_prefix() {
		return 'ep_';
	}

	/**
	 * Element Pack Template ID
	 * @return string
	 */
	public function get_id() {
		return 'ep-templates';
	}

	public function get_title() {
		return __( 'Element Pack Templates', 'bdthemes-element-pack' );
	}

	public function register_data() {
	}

	/**
	 * Get remote templates.
	 *
	 * Retrieve remote templates from Element Pack servers.
	 *
	 * @access public
	 *
	 * @param array $args Optional. Nou used in remote source.
	 *
	 * @return array Remote templates.
	 */
	public function get_items( $args = [] ) {

		$template_server = Element_Pack_Template_Manager::$template_server;
		$api_route       = Element_Pack_Template_Manager::$api_route;
		$url             = $template_server . $api_route . '/templates/';
		$response        = wp_remote_get( $url, [ 'timeout' => 60 ] );
		$body            = wp_remote_retrieve_body( $response );
		$body            = json_decode( $body, true );
		$templates_data  = ! empty( $body['data'] ) ? $body['data'] : false;
		$templates       = [];

		if ( ! empty( $templates_data ) ) {
			foreach ( $templates_data as $template_data ) {
				$templates[] = $this->get_item( $template_data );
			}
		}

		if ( ! empty( $args ) ) {
			$templates = wp_list_filter( $templates, $args );
		}

		return $templates;
	}

	/**
	 * @param array $template_data
	 *
	 * @return array
	 */
	public function get_item( $template_data ) {
		return array(
			'template_id'     => $this->get_prefix() . $template_data['template_id'],
			'source'          => 'remote',
			'type'            => $template_data['type'],
			'subtype'         => $template_data['subtype'],
			'title'           => $template_data['title'],
			'thumbnail'       => $template_data['thumbnail'],
			'date'            => $template_data['date'],
			'author'          => $template_data['author'],
			'tags'            => $template_data['tags'],
			'isPro'           => ( 1 == $template_data['is_pro'] ),
			'popularityIndex' => (int) $template_data['popularity_index'],
			'trendIndex'      => (int) $template_data['trend_index'],
			'hasPageSettings' => ( 1 == $template_data['has_page_settings'] ),
			'url'             => $template_data['url'],
			'favorite'        => ( 1 == $template_data['favorite'] ),
		);
	}

	public function save_item( $template_data ) {
		return false;
	}

	public function update_item( $new_data ) {
		return false;
	}

	public function delete_template( $template_id ) {
		return false;
	}

	public function export_template( $template_id ) {
		return false;
	}

	/**
	 * Get remote template data.
	 *
	 * Retrieve the data of a single remote template from Element Pack servers.
	 *
	 * @access public
	 *
	 * @param array $args Custom template arguments.
	 * @param string $context Optional. The context. Default is `display`.
	 *
	 * @return array Remote Template data.
	 */
	public function get_data( array $args, $context = 'display' ) {

		$template_server = Element_Pack_Template_Manager::$template_server;
		$api_route       = Element_Pack_Template_Manager::$api_route;
		$id              = str_replace( $this->get_prefix(), '', $args['template_id'] );
		$final_url       = $template_server . $api_route . 'templates/' . $id . '.json';
		$response        = wp_remote_get( $final_url, [ 'timeout' => 60 ] );
		$body            = wp_remote_retrieve_body( $response );
		$body            = json_decode( $body, true );
		$data            = ! empty( $body['content'] ) ? $body['content'] : false;

		$result                  = [];
		$result['content']       = $this->replace_elements_ids( $data );
		$result['content']       = $this->process_export_import_content( $result['content'], 'on_import' );
		$result['page_settings'] = [];

		return $result;
	}
}

