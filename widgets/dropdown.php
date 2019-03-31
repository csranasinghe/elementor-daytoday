<?php
namespace ElementorHelloWorld\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Dropdown extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Dropdown';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Dropdown', 'elementor-daytoday' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Dropdown', 'elementor-daytoday' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'elementor-hello-world' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor-daytoday' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'elementor-daytoday' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor-daytoday' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor-daytoday' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor-daytoday' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);

		
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'link_title', [
				'label' => __( 'Label', 'elementor-daytoday' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'URL Label' , 'elementor-daytoday' ),
				'label_block' => true,
			]
	);

			$repeater->add_control(
			'link',
			[
				'label' => __( 'URL', 'elementor-daytoday' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'elementor-daytoday' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => false,
				],
			]
		);

		


		$this->add_control(
			'linklist',
			[
				'label' => __( 'Dropdown Items', 'elementor-daytoday'  ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'link_title' => __( '', 'elementor-daytoday' ),
						'link' => __( '', 'elementor-daytoday' ),
					],
					
				],
				'title_field' => '{{{ link_title }}}',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Styles', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .dropbtn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Title Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .dropbtn' => 'background-color: {{VALUE}}',
				],
			]
		);		


		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['linklist'] ) {
			echo '<div class="elementor-dropdown">'; 
			echo '<button class="dropbtn">'. $settings['title'] .'</button><div class="dropdown-content">';
			foreach (  $settings['linklist'] as $item ) {
				echo ' <a target="_self" href="' . $item['link']['url'] . '">' . $item['link_title'] . '</a>';
				
			}
			echo '</div></div>';
		}
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
	
	<# if ( settings.linklist.length ) { #>
		<div class="dropdown">
			<button class="dropbtn">{{{ settings.title }}}</button>
			<div class="dropdown-content">
			<# _.each( settings.linklist, function( item ) { #>
				<a target="_self" href="{{item.link.url}}"> {{{item.link_title}}} </a>			
			<# }); #>
		</div>
		</div>	
		<# } #>
		<?php
	}
}
