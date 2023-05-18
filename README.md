# We'll build our own ACF/Block Composer...

![Bender from Futurama](https://media.giphy.com/media/cYhhUmbtbneb6/giphy.gif)

## Customizing a Block view in your Sage10 theme

Often you'll find you need to tweak how a block is rendered per theme to match each design.

Block views are stored inside of `resources/views/blocks/{block-name}.blade.php` - to customize the views for your theme you can
copy this file directly over to your themes `resources/views/blocks` directory and start modifying it. The theme version will 
always override the version found in the plugin.

## Customizing a Block class in your Sage10 theme

You may need to modify what ACF fields are in a block, or how the data is being manipulate on its way to the frontend.

The class file for each block is stored in `app/Blocks/{BlockName}.php` and can be copied over directly to your theme
in the same directory and file name.

There are many things you can customize in these files, most of which are self explanatory, while some could use a little explaining.

- `$icon` this is the shortcode for any [dashicon](https://developer.wordpress.org/resource/dashicons/)
- The `$post_types` and `$parent` arrays let you specify what post types and what types of other blocks your block can be embedded in.
- The `public $styles` array is used to add different options for styles to use when building out the template. By default it has a light and dark mode. 
- The `public $example` array is used to provide example data that the client can see when they first add the block to a template.
- The `public function fields()` method is for building out ACF fields used just in this block. Reference this [cheat sheet](https://github.com/Log1x/acf-builder-cheatsheet) for help with how to do the different fields.
- The `public function items()` method is something that can be copied for more of your properties you wish to return to the frontend. You'll notice in the `with()` method we're referencing items as `$this➝items()` which is a direct call to this method. The example one each block comes with is showing you that you can use a ternary to send either the ACF value if it exists, or the example value if it is blank. You can use these methods to transform your data before passing it to the frontend. For every field you can add a method like this to help manipulate the data.

## Adding new Blocks to the plugin

You will start off by duplicaing one of the exsting class files from `app/Blocks` and view files from `resources/views/blocks`.

Configure the class and the view in a customizable format, ideally something that can be re-used. For example, if your block requires the use
of images, add an image field where applicable so this can be changed per theme.

**Registering your block** is done inside of `includes/InitBlocks.php` by adding additional blocks to the array line 11.