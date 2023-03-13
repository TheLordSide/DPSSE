<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Gallery Settings Content
$wbg_details_is_external = ( $wbg_details_is_external ? ' target="_blank"' : '' );
// Shortcoded Options
$wbg_author = '';
$wbg_language = '';
$wbgCategory = ( isset( $attr['category'] ) ? $attr['category'] : '' );
$wbgDisplay = ( isset( $attr['isdisplay'] ) ? $attr['isdisplay'] : $wbg_books_per_page );
$wbgPagination = ( isset( $attr['ispagination'] ) ? $attr['ispagination'] : $wbg_display_pagination );
// true/0
$wbgLayout = ( isset( $attr['layout'] ) ? $attr['layout'] : '' );

if ( is_front_page() ) {
    $wbgPaged = ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
} else {
    $wbgPaged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
}

// Search Items
$wbg_title_s = ( isset( $_GET['wbg_title_s'] ) ? sanitize_text_field( $_GET['wbg_title_s'] ) : '' );
$wbg_category_s = ( isset( $_GET['wbg_category_s'] ) ? sanitize_text_field( $_GET['wbg_category_s'] ) : '' );
$wbg_author_s = ( isset( $_GET['wbg_author_s'] ) ? sanitize_text_field( $_GET['wbg_author_s'] ) : '' );
$wbg_publisher_s = ( isset( $_GET['wbg_publisher_s'] ) ? sanitize_text_field( $_GET['wbg_publisher_s'] ) : '' );
$wbg_published_on_s = ( isset( $_GET['wbg_published_on_s'] ) ? sanitize_text_field( $_GET['wbg_published_on_s'] ) : '' );
$wbg_language_s = ( isset( $_GET['wbg_language_s'] ) ? sanitize_text_field( $_GET['wbg_language_s'] ) : '' );
$wbg_isbn_s = ( isset( $_GET['wbg_isbn_s'] ) ? sanitize_text_field( $_GET['wbg_isbn_s'] ) : '' );
// Main Query Arguments
$wbg_front_search_query_array = array(
    'post_type'   => 'books',
    'post_status' => 'publish',
    'order'       => $wbg_books_order,
    'orderby'     => $wbg_gallary_sorting,
    'meta_query'  => array( array(
    'key'     => 'wbg_status',
    'value'   => 'active',
    'compare' => '=',
) ),
);
$wbgBooksArr = apply_filters( 'wbg_front_search_query_array', $wbg_front_search_query_array );
// If display params found in shortcode
if ( $wbgDisplay != '' ) {
    $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}
// If Pagination found in shortcode
if ( $wbgPagination ) {
    $wbgBooksArr['paged'] = $wbgPaged;
}
// Sorting Operation
if ( 'title' !== $wbg_gallary_sorting && 'date' !== $wbg_gallary_sorting ) {
    $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}
// If Category params found in shortcode
if ( $wbgCategory != '' ) {
    $wbgBooksArr['tax_query'] = array( array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbgCategory,
    ) );
}
// Search Query
if ( '' != $wbg_title_s ) {
    $wbgBooksArr['s'] = $wbg_title_s;
}
if ( '' !== $wbg_category_s ) {
    $wbgBooksArr['tax_query'] = array( array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbg_category_s,
    ) );
}
if ( '' != $wbg_author_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_author',
        'value'   => $wbg_author_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_publisher_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_publisher',
        'value'   => $wbg_publisher_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_isbn_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_isbn',
        'value'   => $wbg_isbn_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_language_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_language',
        'value'   => $wbg_language_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_published_on_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_published_on',
        'value'   => $wbg_published_on_s,
        'compare' => 'LIKE',
    ) );
}
// Front Sorting Operation

if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'price' ) {
    $wbgBooksArr['meta_key'] = 'wbgp_regular_price';
    $wbgBooksArr['orderby'] = 'meta_value_num';
    $wbgBooksArr['meta_type'] = 'DECIMAL';
    $wbgBooksArr['order'] = 'ASC';
}


if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'price-desc' ) {
    $wbgBooksArr['meta_key'] = 'wbgp_regular_price';
    $wbgBooksArr['orderby'] = 'meta_value_num';
    $wbgBooksArr['meta_type'] = 'DECIMAL';
    $wbgBooksArr['order'] = 'DESC';
}


if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'date' ) {
    $wbgBooksArr['orderby'] = 'date';
    $wbgBooksArr['order'] = 'DESC';
    $wbgBooksArr['suppress_filters'] = true;
}


