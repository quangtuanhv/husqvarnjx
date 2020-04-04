<?php
/**
 * Widget - WooCommerce Vehicle Parts Finder - VPF ( YMM ) Terms
 *
 * @class WOO_VPF_YMM_Widget_Filter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Vehicle Parts Finder - VPF ( YMM ) Terms Widget
 */
class WOO_VPF_YMM_Widget_Filter extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woo_vpf_ymm widget_woo_vpf_ymm_filter';
		$this->widget_description = __( "Display the VPF ( YMM ) Terms/Category/Keyword based filter in the sidebar.", WOO_VPF_YMM_TEXT_DOMAIN );
		$this->widget_id          = 'woo_vpf_ymm_filter';
		$this->widget_name        = __( 'WooCommerce Vehicle Parts Finder - VPF ( YMM ) Terms', WOO_VPF_YMM_TEXT_DOMAIN );
		$this->settings           = array(
			'title'  		=> array(
				'type'		=> 'text',
				'std'		=> __( 'Vehicle Parts Filter', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Title', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'view'			=> array(
				'type'		=> 'select',
				'std'		=> 'V',
				'label'		=> __( 'View', WOO_VPF_YMM_TEXT_DOMAIN ),
				'options'	=> array(
					'H'		=> __( 'Horizontal', WOO_VPF_YMM_TEXT_DOMAIN ),
					'V'		=> __( 'Vertical', WOO_VPF_YMM_TEXT_DOMAIN ),
				)
			),
			
			'label_year'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Select Year', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Year Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_make'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Select Make', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Make Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'show_model'	=> array(
				'type'		=> 'checkbox',
				'std'		=> '1',
				'label'		=> __( 'Show Models Filter?', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_model'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Select Model', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Model Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'show_engine'	=> array(
				'type'		=> 'checkbox',
				'std'		=> '',
				'label'		=> __( 'Show Engines Filter?', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_engine'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Select Engine', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Engine Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'show_category'	=> array(
				'type'		=> 'checkbox',
				'std'		=> '',
				'label'		=> __( 'Show Categories Filter?', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_category'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Select Category', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Category Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'show_keyword'	=> array(
				'type'		=> 'checkbox',
				'std'		=> '1',
				'label'		=> __( 'Show Keyword Filter?', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_keyword'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Product Name', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Keyword Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'show_my_vehicles'	=> array(
				'type'		=> 'checkbox',
				'std'		=> '',
				'label'		=> __( 'Show My Vehicles Widget?', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_search'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Search', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Search Button Label', WOO_VPF_YMM_TEXT_DOMAIN )
			),
			
			'label_reset_search'	=> array(
				'type'		=> 'text',
				'std'		=> __( 'Reset Search', WOO_VPF_YMM_TEXT_DOMAIN ),
				'label'		=> __( 'Reset Search Label', WOO_VPF_YMM_TEXT_DOMAIN )
			)
		);
		
		$widget_ops = array(
			'classname'   => $this->widget_cssclass,
			'description' => $this->widget_description
		);

		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );
		WOO_VPF_YMM_Functions::get_filter_widget_template( $instance );
		$this->widget_end( $args );
	}
	
	/**
	 * Output the html at the start of a widget
	 *
	 * @param  array $args
	 * @return string
	 */
	public function widget_start( $args, $instance ) {
		echo $args['before_widget'];

		if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
	}

	/**
	 * Output the html at the end of a widget
	 *
	 * @param  array $args
	 * @return string
	 */
	public function widget_end( $args ) {
		echo $args['after_widget'];
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( empty( $this->settings ) ) {
			return $instance;
		}

		foreach ( $this->settings as $key => $setting ) {

			if ( isset( $new_instance[ $key ] ) ) {
				$instance[ $key ] = sanitize_text_field( $new_instance[ $key ] );
			} elseif ( 'checkbox' === $setting['type'] ) {
				$instance[ $key ] = 0;
			}
		}

		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	public function form( $instance ) {

		if ( empty( $this->settings ) ) {
			return;
		}

		foreach ( $this->settings as $key => $setting ) {

			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			switch ( $setting['type'] ) {

				case 'text' :
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
				break;

				case 'number' :
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
				break;

				case 'select' :
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
				break;

				case 'checkbox' :
					?>
					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
					</p>
					<?php
				break;
			}
		}
	}
}

/**
 * Register Widget
 */
function woo_vpf_ymm_register_widget_filter() {
	register_widget( 'WOO_VPF_YMM_Widget_Filter' );
}
add_action( 'widgets_init', 'woo_vpf_ymm_register_widget_filter' );
