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

/* @gantry-admin/pages/configurations/settings/field.html.twig */
class __TwigTemplate_e1aa264a0beaa592f98a7041fed40845a123cfb87aa34060f22cb11f0d93d3d9 extends \Twig\Template
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
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/pages/configurations/settings/field.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = [])
    {
        // line 4
        $context["action"] = $this->getAttribute(($context["gantry"] ?? null), "route", [0 => (twig_replace_filter(($context["route"] ?? null), ["." => "/"]) . "/validate")], "method");
        // line 5
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, ($context["action"] ?? null), "html", null, true);
        echo "\">
    ";
        // line 6
        if (($this->getAttribute(($context["blueprints"] ?? null), "type", []) == "collection.list")) {
            // line 7
            echo "        ";
            $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/pages/configurations/settings/field.html.twig", 7)->display($context);
            // line 8
            echo "    ";
        } else {
            // line 9
            echo "        <div class=\"card settings-block\">
            <h4>
                ";
            // line 11
            if (($context["title"] ?? null)) {
                // line 12
                echo "                    <span data-title-editable=\"";
                echo twig_escape_filter($this->env, twig_trim_filter($this->getAttribute($this->getAttribute(($context["data"] ?? null), "data", []), ($context["title"] ?? null), [], "array")), "html", null, true);
                echo "\" data-collection-key=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . ($context["title"] ?? null))), "html", null, true);
                echo "\" class=\"title\">
                        ";
                // line 13
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["data"] ?? null), "data", []), ($context["title"] ?? null), [], "array"), "html", null, true);
                echo "
                    </span>
                    <i class=\"fa fa-pencil fa-pencil-alt font-small\" aria-hidden=\"true\" tabindex=\"0\" aria-label=\"";
                // line 15
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_EDIT_TITLE", twig_trim_filter($this->getAttribute($this->getAttribute(($context["data"] ?? null), "data", []), ($context["title"] ?? null), [], "array"))), "html", null, true);
                echo "\" data-title-edit=\"\"></i>
                ";
            } else {
                // line 17
                echo "                ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_EDIT"), "html", null, true);
                echo "
                ";
            }
            // line 19
            echo "            </h4>
            <div class=\"inner-params\">
                ";
            // line 21
            $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/pages/configurations/settings/field.html.twig", 21)->display(twig_array_merge($context, ["skip" => [0 => ($context["title"] ?? null)]]));
            // line 22
            echo "            </div>
        </div>
    ";
        }
        // line 25
        echo "    <div class=\"g-modal-actions\">
        <button class=\"button button-primary\" type=\"submit\">";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY"), "html", null, true);
        echo "</button>
        <button class=\"button button-primary\" data-apply-and-save=\"\">";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY_SAVE"), "html", null, true);
        echo "</button>
        <button class=\"button g5-dialog-close\">";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_CANCEL"), "html", null, true);
        echo "</button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/configurations/settings/field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 28,  103 => 27,  99 => 26,  96 => 25,  91 => 22,  89 => 21,  85 => 19,  79 => 17,  74 => 15,  69 => 13,  62 => 12,  60 => 11,  56 => 9,  53 => 8,  50 => 7,  48 => 6,  43 => 5,  41 => 4,  38 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@gantry-admin/pages/configurations/settings/field.html.twig", "/home/m/mitiba/bardakov.rf/public_html/administrator/components/com_gantry5/templates/pages/configurations/settings/field.html.twig");
    }
}
