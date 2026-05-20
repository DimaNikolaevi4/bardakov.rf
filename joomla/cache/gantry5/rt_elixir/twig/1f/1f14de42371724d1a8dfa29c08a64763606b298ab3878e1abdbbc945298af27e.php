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

/* @particles/locations.html.twig */
class __TwigTemplate_2255879dd179d29a2d64c72a1d366fc8089dfe0fccf3edddcf9bafd085feb75c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'particle' => [$this, 'block_particle'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/locations.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "\t<div class=\"g-locations-particle ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\">
\t\t";
        // line 5
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            // line 6
            echo "\t\t\t<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>
\t\t";
        }
        // line 8
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "pins", []));
        foreach ($context['_seq'] as $context["_key"] => $context["pin"]) {
            // line 9
            echo "\t\t\t<div class=\"g-location-container\">
\t\t\t\t";
            // line 10
            if ($this->getAttribute($context["pin"], "icon", [])) {
                // line 11
                echo "\t\t\t\t\t<i class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["pin"], "icon", []), "html", null, true);
                echo "\"></i>
\t\t\t\t";
            }
            // line 13
            echo "\t\t\t\t<h2>
\t\t\t\t\t<a target=\"";
            // line 14
            echo twig_escape_filter($this->env, (($this->getAttribute($context["pin"], "target", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["pin"], "target", []), "_blank")) : ("_blank")), "html", null, true);
            echo "\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pin"], "link", []));
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pin"], "name", []), "html", null, true);
            echo "\">
\t\t\t\t\t\t";
            // line 15
            echo $this->getAttribute($context["pin"], "name", []);
            echo "</a>
\t\t\t\t</h2>
\t\t\t\t<span>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["pin"], "phone", []), "html", null, true);
            echo "</span>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pin'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "\t</div>
";
    }

    public function getTemplateName()
    {
        return "@particles/locations.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 20,  87 => 17,  82 => 15,  74 => 14,  71 => 13,  65 => 11,  63 => 10,  60 => 9,  55 => 8,  49 => 6,  47 => 5,  42 => 4,  39 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/locations.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/locations.html.twig");
    }
}
