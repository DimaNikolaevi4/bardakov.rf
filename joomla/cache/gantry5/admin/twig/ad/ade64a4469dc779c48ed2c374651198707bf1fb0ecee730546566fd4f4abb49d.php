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

/* forms/fields/joomla/categories.html.twig */
class __TwigTemplate_07a08d905e305292eba504de87423660f1a930cdce51dd8584b4a8dd67a05e61 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'global_attributes' => [$this, 'block_global_attributes'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "forms/fields/input/selectize.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("forms/fields/input/selectize.html.twig", "forms/fields/joomla/categories.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_global_attributes($context, array $blocks = [])
    {
        // line 4
        echo "    ";
        $context["categories"] = twig_array_merge((($this->getAttribute(($context["field"] ?? null), "options", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["field"] ?? null), "options", []), [])) : ([])), $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", []), "finder", [0 => "categories"], "method"), "published", [0 => [0 => 0, 1 => 1]], "method"), "limit", [0 => 0], "method"), "find", [], "method"));
        // line 5
        echo "    ";
        $context["Options"] = $this->getAttribute($this->getAttribute(($context["field"] ?? null), "selectize", []), "Options", []);
        // line 6
        echo "    ";
        $context["options"] = [];
        // line 7
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["category"]) {
            // line 8
            echo "        ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => ["value" => $this->getAttribute($context["category"], "id", []), "text" => ($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->repeatFilter("- ", ($this->getAttribute($context["category"], "level", []) - 1)) . $this->getAttribute($context["category"], "title", []))]]);
            // line 9
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "    ";
        $context["field"] = twig_array_merge(twig_array_merge(($context["field"] ?? null), (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "selectize", [], "any", false, true), "Options", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["field"] ?? null), "selectize", [], "any", false, true), "Options", []), [])) : ([]))), ["selectize" => ["delimiter" => ",", "Options" => ($context["options"] ?? null)]]);
        // line 11
        echo "
    data-selectize=\"";
        // line 12
        echo (($this->getAttribute(($context["field"] ?? null), "selectize", [], "any", true, true)) ? (twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "selectize", [])), "html_attr")) : (""));
        echo "\"
    ";
        // line 13
        $this->displayParentBlock("global_attributes", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "forms/fields/joomla/categories.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 13,  71 => 12,  68 => 11,  65 => 10,  59 => 9,  56 => 8,  51 => 7,  48 => 6,  45 => 5,  42 => 4,  39 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "forms/fields/joomla/categories.html.twig", "/home/m/mitiba/bardakov.rf/public_html/administrator/components/com_gantry5/templates/forms/fields/joomla/categories.html.twig");
    }
}
