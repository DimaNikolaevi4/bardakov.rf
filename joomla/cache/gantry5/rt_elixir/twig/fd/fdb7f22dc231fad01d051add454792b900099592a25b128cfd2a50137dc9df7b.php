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

/* @particles/simplecontent.html.twig */
class __TwigTemplate_0702b88123de1ed142a12fda41791c4d2aadf86d8dbce66ad2b2cfedabc4d9e7 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/simplecontent.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "
    <div class=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\">
        <div class=\"g-simplecontent\">

            ";
        // line 8
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>";
        }
        // line 9
        echo "
            ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 11
            echo "                <div class=\"g-simplecontent-item g-simplecontent-layout-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "layout", []), "html", null, true);
            echo "\">
                    ";
            // line 12
            ob_start(function () { return ''; });
            // line 13
            echo "                        <div class=\"g-simplecontent-item-content-title\">";
            echo $this->getAttribute($context["item"], "content_title", []);
            echo "</div>
                    ";
            $context["particle_item_title"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 15
            echo "
                    ";
            // line 16
            ob_start(function () { return ''; });
            // line 17
            echo "                        <div class=\"g-simplecontent-item-author\">";
            echo $this->getAttribute($context["item"], "author", []);
            echo "</div>
                    ";
            $context["particle_item_author"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 19
            echo "
                    ";
            // line 20
            ob_start(function () { return ''; });
            // line 21
            echo "                        <div class=\"g-simplecontent-item-created-date\">";
            echo $this->getAttribute($context["item"], "created_date", []);
            echo "</div>
                    ";
            $context["particle_item_created_date"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 23
            echo "
                    ";
            // line 24
            if (($this->getAttribute($context["item"], "layout", []) == "header")) {
                // line 25
                echo "                        ";
                if ($this->getAttribute($context["item"], "content_title", [])) {
                    echo twig_escape_filter($this->env, ($context["particle_item_title"] ?? null), "html", null, true);
                }
                // line 26
                echo "                        ";
                if ($this->getAttribute($context["item"], "author", [])) {
                    echo twig_escape_filter($this->env, ($context["particle_item_author"] ?? null), "html", null, true);
                }
                // line 27
                echo "                        ";
                if ($this->getAttribute($context["item"], "created_date", [])) {
                    echo twig_escape_filter($this->env, ($context["particle_item_created_date"] ?? null), "html", null, true);
                }
                // line 28
                echo "                    ";
            }
            // line 29
            echo "
                    ";
            // line 30
            if (($this->getAttribute($context["item"], "layout", []) != "header")) {
                // line 31
                echo "                        ";
                if ($this->getAttribute($context["item"], "created_date", [])) {
                    echo twig_escape_filter($this->env, ($context["particle_item_created_date"] ?? null), "html", null, true);
                }
                // line 32
                echo "                        ";
                if ($this->getAttribute($context["item"], "content_title", [])) {
                    echo twig_escape_filter($this->env, ($context["particle_item_title"] ?? null), "html", null, true);
                }
                // line 33
                echo "                        ";
                if ($this->getAttribute($context["item"], "author", [])) {
                    echo twig_escape_filter($this->env, ($context["particle_item_author"] ?? null), "html", null, true);
                }
                // line 34
                echo "                    ";
            }
            // line 35
            echo "
                    ";
            // line 36
            if ($this->getAttribute($context["item"], "leading_content", [])) {
                echo "<div class=\"g-simplecontent-item-leading-content\">";
                echo $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->htmlFilter($this->getAttribute($context["item"], "leading_content", []));
                echo "</div>";
            }
            // line 37
            echo "                    ";
            if ($this->getAttribute($context["item"], "main_content", [])) {
                echo "<div class=\"g-simplecontent-item-main-content\">";
                echo $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->htmlFilter($this->getAttribute($context["item"], "main_content", []));
                echo "</div>";
            }
            // line 38
            echo "
                    ";
            // line 39
            if ($this->getAttribute($context["item"], "readmore_label", [])) {
                // line 40
                echo "                        <div class=\"g-simplecontent-item-readmore-container\">
                            <a target=\"";
                // line 41
                echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "readmore_target", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "readmore_target", []), "_self")) : ("_self")));
                echo "\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "readmore_link", []));
                echo "\" class=\"g-simplecontent-item-readmore ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "readmore_class", []));
                echo "\">
                                ";
                // line 42
                echo $this->getAttribute($context["item"], "readmore_label", []);
                echo "
                            </a>
                        </div>
                    ";
            }
            // line 46
            echo "                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "@particles/simplecontent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  191 => 48,  184 => 46,  177 => 42,  169 => 41,  166 => 40,  164 => 39,  161 => 38,  154 => 37,  148 => 36,  145 => 35,  142 => 34,  137 => 33,  132 => 32,  127 => 31,  125 => 30,  122 => 29,  119 => 28,  114 => 27,  109 => 26,  104 => 25,  102 => 24,  99 => 23,  93 => 21,  91 => 20,  88 => 19,  82 => 17,  80 => 16,  77 => 15,  71 => 13,  69 => 12,  64 => 11,  60 => 10,  57 => 9,  51 => 8,  45 => 5,  42 => 4,  39 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/simplecontent.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/simplecontent.html.twig");
    }
}
