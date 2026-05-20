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

/* @particles/quickmenu.html.twig */
class __TwigTemplate_c7f031737e9628740e8f38cba6c1aa898de15bb69eeeb675c9eb6c5282154ee0 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'particle' => [$this, 'block_particle'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascript_footer' => [$this, 'block_javascript_footer'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/quickmenu.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "    <div class=\"g-quickmenu-particle ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\" data-quickmenu-id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\">
        ";
        // line 5
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            // line 6
            echo "            <h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>
        ";
        }
        // line 8
        echo "
        <div class=\"g-quickmenu-container-cards swiper-container thumbs\">
            <div class=\"swiper-wrapper\">
                ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "cards", []));
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 12
            echo "                    <div class=\"swiper-slide\">
                        <h6>";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["menu"], "title", []), "html", null, true);
            echo "</h6>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "            </div>
        </div>

        <div class=\"g-quickmenu-container-items swiper-container items\">
            <div class=\"swiper-wrapper\">
                ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "cards", []));
        foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
            // line 22
            echo "                    <div class=\"swiper-slide\">
                        ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["menu"], "items", []));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 24
                echo "                            <div class=\"g-quickmenu-wrapper\">
                                <div class=\"g-quickmenu-item\">
                                    <a target=\"";
                // line 26
                echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "target", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "target", []), "_blank")) : ("_blank")), "html", null, true);
                echo "\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", []));
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", []), "html", null, true);
                echo "\">";
                echo $this->getAttribute($context["item"], "title", []);
                echo "</a>
                                    <p>";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", []), "html", null, true);
                echo "</p>
                                </div>

                                <div class=\"g-quickmenu-price\">
                                    <span>";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "price", []), "html", null, true);
                echo "</span>
                                </div>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "            </div>
            <div class=\"swiper-pagination\"></div>
        </div>
    </div>
";
    }

    // line 43
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 44
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"gantry-theme://css/swiper.css\"/>
";
    }

    // line 47
    public function block_javascript_footer($context, array $blocks = [])
    {
        // line 48
        echo "    ";
        $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery"], "method");
        // line 49
        echo "    ";
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "addScript", [0 => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/swiper.min.js"), 1 => 10, 2 => "footer"], "method");
        // line 50
        echo "    ";
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "addScript", [0 => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/quickmenu.init.js"), 1 => 10, 2 => "footer"], "method");
    }

    public function getTemplateName()
    {
        return "@particles/quickmenu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 50,  158 => 49,  155 => 48,  152 => 47,  147 => 44,  144 => 43,  136 => 37,  129 => 35,  119 => 31,  112 => 27,  102 => 26,  98 => 24,  94 => 23,  91 => 22,  87 => 21,  80 => 16,  71 => 13,  68 => 12,  64 => 11,  59 => 8,  53 => 6,  51 => 5,  44 => 4,  41 => 3,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/quickmenu.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/quickmenu.html.twig");
    }
}
