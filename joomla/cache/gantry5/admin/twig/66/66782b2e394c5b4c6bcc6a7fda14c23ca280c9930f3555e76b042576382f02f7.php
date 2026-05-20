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

/* @gantry-admin/pages/menu/menuitem.html.twig */
class __TwigTemplate_7c956ba258c260572f5c3d9f9f0cff9e896fe2190ef04debb14a4f90cd745cfb extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'gantry' => [$this, 'block_gantry'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/pages/menu/menuitem.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = [])
    {
        // line 4
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["gantry"] ?? null), "route", [0 => "menu/edit", 1 => ($context["id"] ?? null), 2 => $this->getAttribute(($context["item"] ?? null), "path", []), 3 => "validate"], "method"), "html", null, true);
        echo "\">
    <div class=\"card settings-block\">
        <h4>
            <span class=\"g-menuitem-path font-small\">
                ";
        // line 8
        echo twig_join_filter($this->getAttribute(($context["item"] ?? null), "getEscapedTitles", [0 => false], "method"), " <i class=\"fa fa-caret-right\"></i> ");
        echo "
            </span>
            <span data-title-editable=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "title", []), "html", null, true);
        echo "\" class=\"title\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "title", []), "html", null, true);
        echo "</span>
            <i class=\"fa fa-pencil fa-pencil-alt font-small\" aria-hidden=\"true\" tabindex=\"0\" aria-label=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_EDIT_TITLE", $this->getAttribute(($context["data"] ?? null), "title", [])), "html", null, true);
        echo "\" data-title-edit=\"\"></i>
            ";
        // line 12
        if ($this->getAttribute($this->getAttribute(($context["blueprints"] ?? null), "fields", []), ".enabled", [], "array")) {
            // line 13
            echo "            ";
            $this->loadTemplate("forms/fields/enable/enable.html.twig", "@gantry-admin/pages/menu/menuitem.html.twig", 13)->display(twig_array_merge($context, ["default" => true, "name" => "enabled", "field" => $this->getAttribute($this->getAttribute(($context["blueprints"] ?? null), "fields", []), ".enabled", [], "array"), "value" => $this->getAttribute(($context["data"] ?? null), "enabled", [])]));
            // line 14
            echo "            ";
        }
        // line 15
        echo "        </h4>
        <div class=\"inner-params\">
            ";
        // line 17
        $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/pages/menu/menuitem.html.twig", 17)->display(twig_array_merge($context, ["skip" => [0 => "enabled", 1 => "title", 2 => ((($this->getAttribute(($context["data"] ?? null), "level", []) > 1)) ? ("dropdown") : ("-noitem-"))]]));
        // line 18
        echo "        </div>
    </div>
    <div class=\"g-modal-actions\">
        ";
        // line 21
        if ($this->getAttribute(($context["gantry"] ?? null), "authorize", [0 => "menu.edit", 1 => ($context["id"] ?? null), 2 => $this->getAttribute(($context["item"] ?? null), "path", [])], "method")) {
            // line 22
            echo "        ";
            // line 23
            echo "        <button class=\"button button-primary\" type=\"submit\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY"), "html", null, true);
            echo "</button>
        <button class=\"button button-primary\" data-apply-and-save=\"\">";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY_SAVE"), "html", null, true);
            echo "</button>
        ";
        }
        // line 26
        echo "        <button class=\"button g5-dialog-close\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_CANCEL"), "html", null, true);
        echo "</button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/menu/menuitem.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 26,  92 => 24,  87 => 23,  85 => 22,  83 => 21,  78 => 18,  76 => 17,  72 => 15,  69 => 14,  66 => 13,  64 => 12,  60 => 11,  54 => 10,  49 => 8,  41 => 4,  38 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@gantry-admin/pages/menu/menuitem.html.twig", "/home/m/mitiba/bardakov.rf/public_html/administrator/components/com_gantry5/templates/pages/menu/menuitem.html.twig");
    }
}
