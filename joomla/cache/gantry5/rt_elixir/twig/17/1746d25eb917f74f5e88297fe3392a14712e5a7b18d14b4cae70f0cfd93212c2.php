<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* component.html.twig */
class __TwigTemplate_53323c222ad0138110cdde0ebcb51b66602a16a858cc9f0ae0fc01286fb7df4f extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'page_body' => [$this, 'block_page_body'],
            'page_layout' => [$this, 'block_page_layout'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "partials/page.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("partials/page.html.twig", "component.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_body($context, array $blocks = [])
    {
        // line 4
        echo "<body";
        echo $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "bodyAttributes", [0 => ["class" => [0 => ($context["offcanvas_position"] ?? null), 1 => $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "preset", []), 2 => ("g-style-" . $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "preset", []))]]], "method");
        echo ">
    ";
        // line 5
        echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "page", []), "body", []), "body_top", []);
        echo "
    ";
        // line 6
        echo ($context["page_top"] ?? null);
        echo "
    ";
        // line 7
        echo ($context["page_layout"] ?? null);
        echo "
    ";
        // line 8
        echo ($context["page_bottom"] ?? null);
        echo "
    ";
        // line 9
        echo ($context["page_footer"] ?? null);
        echo "
    ";
        // line 10
        echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "page", []), "body", []), "body_bottom", []);
        echo "
    </body>";
    }

    // line 14
    public function block_page_layout($context, array $blocks = [])
    {
        // line 15
        echo "    ";
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "joomla", [0 => true], "method");
        // line 16
        echo "    <div class=\"platform-content row-fluid\">
        <div class=\"span12\">
            <jdoc:include type=\"message\" />
            <jdoc:include type=\"component\" />
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "component.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 16,  77 => 15,  74 => 14,  68 => 10,  64 => 9,  60 => 8,  56 => 7,  52 => 6,  48 => 5,  43 => 4,  40 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "component.html.twig", "/home/m/mitiba/bardakov.rf/public_html/media/gantry5/engines/nucleus/twig/component.html.twig");
    }
}
