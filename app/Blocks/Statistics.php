<?php

namespace App\Blocks;

use App\CustomBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

use App\Fields\Padding;

class Statistics extends CustomBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Statistics';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Statistics block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'image-filter';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
        'spacing' => false,
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [
        [
            'name' => 'list',
            'label' => 'List',
            'isDefault' => true,
        ],
        [
            'name' => 'grid',
            'label' => 'Grid',
        ],
        [
            'name' => 'featured',
            'label' => 'Featured',
        ],
        [
            'name' => 'full-width',
            'label' => 'Full Width',
        ]
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'statistics' => [
            [
                'number' => '0000',
                'description' => 'Plugin small description'
            ],
            [
                'number' => '0001',
                'description' => 'Stat small description'
            ],
            [
                'number' => '0002',
                'description' => 'Stat small description'
            ],
            [
                'number' => '0003',
                'description' => 'Stat small description'
            ],
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'featured_background' => get_field('featured_background'),
            'statistics' => $this->statistics(),
            'padding' => Padding::value()
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $statistics = new FieldsBuilder('statistics');

        $statistics
            ->addImage('featured_background', [
                'return_format' => 'url',
            ])
            ->addRepeater('statistics')
                ->addText('number')
                ->addText('description')
            ->endRepeater();

        return $statistics->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function statistics()
    {
        return get_field('statistics') ?: $this->example['statistics'];
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
