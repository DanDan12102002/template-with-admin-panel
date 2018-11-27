<?php
defined('_JEXEC') or die;

class View {
    /**
     * Renders template with closure.
     *
     * @param mixed $context
     * @param string $template
     *
     * @return string
     */
    public function render($context, $template)
    {
        $closure = function($template) {
            ob_start();
            include $template;
            return ob_end_flush();
        };

        # Create a closure
		$closure = $closure->bindTo($context, $context);
        $closure($template);
    }
}
?>