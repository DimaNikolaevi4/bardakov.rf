---
name: ARIA and visual hiding
description: Keep accessibility-tree state separate from visual visibility in site styles.
---

Do not use a global `[aria-hidden="true"] { display: none; }` rule. Decorative icons use `aria-hidden="true"` so assistive technology skips them, but the icons still need to remain visible. Give overlays and panels their own visual-state styles.

**Why:** A global visual rule made every decorative icon disappear across the site, including navigation and action controls.

**How to apply:** When hiding a component, use its own visibility, opacity, transform, or display rules. Treat `aria-hidden` as an accessibility semantic, not a general-purpose visual toggle.
