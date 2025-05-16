<?php
class Custom_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        $class_names = 'nav-item';
        if ($has_children && $depth === 0) {
            $class_names .= ' dropdown';
        } elseif ($depth > 0) {
            $class_names .= ' dropdown-submenu';
        }

        // DODANE: Klasa 'active' jeśli aktualny element menu
        if (
            in_array('current-menu-item', $classes) ||
            in_array('current-menu-ancestor', $classes) ||
            in_array('current-menu-parent', $classes)
        ) {
            $class_names .= ' active';
        }

        $output .= '<li class="' . esc_attr($class_names) . '">';

        // Atrybuty <a>
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '#';

        // Klasa linku
        if ($depth === 0) {
            $atts['class'] = $has_children ? 'nav-link dropdown-toggle' : 'nav-link';
            // DODANE: Klasa 'active' także do <a>
            if (
                in_array('current-menu-item', $classes) ||
                in_array('current-menu-ancestor', $classes) ||
                in_array('current-menu-parent', $classes)
            ) {
                $atts['class'] .= ' active';
            }
        } else {
            $atts['class'] = 'dropdown-item';
            // DODANE: Klasa 'active' dla dropdown-item, jeśli aktywny
            if (
                in_array('current-menu-item', $classes) ||
                in_array('current-menu-ancestor', $classes) ||
                in_array('current-menu-parent', $classes)
            ) {
                $atts['class'] .= ' active';
            }
        }

        // Atrybuty HTML
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        // Tytuł linku
        $title = apply_filters('the_title', $item->title, $item->ID);

        // Output: link + przycisk submenu toggle (tylko jeśli są dzieci)
        $item_output  = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';

        if ($has_children) {
            $item_output .= '<button class="submenu-toggle" aria-label="Toggle submenu" aria-expanded="false" type="button"></button>';
        }

        $item_output .= $args->after ?? '';
        $output .= $item_output;
    }


    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
