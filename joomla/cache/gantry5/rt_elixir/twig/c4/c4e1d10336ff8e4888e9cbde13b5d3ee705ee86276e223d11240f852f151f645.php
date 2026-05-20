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

/* @particles/aos.html.twig */
class __TwigTemplate_8f1381599b003a26dc791b5c837d624c71dbf4dfd218b8b4b01d73626cec0830 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascript' => [$this, 'block_javascript'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 11
        ob_start(function () { return ''; });
        // line 12
        echo "\tAOS.init({

\tduration: ";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "duration", []), "html", null, true);
        echo ",
\tonce: ";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "once", []), "html", null, true);
        echo ",
\tdelay: ";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "delay", []), "html", null, true);
        echo ",
\teasing: '";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "easing", []), "html", null, true);
        echo "',
\toffset: ";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "offset", []), "html", null, true);
        echo ",

\t});
";
        $context["init"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 22
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "addInlineScript", [0 => ($context["init"] ?? null), 1 =>  -10, 2 => "footer"], "method");
        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/aos.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 4
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"gantry-theme://css/aos.css\" />
";
    }

    // line 7
    public function block_javascript($context, array $blocks = [])
    {
        // line 8
        echo "    <script src=\"gantry-theme://js/aos.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "@particles/aos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 8,  80 => 7,  75 => 4,  72 => 3,  67 => 1,  65 => 22,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  42 => 14,  38 => 12,  36 => 11,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/aos.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/aos.html.twig");
    }
}
