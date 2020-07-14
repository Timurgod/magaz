<?php

function easy_store_sidebar_callback( $post ) {

    $easy_store_page_sidebar_option = array(
        'default-sidebar' => array(
            'id'        => 'post-default-sidebar',
            'value'     => 'default_sidebar',
            'label'     => __( 'Default Sidebar', 'easy-store' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
        ),
        'left-sidebar' => array(
            'id'        => 'post-right-sidebar',
            'value'     => 'left_sidebar',
            'label'     => __( 'Left sidebar', 'easy-store' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
        ),
        'right-sidebar' => array(
            'id'        => 'post-left-sidebar',
            'value'     => 'right_sidebar',
            'label'     => __( 'Right sidebar', 'easy-store' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
        ),
        'no-sidebar'    => array(
            'id'        => 'post-no-sidebar',
            'value'     => 'no_sidebar',
            'label'     => __( 'No sidebar Full width', 'easy-store' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
        ),
        'no-sidebar-center' => array(
            'id'        => 'post-no-sidebar-center',
            'value'     => 'no_sidebar_center',
            'label'     => __( 'No sidebar Content Centered', 'easy-store' ),
            'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
        )
    );

    $sidebar_layout = get_post_meta( $post->ID, 'easy_store_sidebar_layout', true );

    $sidebar_layout = ( $sidebar_layout ) ? $sidebar_layout : 'default_sidebar';

    wp_nonce_field( 'easy_store_nonce_' . basename( __FILE__ ) , 'easy_store_sidebar_layout_nonce' );
    ?>
        <div class="es-meta-options-wrap">
            <div class="buttonset">
                <?php
                    foreach ( $easy_store_page_sidebar_option as $field ) {
                        $sidebar_layout = get_post_meta( $post->ID, 'easy_store_sidebar_layout', true );
                        $sidebar_layout = ( $sidebar_layout ) ? $sidebar_layout : 'default_sidebar';
                ?>
                        <input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="easy_store_sidebar_layout" <?php checked( $field['value'], $sidebar_layout ); ?> />
                        <label for="<?php echo esc_attr( $field['id'] ); ?>">
                            <span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                        </label>
                    
                <?php } ?>
            </div><!-- .buttonset -->
        </div><!-- .es-meta-options-wrap  -->
    <?php
}

