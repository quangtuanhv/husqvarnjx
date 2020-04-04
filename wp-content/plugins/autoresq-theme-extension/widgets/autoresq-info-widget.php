<?php
/**
 * Autoresq info widget (image + text)
 *
 * @package Autoresq
 */



add_action('widgets_init', function(){
	register_widget( 'Autoresq_Info_Widget' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'underscore' );
});

// Autoresq info widget
class Autoresq_Info_Widget extends WP_Widget {

	/**
	 * Sets up the widget
	 */
	function __construct() {
		parent::__construct(
			'autoresq_info_widget', // Base ID
			esc_html__( 'Autoresq Info', 'zoutula' ), // Name
			array( 'description' => esc_html__( 'Your site\'s info Box.', 'zoutula' ) ) // Args
		);

        //available SVG images
        $autoresq_images = new Ztl_Images();
        $this->images = $autoresq_images->getAll();
        $this->images_location = $autoresq_images->getLocation();

        if ( is_active_widget( '', '', 'autoresq_info_widget' ) ) {
            // add carousel js and css
            add_action('wp_enqueue_scripts', function(){
                // make sure you get all widget settings
                $info_widget = new Autoresq_Info_Widget();
                $settings = $info_widget->get_settings();
                if ( $settings ) {
                    foreach ( $settings as $setting ) {
                        if ( isset( $setting['widget_id'] ) && ! empty( $setting['widget_id'] ) ) {
                            $css = '    .ztl-widget-info-' . esc_attr( $setting['widget_id'] ) . ' .ztl-widget-info{ max-width: ' . esc_attr( $setting['box_max_width'] ) . 'px;}
                                        .ztl-widget-info-' . esc_attr( $setting['widget_id'] ) . ' .ztl-widget-info-image{ max-width: ' . esc_attr( $setting['image_max_width'] ) . 'px; max-height: ' . esc_attr( $setting['image_max_height'] ) . 'px; margin-right:' . esc_attr( $setting['image_margin'] ) . 'px;}
                                        .ztl-widget-info-' . esc_attr( $setting['widget_id'] ) . ' .ztl-widget-info-description{ height: ' . esc_attr( $setting['image_max_height'] ) . 'px;}';
                            wp_add_inline_style( 'autoresq-style', wp_strip_all_tags( $css ) );
                        }
                    }
                }
            });
        }


	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
	    extract( $args );

		// these are our widget options
		$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '' );
        $description = isset( $instance['description'] ) ? ( $instance['description'] ) : '';
        $image_svg = isset( $instance['image_svg'] ) ? ( $instance['image_svg'] ) : '';
		$widget_id = isset( $instance['widget_id'] ) ? (int) ($instance['widget_id']) : '';

		echo wp_kses( $before_widget, array( 'aside' => array( 'class' => array(), 'id' => array() ) ) );

        $allowed_tags = array(
            'i' => array(
                'class' => array(),
                'style' => array(),
            ),
            'span' => array(
	            'style' => array(),
	            'href'=> array(),
            ),
            'a' => array(
                'style' => array(),
                'href'=> array(),
            ),
            'strong' => array(),
            'br' => array(),

        );


		?>
		<div class="ztl-widget-info-<?php echo esc_attr( $widget_id ); ?>">

			<?php
			if ( $title ) {
				echo wp_kses( $before_title, array( 'h2' => array( 'class' => array() ) ) );
				echo esc_html( $title );
				echo wp_kses( $after_title, array( 'h2' => array( 'class' => array() ) ) );
			}
			?>

			<div class="ztl-widget-info">
                <div class="ztl-widget-info-image">
                    <?php echo $image_svg; ?>
                </div>
                <span class="ztl-widget-info-description">
                    <?php echo wp_kses($description, $allowed_tags); ?>
                </span>
			</div>
			
		</div>
		<?php
		echo wp_kses( $after_widget,  array( 'aside' => array( 'class' => array(), 'id' => array() ) ) );
	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = $new_instance['description'];

		$instance['box_max_width'] = $new_instance['box_max_width'];

        $instance['image'] = $new_instance['image'];
        $instance['image_first_color'] = $new_instance['image_first_color'];
        $instance['image_second_color'] = $new_instance['image_second_color'];

		$instance['image_max_width'] = (int) ($new_instance['image_max_width']);
		$instance['image_max_height'] = (int) ($new_instance['image_max_height']);
		$instance['image_margin'] = (int) ($new_instance['image_margin']);
		$instance['widget_id'] = isset( $this->number ) ? (int) ($this->number) : 0;


