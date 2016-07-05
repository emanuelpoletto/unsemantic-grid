<?php
// remove_filter( 'the_content', 'do_shortcode', 11 );
// add_filter( 'the_content', 'do_shortcode', 9 );

/**
 * Unsemantic Grid grid_cols shortcode
 * 
 * @param  array  $atts    attributes
 * @param  string $content content between shortcode tags
 * 
 * @return string          wrapped content
 */
function unsemantic_grid_cols_shortcode( $atts, $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'parent' => false,
            'first' => false,
            'last' => false,
            'class' => false,
        ), $atts );
    $parent = (bool) $atts['parent'];
    $first = (bool) $atts['first'];
    $last = (bool) $atts['last'];

    // Code
    $classes = array(
        'grid-container',
        $parent ? 'grid-parent' : '',
        $first ? 'grid-first' : '',
        $last ? 'grid-last' : '',
        $atts['class'] ? sanitize_html_class( $atts['class'] ) : '',
    );
    $classes = array_filter( $classes );

    return '<div class="' . implode( ' ', $classes ) . '"' . $attr . '>' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'grid_cols', 'unsemantic_grid_cols_shortcode' );

/**
 * Unsemantic Grid grid_col shortcode
 * 
 * @param  array $atts     attributes
 * @param  string $content content between shortcode tags
 * 
 * @return string          wrapped content
 */
function unsemantic_grid_col_shortcode( $atts, $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'g' => 100, // global grid
            'd' => 0,
            't' => 0,
            'm' => 0,
            'gp' => 0, // global prefix
            'dp' => 0,
            'tp' => 0,
            'mp' => 0,
            'gs' => 0, // global suffix
            'ds' => 0,
            'ts' => 0,
            'ms' => 0,
            'gf' => false, // global first
            'df' => false,
            'tf' => false,
            'mf' => false,
            'gl' => false, // global last
            'dl' => false,
            'tl' => false,
            'ml' => false,
            'parent' => false,
            'class' => false,
        ), $atts );

    $int_vars = array( 'g', 'd', 't', 'm', 'gp', 'dp', 'tp', 'mp', 'gs', 'ds', 'ts', 'ms' );
    foreach ( $int_vars as $var ) {
        $$var = ( '33' == $atts[ $var ]  || '66' == $atts[ $var ] )
              ? $atts[ $var ]
              : ( intval( (int) $atts[ $var ] / 5 ) * 5 );
    }

    $bool_vars = array( 'gf', 'df', 'tf', 'mf', 'gl', 'dl', 'tl', 'ml', 'parent' );
    foreach ( $bool_vars as $var ) {
        $$var = (bool) $atts[ $var ];
    }

    $class = $atts['class'];

    // Code
    if ( ! empty( $class ) ) {
        $class = explode( ' ', $class );
        foreach ( $class as $key => $value ) {
            $class[ $key ] = sanitize_html_class( $value );
        }
        $class = implode( ' ', $class );
    }

    $classes = array(
        'grid-' . ( $d ? $d : $g ),
        'tablet-grid-' . ( $t ? $t : $g ),
        'mobile-grid-' . ( $m ? $m : $g ),
        ( $dp || $gp ) ? 'prefix-' . ( $dp ? $dp : $gp ) : '',
        ( $tp || $gp ) ? 'tablet-prefix-' . ( $tp ? $tp : $gp ) : '',
        ( $mp || $gp ) ? 'mobile-prefix-' . ( $mp ? $mp : $gp ) : '',
        ( $ds || $gs ) ? 'suffix-' . ( $ds ? $ds : $gs ) : '',
        ( $ts || $gs ) ? 'tablet-suffix-' . ( $ts ? $ts : $gs ) : '',
        ( $ms || $gs ) ? 'mobile-suffix-' . ( $ms ? $ms : $gs ) : '',
        ( $df || $gf ) ? 'grid-first' : '',
        ( $tf || $gf ) ? 'tablet-grid-first' : '',
        ( $mf || $gf ) ? 'mobile-grid-first' : '',
        ( $dl || $gl ) ? 'grid-last' : '',
        ( $tl || $gl ) ? 'tablet-grid-last' : '',
        ( $ml || $gl ) ? 'mobile-grid-last' : '',
        $parent ? 'grid-parent' : '',
        $class ? $class : '',
    );
    $classes = array_filter( $classes );

    return '<div class="' . implode( ' ', $classes ) . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'grid_col', 'unsemantic_grid_col_shortcode' );
add_shortcode( 'grid_col_child', 'unsemantic_grid_col_shortcode' );
add_shortcode( 'grid_col_grandchild', 'unsemantic_grid_col_shortcode' );