if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'default' ) {
    $wbgBooksArr['orderby'] = $wbg_gallary_sorting;
    $wbgBooksArr['order'] = $wbg_books_order;
    $wbgBooksArr['suppress_filters'] = true;
}

// Load Styling
include WBG_PATH . 'assets/css/gallery.php';
// Perform query and assign it to wp_query
$wbgBooks = new WP_Query( $wbgBooksArr );
?>
<div class="wbg-parent-wrapper">
  <?php 
// Search Panel Started

if ( $wbg_display_search_panel ) {
    $search_dad_list = $this->get_search_items();
    include WBG_PATH . 'front/view/search.php';
}


if ( $wbgBooks->have_posts() ) {
    
    if ( $wbg_display_total_books ) {
        $wbg_prev_posts = ($wbgPaged - 1) * $wbgBooks->query_vars['posts_per_page'];
        $wbg_from = 1 + $wbg_prev_posts;
        $wbg_to = count( $wbgBooks->posts ) + $wbg_prev_posts;
        $wbg_of = $wbgBooks->found_posts;
        ?>
        <div class="wbg-total-books-title">
          <?php 
        _e( 'Showing', WBG_TXT_DOMAIN );
        ?> <span><?php 
        printf(
            '%s-%s of %s',
            $wbg_from,
            $wbg_to,
            $wbg_of
        );
        ?></span> <?php 
        _e( 'Books', WBG_TXT_DOMAIN );
        ?>
        </div>
        <?php 
    }
    
    ?>
    <div class="wbg-main-wrapper <?php 
    echo  'wbg-product-column-' . esc_attr( $wbg_gallary_column ) . ' wbg-product-column-mobile-' . esc_attr( $wbg_gallary_column_mobile ) ;
    ?> <?php 
    echo  ( 'list' !== $wbg_gallary_template ? 'grid' : $wbg_gallary_template ) ;
    ?>">
      <?php 
    while ( $wbgBooks->have_posts() ) {
        $wbgBooks->the_post();
        $wbgImgUrl = get_post_meta( $post->ID, 'wbgp_img_url', true );
        //apply_filters( 'wbg_image_url', $post->ID );
        $wbg_book_cover_size_imp = 200;
        $wbg_book_cover_resulution = 'thumbnail';
        if ( 'default' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = [ 0, 200 ];
        }
        
        if ( 'thumbnail' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = 'thumbnail';
            $wbg_book_cover_size_imp = 150;
        }
        
        
        if ( 'medium' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = 'medium';
            $wbg_book_cover_size_imp = 300;
        }
        
        
        if ( 'full' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = [ 0, 500 ];
            $wbg_book_cover_size_imp = 500;
        }
        
        $wbg_default_book_cover_url = ( '' !== $wbg_default_book_cover_url ? $wbg_default_book_cover_url : WBG_ASSETS . 'img/noimage.jpg' );
        $feat_image = '<img src="' . esc_url( $wbg_default_book_cover_url ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
        
        if ( 'f' === $wbg_book_cover_priority ) {
            
            if ( has_post_thumbnail() ) {
                $feat_image = get_the_post_thumbnail( $post->ID, $wbg_book_cover_resulution );
            } else {
                if ( $wbgImgUrl ) {
                    $feat_image = '<img src="' . esc_url( $wbgImgUrl ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
                }
            }
        
        } else {
            
            if ( $wbgImgUrl ) {
                $feat_image = '<img src="' . esc_url( $wbgImgUrl ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
            } else {
                if ( has_post_thumbnail() ) {
                    $feat_image = get_the_post_thumbnail( $post->ID, $wbg_book_cover_resulution );
                }
            }
        
        }
        
        if ( 'grid' === $wbg_gallary_template ) {
            include 'gallery/layout/grid.php';
        }
        if ( 'list' === $wbg_gallary_template ) {
            include 'gallery/layout/list.php';
        }
        if ( 'grid-classic' === $wbg_gallary_template ) {
            include 'gallery/layout/grid-classic.php';
        }
    }
    ?>
    </div>
    <?php 
    if ( $wbgPagination ) {
        $this->loop_fotter_content( $wbgBooks->max_num_pages, $wbgPaged );
    }
} else {
    ?><p class="wbg-no-books-found"><?php 
    esc_html_e( $wbg_no_book_message );
    ?></p><?php 
}

// Reset Post Data
wp_reset_postdata();
?>
</div>
