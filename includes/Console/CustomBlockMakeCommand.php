<?php

namespace App\Console;
use Log1x\AcfComposer\Console\MakeCommand;

// use Illuminate\Console\GeneratorCommand;

// class CustomBlockMakeCommand extends GeneratorCommand
class CustomBlockMakeCommand extends MakeCommand
{
    // protected $name = 'acf:customblock';
    // protected $description = 'Create a new ACF custom block';
    // protected $type = 'Block';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'acf:customblock {name* : The name of the block}
                            {--construct : Generate block properties inside of `__construct`}
                            {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new ACF custom block type';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Block';

    /**
     * The view stub used when generated.
     *
     * @var string|bool
     */
    protected $view = 'block';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('construct')) {
            return $this->resolveStub('block.construct');
        }

        return $this->resolveStub('block');
    }
    // protected function getStub()
    // {
    //     return __DIR__ . '/stubs/custom-block.stub';
    // }

    // protected function getDefaultNamespace($rootNamespace)
    // {
    //     return $rootNamespace . '\Blocks';
    // }

    // protected function buildClass($name)
    // {
    //     $replace = [
    //         'DummyNamespace' => $this->getNamespace($name),
    //         'DummyClass' => class_basename($name),
    //         'DummyParentClass' => 'App\CustomBlock',
    //     ];

    //     return str_replace(
    //         array_keys($replace),
    //         array_values($replace),
    //         parent::buildClass($name)
    //     );
    // }
}
