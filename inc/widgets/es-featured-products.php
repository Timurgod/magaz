<?php

class Easy_Store_Featured_Products extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_store_featured_products',
            'description'                   => __( 'Display numbers of featured products from selective categories.', 'easy-store' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_store_featured_products', __( 'ES: Featured Products', 'easy-store' ), $widget_ops );
    }

    private function widget_fields() {
        
        $fields = array(

            'section_title' => array(
                'easy_store_widgets_name'         => 'section_title',
                'easy_store_widgets_title'        => __( 'Section Title', 'easy-store' ),
                'easy_store_widgets_field_type'   => 'text'
            ),

            'section_info' => array(
                'easy_store_widgets_name'         => 'section_info',
                'easy_store_widgets_title'        => __( 'Section Info', 'easy-store' ),
                'easy_store_widgets_row'          => 5,  
                'easy_store_widgets_field_type'   => 'textarea'
            ),

            'section_post_count' => array(
                'easy_store_widgets_name'         => 'section_post_count',
                'easy_store_widgets_title'        => __( 'Product Count', 'easy-store' ),
                'easy_store_widgets_default'      => 10,  
                'easy_store_widgets_field_type'   => 'number'
            ),
        );
        return $fields;
    }

    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $easy_store_section_title  = empty( $instance['section_title'] ) ? '' : $instance['section_title'];
        $easy_store_section_info   = empty( $instance['section_info'] ) ? '' : $instance['section_info'];
        $easy_store_product_count  = empty( $instance['section_post_count'] ) ? 10 : $instance['section_post_count'];

        if( !empty( $easy_store_section_title ) || !empty( $easy_store_section_info ) ) {
            $sec_title_class = 'has-title';
        } else {
            $sec_title_class = 'no-title';
        }

        $featured_args = array(
            'post_type' => 'product',
            'posts_per_page' => absint( $easy_store_product_count ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                ),
            ),
        );
        
        $featured_query = new WP_Query( $featured_args );
        $total_post = $featured_query->post_count;

        echo $before_widget;
?>
            <div class="es-section-wrapper widget-section">
                <div class="mt-container">
                    <div class="section-title-wrapper <?php echo esc_attr( $sec_title_class ); ?>">
                        <div class="section-title-block-wrap es-clearfix">
                            <div class="section-title-block">
                                <?php
                                    if( !empty( $easy_store_section_title ) ) {
                                        echo $before_title . esc_html( $easy_store_section_title ) . $after_title;
                                    }

                                    if( !empty( $easy_store_section_info ) ) {
                                        echo '<span class="section-info">'. esc_html( $easy_store_section_info ) .'</span>';
                                    }
                                ?>
                            </div> <!-- section-title-block -->
                        </div>
                        <?php if( $total_post > 0 ) { ?>
                            <div class="carousel-nav-action">
                                <div class="es-navPrev carousel-controls"><i class="fa fa-angle-left"></i></div>
                                <div class="es-navNext carousel-controls"><i class="fa fa-angle-right"></i></div>
                            </div>
                        <?php } ?>
                    </div><!-- .section-title-wrapper -->
                    <div class="es-featured-products-wrapper featured-carousel">                        
                        <?php
                            if ( $featured_query->have_posts() ) {
                                echo '<ul class="featuredProducts cS-hidden">';
                                while ( $featured_query->have_posts() ) {
                                    $featured_query->the_post();
                                    wc_get_template_part( 'content', 'product' );
                                }
                                echo '</ul><!--.featuredProducts-->';
                            } else {
                                easy_store_no_product_found();
                            }
                            wp_reset_postdata();
                        ?>
                    </div><!-- .es-featured-products-wrapper -->
                </div><!-- .mt-container -->
            </div><!-- .es-promos-wrapper -->
<?php
        echo $after_widget;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            $instance[$easy_store_widgets_name] = easy_store_widgets_updated_field_value( $widget_field, $new_instance[$easy_store_widgets_name] );
        }

        return $instance;
    }

    public function form( $instance ) {

        $widget_fields = $this->widget_fields();

        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            if ( empty( $instance ) && isset( $easy_store_widgets_default ) ) {
                $easy_store_widgets_field_value = $easy_store_widgets_default;
            } elseif( empty( $instance ) ) {
                $easy_store_widgets_field_value = '';
            } else {
                $easy_store_widgets_field_value = wp_kses_post( $instance[$easy_store_widgets_name] );
            }
            easy_store_widgets_show_widget_field( $this, $widget_field, $easy_store_widgets_field_value );
        }
    }
}