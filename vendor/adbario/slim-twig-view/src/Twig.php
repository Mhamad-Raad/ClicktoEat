<?php
/**
 * Twig View for Slim Framework
 *
 * @author  Riku Särkinen <riku@adbar.io>
 * @link    https://github.com/adbario/slim-twig-view
 * @license https://github.com/adbario/slim-twig-view/blob/master/LICENSE.md (MIT License)
 */
namespace Adbar\Slim\Views;

/**
 * Twig View
 *
 * This class extends Slim Framework view helper for Twig templating engine.
 * Class adds file extension and dot notation for template path.
 */
class Twig extends \Slim\Views\Twig
{
    /**
     * Twig template file extension
     *
     * @var string
     */
    protected $fileExtension = 'twig';

    /**
     * Create new Twig view
     *
     * Stores Twig template file extension and creates a new Twig view with the parent constructor.
     *
     * @param string|array $path     Path(s) to templates directory
     * @param array        $settings Twig environment settings
     */
    public function __construct($path, $settings = [])
    {
        if (isset($settings['file_extension'])) {
            $this->fileExtension = $settings['file_extension'];
        }

        parent::__construct($path, $settings);
    }

    /**
     * Fetch rendered template
     *
     * Replaces dots with forward slashes for dot notation, adds file extension and
     * fetches the rendered template with the parent method.
     *
     * @param  string $template Template pathname relative to templates directory
     * @param  array  $data     Associative array of template variables
     *
     * @return string
     */
    public function fetch($template, $data = [])
    {
        $template = str_replace('.', '/', $template) . '.' . $this->fileExtension;

        return parent::fetch($template, $data);
    }
}
