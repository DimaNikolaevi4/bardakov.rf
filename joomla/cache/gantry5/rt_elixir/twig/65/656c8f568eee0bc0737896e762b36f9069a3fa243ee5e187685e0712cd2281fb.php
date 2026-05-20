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

/* @particles/slideshow.html.twig */
class __TwigTemplate_7c5b41ec225a5212da66befd4e4ad1ca4d03207a1bd914096df7187086d6eaa5 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/slideshow.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "    <div class=\"g-slideshow-wrapper\">
        <style scoped>
            #";
        // line 6
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo " .g-slideshow-slider {
                height: ";
        // line 7
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "height", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "height", []), "85vh")) : ("85vh")), "html", null, true);
        echo ";
            }

            @media only all and (max-width: ";
        // line 10
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", [], "any", false, true), "get", [0 => "styles.breakpoints.tablet-container"], "method", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", [], "any", false, true), "get", [0 => "styles.breakpoints.tablet-container"], "method"), "51rem")) : ("51rem")), "html", null, true);
        echo ") {
                #";
        // line 11
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo " .g-slideshow-slider {
                    height: ";
        // line 12
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "heightMobile", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "heightMobile", []), "500px")) : ("500px")), "html", null, true);
        echo " !important;
                }
            }
        </style>

        <div id=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" class=\"g-slideshow swiper-container ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\" data-slideshow-id=\"";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" data-slideshow-effect=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "effect", []), "html", null, true);
        echo "\" data-slideshow-autoplay=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "autoplay", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" data-slideshow-loop=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "loop", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" data-direction=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "direction", []), "html", null, true);
        echo "\" data-slideshow-timeout=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "autoplayTimeout", []), "html", null, true);
        echo "\" data-slideshow-speed=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "speed", []), "html", null, true);
        echo "\" data-slideshow-touchmove=\"";
        if (($this->getAttribute(($context["particle"] ?? null), "touchmove", []) == "enabled")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\" ";
        if (($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "direction", []) == "rtl")) {
            echo " dir=\"rtl\" ";
        }
        echo ">
            <div class=\"g-slideshow-slider swiper-wrapper\">
                ";
        // line 19
        if (( !$this->getAttribute(($context["particle"] ?? null), "source", []) || ($this->getAttribute(($context["particle"] ?? null), "source", []) == "particle"))) {
            // line 20
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", []));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 21
                echo "                        <div class=\"swiper-slide ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "class", []));
                echo "\">
                            <div class=\"slide\">
                                <div class=\"slide-content\">
                                    <div class=\"content-background\" style=\"background-image: url(";
                // line 24
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "image", [])));
                echo ");\"></div>

                                    <div class=\"content-left\">
                                        ";
                // line 27
                if ($this->getAttribute($context["item"], "main_title", [])) {
                    // line 28
                    echo "                                            <h1 class=\"g-slideshow-main-title\">
                                                ";
                    // line 29
                    if ($this->getAttribute($context["item"], "link", [])) {
                        // line 30
                        echo "                                                    <a href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", []), "html", null, true);
                        echo "\" target=\"";
                        echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "linktarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "linktarget", []), "_self")) : ("_self")), "html", null, true);
                        echo "\">";
                        echo $this->getAttribute($context["item"], "main_title", []);
                        echo "</a>
                                                ";
                    } else {
                        // line 32
                        echo "                                                    ";
                        echo $this->getAttribute($context["item"], "main_title", []);
                        echo "
                                                ";
                    }
                    // line 34
                    echo "                                            </h1>
                                        ";
                }
                // line 36
                echo "
                                        ";
                // line 37
                if ($this->getAttribute($context["item"], "description1", [])) {
                    // line 38
                    echo "                                            <div class=\"g-slideshow-description1\">
                                                ";
                    // line 39
                    echo $this->getAttribute($context["item"], "description1", []);
                    echo "
                                            </div>
                                        ";
                }
                // line 42
                echo "                                    </div>

                                    <div class=\"content-right\">
                                        ";
                // line 45
                if ($this->getAttribute($context["item"], "description2", [])) {
                    // line 46
                    echo "                                            <div class=\"g-slideshow-description2\">
                                                ";
                    // line 47
                    echo $this->getAttribute($context["item"], "description2", []);
                    echo "
                                            </div>
                                        ";
                }
                // line 50
                echo "                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "                ";
        } else {
            // line 56
            echo "                    ";
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
            try {
                $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =                 $this->loadTemplate((("@particles/slideshow-" . $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "platform", []), "name", [])) . ".html.twig"), "@particles/slideshow.html.twig", 56);
            } catch (LoaderError $e) {
                // ignore missing template
            }
            if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
                $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display($context);
            }
            // line 57
            echo "                ";
        }
        // line 58
        echo "            </div>

            ";
        // line 60
        if (($this->getAttribute(($context["particle"] ?? null), "arrows", []) == "enabled")) {
            // line 61
            echo "                ";
            if (($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", []), "direction", []) == "rtl")) {
                // line 62
                echo "                    <div class=\"navigation rtl\">
                        <div class=\"swiper-button-next\">
                            <i class=\"fa fa-angle-left\"></i>
                        </div>
                        <div class=\"swiper-button-prev\">
                            <i class=\"fa fa-angle-right\"></i>
                        </div>
                    </div>
                ";
            } else {
                // line 71
                echo "                    <div class=\"navigation\">
                        <div class=\"swiper-button-next\">
                            <i class=\"fa fa-angle-right\"></i>
                        </div>
                        <div class=\"swiper-button-prev\">
                            <i class=\"fa fa-angle-left\"></i>
                        </div>
                    </div>
                ";
            }
            // line 80
            echo "            ";
        }
        // line 81
        echo "
            ";
        // line 83
        echo "            ";
        if (((($this->getAttribute(($context["particle"] ?? null), "bullets", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "bullets", []), "enabled")) : ("enabled")) == "enabled")) {
            // line 84
            echo "                <div class=\"swiper-pagination\"></div>
            ";
        }
        // line 86
        echo "        </div>
    </div>
";
    }

    // line 90
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 91
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"gantry-theme://css/swiper.css\" />
";
    }

    // line 94
    public function block_javascript_footer($context, array $blocks = [])
    {
        // line 95
        echo "    ";
        $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery"], "method");
        // line 96
        echo "    ";
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "addScript", [0 => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/swiper.min.js"), 1 => 10, 2 => "footer"], "method");
        // line 97
        echo "    ";
        $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "document", []), "addScript", [0 => $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/slideshow.init.js"), 1 => 10, 2 => "footer"], "method");
    }

    public function getTemplateName()
    {
        return "@particles/slideshow.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  284 => 97,  281 => 96,  278 => 95,  275 => 94,  270 => 91,  267 => 90,  261 => 86,  257 => 84,  254 => 83,  251 => 81,  248 => 80,  237 => 71,  226 => 62,  223 => 61,  221 => 60,  217 => 58,  214 => 57,  203 => 56,  200 => 55,  190 => 50,  184 => 47,  181 => 46,  179 => 45,  174 => 42,  168 => 39,  165 => 38,  163 => 37,  160 => 36,  156 => 34,  150 => 32,  140 => 30,  138 => 29,  135 => 28,  133 => 27,  127 => 24,  120 => 21,  115 => 20,  113 => 19,  74 => 17,  66 => 12,  62 => 11,  58 => 10,  52 => 7,  48 => 6,  44 => 4,  41 => 3,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/slideshow.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/slideshow.html.twig");
    }
}
