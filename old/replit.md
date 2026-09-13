# Бардаков.рф — Personal Portfolio Site

A personal portfolio and educational resource site for Dmitry Nikolaevich Bardakov, a teacher at the Salsk Industrial Technical School.

## Project Structure

- `new-stack/site/` — Modern static HTML site (49 pages), served as the main app
- `joomla/` — Legacy Joomla 5 version (reference only, not served)
- `homepage/` — Alternative landing page (jQuery/Flipster)

## Tech Stack

- **Frontend:** HTML5, CSS3, Vanilla JS, Bootstrap 5.3 (CDN)
- **Components:** JS-include pattern via `fetch()` for shared header/footer
- **Search:** Pagefind (static search indexer)
- **Animations:** AOS (Animate on Scroll), Swiper
- **Analytics:** Yandex.Metrika

## How to Run

The app runs as a static file server:

```
python3 -m http.server 5000 --directory new-stack/site --bind 0.0.0.0
```

Access it on port 5000. The `.replit` file is configured to start this automatically.

## Deployment

Configured for static deployment (`publicDir = "new-stack/site"`).

## User Preferences

- Preserve the existing multi-page static HTML structure
- No login/auth system — this is a public portfolio site
- No backend required — purely static
