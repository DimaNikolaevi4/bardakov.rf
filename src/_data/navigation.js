import { readFileSync } from "node:fs";
import yaml from "js-yaml";

export default yaml.load(readFileSync(new URL("./navigation.yaml", import.meta.url), "utf8"));
