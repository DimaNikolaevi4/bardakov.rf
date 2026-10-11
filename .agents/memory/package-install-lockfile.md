---
name: Package install lockfile churn
description: Unrelated dependency metadata changes caused by package installation.
---

When using Replit's package installer to satisfy a missing package, npm may upgrade an existing compatible dependency and rewrite unrelated optional-platform metadata or registry URLs in `package-lock.json`.

**Why:** Unreviewed lockfile churn can create dependency changes unrelated to the feature being built.

**How to apply:** Compare `package.json` and `package-lock.json` before and after installs; restore unrelated version, range, or metadata changes while preserving the installed local packages.
