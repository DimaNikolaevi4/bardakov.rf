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

/* @particles/infolist.html.twig */
class __TwigTemplate_3e5504e7420036839cad597823d77b6c1c904023317c31b075ba7cb7a5ac12d6 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/infolist.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "
    <div class=\"g-infolist-particle\">

        ";
        // line 7
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            echo "<h2 class=\"g-title g-infolist-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>";
        }
        // line 8
        echo "
        ";
        // line 9
        if ($this->getAttribute(($context["particle"] ?? null), "intro", [])) {
            // line 10
            echo "            <p class=\"g-infolist-desc\">";
            echo $this->getAttribute(($context["particle"] ?? null), "intro", []);
            echo "</p>
        ";
        }
        // line 12
        echo "
        <div class=\"g-infolist ";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "cols", []));
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\">

            ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "infolists", []));
        foreach ($context['_seq'] as $context["_key"] => $context["infolist"]) {
            // line 16
            echo "                <div class=\"g-infolist-item";
            if ($this->getAttribute($context["infolist"], "icon", [])) {
                echo " g-infolist-with-icon";
            }
            if ($this->getAttribute($context["infolist"], "image", [])) {
                echo " g-infolist-with-img";
            }
            echo " ";
            if ((($this->getAttribute($context["infolist"], "image", []) && ($this->getAttribute($context["infolist"], "imageloc", []) == "center")) || ($this->getAttribute($context["infolist"], "icon", []) && ($this->getAttribute($context["infolist"], "iconloc", []) == "center")))) {
                echo "center";
            }
            echo "\">

                    <div class=\"g-infolist-item-container\">

                    ";
            // line 20
            ob_start(function () { return ''; });
            // line 21
            echo "                        <div class=\"g-infolist-item-icon ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "iconloc", []));
            echo "\">
                            <i class=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "icon", []));
            echo "\"></i>
                        </div>
                    ";
            $context["icondata"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 25
            echo "
                    ";
            // line 26
            ob_start(function () { return ''; });
            // line 27
            echo "                        <div class=\"g-infolist-item-img g-block";
            if (($this->getAttribute($context["infolist"], "imagestyle", []) == "compact")) {
                echo " size-22";
            }
            if (($this->getAttribute($context["infolist"], "imagestyle", []) == "browser")) {
                echo " browser";
            }
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "imageloc", []));
            echo " ";
            if (($this->getAttribute($context["infolist"], "imagestyle", []) == "avatar")) {
                echo "avatar";
            }
            echo "\">
                            ";
            // line 28
            if (($this->getAttribute($context["infolist"], "imagestyle", []) == "browser")) {
                // line 29
                echo "                            <div class=\"browser-wrapper\">
                                <div class=\"browser-bar\">
                                    <span class=\"browser-button\"></span>
                                </div>
                            ";
            }
            // line 34
            echo "
                                <img src=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["infolist"], "image", [])));
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["infolist"], "title", [])));
            echo "\" />

                            ";
            // line 37
            if (($this->getAttribute($context["infolist"], "imagestyle", []) == "browser")) {
                // line 38
                echo "                            </div>
                            ";
            }
            // line 40
            echo "                        </div>
                    ";
            $context["imagedata"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 42
            echo "
                    ";
            // line 43
            if (($this->getAttribute($context["infolist"], "icon", []) && ($this->getAttribute($context["infolist"], "iconloc", []) == "left"))) {
                // line 44
                echo "                        ";
                echo twig_escape_filter($this->env, ($context["icondata"] ?? null), "html", null, true);
                echo "
                    ";
            }
            // line 46
            echo "
                    ";
            // line 47
            if (($this->getAttribute($context["infolist"], "image", []) && ($this->getAttribute($context["infolist"], "imageloc", []) == "left"))) {
                // line 48
                echo "                        ";
                echo twig_escape_filter($this->env, ($context["imagedata"] ?? null), "html", null, true);
                echo "
                    ";
            }
            // line 50
            echo "
                    <div class=\"g-infolist-item-text";
            // line 51
            if (($this->getAttribute($context["infolist"], "icon", []) || $this->getAttribute($context["infolist"], "image", []))) {
                echo " ";
            }
            echo " g-infolist-textstyle-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "textstyle", []), "html", null, true);
            echo "\">
                        ";
            // line 52
            if (($this->getAttribute($context["infolist"], "icon", []) && ($this->getAttribute($context["infolist"], "iconloc", []) == "center"))) {
                // line 53
                echo "                            ";
                echo twig_escape_filter($this->env, ($context["icondata"] ?? null), "html", null, true);
                echo "
                        ";
            }
            // line 55
            echo "
                        ";
            // line 56
            if (($this->getAttribute($context["infolist"], "image", []) && ($this->getAttribute($context["infolist"], "imageloc", []) == "center"))) {
                // line 57
                echo "                            ";
                echo twig_escape_filter($this->env, ($context["imagedata"] ?? null), "html", null, true);
                echo "
                        ";
            }
            // line 59
            echo "
                        ";
            // line 60
            if (($this->getAttribute($context["infolist"], "tag", []) || $this->getAttribute($context["infolist"], "subtag", []))) {
                // line 61
                echo "                            <div class=\"g-infolist-tags\">
                                ";
                // line 62
                if ($this->getAttribute($context["infolist"], "tag", [])) {
                    // line 63
                    echo "                                    ";
                    if ($this->getAttribute($context["infolist"], "link", [])) {
                        // line 64
                        echo "                                    <a href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "link", []));
                        echo "\" target=\"";
                        echo twig_escape_filter($this->env, (($this->getAttribute($context["infolist"], "readmoretarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["infolist"], "readmoretarget", []), "_self")) : ("_self")));
                        echo "\">
                                    ";
                    }
                    // line 66
                    echo "
                                        <span class=\"g-tag\">";
                    // line 67
                    echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "tag", []));
                    echo "</span>

                                    ";
                    // line 69
                    if ($this->getAttribute($context["infolist"], "link", [])) {
                        // line 70
                        echo "                                    </a>
                                    ";
                    }
                    // line 72
                    echo "                                ";
                }
                // line 73
                echo "
                                ";
                // line 74
                if ($this->getAttribute($context["infolist"], "subtag", [])) {
                    // line 75
                    echo "                                    <span class=\"g-small\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "subtag", []));
                    echo "</span>
                                ";
                }
                // line 77
                echo "                            </div>
                        ";
            }
            // line 79
            echo "
                        ";
            // line 80
            if ($this->getAttribute($context["infolist"], "title", [])) {
                // line 81
                ob_start(function () { return ''; });
                // line 82
                echo "<div class=\"g-infolist-item-title ";
                if (($this->getAttribute($context["infolist"], "textstyle", []) == "bold")) {
                    echo "g-bold";
                }
                echo "\">";
                // line 83
                if (($this->getAttribute($context["infolist"], "textstyle", []) == "large")) {
                    // line 84
                    echo "<div class=\"g-title-hero\">";
                }
                // line 87
                if ($this->getAttribute($context["infolist"], "link", [])) {
                    // line 88
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "link", []));
                    echo "\" target=\"";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["infolist"], "readmoretarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["infolist"], "readmoretarget", []), "_self")) : ("_self")));
                    echo "\">";
                }
                // line 91
                if (($this->getAttribute($context["infolist"], "icon", []) && ($this->getAttribute($context["infolist"], "iconloc", []) == "inline"))) {
                    // line 92
                    echo "                                    <span class=\"g-infolist-item-icon-inline\">
                                        <i class=\"";
                    // line 93
                    echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "icon", []));
                    echo "\"></i>
                                    </span>
                                    ";
                }
                // line 97
                echo $this->getAttribute($context["infolist"], "title", []);
                // line 99
                if ($this->getAttribute($context["infolist"], "link", [])) {
                    // line 100
                    echo "</a>";
                }
                // line 103
                if (($this->getAttribute($context["infolist"], "textstyle", []) == "large")) {
                    // line 104
                    echo "</div>";
                }
                // line 106
                echo "</div>";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            }
            // line 109
            echo "
                        ";
            // line 110
            if ($this->getAttribute($context["infolist"], "desc", [])) {
                // line 111
                echo "                            <div class=\"g-infolist-item-desc\">
                                ";
                // line 112
                if (($this->getAttribute($context["infolist"], "textstyle", []) == "large")) {
                    // line 113
                    echo "                                <div class=\"g-large\">
                                ";
                }
                // line 115
                echo "
                                    ";
                // line 116
                echo $this->getAttribute($context["infolist"], "desc", []);
                echo "

                                ";
                // line 118
                if (($this->getAttribute($context["infolist"], "textstyle", []) == "large")) {
                    // line 119
                    echo "                                </div>
                                ";
                }
                // line 121
                echo "                            </div>
                        ";
            }
            // line 123
            echo "
                        ";
            // line 124
            if ($this->getAttribute($context["infolist"], "link", [])) {
                // line 125
                echo "                            <div class=\"g-infolist-link\">
                                <a href=\"";
                // line 126
                echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "link", []));
                echo "\" target=\"";
                echo twig_escape_filter($this->env, (($this->getAttribute($context["infolist"], "readmoretarget", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["infolist"], "readmoretarget", []), "_self")) : ("_self")));
                echo "\" class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "readmoreclass", []));
                echo "\">
                                    ";
                // line 127
                if ($this->getAttribute($context["infolist"], "buttonicon", [])) {
                    echo "<i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "buttonicon", []));
                    echo "\"></i>";
                }
                // line 128
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["infolist"], "label", []));
                echo "
                                </a>
                            </div>
                        ";
            }
            // line 132
            echo "                    </div>

                    ";
            // line 134
            if (($this->getAttribute($context["infolist"], "icon", []) && ($this->getAttribute($context["infolist"], "iconloc", []) == "right"))) {
                // line 135
                echo "                        ";
                echo twig_escape_filter($this->env, ($context["icondata"] ?? null), "html", null, true);
                echo "
                    ";
            }
            // line 137
            echo "
                    ";
            // line 138
            if (($this->getAttribute($context["infolist"], "image", []) && ($this->getAttribute($context["infolist"], "imageloc", []) == "right"))) {
                // line 139
                echo "                        ";
                echo twig_escape_filter($this->env, ($context["imagedata"] ?? null), "html", null, true);
                echo "
                    ";
            }
            // line 141
            echo "                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['infolist'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 144
        echo "
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "@particles/infolist.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  410 => 144,  402 => 141,  396 => 139,  394 => 138,  391 => 137,  385 => 135,  383 => 134,  379 => 132,  371 => 128,  365 => 127,  357 => 126,  354 => 125,  352 => 124,  349 => 123,  345 => 121,  341 => 119,  339 => 118,  334 => 116,  331 => 115,  327 => 113,  325 => 112,  322 => 111,  320 => 110,  317 => 109,  313 => 106,  310 => 104,  308 => 103,  305 => 100,  303 => 99,  301 => 97,  295 => 93,  292 => 92,  290 => 91,  283 => 88,  281 => 87,  278 => 84,  276 => 83,  270 => 82,  268 => 81,  266 => 80,  263 => 79,  259 => 77,  253 => 75,  251 => 74,  248 => 73,  245 => 72,  241 => 70,  239 => 69,  234 => 67,  231 => 66,  223 => 64,  220 => 63,  218 => 62,  215 => 61,  213 => 60,  210 => 59,  204 => 57,  202 => 56,  199 => 55,  193 => 53,  191 => 52,  183 => 51,  180 => 50,  174 => 48,  172 => 47,  169 => 46,  163 => 44,  161 => 43,  158 => 42,  154 => 40,  150 => 38,  148 => 37,  141 => 35,  138 => 34,  131 => 29,  129 => 28,  113 => 27,  111 => 26,  108 => 25,  102 => 22,  97 => 21,  95 => 20,  78 => 16,  74 => 15,  67 => 13,  64 => 12,  58 => 10,  56 => 9,  53 => 8,  47 => 7,  42 => 4,  39 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/infolist.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/infolist.html.twig");
    }
}
