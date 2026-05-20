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

/* @particles/flipster.html.twig */
class __TwigTemplate_7b19ab4b58b1d076de10e44f941bca526d1d7bdb47229ed9eb94d193a5f06fb0 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/flipster.html.twig", 1);
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
        echo "
        <div id=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" data-flipster-id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" data-flipster-start=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "start", []), "html", null, true);
        echo "\" data-flipster-fadein=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "fadein", []), "html", null, true);
        echo "\" data-flipster-loop=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "loop", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" data-flipster-autoplay=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "autoplay", []) > 0)) {
            echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "autoplay", []), "html", null, true);
        } else {
            echo "false";
        }
        echo "\" data-flipster-pauseonhover=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "pauseonhover", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" data-flipster-style=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "style", []), "html", null, true);
        echo "\" data-flipster-spacing=\"-0.2\" data-flipster-click=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "click", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" data-flipster-keyboard=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "keyboard", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" data-flipster-scrollwheel=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "scrollwheel", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"  data-flipster-touch=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "touch", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" class=\"g-flipster\">
            <div class=\"g-flipster-cards\">
                ";
        // line 9
        if (( !$this->getAttribute(($context["particle"] ?? null), "source", []) || ($this->getAttribute(($context["particle"] ?? null), "source", []) == "particle"))) {
            // line 10
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", []));
            foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
                // line 11
                echo "                        <div class=\"g-flipster-card g-flipster-card-accent-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "accent", []), "html", null, true);
                echo "\" ";
                if ($this->getAttribute($context["card"], "width", [])) {
                    echo "style=\"width: ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "width", []), "html", null, true);
                    echo "px;\"";
                }
                echo ">
                            <div class=\"g-flipster-card-container ";
                // line 12
                if ($this->getAttribute($context["card"], "image", [])) {
                    echo "g-flipster-card-image";
                }
                echo "\">
                                ";
                // line 13
                if ( !$this->getAttribute($context["card"], "image", [])) {
                    // line 14
                    echo "                                    <div class=\"g-flipster-description\">
                                        ";
                    // line 15
                    echo $this->getAttribute($context["card"], "desc", []);
                    echo "
                                    </div>
                                    <div class=\"g-flipster-title\">
                                        ";
                    // line 18
                    echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "title", []), "html", null, true);
                    echo "
                                    </div>
                                    ";
                    // line 20
                    if ($this->getAttribute($context["card"], "buttontext", [])) {
                        // line 21
                        echo "                                        <div class=\"g-flipster-button\">
                                            <a target=\"";
                        // line 22
                        echo twig_escape_filter($this->env, (($this->getAttribute($context["card"], "buttontarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["card"], "buttontarget", []), "_self")) : ("_self")));
                        echo "\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "buttonlink", []));
                        echo "\" title=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "buttontext", []));
                        echo "\" class=\"button ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "buttonclass", []));
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["card"], "buttontext", []));
                        echo "</a>
                                        </div>
                                    ";
                    }
                    // line 25
                    echo "                                ";
                } else {
                    // line 26
                    echo "                                    <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["card"], "image", [])));
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, _twig_default_filter(twig_escape_filter($this->env, $this->getAttribute($context["card"], "title", [])), $this->getAttribute($context["card"], "image", [])), "html", null, true);
                    echo "\" />
                                ";
                }
                // line 28
                echo "                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['card'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "                ";
        } else {
            // line 32
            echo "                    ";
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
            try {
                $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =                 $this->loadTemplate((("@particles/flipster-" . $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", []), "name", [])) . ".html.twig"), "@particles/flipster.html.twig", 32);
            } catch (LoaderError $e) {
                // ignore missing template
            }
            if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
                $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display($context);
            }
            // line 33
            echo "                ";
        }
        // line 34
        echo "            </div>
        </div>
    </div>
";
    }

    // line 39
    public function block_javascript_footer($context, array $blocks = [])
    {
        // line 40
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/jquery.flipster.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/jquery.flipster.init.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "@particles/flipster.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  222 => 41,  217 => 40,  214 => 39,  207 => 34,  204 => 33,  193 => 32,  190 => 31,  182 => 28,  174 => 26,  171 => 25,  157 => 22,  154 => 21,  152 => 20,  147 => 18,  141 => 15,  138 => 14,  136 => 13,  130 => 12,  119 => 11,  114 => 10,  112 => 9,  57 => 7,  54 => 6,  48 => 5,  43 => 4,  40 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/flipster.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/flipster.html.twig");
    }
}
