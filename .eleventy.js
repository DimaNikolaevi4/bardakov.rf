// .eleventy.js — конфигурация Eleventy для bardakov.rf
// Обновлено: 2026-10-09 (Этап 2.2)

import eleventyPluginRss from "@11ty/eleventy-plugin-rss";

export default function (eleventyConfig) {
  // === Passthrough copies (файлы копируются в public/ без обработки) ===
  eleventyConfig.addPassthroughCopy({ "src/assets/": "assets/" });
  eleventyConfig.addPassthroughCopy({ "src/styles/": "assets/css/" });
  eleventyConfig.addPassthroughCopy({ "src/content/robots.txt": "robots.txt" });
  eleventyConfig.addPassthroughCopy({ "src/content/favicon.ico": "favicon.ico" });
  eleventyConfig.addPassthroughCopy({ "src/content/sitemap.xml": "sitemap.xml" });
  eleventyConfig.addPassthroughCopy({ "src/content/yandex_*.html": "./" });

  // Исключить служебные файлы из обработки как шаблоны
  eleventyConfig.ignores.add("src/content/yandex_*.html");

  // === Шаблонизаторы ===
  // Nunjucks для .njk файлов (по умолчанию)
  // html НЕ обрабатывается как шаблон — это служебные файлы (yandex_*.html и т.п.)
  eleventyConfig.setTemplateFormats(["njk", "md", "11ty.js"]);

  // Markdown настройки
  eleventyConfig.amendLibrary("md", (mdLib) => {
    mdLib.set({ html: true, breaks: false, linkify: true, typographer: true });
  });

  // === Кастомные фильтры ===

  // slugify: "Привет мир" → "privet-mir" (с поддержкой кириллицы)
  eleventyConfig.addFilter("slugify", (str) => {
    if (!str) return "";
    const map = {
      а: "a", б: "b", в: "v", г: "g", д: "d", е: "e", ё: "e",
      ж: "zh", з: "z", и: "i", й: "y", к: "k", л: "l", м: "m",
      н: "n", о: "o", п: "p", р: "r", с: "s", т: "t", у: "u",
      ф: "f", х: "h", ц: "ts", ч: "ch", ш: "sh", щ: "sch",
      ъ: "", ы: "y", ь: "", э: "e", ю: "yu", я: "ya",
    };
    return String(str)
      .toLowerCase()
      .replace(/[а-яё]/g, (ch) => map[ch] || ch)
      .replace(/[^a-z0-9\s-]/g, "")
      .trim()
      .replace(/\s+/g, "-")
      .replace(/-+/g, "-");
  });

  // date: ISO дата → "9 октября 2026"
  eleventyConfig.addFilter("dateRu", (dateObj) => {
    if (!dateObj) return "";
    const months = [
      "января", "февраля", "марта", "апреля", "мая", "июня",
      "июля", "августа", "сентября", "октября", "ноября", "декабря",
    ];
    const d = new Date(dateObj);
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
  });

  // dateISO: "2026-10-09" → "2026-10-09T00:00:00+03:00"
  eleventyConfig.addFilter("dateISO", (dateObj) => {
    if (!dateObj) return "";
    return new Date(dateObj).toISOString();
  });

  // date: форматирование дат (Nunjucks-compatible)
  // Примеры: {{ "now" | date("Y") }} → 2026
  //          {{ "2026-10-09" | date("d.m.Y") }} → 09.10.2026
  eleventyConfig.addFilter("date", (dateObj, format) => {
    if (!dateObj) return "";
    const d = dateObj === "now" ? new Date() : new Date(dateObj);
    if (isNaN(d.getTime())) return "";

    const pad = (n) => String(n).padStart(2, "0");

    const replacements = {
      Y: d.getFullYear(),
      y: String(d.getFullYear()).slice(-2),
      m: pad(d.getMonth() + 1),
      n: d.getMonth() + 1,
      d: pad(d.getDate()),
      j: d.getDate(),
      H: pad(d.getHours()),
      i: pad(d.getMinutes()),
      s: pad(d.getSeconds()),
    };

    let result = format || "Y-m-d H:i:s";
    for (const [key, value] of Object.entries(replacements)) {
      result = result.replace(new RegExp(key, "g"), value);
    }
    return result;
  });

  // truncate: обрезка строки до указанной длины с многоточием
  eleventyConfig.addFilter("truncate", (str, n = 100) => {
    if (!str) return "";
    if (str.length <= n) return str;
    return str.slice(0, n).trim() + "…";
  });

  // limit: взять первые N элементов массива
  eleventyConfig.addFilter("limit", (arr, limit) => {
    if (!Array.isArray(arr)) return [];
    return arr.slice(0, limit);
  });

  // where: фильтр массива объектов по значению поля
  eleventyConfig.addFilter("where", (arr, field, value) => {
    if (!Array.isArray(arr)) return [];
    return arr.filter((item) => item[field] === value);
  });

  // sortByDate: сортировка массива объектов по дате (убывание)
  eleventyConfig.addFilter("sortByDateDesc", (arr, field = "date") => {
    if (!Array.isArray(arr)) return [];
    return arr
      .filter((item) => item[field])
      .sort((a, b) => new Date(b[field]) - new Date(a[field]));
  });

  // absolutizeURL: преобразует относительный URL в абсолютный
  eleventyConfig.addFilter("absolutizeURL", (url) => {
    if (!url) return "";
    if (url.startsWith("http")) return url;
    const baseUrl = "https://бардаков.рф";
    return baseUrl + (url.startsWith("/") ? url : "/" + url);
  });

  // === Кастомные коллекции ===

  // Все страницы с датой публикации (для sitemap, RSS)
  eleventyConfig.addCollection("publishedPages", (collectionApi) => {
    return collectionApi
      .getAll()
      .filter((item) => item.data.date)
      .sort((a, b) => new Date(b.date) - new Date(a.date));
  });

  // Все страницы раздела «Обо мне»
  eleventyConfig.addCollection("aboutPages", (collectionApi) => {
    return collectionApi
      .getAll()
      .filter((item) => item.data.section === "obo-mne")
      .sort((a, b) => (a.data.order || 999) - (b.data.order || 999));
  });

  // Все страницы раздела «Обучение»
  eleventyConfig.addCollection("educationPages", (collectionApi) => {
    return collectionApi
      .getAll()
      .filter((item) => item.data.section === "obuchenie")
      .sort((a, b) => (a.data.order || 999) - (b.data.order || 999));
  });

  // Все страницы раздела «Абитуриенту»
  eleventyConfig.addCollection("abiturientuPages", (collectionApi) => {
    return collectionApi
      .getAll()
      .filter((item) => item.data.section === "abiturientu")
      .sort((a, b) => (a.data.order || 999) - (b.data.order || 999));
  });

  // Все страницы раздела «Воспитание»
  eleventyConfig.addCollection("vospitaniePages", (collectionApi) => {
    return collectionApi
      .getAll()
      .filter((item) => item.data.section === "vospitanie")
      .sort((a, b) => (a.data.order || 999) - (b.data.order || 999));
  });

  // === Плагины ===
  eleventyConfig.addPlugin(eleventyPluginRss);

  // === Настройки сервера для dev-режима ===
  eleventyConfig.setServerOptions({
    liveReload: true,
    domDiff: true,
    port: 8080,
    showAllHosts: true,
    showVersion: true,
  });

  return {
    // Папки
    dir: {
      input: "src",
      output: "public",
      includes: "_includes",
      data: "_data",
      layouts: "_includes/layouts",
    },
    // Шаблонизаторы по умолчанию
    templateFormats: ["njk", "md"],
    htmlTemplateEngine: "njk",
    markdownTemplateEngine: "njk",
    // Включить автоматическое создание permalink с trailing slash
    trailingSlash: false,
    // Включить обнаружение дат в frontmatter (date: 2026-10-09)
    dataDeepMerge: true,
  };
}
