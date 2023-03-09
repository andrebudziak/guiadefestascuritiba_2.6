<?php

class holo_accordion extends Holo_Abstract_Shortcodes {

    public function __construct()
    {

        parent::__construct();

        $this->name = 'Accordion';
        $this->children_class = 'holo_accordion_item';
        $this->admin_icon = 'entypo-minus-squared';

        $this->attributes = array(
            'multiple_open' => array(
                'label' => 'Multiple Open Toggles',
                'type' => 'checkbox'
            ),
            'filterable' => array(
                'label' => 'filterable',
                'type' => 'checkbox'
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_left',
            'margin_bottom',
            'margin_right',
        ));

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['accordion_items'] = array();
        $unique_id = $this->unique_id;
        $filter_markup = '';
        $filter_class = '';
        $categories = array();
        $accordion_items = '';
        $multiple_open_class = ((int)$multiple_open !== 1 ? 'data-parent="#accordion' . $unique_id . '"' : '');
        $inline_style = $this->get_styles_markup();

        $panel_class = ( (int)$filterable === 1 ? 'filter-panel' : '' );

        do_shortcode($content);

        $index = 1;
        foreach ($GLOBALS['accordion_items'] as $item) {
            $opened_class = ((int)$item['opened'] === 1 ? 'in' : '');
            $collapsed = ((int)$item['opened'] === 1 ? '' : 'collapsed');

            $category_slug = strtolower(str_replace(' ', '_', $item['category']));

            $accordion_items .= '
                <div class="panel panel-default ' . $category_slug . ' ' . $panel_class .  '">
                    <div class="panel-heading">
                        <h6 class="panel-title">
                            <a class="' . $collapsed . '" ' . $multiple_open_class . ' data-toggle="collapse" href="#accordion' . $unique_id . '-item-' . $index . '">
                                <i class="fa-"></i>
                                ' . $item['title'] . '
                            </a>
                        </h6>
                    </div>
                    <div class="panel-collapse collapse ' . $opened_class . '" id="accordion' . $unique_id . '-item-' . $index . '">
                        <div class="panel-body">
                        ' . $item['content'] . '
                        </div>
                    </div>
                </div>
            ';

            $categories[$category_slug] = $item['category'];

            $index++;
        }

        if ( (int)$filterable === 1 ) {

            $filters = '';
            $panel_class = 'panel';

            $filter_class = 'filter-panel';

            $categories = array_unique($categories);

            foreach ( $categories as $category_slug => $category_name ) {

                $filters .= '<li class="filter" data-filter="' . $category_slug . '">' . $category_name . '</li>';

            }

            $filter_markup = '
                <ol class="breadcrumb accordion-filter" id="' . $unique_id . '-filters">
                    <li class="active filter" data-filter="all">All</li>
                    ' . $filters . '
                </ol>';

        }

        $returnContent = $inline_style .'
            <div>
                ' . $filter_markup . '
                <div class="panel-group accordion ' . $filter_class . '" id="' . $unique_id . '">
                ' . $accordion_items . '
                </div>
            </div>
        ';

        return $returnContent;
    }
}