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

/* @particles/imagegrid.html.twig */
class __TwigTemplate_00060f19f2cab9c02fff383a1f564f6c7bc665f7361ee50fc3e2e9b62017107b extends \Twig\Template
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
        // line 3
        $this->getAttribute(($context["gantry"] ?? null), "load", [0 => "lightcase.init"], "method");
        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/imagegrid.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_particle($context, array $blocks = [])
    {
        // line 6
        echo "
    ";
        // line 7
        if ($this->getAttribute(($context["particle"] ?? null), "title", [])) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", []);
            echo "</h2>";
        }
        // line 8
        echo "
    <div class=\"g-imagegrid ";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", []));
        echo "\">

        ";
        // line 11
        if ($this->getAttribute(($context["particle"] ?? null), "desc", [])) {
            echo "<div class=\"g-imagegrid-desc\">";
            echo $this->getAttribute(($context["particle"] ?? null), "desc", []);
            echo "</div>";
        }
        // line 12
        echo "
        <div class=\"g-imagegrid-wrapper ";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "cols", []));
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "layout", []), "html", null, true);
        echo "\">
            ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "imagegriditems", []));
        foreach ($context['_seq'] as $context["_key"] => $context["imagegriditem"]) {
            // line 15
            echo "                <div class=\"g-imagegrid-item\">
                    <a class=\"g-imagegrid-link\" href=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["imagegriditem"], "image", [])));
            echo "\" data-rel=\"lightcase";
            if ($this->getAttribute(($context["particle"] ?? null), "album", [])) {
                echo ":";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "album", []), "html", null, true);
            }
            echo "\">
                        ";
            // line 17
            if (($this->getAttribute(($context["particle"] ?? null), "layout", []) == "g-imagegrid-captions")) {
                // line 18
                echo "                        ";
            }
            // line 19
            echo "                        <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["imagegriditem"], "image", [])));
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["imagegriditem"], "caption", []));
            echo "\" />
                        <div class=\"indicator\">
                            <div>
                                ";
            // line 22
            if (($this->getAttribute(($context["particle"] ?? null), "layout", []) == "g-imagegrid-standard")) {
                // line 23
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["imagegriditem"], "caption", []), "html", null, true);
                echo "
                                ";
            } else {
                // line 25
                echo "                                    <div class=\"g-imagegrid-caption\">
                                        ";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($context["imagegriditem"], "caption", []), "html", null, true);
                echo "
                                    </div>
                                ";
            }
            // line 29
            echo "                            </div>
                        </div>
                    </a>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['imagegriditem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "@particles/imagegrid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 34,  124 => 29,  118 => 26,  115 => 25,  109 => 23,  107 => 22,  98 => 19,  95 => 18,  93 => 17,  84 => 16,  81 => 15,  77 => 14,  71 => 13,  68 => 12,  62 => 11,  57 => 9,  54 => 8,  48 => 7,  45 => 6,  42 => 5,  37 => 1,  35 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@particles/imagegrid.html.twig", "/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/imagegrid.html.twig");
    }
}
