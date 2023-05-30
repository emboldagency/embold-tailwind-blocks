# We'll build our own ACF/Block Composer...

![Bender from Futurama](https://media.giphy.com/media/cYhhUmbtbneb6/giphy.gif)

## What does it do?

It extracts the acf-composer and acf-builder packages that Sage built on into a plugin. We can include our own default 
Block and Field classes in the plugin files to jumpstart theme development.

If for some reason you need to tweak or modify what comes with the plugin you can copy the file into your theme and tweak it.
Need the Statistics block to do something slightly different? Copy its app/Blocks/Statistics.php from the plugin to your theme and 
the theme files take priority. You can do this with the Padding field, or any views as well.

It includes the following by default:

### Blocks
- Statistics: A list of statistics with subfields for number and description, in 4 styles of featurd, grid, list, and full width.

### Fields
- Padding: A padding field option added to every block where the user can check whether they want padding to apply to all sides of just individual sides of a block.

### Options
The plugin creates a parent "Theme Options" category in the sidebar, this way when you're creating any options pages you
can set their parent slugs to `theme-options`.

## Sage 10 setup

After the plugin is installed and activated, you'll want to configure both your tailwind.config.js and bud.config.js to
watch the plugins files so that purge and browsersync work with the plugin.

bud.config.js
```js
.watch([
            'resources/views',
            'app',
            '../../plugins/embold-tailwind-blocks',
        ])
```

tailwind.config.cjs
```js
content: [
        './index.php',
        './app/**/*.php',
        './resources/**/*.{php,vue,js}',
        '../../plugins/embold-tailwind-blocks/**/*.php',
    ],
```

Now classes only used in the plugin files will not be purged, and the page can be automatically reloaded when files change.

## Customizing a Block view in your Sage10 theme

Often you'll find you need to tweak how a block is rendered per theme to match each design.

Block views are stored inside of `resources/views/blocks/{block-name}.blade.php` - to customize the views for your theme you can
copy this file directly over to your themes `resources/views/blocks` directory and start modifying it. The theme version will 
always override the version found in the plugin.

## Customizing Block JavaScript in your Sage10 theme

Some blocks come with a JavaScript file that you can copy over to your theme and override.

These JavaScript files are named after the block slug similar to blade files, and are stored inside of `resources/scripts/blocks/{block-name}.js`.
This file can be copied into your theme in the same directory and customized as needed. The theme version will  always override the version found in the plugin.

## Customizing a Block class in your Sage10 theme

You may need to modify what ACF fields are in a block, or how the data is being manipulate on its way to the frontend.

> **Important:** If you copy over your blocks class you must also copy over the view

The class file for each block is stored in `app/Blocks/{BlockName}.php` and can be copied over directly to your theme
in the same directory and file name.

There are many things you can customize in these files, most of which are self explanatory, while some could use a little explaining.

- `$icon` this is the shortcode for any [dashicon](https://developer.wordpress.org/resource/dashicons/)
- `$category` should always be "embold" so that all of our custom blocks are grouped together in the editor.
- The `$post_types` and `$parent` arrays let you specify what post types and what types of other blocks your block can be embedded in.
- The `public $styles` array is used to add different options for styles to use when building out the template. By default it has a light and dark mode. 
- The `public $example` array is used to provide example data that the client can see when they first add the block to a template.
- The `public function fields()` method is for building out ACF fields used just in this block. Reference this [cheat sheet](https://github.com/Log1x/acf-builder-cheatsheet) for help with how to do the different fields.
- The `public function items()` method is example of how you can manipulate properties before sending them to the frontend. You'll notice in the `with()` method we're referencing items as `$this➝items()` which is a direct call to this method. The example one each block comes with is showing you that you can use a ternary to send either the ACF value if it exists, or the example value if it is blank. You can use these methods to transform your data before passing it to the frontend. If you wanted to manipulate a `date` field for example before rendering it on the frontend you could make a `public function date()` method.

## Bundled Styling for blocks

In the `resources/styles/blocks` directory you'll find some .css files that match up with the slug naming of blocks. These
files are not loaded into the site by default but are bundled in so you can copy/paste them over to have a good starting
poing.

## Adding new Blocks to the plugin

You will start off by duplicaing one of the exsting class files from `app/Blocks` and view files from `resources/views/blocks`.

Configure the class and the view in a customizable format, ideally something that can be re-used. For example, if your block requires the use
of images, add an image field where applicable so this can be changed per theme.

**Registering your block** is done inside of `includes/InitBlocks.php` by adding additional blocks to the `$block_classes` array in the `initialize` method.