		//svg folder
        $image_svg = file_get_contents($this->images_location.$instance['image']);

        //replace colors
        $image_svg = str_replace('#333333', $instance['image_first_color'] , $image_svg );
        $image_svg = str_replace('#F4C70E', $instance['image_second_color'] , $image_svg );

        $instance['image_svg'] = $image_svg;
	    return $instance;
	}


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance
	 */
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance ,
			array(
			    'title' => 'Info Box',
                'box_max_width' => '300',
                'image_first_color' => '#f4c70b',
                'image_second_color' => '#333333',
                'image_max_width' => '46',
                'image_max_height' => '46',
                'image_margin' => '40',
                'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit',
				)
		);


		$title = (isset( $instance['title'] ) ? ($instance['title']) : '');
		$box_max_width = (isset( $instance['box_max_width'] ) ? ($instance['box_max_width']) : '');
        $image = (isset( $instance['image'] ) ? ($instance['image']) : '');

        $image_svg = (isset( $instance['image_svg'] ) ? ($instance['image_svg']) : '');
        $image_first_color = (isset( $instance['image_first_color'] ) ? ($instance['image_first_color']) : '');
        $image_second_color = (isset( $instance['image_second_color'] ) ? ($instance['image_second_color']) : '');

		$image_max_width = (isset( $instance['image_max_width'] ) ? ($instance['image_max_width']) : '');
		$image_max_height = (isset( $instance['image_max_height'] ) ? ($instance['image_max_height']) : '');
		$image_margin = (isset( $instance['image_margin'] ) ? ($instance['image_margin']) : '');
		$description = (isset( $instance['description'] ) ? ($instance['description']) : '');
        ?>

		<p>
      		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title','zoutula' ); ?></label>
      		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    	</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'box_max_width' ) ); ?>"><?php esc_html_e( 'Box Max Width (px)','zoutula' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'box_max_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'box_max_width' ) ); ?>" type="number" value="<?php echo esc_attr( $box_max_width ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_first_color' ) ); ?>" style="display:block;"><?php esc_html_e( 'Image First Color:','zoutula' ); ?></label>
            <input class="widefat color-picker" id="<?php echo esc_attr( $this->get_field_id( 'image_first_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_first_color' ) ); ?>" type="text" value="<?php echo esc_attr( $image_first_color ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_second_color' ) ); ?>" style="display:block;"><?php esc_html_e( 'Image Second Color:','zoutula' ); ?></label>
            <input class="widefat color-picker" id="<?php echo esc_attr( $this->get_field_id( 'image_second_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_second_color' ) ); ?>" type="text" value="<?php echo esc_attr( $image_second_color ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image','zoutula' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>">
                <?php
                foreach ($this->images as $item) {
                    $key = str_replace('ztl-icon-','',key($item));
                    $value = reset($item);

                    if ($key.'.svg' == $image) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    echo '<option value="' . $key.'.svg' . '" ' . $selected . '>' . $value . '</option>';
                }
                ?>
            </select>
            <div style="max-width:200px; max-height:200px; margin:20px auto; background-color:#f2f2f2; ">
                <?php echo $image_svg; ?>
            </div>

        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_max_width' ) ); ?>"><?php esc_html_e( 'Image Max Width (px)','zoutula' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_max_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_max_width' ) ); ?>" type="number" value="<?php echo esc_attr( $image_max_width ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_max_height' ) ); ?>"><?php esc_html_e( 'Image Max Height (px)','zoutula' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_max_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_max_height' ) ); ?>" type="number" value="<?php echo esc_attr( $image_max_height ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_margin' ) ); ?>"><?php esc_html_e( 'Image Margin (px)','zoutula' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_margin' ) ); ?>" type="number" value="<?php echo esc_attr( $image_margin ); ?>" />
        </p>

    	<p>
      		<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description','zoutula' ); ?></label>
            <textarea rows="5" cols="10" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
    	</p>

		<hr />


        <script>
            (function($){
                'use strict';

                $(document).ready(function($){
                    //color picker
                    $('#widgets-right .widget:has(.color-picker)').each(function() {
                        initColorPicker($(this));
                    });
                });

                function initColorPicker(widget){
                    widget.find('.color-picker').wpColorPicker({
                        change: _.throttle(function(){
                            $(this).trigger('change');
                        }, 3000)
                    });
                }

                function onFormUpdate(event, widget){
                    initColorPicker(widget);
                }

                $(document).on('widget-added widget-updated', onFormUpdate);

            }(jQuery));

        </script>

    <?php
	}
}
