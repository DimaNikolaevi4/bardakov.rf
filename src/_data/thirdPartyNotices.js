import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const projectRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "../..");
const manifest = JSON.parse(fs.readFileSync(path.join(projectRoot, "package.json"), "utf8"));

const licenseUrls = {
  MIT: "https://opensource.org/license/mit/",
  "OFL-1.1": "https://openfontlicense.org/open-font-license-official-text/",
  "BSD-2-Clause": "https://opensource.org/license/bsd-2-clause",
  "Apache-2.0": "https://www.apache.org/licenses/LICENSE-2.0",
  "BlueOak-1.0.0": "https://blueoakcouncil.org/license/1.0.0",
};

const websiteLibraries = [
  ["@fontsource/inter", "Шрифт Inter для основного текста сайта."],
  ["@fontsource/manrope", "Шрифт Manrope для заголовков."],
  ["bootstrap-icons", "Набор иконок, подключённый в интерфейсе сайта."],
];

const buildLibraries = [
  ["@11ty/eleventy", "Генератор статических страниц."],
  ["@11ty/eleventy-plugin-rss", "Формирование RSS-ленты."],
  ["@11ty/eleventy-img", "Подготовка изображений для публикации."],
  ["ajv", "Валидация JSON Schema для frontmatter."],
  ["ajv-formats", "Форматы (date, uri, email) для валидатора ajv."],
  ["gray-matter", "Парсинг YAML frontmatter в Markdown-файлах."],
  ["html-validate", "Проверка HTML-разметки."],
  ["husky", "Запуск проверок при работе с Git."],
  ["js-yaml", "Чтение YAML-данных проекта."],
  ["linkinator", "Проверка ссылок в проекте."],
  ["lint-staged", "Запуск проверок для изменённых файлов."],
  ["markdownlint-cli2", "Проверка Markdown-файлов."],
  ["nunjucks", "Шаблоны страниц и компонентов."],
  ["pagefind", "Создание индекса поиска по сайту."],
  ["prettier", "Форматирование исходных файлов."],
  ["rimraf", "Очистка каталогов сборки."],
  ["sharp", "Обработка изображений."],
];

function resolvePackage([name, purpose]) {
  const declaredIn = manifest.dependencies?.[name]
    ? "dependencies"
    : manifest.devDependencies?.[name]
      ? "devDependencies"
      : null;

  if (!declaredIn) {
    throw new Error(`Пакет ${name} указан на странице лицензий, но отсутствует в package.json.`);
  }

  const packagePath = path.join(projectRoot, "node_modules", name, "package.json");
  const packageInfo = JSON.parse(fs.readFileSync(packagePath, "utf8"));
  const license = typeof packageInfo.license === "string"
    ? packageInfo.license
    : packageInfo.license?.type;

  if (!packageInfo.version || !license) {
    throw new Error(`В package.json пакета ${name} отсутствуют версия или лицензия.`);
  }

  return {
    name,
    version: packageInfo.version,
    purpose,
    license,
    licenseUrl: licenseUrls[license] || null,
    packageUrl: `https://www.npmjs.com/package/${name}/v/${packageInfo.version}`,
  };
}

export default {
  website: websiteLibraries.map(resolvePackage),
  build: buildLibraries.map(resolvePackage),
};
