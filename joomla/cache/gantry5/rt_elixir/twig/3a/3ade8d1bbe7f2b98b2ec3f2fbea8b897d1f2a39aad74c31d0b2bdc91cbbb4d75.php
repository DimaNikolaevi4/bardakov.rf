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

/* @particles/video.html.twig */
class __TwigTemplate_e9d37b16d9f082a860597302703a4d9b3ecb19edd8b8188950b2bbd7b496607f extends \Twig\Template
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
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/video.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"g-video-container g-video-container-columns-";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "columns", []), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\" >
    ";
        // line 5
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>";
        }
        // line 6
        echo "    ";
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
            // line 7
            echo "
    <div class=\"g-video-inner\">
        <div id=\"g-";
            // line 9
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", []), "html", null, true);
            echo "\" data-g-video-id=\"g-";
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", []), "html", null, true);
            echo "\"  class=\"g-video\">
            ";
            // line 10
            if (($this->getAttribute($context["item"], "source", []) == "vimeo")) {
                // line 11
                echo "            <iframe width=\"100%\" height=\"auto\" src=\"https://player.vimeo.com/video/";
                echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute($context["item"], "video", []), ["https://vimeo.com/" => "", "https://vimeo.com/ondemand/" => ""]), "html", null, true);
                echo "?autoplay=";
                if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "&amp;loop=";
                if (($this->getAttribute($context["item"], "loop", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "&amp;muted=";
                if (($this->getAttribute($context["item"], "muted", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            ";
            }
            // line 13
            echo "
            ";
            // line 14
            if (($this->getAttribute($context["item"], "source", []) == "youtube")) {
                // line 15
                echo "            <iframe width=\"100%\" height=\"auto\" src=\"https://www.youtube.com/embed/";
                echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute($context["item"], "video", []), ["https://www.youtube.com/watch?v=" => "", "http://www.youtube.com/watch?v=" => "", "https://youtu.be/" => "", "http://youtu.be/" => ""]), "html", null, true);
                echo "?showinfo=";
                if (($this->getAttribute($context["item"], "info", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "&amp;autoplay=";
                if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "&amp;controls=";
                if (($this->getAttribute($context["item"], "controls", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                if (($this->getAttribute($context["item"], "loop", []) == "enabled")) {
                    echo "&amp;loop=1&amp;playlist=";
                    echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute($context["item"], "video", []), ["https://www.youtube.com/watch?v=" => "", "http://www.youtube.com/watch?v=" => "", "https://youtu.be/" => "", "http://youtu.be/" => ""]), "html", null, true);
                }
                echo "&amp;rel=";
                if (($this->getAttribute($context["item"], "related", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "&amp;mute=";
                if (($this->getAttribute($context["item"], "muted", []) == "enabled")) {
                    echo "1";
                } else {
                    echo "0";
                }
                echo "&amp;start=";
                echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "start", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "start", []), "0")) : ("0")), "html", null, true);
                echo "\" frameborder=\"0\" allowfullscreen></iframe>
            ";
            }
            // line 17
            echo "
            ";
            // line 18
            if (($this->getAttribute($context["item"], "source", []) == "local")) {
                // line 19
                echo "            <video ";
                if (($this->getAttribute($context["item"], "controls", []) == "disabled")) {
                    echo "onclick=\"this.paused?this.play():this.pause();\"";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                    echo "autoplay";
                }
                echo " poster=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "posterimage", [])));
                echo "\" ";
                if (($this->getAttribute($context["item"], "loop", []) == "enabled")) {
                    echo "loop";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "controls", []) == "enabled")) {
                    echo "controls";
                } else {
                    echo "class=\"g-video-nocontrols\"";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "muted", []) == "enabled")) {
                    echo "muted";
                }
                echo " playsinline>
                ";
                // line 20
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "local", []));
                foreach ($context['_seq'] as $context["_key"] => $context["source"]) {
                    // line 21
                    echo "                <source src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["source"], "file", [])));
                    echo "\" type=\"video/";
                    echo twig_escape_filter($this->env, twig_replace_filter(twig_slice($this->env, $this->getAttribute($context["source"], "file", []),  -4), ["." => ""]), "html", null, true);
                    echo "\">
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['source'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "                </video>
                ";
                // line 24
                if (($this->getAttribute($context["item"], "controls", []) == "disabled")) {
                    // line 25
                    echo "                <div class=\"g-videolocal-play ";
                    if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                        echo "pause";
                    }
                    echo "\"></div>
                ";
                }
                // line 27
                echo "                ";
            }
            // line 28
            echo "
                ";
            // line 29
            if (($this->getAttribute($context["item"], "source", []) == "external")) {
                // line 30
                echo "                <video ";
                if (($this->getAttribute($context["item"], "controls", []) == "disabled")) {
                    echo "onclick=\"this.paused?this.play():this.pause();\"";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                    echo "autoplay";
                }
                echo " poster=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "posterimage", [])));
                echo "\" ";
                if (($this->getAttribute($context["item"], "loop", []) == "enabled")) {
                    echo "loop";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "controls", []) == "enabled")) {
                    echo "controls";
                } else {
                    echo "class=\"g-video-nocontrols\"";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "muted", []) == "enabled")) {
                    echo "muted";
                }
                echo " playsinline>
                    <source src=\"";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "video", []), "html", null, true);
                echo "\" type=\"video/";
                echo twig_escape_filter($this->env, twig_replace_filter(twig_slice($this->env, $this->getAttribute($context["item"], "video", []),  -4), ["." => ""]), "html", null, true);
                echo "\">
                    </video>
                    ";
                // line 33
                if (($this->getAttribute($context["item"], "controls", []) == "disabled")) {
                    // line 34
                    echo "                    <div class=\"g-videolocal-play ";
                    if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                        echo "pause";
                    }
                    echo "\"></div>
                    ";
                }
                // line 36
                echo "                    ";
            }
            // line 37
            echo "
                    ";
            // line 38
            if (($this->getAttribute($context["item"], "source", []) == "preset")) {
                // line 39
                echo "                    <video ";
                if (($this->getAttribute($context["item"], "controls", []) == "disabled")) {
                    echo "onclick=\"this.paused?this.play():this.pause();\"";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                    echo "autoplay";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "loop", []) == "enabled")) {
                    echo "loop";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "controls", []) == "enabled")) {
                    echo "controls";
                } else {
                    echo "class=\"g-video-nocontrols\"";
                }
                echo " ";
                if (($this->getAttribute($context["item"], "muted", []) == "enabled")) {
                    echo "muted";
                }
                echo " playsinline>
                        <source src=\"";
                // line 40
                echo twig_escape_filter($this->env, _twig_default_filter($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "presets", []), $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "preset", []), [], "array"), "styles", []), "slideshow", []), "video", [])), $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "get", [0 => "styles.slideshow.video"], "method"))), "html", null, true);
                echo "\" type=\"video/";
                echo twig_escape_filter($this->env, twig_replace_filter(twig_slice($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", [], "any", false, true), "presets", [], "any", false, true), $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "preset", []), [], "array", false, true), "styles", [], "any", false, true), "slideshow", [], "any", false, true), "video", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", [], "any", false, true), "presets", [], "any", false, true), $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "preset", []), [], "array", false, true), "styles", [], "any", false, true), "slideshow", [], "any", false, true), "video", []), $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "get", [0 => "styles.slideshow.video"], "method"))) : ($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "get", [0 => "styles.slideshow.video"], "method"))),  -4), ["." => ""]), "html", null, true);
                echo "\">
                            <source src=\"";
                // line 41
                echo twig_escape_filter($this->env, twig_replace_filter(_twig_default_filter($this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "presets", []), $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "theme", []), "preset", []), [], "array"), "styles", []), "slideshow", []), "video", [])), $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "config", []), "get", [0 => "styles.slideshow.video"], "method"))), ["webm" => "mp4"]), "html", null, true);
                echo "\" type=\"video/mp4\">
                            </video>
                            ";
                // line 43
                if (($this->getAttribute($context["item"], "controls", []) == "disabled")) {
                    // line 44
                    echo "                            <div class=\"g-videolocal-play ";
                    if (($this->getAttribute($context["item"], "autoplay", []) == "enabled")) {
                        echo "pause";
                    }
                    echo "\"></div>
                            ";
                }
                // line 46
                echo "                            ";
            }
            // line 47
            echo "                        </div>
                        ";
            // line 48
            if ($this->getAttribute($context["item"], "caption", [])) {
                // line 49
                echo "                            <div class=\"g-video-caption\">";
                echo $this->getAttribute($context["item"], "caption", []);
                echo "</div>
                        ";
            }
            // line 51
            echo "                    </div>
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
        // line 53
        echo "                </div>
            ";
    }

    // line 56
    public function block_javascript_footer($context, array $blocks = [])
    {
        // line 57
        echo "            ";
        $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "jquery"], "method");
        // line 58
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/video.init.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "@particles/video.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  367 => 58,  364 => 57,  361 => 56,  356 => 53,  341 => 51,  335 => 49,  333 => 48,  330 => 47,  327 => 46,  319 => 44,  317 => 43,  312 => 41,  306 => 40,  281 => 39,  279 => 38,  276 => 37,  273 => 36,  265 => 34,  263 => 33,  256 => 31,  229 => 30,  227 => 29,  224 => 28,  221 => 27,  213 => 25,  211 => 24,  208 => 23,  197 => 21,  193 => 20,  166 => 19,  164 => 18,  161 => 17,  119 => 15,  117 => 14,  114 => 13,  90 => 11,  88 => 10,  78 => 9,  74 => 7,  56 => 6,  50 => 5,  43 => 4,  40 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/video.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/video.html.twig");
    }
}
