<?php

class Easy_Store_Advance_Product_Search extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 
            'classname' => 'easy_store_advance_product_search',
            'description' => __( 'About search product in specific categories.', 'easy-store' )
        );
        parent::__construct( 'easy_store_advance_product_search', __( 'ES: Advance Product Search', 'easy-store' ), $widget_ops );
    }

    private function widget_fields() {
        
        $fields = array(

            'search_placeholder' => array(
                'easy_store_widgets_name'         => 'search_placeholder',
                'easy_store_widgets_title'        => __( 'Placeholder', 'easy-store' ),
                'easy_store_widgets_default'      => __( 'Search Product', 'easy-store' ),
                'easy_store_widgets_field_type'   => 'text'
            )
        );
        return $fields;
    }

    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $easy_store_search_placeholder  = empty( $instance['search_placeholder'] ) ? __( 'Search Product', 'easy-store' ) : $instance['search_placeholder'];

        echo $before_widget;
    ?>
            <div class="es-advance-product-search-wrapper">
                <div class="advance-product-search">
                    <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $woo_terms = get_terms( array(
                            'taxonomy'   => 'product_cat',
                            'hide_empty' => true,
                            'parent'     => 0,
                        ) );
                        if (  ! empty( $woo_terms ) && ! is_wp_error( $woo_terms ) ) {
                            $select_cat = ( isset( $_GET['product_category'] ) ) ? absint( $_GET['product_category'] ) : '' ;
                    ?>
                            <select class="es-select-products" name="product_category">
                                <option value=""><?php esc_html_e( 'All Categories', 'easy-store' ); ?></option>
                                <?php foreach ( $woo_terms as $cat ) { ?>
                                    <option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $select_cat, $cat->term_id ); ?> ><?php echo esc_html( $cat->name ); ?></option>
                                <?php } ?>
                            </select>
                    <?php } ?>
                        <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr( $easy_store_search_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button class="fa fa-search searchsubmit" type="submit"></button>
                        <input type="hidden" name="post_type" value="product" />
                    </form><!-- .woocommerce-product-search -->
                </div><!-- .advance-product-search -->
            </div><!-- .es-advance-product-search-wrapper -->
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