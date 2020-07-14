<?php

class Easy_Store_Category_Products extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_store_category_products',
            'description'                   => __( 'Display WooCommerce product lists from selected category.', 'easy-store' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_store_category_products', __( 'ES: Category Products', 'easy-store' ), $widget_ops );
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
                'easy_store_widgets_field_type'   => 'text'
            ),

            'section_cat_slug' => array(
                'easy_store_widgets_name'         => 'section_cat_slug',
                'easy_store_widgets_title'        => __( 'Select Category', 'easy-store' ),
                'easy_store_widgets_default'      => '',
                'easy_store_widgets_field_type'   => 'woo_category_dropdown'
            ),

            'section_post_count' => array(
                'easy_store_widgets_name'         => 'section_post_count',
                'easy_store_widgets_title'        => __( 'Product Count', 'easy-store' ),
                'easy_store_widgets_default'          => 8,  
                'easy_store_widgets_field_type'   => 'number'
            )
        );
        return $fields;
    }

    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $easy_store_section_title    = empty( $instance['section_title'] ) ? '' : $instance['section_title'];
        $easy_store_section_info     = empty( $instance['section_info'] ) ? '' : $instance['section_info'];
        $easy_store_section_cat_slug = empty( $instance['section_cat_slug'] ) ? '' : $instance['section_cat_slug'];
        $easy_store_product_count    = empty( $instance['section_post_count'] ) ? 8 : $instance['section_post_count'];

        if( !empty( $easy_store_section_title ) || !empty( $easy_store_section_info ) ) {
            $sec_title_class = 'has-title';
        } else {
            $sec_title_class = 'no-title';
        }

        $product_args = array(
            'post_type'      => 'product',
            'product_cat'    => esc_attr( $easy_store_section_cat_slug ),
            'posts_per_page' => absint( $easy_store_product_count )            
        );

        $product_query = new WP_Query( $product_args );

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
                    </div>
                    <div class="es-cat-products-wrapper">                        
                        <?php
                            if ( $product_query->have_posts() ) {
                                while ( $product_query->have_posts() ) {
                                    $product_query->the_post();
                                    wc_get_template_part( 'content', 'product' );
                                }
                            } else {
                                easy_store_no_product_found();
                            }
                            wp_reset_postdata();
                        ?>
                    </div><!-- .es-featured-items-wrapper -->
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