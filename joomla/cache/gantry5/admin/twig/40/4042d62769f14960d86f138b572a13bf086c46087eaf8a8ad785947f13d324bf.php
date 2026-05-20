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

/* @gantry-admin/modals/particle.html.twig */
class __TwigTemplate_e9e8ec9f4e0217c80166e74f2a252eab596e3249adc26d53a082c4b466188953 extends \Twig\Template
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
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/modals/particle.html.twig", 1);
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
        echo twig_escape_filter($this->env, $this->getAttribute(($context["gantry"] ?? null), "route", [0 => ($context["action"] ?? null)], "method"), "html", null, true);
        echo "\">
    <div class=\"g-tabs\" role=\"tablist\">
        <ul>
            <li class=\"active\">
                <a href=\"#\" id=\"g-settings-particle-tab\" role=\"presentation\" aria-controls=\"g-settings-particle\" role=\"tab\" aria-expanded=\"true\">
                    ";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_PARTICLE"), "html", null, true);
        echo "
                </a>
            </li>
            ";
        // line 12
        if (($context["block"] ?? null)) {
            // line 13
            echo "            <li>
                <a href=\"#\" id=\"g-settings-block-tab\" role=\"presentation\" aria-controls=\"g-settings-block\" role=\"tab\" aria-expanded=\"false\">
                    ";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_BLOCK"), "html", null, true);
            echo "
                </a>
            </li>
            ";
        }
        // line 19
        echo "        </ul>
    </div>

    <div class=\"g-panes\">
        <div class=\"g-pane active\" role=\"tabpanel\" id=\"g-settings-particle\" aria-labelledby=\"g-settings-particle-tab\" aria-expanded=\"true\">
            <div class=\"card settings-block\">
                <h4>
                    <span data-title-editable=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", []), "html", null, true);
        echo "\" class=\"title\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", []), "html", null, true);
        echo "</span>
                    <i class=\"fa fa-pencil fa-pencil-alt font-small\" aria-hidden=\"true\" tabindex=\"0\" aria-label=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_EDIT_TITLE", $this->getAttribute(($context["item"] ?? null), "title", [])), "html", null, true);
        echo "\" data-title-edit=\"\"></i>
                    <span class=\"badge font-small\">";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", []), "type", []), "html", null, true);
        echo "</span>
                    ";
        // line 29
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "form", []), "fields", []), "enabled", [])) {
            // line 30
            echo "                    ";
            $this->loadTemplate("forms/fields/enable/enable.html.twig", "@gantry-admin/modals/particle.html.twig", 30)->display(twig_array_merge($context, ["name" => (($context["prefix"] ?? null) . "enabled"), "field" => $this->getAttribute($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "form", []), "fields", []), "enabled", []), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", []), "particle", []), "enabled", []), "default" => 1]));
            // line 31
            echo "                    ";
        }
        // line 32
        echo "                </h4>

                <div class=\"inner-params\">
                    ";
        // line 35
        $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/modals/particle.html.twig", 35)->display(twig_array_merge($context, ["blueprints" => $this->getAttribute(($context["particle"] ?? null), "form", []), "data" => ($context["data"] ?? null), "prefix" => ($context["prefix"] ?? null), "skip" => [0 => "enabled"]]));
        // line 36
        echo "                </div>
            </div>
        </div>

        ";
        // line 40
        if (($context["block"] ?? null)) {
            // line 41
            echo "        <div class=\"g-pane\" role=\"tabpanel\" id=\"g-settings-block\" aria-labelledby=\"g-settings-block-tab\" aria-expanded=\"false\">
            <div class=\"card settings-block\">
                <h4>
                    ";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_BLOCK"), "html", null, true);
            echo "
                </h4>
                <div class=\"inner-params\">
                    ";
            // line 47
            $this->loadTemplate("forms/fields.html.twig", "@gantry-admin/modals/particle.html.twig", 47)->display(twig_array_merge($context, ["blueprints" => $this->getAttribute(($context["block"] ?? null), "form", []), "data" => $this->getAttribute(($context["item"] ?? null), "options", []), "prefix" => "block."]));
            // line 48
            echo "                </div>
            </div>
        </div>
        ";
        }
        // line 52
        echo "    </div>

    <div class=\"g-modal-actions\">
        <button class=\"button button-primary\" type=\"submit\">";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY"), "html", null, true);
        echo "</button>
        <button class=\"button button-primary\" data-apply-and-save=\"\">";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_APPLY_SAVE"), "html", null, true);
        echo "</button>
        <button class=\"button g5-dialog-close\">";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_CANCEL"), "html", null, true);
        echo "</button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/modals/particle.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 57,  143 => 56,  139 => 55,  134 => 52,  128 => 48,  126 => 47,  120 => 44,  115 => 41,  113 => 40,  107 => 36,  105 => 35,  100 => 32,  97 => 31,  94 => 30,  92 => 29,  88 => 28,  84 => 27,  78 => 26,  69 => 19,  62 => 15,  58 => 13,  56 => 12,  50 => 9,  41 => 4,  38 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@gantry-admin/modals/particle.html.twig", "/home/m/mitiba/bardakov.rf/public_html/administrator/components/com_gantry5/templates/modals/particle.html.twig");
    }
}
