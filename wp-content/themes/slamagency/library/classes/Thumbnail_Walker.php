<?php

/*
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class Thumbnail_Walker extends Walker_Nav_Menu
{
/**
 * Start the element output.
 *
 * @param  string $output Passed by reference. Used to append additional content.
 * @param  object $item   Menu item data object.
 * @param  int $depth     Depth of menu item. May be used for padding.
 * @param  array $args    Additional strings.
 * @return void
 */
 function start_el(&$output, $item, $depth, $args)
 {
    $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

    $class_names = join(
        ' '
    ,   apply_filters(
            'nav_menu_css_class'
        ,   array_filter( $classes ), $item
        )
    );

    ! empty ( $class_names )
        and $class_names = ' class="'. esc_attr( $class_names ) . '"';

    $output .= "<li id='menu-item-$item->ID' $class_names>";

    $attributes  = '';

    ! empty( $item->attr_title )
        and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
    ! empty( $item->target )
        and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
    ! empty( $item->xfn )
        and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
    ! empty( $item->url )
        and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

    // insert thumbnail
    // you may change this
    $thumbnail = '';
    if ( has_post_thumbnail( $item->object_id ) ) {
    	$thumbnail = get_the_post_thumbnail( $item->object_id, 'menu' );
    }

    $title = apply_filters( 'the_title', $item->title, $item->ID );

    $item_output = $args->before
        . "<a $attributes>"
        . $thumbnail
        . $args->link_before
        . "<span class='title'>"
        . $title
        . "</span>"
        . '</a> '
        . $args->link_after
        . $args->after;

    // Since $output is called by reference we don't need to return anything.
    $output .= apply_filters(
        'walker_nav_menu_start_el'
    ,   $item_output
    ,   $item
    ,   $depth
    ,   $args
    );
   }
}