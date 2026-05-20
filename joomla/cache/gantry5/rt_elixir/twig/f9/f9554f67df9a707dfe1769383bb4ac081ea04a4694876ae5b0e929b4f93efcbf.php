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

/* @particles/image.html.twig */
class __TwigTemplate_c1b19bbba9b7b084dbc7c3c8c35a5a26d275be7eb78b684f8c3747ae80d6c564 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/image.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "\t";
        $context["url"] = _twig_default_filter($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute(($context["particle"] ?? null), "url", [])), $this->getAttribute(($context["gantry"] ?? null), "siteUrl", [], "method"));
        // line 5
        echo "\t";
        if ((($context["url"] ?? null) == $this->getAttribute(($context["gantry"] ?? null), "siteUrl", [], "method"))) {
            // line 6
            echo "\t\t";
            $context["rel"] = "rel=\"home\"";
            // line 7
            echo "\t";
        }
        // line 8
        echo "\t";
        $context["image"] = $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute(($context["particle"] ?? null), "image", []));
        // line 9
        echo "\t";
        if ($this->getAttribute(($context["particle"] ?? null), "link", [])) {
            // line 10
            echo "\t\t<a href=\"";
            echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
            echo "\" class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
            echo "\" target=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "target", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "target", []), "_self")) : ("_self")), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "title", []), "html", null, true);
            echo "\" ";
            echo ((array_key_exists("rel", $context)) ? (_twig_default_filter(($context["rel"] ?? null), "")) : (""));
            echo ">
\t\t";
        }
        // line 12
        echo "
\t\t";
        // line 13
        if ( !twig_test_empty($this->getAttribute(($context["particle"] ?? null), "svg", []))) {
            // line 14
            echo "\t\t\t";
            echo $this->getAttribute(($context["particle"] ?? null), "svg", []);
            echo "
\t\t";
        } elseif (        // line 15
($context["image"] ?? null)) {
            // line 16
            echo "\t\t\t<img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute(($context["particle"] ?? null), "image", [])), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "text", []), "html", null, true);
            echo "\"/>
\t\t";
        }
        // line 18
        echo "
\t\t";
        // line 19
        if ($this->getAttribute(($context["particle"] ?? null), "link", [])) {
            // line 20
            echo "\t\t</a>
\t\t";
        } else {
            // line 22
            echo "\t";
        }
    }

    public function getTemplateName()
    {
        return "@particles/image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 22,  99 => 20,  97 => 19,  94 => 18,  86 => 16,  84 => 15,  79 => 14,  77 => 13,  74 => 12,  60 => 10,  57 => 9,  54 => 8,  51 => 7,  48 => 6,  45 => 5,  42 => 4,  39 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/image.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/image.html.twig");
    }
}
