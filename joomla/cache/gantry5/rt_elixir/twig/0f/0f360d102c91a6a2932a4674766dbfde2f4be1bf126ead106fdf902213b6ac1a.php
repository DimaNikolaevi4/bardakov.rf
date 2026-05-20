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

/* @particles/accordion.html.twig */
class __TwigTemplate_3e4274274f84352dc6111c1d19ebf4bc962879cd15df8d5a93a4565eabecfc47 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'particle' => [$this, 'block_particle'],
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/accordion.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "    <div class=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\">
        ";
        // line 5
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>";
        }
        // line 6
        echo "        <ul class=\"accordion\" id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" data-accordion-id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\">

            ";
        // line 8
        if (($this->getAttribute(($context["particle"] ?? null), "source", []) == "joomla")) {
            // line 9
            echo "
                ";
            // line 11
            echo "                ";
            $context["category_options"] = (($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", []), "categories", [])) ? (["id" => [0 => twig_split_filter($this->env, $this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", []), "categories", []), ","), 1 => 0]]) : ([]));
            // line 12
            echo "                ";
            $context["categories_finder"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["joomla"] ?? null), "finder", [0 => "category", 1 => ($context["category_options"] ?? null)], "method"), "published", [0 => 1], "method"), "language", [], "method"), "find", [], "method");
            // line 13
            echo "                ";
            $context["article_finder"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["joomla"] ?? null), "finder", [0 => "content"], "method"), "category", [0 => ($context["categories_finder"] ?? null)], "method"), "published", [0 => 1], "method"), "featured", [0 => false], "method"), "language", [], "method");
            // line 14
            echo "                ";
            $context["items"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["article_finder"] ?? null), "order", [0 => "publish_up", 1 => "ASC"], "method"), "limit", [0 => (($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", [], "any", false, true), "articles", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", [], "any", false, true), "articles", []), "1")) : ("1"))], "method"), "start", [0 => 0], "method"), "find", [], "method");
            // line 15
            echo "
                ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 17
                echo "                    <li id=\"accordion-id";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", []), "html", null, true);
                echo "\" >
                        <div class=\"accordion-item-title\">";
                // line 18
                if ($this->getAttribute($context["item"], "title", [])) {
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", []));
                }
                // line 19
                echo "                            <span class=\"indicator\"><span>+</span></span>
                        </div>
                        <div class=\"accordion-item-content\">
                            ";
                // line 22
                if ((($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", []), "introtext", []) == "enabled") && $this->getAttribute($context["item"], "introtext", []))) {
                    echo $this->getAttribute($context["item"], "introtext", []);
                }
                // line 23
                echo "                            ";
                if ((($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", []), "link", []) == "enabled") && $this->getAttribute($context["item"], "route", []))) {
                    // line 24
                    echo "                                <br /><br />
                                <span class=\"accor-button\">
                                    <a target=\"";
                    // line 26
                    echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", [], "any", false, true), "linktarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", [], "any", false, true), "linktarget", []), "_self")) : ("_self")));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "route", []));
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", []));
                    echo "\" class=\"button\">";
                    echo (($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", [], "any", false, true), "linktext", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["particle"] ?? null), "joomla", [], "any", false, true), "linktext", []), "Read more")) : ("Read more"));
                    echo "</a>
                                </span>
                            ";
                }
                // line 29
                echo "                        </div>
                    </li>
                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "
            ";
        } else {
            // line 34
            echo "
                ";
            // line 36
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", []));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 37
                echo "                    <li id=\"accordion-id";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", []), "html", null, true);
                echo "\" >
                        <div class=\"accordion-item-title\">";
                // line 38
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", []), "html", null, true);
                echo "
                            <span class=\"indicator\"><span>+</span></span>
                        </div>
                        <div class=\"accordion-item-content\">
                            ";
                // line 42
                echo $this->getAttribute($context["item"], "desc", []);
                echo "
                            ";
                // line 43
                if ($this->getAttribute($context["item"], "buttontext", [])) {
                    // line 44
                    echo "                                <br /><br />
                                <span class=\"accor-button\">
                                    <a target=\"";
                    // line 46
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "buttontarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "buttontarget", []), "_self")) : ("_self")));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttonlink", []));
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttontext", []));
                    echo "\" class=\"button ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttonclass", []));
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttontext", []));
                    echo "</a>
                                </span>
                            ";
                }
                // line 49
                echo "                        </div>
                    </li>
                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "
            ";
        }
        // line 54
        echo "        </ul>
    </div>
";
    }

    // line 58
    public function block_javascript_footer($context, array $blocks = [])
    {
        // line 59
        $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery"], "method");
        // line 60
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/accordion.init.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "@particles/accordion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 60,  242 => 59,  239 => 58,  233 => 54,  229 => 52,  213 => 49,  199 => 46,  195 => 44,  193 => 43,  189 => 42,  182 => 38,  177 => 37,  159 => 36,  156 => 34,  152 => 32,  136 => 29,  124 => 26,  120 => 24,  117 => 23,  113 => 22,  108 => 19,  104 => 18,  99 => 17,  82 => 16,  79 => 15,  76 => 14,  73 => 13,  70 => 12,  67 => 11,  64 => 9,  62 => 8,  54 => 6,  48 => 5,  43 => 4,  40 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/accordion.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/accordion.html.twig");
    }
}
