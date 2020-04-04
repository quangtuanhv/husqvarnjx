<?php

namespace Elementor;

use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Jet_Smart_Filters_Sorting_Widget extends Widget_Base {

	public function get_name() {
		return 'jet-smart-filters-sorting';
	}

	public function get_title() {
		return __( 'Sorting Filter', 'jet-smart-filters' );
	}

	public function get_icon() {
		return 'jet-smart-filters-icon-sorting-filter';
	}

	public function get_categories() {
		return array( jet_smart_filters()->widgets->get_category() );
	}

	protected function _register_controls() {
		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/sorting/css-scheme',
			array(
				'filter'       => '.jet-sorting',
				'label'        => '.jet-sorting-label',
				'select'       => '.jet-sorting-select',
				'apply-button' => '.apply-filters__button',
			)
		);

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'Content', 'jet-smart-filters' ),
			)
		);

		$this->add_control(
			'content_provider',
			array(
				'label'   => __( 'This filter for', 'jet-smart-filters' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => jet_smart_filters()->data->content_providers(),
			)
		);

		$this->add_control(
			'epro_posts_notice',
			array(
				'type' => Controls_Manager::RAW_HTML,
				'raw'  => __( 'Please set <b>jet-smart-filters</b> into Query ID option of PRO widget you want to filter', 'jet-smart-filters' ),
				'condition' => array(
					'content_provider' => array( 'epro-posts', 'epro-archive', 'epro-portfolio', 'epro-products', 'epro-archive-products' ),
				),
			)
		);

		$this->add_control(
			'apply_type',
			array(
				'label'   => __( 'Apply type', 'jet-smart-filters' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ajax',
				'options' => array(
					'ajax'   => __( 'AJAX', 'jet-smart-filters' ),
					'reload' => __( 'Page reload', 'jet-smart-filters' ),
					'mixed'  => __( 'Mixed', 'jet-smart-filters' ),
				),
			)
		);

		$this->add_control(
			'apply_on',
			array(
				'label'     => __( 'Apply on', 'jet-smart-filters' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'value',
				'options'   => array(
					'value'  => __( 'Value change', 'jet-smart-filters' ),
					'submit' => __( 'Click on apply button', 'jet-smart-filters' ),
				),
				'condition' => array(
					'apply_type' => array( 'ajax', 'mixed' ),
				),
			)
		);

		$this->add_control(
			'apply_button',
			array(
				'label'        => esc_html__( 'Show apply button', 'jet-smart-filters' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => '',
				'label_on'     => esc_html__( 'Yes', 'jet-smart-filters' ),
				'label_off'    => esc_html__( 'No', 'jet-smart-filters' ),
				'return_value' => 'yes',
				'default'      => ''
			)
		);

		$this->add_control(
			'apply_button_text',
			array(
				'label'     => esc_html__( 'Apply button text', 'jet-smart-filters' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Apply filters', 'jet-smart-filters' ),
				'condition' => array(
					'apply_button' => 'yes'
				),
			)
		);

		$this->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'jet-smart-filters' ),
				'type'    => Controls_Manager::TEXT,
				'default' => ''
			)
		);

		$this->add_control(
			'label_block',
			array(
				'label'        => esc_html__( 'Label Block', 'jet-smart-filters' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => '',
				'label_on'     => esc_html__( 'Yes', 'jet-smart-filters' ),
				'label_off'    => esc_html__( 'No', 'jet-smart-filters' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => array(
					'label!' => ''
				)
			)
		);

		$this->add_control(
			'placeholder',
			array(
				'label'   => __( 'Placeholder', 'jet-smart-filters' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Sort...', 'jet-smart-filters' )
			)
		);

		$this->add_control(
			'query_id',
			array(
				'label'       => esc_html__( 'Query ID', 'jet-smart-filters' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'description' => __( 'Set unique query ID if you use multiple widgets of same provider on the page. Same ID you need to set for filtered widget.', 'jet-smart-filters' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_sorting_list',
			array(
				'label' => __( 'Sorting List', 'jet-smart-filters' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'jet-smart-filters' ),
				'type'    => Controls_Manager::TEXT,
				'default' => ''
			)
		);

		$repeater->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'jet-smart-filters' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => $this->orderby_options_list(),
			)
		);

		$repeater->add_control(
			'meta_key',
			array(
				'label'      => __( 'Meta key', 'jet-smart-filters' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => '',
				'condition'  => array(
					'orderby' => array( 'meta_value', 'meta_value_num' ),
				)
			)
		);

		$repeater->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'jet-smart-filters' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => array(
					'ASC'  => __( 'ASC', 'jet-smart-filters' ),
					'DESC' => __( 'DESC', 'jet-smart-filters' )
				),
				'condition'  => array(
					'orderby!' => array( 'none', 'rand' ),
				)
			)
		);

		$this->add_control(
			'sorting_list',
			array(
				'label' => __( 'Sorting List', 'jet-smart-filters' ),
				'type'  => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => array(
					array(
						'title'    => __( 'By title from lowest to highest', 'jet-smart-filters' ),
						'orderby' => 'title',
						'order'    => 'ASC'
					),
					array(
						'title'    => __( 'By title from highest to lowest', 'jet-smart-filters' ),
						'orderby' => 'title',
						'order'    => 'DESC'
					),
					array(
						'title'    => __( 'By date from lowest to highest', 'jet-smart-filters' ),
						'orderby' => 'date',
						'order'    => 'ASC'
					),
					array(
						'title'    => __( 'By date from highest to lowest', 'jet-smart-filters' ),
						'orderby' => 'date',
						'order'    => 'DESC'
					)
				),
				'title_field' => '{{{ title }}}'
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label'      => esc_html__( 'Content', 'jet-smart-filters' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_responsive_control(
			'select_width',
			array(
				'label'      => esc_html__( 'Select Width', 'jet-smart-filters' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'%',
					'px',
				),
				'range'      => array(
					'%'  => array(
						'min' => 10,
						'max' => 100,
					),
					'px' => array(
						'min' => 50,
						'max' => 400,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 150,
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['select'] => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'jet-smart-filters' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors_dictionary' => array(
					'left'   => 'justify-content: flex-start;',
					'center' => 'justify-content: center;',
					'right'  => 'justify-content: flex-end;',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['filter'] => '{{VALUE}}',
				),
				'condition' => array(
					'label_block' => ''
				)
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_select_style',
			array(
				'label' => esc_html__( 'Select', 'jet-smart-filters' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'select_typography',
				'selector' => '{{WRAPPER}} ' . $css_scheme['select'],
			)
		);

		$this->add_control(
			'select_color',
			array(
				'label'     => esc_html__( 'Text Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['select'] => 'color: {{VALUE}};'
				),
			)
		);

		$this->add_control(
			'select_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['select'] => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'select_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['select'],
				'separator'   => 'before'

			)
		);

		$this->add_control(
			'select_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'jet-smart-filters' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['select'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'select_box_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['select'],
			)
		);

		$this->add_responsive_control(
			'select_padding',
			array(
				'label'      => esc_html__( 'Padding', 'jet-smart-filters' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['select'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before'
			)
		);

		$this->add_responsive_control(
			'select_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'jet-smart-filters' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors_dictionary' => array(
					'left'   => 'align-self: flex-start;',
					'center' => 'align-self: center;',
					'right'  => 'align-self: flex-end;',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['select'] => '{{VALUE}}',
				),
				'condition' => array(
					'label_block!' => ''
				)
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			array(
				'label'      => esc_html__( 'Label', 'jet-smart-filters' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} ' . $css_scheme['label'],
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['label'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'label_margin',
			array(
				'label'      => esc_html__( 'Margin', 'jet-smart-filters' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['label'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before'
			)
		);

		$this->add_responsive_control(
			'label_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'jet-smart-filters' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors_dictionary' => array(
					'left'   => 'align-self: flex-start;',
					'center' => 'align-self: center;',
					'right'  => 'align-self: flex-end;',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['label'] => '{{VALUE}}',
				),
				'condition' => array(
					'label_block!' => ''
				)
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_apply_button_style',
			array(
				'label'      => esc_html__( 'Button', 'jet-smart-filters' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filter_apply_button_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ' . $css_scheme['apply-button'],
			)
		);

		$this->start_controls_tabs( 'filter_apply_button_style_tabs' );

		$this->start_controls_tab(
			'filter_apply_button_normal_styles',
			array(
				'label' => esc_html__( 'Normal', 'jet-smart-filters' ),
			)
		);

		$this->add_control(
			'filter_apply_button_normal_color',
			array(
				'label'     => esc_html__( 'Text Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_apply_button_normal_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'filter_apply_button_hover_styles',
			array(
				'label' => esc_html__( 'Hover', 'jet-smart-filters' ),
			)
		);

		$this->add_control(
			'filter_apply_button_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] . ':hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_apply_button_hover_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] . ':hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'filter_apply_button_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'jet-smart-filters' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] . ':hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'filter_apply_button_border_border!' => '',
				)
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'filter_apply_button_border',
				'label'       => esc_html__( 'Border', 'jet-smart-filters' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['apply-button'],
				'separator'   => 'before'
			)
		);

		$this->add_control(
			'filter_apply_button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'jet-smart-filters' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'filter_apply_button_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['apply-button'],
			)
		);

		$this->add_responsive_control(
			'filter_apply_button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'jet-smart-filters' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before'
			)
		);

		$this->add_responsive_control(
			'filter_apply_button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'jet-smart-filters' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'filter_apply_button_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'jet-smart-filters' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start'   => array(
						'title' => esc_html__( 'Left', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'  => array(
						'title' => esc_html__( 'Right', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-right',
					),
					'stretch'  => array(
						'title' => esc_html__( 'Stretch', 'jet-smart-filters' ),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['apply-button'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Retrun orderby options list
	 *
	 * @return array
	 */
	public function orderby_options_list() {
		$options_list = array(
			'none'          => __( 'No order (by ID)', 'jet-smart-filters' ),
			'rand'          => __( 'Random', 'jet-smart-filters' ),
			'author'        => __( 'Author', 'jet-smart-filters' ),
			'title'         => __( 'Title', 'jet-smart-filters' ),
			'name'          => __( 'Name (post slug)', 'jet-smart-filters' ),
			'date'          => __( 'Date', 'jet-smart-filters' ),
			'modified'      => __( 'Last modified date', 'jet-smart-filters' ),
			'comment_count' => __( 'Number of comments', 'jet-smart-filters' ),
		);

		if ( class_exists( 'WooCommerce' ) ) {
			$options_list += array(
				'price'          => __( 'Product price', 'jet-smart-filters' ),
				'sales_number'   => __( 'Product sales number', 'jet-smart-filters' ),
				'rating'         => __( 'Product rating', 'jet-smart-filters' ),
				'reviews_number' => __( 'Product reviews number', 'jet-smart-filters' ),
			);
		}

		$options_list['meta_value']     = __( 'Meta key', 'jet-smart-filters' );
		$options_list['meta_value_num'] = __( 'Meta key numeric', 'jet-smart-filters' );

		return $options_list;

	}

	/**
	 * Return apply type
	 *
	 * @return String
	 */
	public function get_apply_type($settings) {
		$apply_type = 'ajax';

		if ( 'submit' === $settings['apply_on'] && in_array( $settings['apply_type'], ['ajax', 'mixed'] ) ) {
			$apply_type = $settings['apply_type'] . '-reload';
		} else {
			$apply_type = $settings['apply_type'];
		}

		return $apply_type;
	}

	/**
	 * Sorting container data attributes
	 *
	 * @return String
	 */
	public function container_data_atts() {
		$output = '';
		$settings = $this->get_settings();

		$data_atts = array(
			'data-smart-filter'     => 'sorting',
			'data-query-type'       => 'sort',
			'data-query-var'        => 'standard',
			'data-content-provider' => ! empty( $settings['content_provider'] ) ? $settings['content_provider'] : '',
			'data-query-id'         => ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default',
			'data-apply-type'       => $this->get_apply_type( $settings ),
		);

		foreach ( $data_atts as $key => $value ) {
			$output .= sprintf( ' %1$s="%2$s"', $key, $value );
		}

		return $output;
	}

	/**
	 * Sorting select control data attributes
	 *
	 * @return String
	 */
	public function select_data_atts() {
		$output = '';
		$settings = $this->get_settings();

		if ( 'submit' === $settings['apply_on'] && in_array( $settings['apply_type'], ['ajax', 'mixed'] ) ) {
			$apply_type = $settings['apply_type'] . '-reload';
		} else {
			$apply_type = $settings['apply_type'];
		}

		$data_atts = array(
			'data-apply-provider' => ! empty( $settings['content_provider'] ) ? $settings['content_provider'] : '',
			'data-query-id'       => ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default',
			'data-apply-type'     => $this->get_apply_type( $settings ),
		);

		foreach ( $data_atts as $key => $value ) {
			$output .= sprintf( ' %1$s="%2$s"', $key, $value );
		}

		return $output;
	}

	/**
	 * Returns sorting data options
	 *
	 * @return array
	 */
	public function sorting_options() {
		$settings = $this->get_settings();
		$options  = array();
		$currentFromRequest = isset( $_REQUEST['_sort_standard'] )
			? json_decode( str_replace( '\"', '"', $_REQUEST['_sort_standard'] ), true )
			: false;

		foreach ( $settings['sorting_list'] as $option_data ) {
			$option_value = $this->option_value( $option_data );
			$option = array(
				'title' => $option_data['title'],
				'value' => htmlspecialchars( json_encode( $option_value ) )
			);

			if ( $currentFromRequest === $option_value ) {
				$option['current'] = true;
			}

			if ( !empty( $option['title'] ) && !empty( $option['value'] ) ) {
				$options[] = $option;
			}
		}

		return $options;
	}

	/**
	 * Returns option data value
	 *
	 * @param array  $option
	 * @return array
	 */
	private function option_value( $option ) {
		$output = array();

		if ( in_array( $option['orderby'], ['none', 'rand'] ) ) {
			$option['order'] = '';
		}

		foreach ( ['orderby', 'order', 'meta_key'] as $key ) {
			if ( ! empty( $option[$key] ) ) {
				$output[$key] = $option[$key];
			}
		}

		return $output;
	}

	protected function render() {
		$settings            = $this->get_settings();
		$sorting_options     = $this->sorting_options();
		$container_data_atts = $this->container_data_atts();
		$select_data_atts    = $this->select_data_atts();

		include jet_smart_filters()->get_template( 'filters/sorting.php' );

		if ( 'yes' === $settings['apply_button'] ) {
			include jet_smart_filters()->get_template( 'common/apply-filters.php' );
		}
	}

}