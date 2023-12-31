<?php

/**
 * Content Slider Widget.
 *
 * @since 2.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Frontend;
use \Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Content_Slider_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.0.0
	 */
	public function get_name() {
		return 'sina_content_slider';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.0.0
	 */
	public function get_title() {
		return __( 'Sina Content Slider', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.0.0
	 */
	public function get_icon() {
		return 'eicon-post-slider';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.0.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.0.0
	 */
	public function get_keywords() {
		return [ 'sina slider', 'sina content slider' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.0.0
	 */
	public function get_style_depends() {
		return [
			'owl-carousel',
			'animate-merge',
			'sina-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 2.0.0
	 */
	public function get_script_depends() {
		return [
			'jquery-owl',
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.0
	 */
	protected function _register_controls() {
		// Start Slider Content
		// =====================
		$this->start_controls_section(
			'slider_content',
			[
				'label' => __( 'Slider Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'save_templates',
			[
				'label' => __( 'Use Save Templates', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$repeater->add_control(
			'template',
			[
				'label' => __( 'Choose Template', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'save_templates!' => '',
				],
				'description' => __('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext'),
			]
		);
		$repeater->add_control(
			'is_video',
			[
				'label' => __( 'Use video', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$repeater->add_control(
			'video_link',
			[
				'label' => __( 'Video Link', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter video link', 'sina-ext'),
				'condition' => [
					'save_templates' => '',
					'is_video' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter Title', 'sina-ext'),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Web Development',
				'condition' => [
					'save_templates' => '',
					'is_video' => '',
				],
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => __( 'Select Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'condition' => [
					'save_templates' => '',
					'is_video' => '',
				],
				'default' => 'h2',
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter Title', 'sina-ext'),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'condition' => [
					'save_templates' => '',
					'is_video' => '',
				],
			]
		);
		$repeater->add_control(
			'subtitle_tag',
			[
				'label' => __( 'Select Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h3',
				'condition' => [
					'save_templates' => '',
					'is_video' => '',
				],
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label' => __('Description', 'sina-ext'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'condition' => [
					'save_templates' => '',
					'is_video' => '',
				],
			]
		);
		$repeater->add_control(
			'item_styles',
			[
				'label' => __( 'Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'item_background',
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.sina-cs-item',
			]
		);
		$this->add_control(
			'slides',
			[
				'label' => __('Add Item', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Web Development',
						'subtitle' => '',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					],
					[
						'title' => 'Graphics Design',
						'subtitle' => '',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					],
					[
						'title' => 'Digital Marketing',
						'subtitle' => '',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Slider Content
		// ===================


		// Start Slider Settings
		// ========================
		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => __( 'Slider Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'show_item',
			[
				'label' => __( 'Show Item', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => __( '1', 'sina-ext' ),
					'2' => __( '2', 'sina-ext' ),
					'3' => __( '3', 'sina-ext' ),
					'4' => __( '4', 'sina-ext' ),
				],
				'desktop_default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);
		Sina_Common_Data::carousel_content( $this, '.sina-content-slider' );

		$this->end_controls_section();
		// End Slider Settings
		// =====================


		// Start Box Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => '300',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cs-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-cs-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-cs-item',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-cs-item',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-cs-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cs-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cs-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Title Style
		// ====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-cs-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '32',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '42',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
				],
				'selector' => '{{WRAPPER}} .sina-cs-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-cs-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cs-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-cs-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =================


		// Start Subtitle Style
		// =====================
		$this->start_controls_section(
			'subtitle_style',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-cs-subtitle' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '24',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '32',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-cs-subtitle',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_shadow',
				'selector' => '{{WRAPPER}} .sina-cs-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cs-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-cs-subtitle' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Subtitle Style
		// ===================


		// Start Desc Style
		// ==================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-cs-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-cs-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-cs-desc',
			]
		);
		$this->add_responsive_control(
			'desc_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'justify',
				'selectors' => [
					'{{WRAPPER}} .sina-cs-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Desc Style
		// ================


		// Start Nav & Dots Style
		// ===========================
		$this->start_controls_section(
			'nav_dots_style',
			[
				'label' => __( 'Nav & Dots', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::nav_dots_style($this, '.sina-content-slider');
		$this->end_controls_section();
		// End Nav & Dots Style
		// ==========================


		// Start Center Style
		// =====================
		$this->start_controls_section(
			'center_item_style',
			[
				'label' => __( 'Center Item', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'center!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'scale',
			[
				'label' => __( 'Scale', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .active.center.owl-item' => 'transform: scale({{SIZE}}); z-index: 2;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'center_item_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .active.center .sina-cs-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'center_item_border',
				'selector' => '{{WRAPPER}} .active.center  .sina-cs-item',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'center_item_shadow',
				'selector' => '{{WRAPPER}} .active.center  .sina-cs-item',
			]
		);

		$this->end_controls_section();
		// End Center Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-content-slider owl-carousel"
		data-item-lg="<?php echo esc_attr( $data['show_item'] ); ?>"
		data-item-md="<?php echo esc_attr( $data['show_item_tablet'] ); ?>"
		data-item-sm="<?php echo esc_attr( $data['show_item_mobile'] ); ?>"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-center="<?php echo esc_attr( $data['center'] ); ?>"
		data-slide-anim="<?php echo esc_attr( $data['slide_anim'] ); ?>"
		data-slide-anim-out="<?php echo esc_attr( $data['slide_anim_out'] ); ?>"
		data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
		data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>">

			<?php foreach ($data['slides'] as $slide): ?>
				<div class="sina-cs-item elementor-repeater-item-<?php echo esc_attr( $slide[ '_id' ] ); ?>">
					<?php
						if ( 'yes' == $slide['save_templates'] && $slide['template'] ) :
							$frontend = new Frontend;
							echo $frontend->get_builder_content( $slide['template'], true );
						elseif ( 'yes' == $slide['is_video'] && '' !== $slide['video_link'] ) :
					?>
							<a class="owl-video" href="<?php echo esc_url( $slide['video_link'] ) ?>"></a>
					<?php else: ?>
						<?php if ( $slide['title'] ): ?>
							<?php printf( '<%1$s class="%2$s">%3$s</%1$s>', $slide['title_tag'], 'sina-cs-title', $slide['title'] ); ?>
						<?php endif; ?>

						<?php if ( $slide['subtitle'] ): ?>
							<?php printf( '<%1$s class="%2$s">%3$s</%1$s>', $slide['subtitle_tag'], 'sina-cs-subtitle', $slide['subtitle'] ); ?>
						<?php endif; ?>

						<?php if ( $slide['desc'] ): ?>
							<?php printf( '<div class="sina-cs-desc">%1$s</div>', $slide['desc'] ); ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>

		</div><!-- .sina-content-slider -->
		<?php
	}


	protected function _content_template() {

	}
}