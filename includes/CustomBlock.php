<?php

namespace App;

use Log1x\AcfComposer\Block;

use Illuminate\Support\Str;

abstract class CustomBlock extends Block {

    public function render($block, $content = '', $preview = false, $post_id = 0, $wp_block = false, $context = false)
    {
        $this->block = (object) $block;
        $this->content = $content;
        $this->preview = $preview;
        $this->post_id = $post_id;
        $this->instance = $wp_block;
        $this->context = $context;

        $this->post = get_post($post_id);

        $this->classes = collect([
            'slug' => Str::start(
                Str::slug($this->slug),
                'wp-block-'
            ),
            'align' => ! empty($this->block->align) ?
                Str::start($this->block->align, 'align') :
                false,
            'align_text' => ! empty($this->supports['align_text']) ?
                Str::start($this->block->align_text, 'align-text-') :
                false,
            'align_content' => ! empty($this->supports['align_content']) ?
                Str::start($this->block->align_content, 'is-position-') :
                false,
            'full_height' => ! empty($this->supports['full_height'])
                && ! empty($this->block->full_height) ?
                'full-height' :
                false,
            'classes' => $this->block->className ?? false,
        ])->filter()->implode(' ');

        $this->style = $this->getStyle();

        $theme_view_path = "blocks/{$this->slug}";

        // Check if the theme already has a view for this block, and return it if so
        if (view()->exists($theme_view_path)) {
            return $this->view($theme_view_path, ['block' => $this]);
        }

        // If the theme doesn't have a view for this block, return ours
        return $this->view(str_replace('includes/', '', $this->app->resourcePath("views/blocks/{$this->slug}.blade.php")), ['block' => $this]);
    }
}