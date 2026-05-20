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

/* @particles/frameworks.html.twig */
class __TwigTemplate_cf8cb1d9da18af4794d7f29c65ee5ca223b5c18e8fabc729e9fdfdfa693f392a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "jquery", []), "enabled", [])) {
            // line 2
            echo "    ";
            $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery"], "method");
            // line 3
            echo "    ";
            if ($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "jquery", []), "ui_core", [])) {
                // line 4
                echo "        ";
                $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery.ui.core"], "method");
                // line 5
                echo "    ";
            }
            // line 6
            echo "    ";
            if ($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "jquery", []), "ui_sortable", [])) {
                // line 7
                echo "        ";
                $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery.ui.sortable"], "method");
                // line 8
                echo "    ";
            }
        }
        // line 10
        echo "
";
        // line 11
        if ($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "bootstrap", []), "enabled", [])) {
            // line 12
            echo "    ";
            $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "bootstrap"], "method");
        }
        // line 14
        echo "
";
        // line 15
        if ($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "mootools", []), "enabled", [])) {
            // line 16
            echo "    ";
            $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "mootools"], "method");
            // line 17
            echo "    ";
            if ($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "mootools", []), "more", [])) {
                // line 18
                echo "        ";
                $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "mootools.more"], "method");
                // line 19
                echo "    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "@particles/frameworks.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 19,  74 => 18,  71 => 17,  68 => 16,  66 => 15,  63 => 14,  59 => 12,  57 => 11,  54 => 10,  50 => 8,  47 => 7,  44 => 6,  41 => 5,  38 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/frameworks.html.twig", "/home/m/mitiba/bardakov.rf/public_html/media/gantry5/engines/nucleus/particles/frameworks.html.twig");
    }
}
