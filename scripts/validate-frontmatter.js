#!/usr/bin/env node
/**
 * validate-frontmatter.js — Валидация YAML frontmatter в контентных файлах
 *
 * Использует: ajv (JSON Schema validator) + gray-matter (парсер frontmatter)
 * JSON Schema: docs/frontmatter.schema.json
 *
 * Использование:
 *   node scripts/validate-frontmatter.js              # проверить все файлы
 *   node scripts/validate-frontmatter.js --staged     # проверить только staged файлы (через lint-staged)
 *   node scripts/validate-frontmatter.js src/content/ # проверить конкретную директорию
 *
 * Создано: 2026-10-11 (Этап 4.2)
 */

import { readFileSync, readdirSync, statSync, existsSync } from "fs";
import { join, extname, resolve, dirname } from "path";
import { fileURLToPath } from "url";
import addFormats from "ajv-formats";
import matter from "gray-matter";

const __dirname = dirname(fileURLToPath(import.meta.url));
const ROOT = resolve(__dirname, "..");

// Пути
const SCHEMA_PATH = join(ROOT, "docs", "frontmatter.schema.json");
const LAYOUTS_DIR = join(ROOT, "src", "_includes", "layouts");
const CONTENT_DIRS = [join(ROOT, "src", "content")];

// Цвета для терминала
const c = {
  red: (s) => `\x1b[31m${s}\x1b[0m`,
  green: (s) => `\x1b[32m${s}\x1b[0m`,
  yellow: (s) => `\x1b[33m${s}\x1b[0m`,
  cyan: (s) => `\x1b[36m${s}\x1b[0m`,
  bold: (s) => `\x1b[1m${s}\x1b[0m`,
  dim: (s) => `\x1b[2m${s}\x1b[0m`,
};

// Загрузка JSON Schema
const schema = JSON.parse(readFileSync(SCHEMA_PATH, "utf-8"));

// Настройка ajv (используем draft-07 для совместимости)
import Ajv2020 from "ajv/dist/2020.js";
const ajv = new Ajv2020({ allErrors: true, strict: false });
addFormats(ajv);
const validate = ajv.compile(schema);

// Существующие layouts
const existingLayouts = readdirSync(LAYOUTS_DIR)
  .filter((f) => f.endsWith(".njk"))
  .map((f) => f);

// Сбор всех .md и .njk файлов
function findContentFiles(dirs) {
  const files = [];
  for (const dir of dirs) {
    if (!existsSync(dir)) continue;
    const walk = (d) => {
      for (const entry of readdirSync(d)) {
        const full = join(d, entry);
        const stat = statSync(full);
        if (stat.isDirectory()) {
          if (!entry.startsWith("_") && !entry.startsWith(".")) {
            walk(full);
          }
        } else if (extname(entry) === ".md" || extname(entry) === ".njk") {
          // Пропускаем служебные файлы
          if (entry.startsWith("yandex_") || entry === "robots.txt") continue;
          files.push(full);
        }
      }
    };
    walk(dir);
  }
  return files;
}

// Рекурсивное удаление .njk из путей
function getFilesFromArgs(args) {
  const files = [];
  for (const arg of args) {
    if (arg.startsWith("--")) continue;
    const full = resolve(arg);
    if (statSync(full).isDirectory()) {
      files.push(...findContentFiles([full]));
    } else {
      files.push(full);
    }
  }
  return files;
}

// Проверка одного файла
function validateFile(filepath) {
  const relativePath = filepath.replace(ROOT + "/", "");
  const raw = readFileSync(filepath, "utf-8");
  const { data: fm } = matter(raw);

  const errors = [];

  // 1. Проверка через JSON Schema
  const valid = validate(fm);
  if (!valid) {
    for (const err of validate.errors) {
      const field = err.instancePath.replace("/", "") || err.params?.missingProperty || "?";
      let msg = err.message;
      if (err.params?.allowedValues) {
        msg += ` (${err.params.allowedValues.join(", ")})`;
      }
      errors.push({ code: "FM_SCHEMA", field, message: msg, value: fm[field] });
    }
  }

  // 2. Дополнительная проверка: layout существует
  if (fm.layout && !existingLayouts.includes(fm.layout)) {
    errors.push({
      code: "FM007",
      field: "layout",
      message: `Layout does not exist: ${fm.layout}. Available: ${existingLayouts.join(", ")}`,
      value: fm.layout,
    });
  }

  // 3. Проверка description длины (дополнительная, т.к. ajv может не выдавать понятное сообщение)
  if (fm.description) {
    const len = fm.description.length;
    if (len < 50) {
      errors.push({
        code: "FM006",
        field: "description",
        message: `Description must be 50–160 characters (current: ${len}). Add more detail.`,
        value: fm.description,
      });
    } else if (len > 160) {
      errors.push({
        code: "FM006",
        field: "description",
        message: `Description must be 50–160 characters (current: ${len}). Shorten it.`,
        value: fm.description,
      });
    }
  }

  return { file: relativePath, errors, data: fm };
}

// Главная функция
function main() {
  console.log(c.bold("\n🔍 Валидация Frontmatter"));
  console.log(c.dim(`   Schema: docs/frontmatter.schema.json`));
  console.log(c.dim(`   Layouts: ${existingLayouts.join(", ")}`));

  // Сбор файлов
  let files;
  const args = process.argv.slice(2);
  const isStaged = args.includes("--staged");
  const fileArgs = args.filter((a) => !a.startsWith("--"));

  if (isStaged) {
    // lint-staged передаёт файлы как аргументы
    files = fileArgs;
  } else if (fileArgs.length > 0) {
    files = getFilesFromArgs(fileArgs);
  } else {
    files = findContentFiles(CONTENT_DIRS);
  }

  if (files.length === 0) {
    console.log(c.green("\n✅ Нет файлов для проверки.\n"));
    return;
  }

  console.log(c.dim(`   Проверяется файлов: ${files.length}\n`));

  let totalErrors = 0;
  let validFiles = 0;

  for (const file of files) {
    const result = validateFile(file);

    if (result.errors.length === 0) {
      console.log(c.green(`  ✅ ${result.file}`));
      validFiles++;
    } else {
      console.log(c.red(`  ❌ ${result.file}`));
      for (const err of result.errors) {
        const valStr = err.value ? c.dim(` (значение: "${String(err.value).substring(0, 50)}")`) : "";
        console.log(c.yellow(`     [${err.code}] ${err.field}: ${err.message}${valStr}`));
      }
      totalErrors += result.errors.length;
    }
  }

  console.log("");
  if (totalErrors === 0) {
    console.log(c.green(c.bold(`✅ Все ${validFiles} файлов прошли валидацию!\n`)));
  } else {
    console.log(c.red(c.bold(`❌ Найдено ${totalErrors} ошибок в ${files.length - validFiles} файлах.\n`)));
    process.exit(1);
  }
}

main();
