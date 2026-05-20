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

/* @gantry-admin/partials/layout.html.twig */
class __TwigTemplate_6e02482a51cef471d68dfcca1306798983e28892255c32422603497556110aa1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascript' => [$this, 'block_javascript'],
            'content' => [$this, 'block_content'],
            'gantry_content_wrapper' => [$this, 'block_gantry_content_wrapper'],
            'gantry' => [$this, 'block_gantry'],
            'footer_section' => [$this, 'block_footer_section'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@gantry-admin/partials/page.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("@gantry-admin/partials/page.html.twig", "@gantry-admin/partials/layout.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 4
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/css-compiled/g-admin.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/css/font-awesome6-all.min.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/css/font-awesome6-shim.min.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    ";
        // line 7
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 10
    public function block_javascript($context, array $blocks = [])
    {
        // line 11
        echo "    <script type=\"text/javascript\" defer=\"defer\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-admin://assets/js/main.js"), "html", null, true);
        echo "\"></script>
    ";
        // line 12
        $this->loadTemplate("@gantry-admin/partials/js-translations.html.twig", "@gantry-admin/partials/layout.html.twig", 12)->display($context);
        // line 13
        echo "    ";
        $this->displayParentBlock("javascript", $context, $blocks);
        echo "
";
    }

    // line 16
    public function block_content($context, array $blocks = [])
    {
        // line 17
        echo "<div id=\"g5-container\">
    <div class=\"inner-container\">
        ";
        // line 19
        $this->displayBlock('gantry_content_wrapper', $context, $blocks);
        // line 34
        echo "    </div>
</div>
";
    }

    // line 19
    public function block_gantry_content_wrapper($context, array $blocks = [])
    {
        // line 20
        echo "            <div data-g5-content-wrapper=\"\">
                <div class=\"g-grid\">
                    <div class=\"g-block main-block\">
                        <div id=\"g-main\">
                            <div class=\"g-content\" data-g5-content=\"\">
                                ";
        // line 25
        $this->displayBlock('gantry', $context, $blocks);
        // line 28
        echo "                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    // line 25
    public function block_gantry($context, array $blocks = [])
    {
        // line 26
        echo "                                    ";
        echo ($context["content"] ?? null);
        echo "
                                ";
    }

    // line 38
    public function block_footer_section($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 38,  122 => 26,  119 => 25,  110 => 28,  108 => 25,  101 => 20,  98 => 19,  92 => 34,  90 => 19,  86 => 17,  83 => 16,  76 => 13,  74 => 12,  69 => 11,  66 => 10,  60 => 7,  56 => 6,  52 => 5,  47 => 4,  44 => 3,  34 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@gantry-admin/partials/layout.html.twig", "/home/m/mitiba/bardakov.rf/public_html/administrator/components/com_gantry5/templates/partials/layout.html.twig");
    }
}
