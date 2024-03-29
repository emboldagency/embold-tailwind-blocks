<?php

namespace Roots\Acorn\Sage\Concerns;

trait FiltersEnqueues
{
    /**
     * Add support for MJS.
     *
     * Filter: script_loader_tag
     *
     * @param  string  $tag
     * @param  string  $handle
     * @param  string  $src
     * @return string
     */
    public function filterScriptLoaderTag($tag, $handle, $src)
    {
        if (! $extension = pathinfo(parse_url($src, PHP_URL_PATH), PATHINFO_EXTENSION)) {
            return $tag;
        }

        if ($extension !== 'mjs') {
            return $tag;
        }

        $tag = preg_replace('/type=["\'][^"\']+["\']/', '', $tag);

        return str_replace('<script ', '<script type="module" ', $tag);
    }
}
