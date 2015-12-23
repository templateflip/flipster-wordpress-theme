<?php

/* Load Kirki customizer framework */
include_once dirname( __FILE__ ) . '/options/kirki.php';


/* Early exit if Kirki is not installed */
if ( ! class_exists( 'Kirki' ) ) {
    return;
}

/* Register Kirki config */
Kirki::add_config( 'shamrock_settings', array(
        'capability'    => 'edit_theme_options',
        'option_type' => 'theme_mod',
    ) );

/* Header options */

Kirki::add_section( 'shamrock_header', array(
        'priority'    => 101,
        'title'       => __( 'Header', 'shamrock' ),
        'description'    => __( 'These are setting for your website header/navigation area', 'shamrock' ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'image',
        'setting'    => 'logo',
        'label'       => __( 'Logo', 'shamrock' ),
        'description' => __( 'Upload your logo', 'shamrock' ),
        'section'     => 'shamrock_header',
        'default'     => '',
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'site_description',
        'label'       => __( 'Display site description', 'shamrock' ),
        'section'     => 'shamrock_header',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'nav_social',
        'label'       => __( 'Include social icons in navigation', 'shamrock' ),
        'section'     => 'shamrock_header',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'nav_search',
        'label'       => __( 'Include search in navigation', 'shamrock' ),
        'section'     => 'shamrock_header',
        'default'     => 1,
    ) );

/* General blog options */

Kirki::add_section( 'shamrock_blog', array(
        'priority'    => 101,
        'title'       => __( 'Blog', 'shamrock' ),
        'description'    => __( 'These are general blog settings for your archive pages', 'shamrock' ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'rtl',
        'label'       => __( 'RTL mode', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => false,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'radio',
        'setting'    => 'blog_layout',
        'label'       => __( 'Blog layout', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => 'sidebar',
        'choices'     => array(
            'sidebar' => __( 'With Sidebar', 'shamrock' ),
            'classic' => __( 'Full Width (no sidebar)', 'shamrock' ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'show_fimg',
        'label'       => __( 'Display featured image', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'image',
        'setting'    => 'default_fimg',
        'label'       => __( 'Deafult featured image', 'shamrock' ),
        'description' => __( 'Upload an image to display it for posts which don\'t have featured image set', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => '',
        'required'  => array(
            array(
                'setting'  => 'show_fimg',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'show_cat',
        'label'       => __( 'Display category', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'multicheck',
        'setting'     => 'meta',
        'label'       => __( 'Display post meta data', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => array( 'date', 'author', 'rtime', 'comments' ),
        'choices'     => array(
            'date' => __( 'Date', 'shamrock' ),
            'author' => __( 'Author', 'shamrock' ),
            'rtime' => __( 'Reading time', 'shamrock' ),
            'comments' => __( 'Comments', 'shamrock' ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'radio',
        'setting'    => 'content_type',
        'label'       => __( 'Content limit type', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => 'excerpt',
        'choices'     => array(
            'content' => __( 'Manual (using &lt;!--more--&gt; tag)', 'shamrock' ),
            'excerpt' => __( 'Automatic (excerpt)', 'shamrock' ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'text',
        'setting'    => 'excerpt_length',
        'label'       => __( 'Excerpt length', 'shamrock' ),
        'description' => __( 'Specify your excerpt length (number of characters)', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'   => 230,
        'required'  => array(
            array(
                'setting'  => 'content_type',
                'operator' => '==',
                'value'    => 'excerpt',
            ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'text',
        'setting'    => 'excerpt_more',
        'label'       => __( 'Excerpt "more" string', 'shamrock' ),
        'description' => __( 'Specify more string to append after excerpts', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'   => '...',
        'required'  => array(
            array(
                'setting'  => 'content_type',
                'operator' => '==',
                'value'    => 'excerpt',
            ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'radio',
        'setting'    => 'pagination',
        'label'       => __( 'Pagination', 'shamrock' ),
        'section'     => 'shamrock_blog',
        'default'     => 'numeric',
        'choices'     => array(
            'numeric' => __( 'Numeric', 'shamrock' ),
            'classic' => __( 'Classic (prev/next)', 'shamrock' ),
        ),
    ) );

/* Single post options */

Kirki::add_section( 'shamrock_single', array(
        'priority'    => 101,
        'title'       => __( 'Single Post', 'shamrock' ),
        'description'    => __( 'These are settings which are applied to your single post template', 'shamrock' ),
    ) );


Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'radio',
        'setting'    => 'single_layout',
        'label'       => __( 'Single posts layout', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 'sidebar',
        'choices'     => array(
            'sidebar' => __( 'With Sidebar', 'shamrock' ),
            'classic' => __( 'Full Width (no sidebar)', 'shamrock' ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'single_show_fimg',
        'label'       => __( 'Display featured image', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'single_show_cat',
        'label'       => __( 'Display category', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'multicheck',
        'setting'     => 'single_meta',
        'label'       => __( 'Display post meta data', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => array( 'date', 'author', 'rtime', 'comments' ),
        'choices'     => array(
            'date' => __( 'Date', 'shamrock' ),
            'author' => __( 'Author', 'shamrock' ),
            'rtime' => __( 'Reading time', 'shamrock' ),
            'comments' => __( 'Comments', 'shamrock' ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'single_show_tags',
        'label'       => __( 'Display tags', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'single_show_prev_next',
        'label'       => __( 'Display previous/next post links', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'prev_next_cat',
        'label'       => __( 'Previous/next links to posts from same category?', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 1,
        'required'  => array(
            array(
                'setting'  => 'single_show_prev_next',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'single_show_author',
        'label'       => __( 'Display author info', 'shamrock' ),
        'section'     => 'shamrock_single',
        'default'     => 1,
    ) );



/* Colors */

Kirki::add_section( 'shamrock_colors', array(
        'priority'    => 101,
        'title'       => __( 'Colors', 'shamrock' ),
        'description'    => __( 'Use these settings to manage theme colors.', 'shamrock' )
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'color',
        'settings'    => 'color_body_bg',
        'label'       => __( 'Background color', 'shamrock' ),
        'description' => __( 'Used for body background', 'shamrock' ),
        'section'     => 'shamrock_colors',
        'default'     => '#ffffff',
        'priority'    => 101
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'color',
        'settings'    => 'color_txt',
        'label'       => __( 'Text color', 'shamrock' ),
        'description' => __( 'This is the color for standard text', 'shamrock' ),
        'section'     => 'shamrock_colors',
        'default'     => '#333333',
        'priority'    => 101
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'color',
        'settings'    => 'color_h',
        'label'       => __( 'Headings color', 'shamrock' ),
        'description' => __( 'Used for titles, navigation and H elements', 'shamrock' ),
        'section'     => 'shamrock_colors',
        'default'     => '#333333',
        'priority'    => 101
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'color',
        'settings'    => 'color_acc',
        'label'       => __( 'Accent color', 'shamrock' ),
        'description' => __( 'Used for links, buttons and some special elements', 'shamrock' ),
        'section'     => 'shamrock_colors',
        'default'     => '#d34836',
        'priority'    => 101
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'color',
        'settings'    => 'color_cat',
        'label'       => __( 'Category color', 'shamrock' ),
        'description' => __( 'This is default color for category links/buttons', 'shamrock' ),
        'section'     => 'shamrock_colors',
        'default'     => '#ffeb79',
        'priority'    => 101
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'color',
        'settings'    => 'color_meta',
        'label'       => __( 'Meta color ', 'shamrock' ),
        'description' => __( 'Used for meta elements and some labels', 'shamrock' ),
        'section'     => 'shamrock_colors',
        'default'     => '#999999',
        'priority'    => 101
    ) );


/* Images */

Kirki::add_section( 'shamrock_images', array(
        'priority'    => 101,
        'title'       => __( 'Image Sizes', 'shamrock' ),
        'description'    => __( 'Theme will optionally generate two additional image sizes to fit the design. When you change this options, it is highy reccomemnded to run Force Regenerate Thumbnails plugin afterwards.',  'shamrock' )
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'img_size_standard',
        'label'       => __( 'Generate standard featured image', 'shamrock' ),
        'description'  => __( 'Used for regular templates with sidebar', 'shamrock' ),
        'section'     => 'shamrock_images',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'radio',
        'setting'    => 'img_size_standard_ratio',
        'label'       => __( 'Standard featured image ratio', 'shamrock' ),
        'section'     => 'shamrock_images',
        'choices'   => array(
            'original' => __( 'Original (do not crop)', 'shamrock' ),
            '4_3' => __( '4:3', 'shamrock' ),
            '16_9' => __( '16:9', 'shamrock' ),
            'custom' => __( 'Your custom ratio', 'shamrock' )
        ),
        'default'   => '16_9',
        'required'  => array(
            array(
                'setting'  => 'img_size_standard',
                'operator' => '==',
                'value'    => 1,
            ),

        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'text',
        'setting'    => 'img_size_standard_custom',
        'label'       => '',
        'description' => __( 'Specify your custom ratio for standard images (x:y)', 'shamrock' ),
        'section'     => 'shamrock_images',
        'default'   => '',
        'required'  => array(
            array(
                'setting'  => 'img_size_standard',
                'operator' => '==',
                'value'    => 1,
            ),
            array(
                'setting'  => 'img_size_standard_ratio',
                'operator' => '==',
                'value'    => 'custom',
            ),
        ),
    ) );


Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'checkbox',
        'setting'    => 'img_size_full',
        'label'       => __( 'Generate full width featured image', 'shamrock' ),
        'description'  => __( 'Used for templates with no sidebar', 'shamrock' ),
        'section'     => 'shamrock_images',
        'default'     => 1,
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'radio',
        'setting'    => 'img_size_full_ratio',
        'label'       => __( 'Full width featured image ratio', 'shamrock' ),
        'section'     => 'shamrock_images',
        'choices'   => array(
            'original' => __( 'Original (do not crop)', 'shamrock' ),
            '4_3' => __( '4:3', 'shamrock' ),
            '16_9' => __( '16:9', 'shamrock' ),
            'custom' => __( 'Your custom ratio', 'shamrock' )
        ),
        'default'   => '16_9',
        'required'  => array(
            array(
                'setting'  => 'img_size_full',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ) );

Kirki::add_field( 'shamrock_settings', array(
        'type'        => 'text',
        'setting'    => 'img_size_full_custom',
        'label'       => '',
        'description' => __( 'Specify your custom ratio for full width images (x:y)', 'shamrock' ),
        'section'     => 'shamrock_images',
        'default'   => '',
        'required'  => array(
            array(
                'setting'  => 'img_size_full',
                'operator' => '==',
                'value'    => 1,
            ),
            array(
                'setting'  => 'img_size_full_ratio',
                'operator' => '==',
                'value'    => 'custom',
            ),
        ),
    ) );

function shamrock_kirki_config( $config ) {

    $config['url_path'] = trailingslashit( get_stylesheet_directory_uri() ) . 'include/options/';
    return $config;

}

add_filter( 'kirki/config', 'shamrock_kirki_config' );

?>