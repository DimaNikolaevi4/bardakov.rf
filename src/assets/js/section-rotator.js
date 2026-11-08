(function () {
  "use strict";

  const positionClasses = [
    "is-hidden",
    "is-before",
    "is-left",
    "is-center",
    "is-right",
    "is-after",
  ];
  const accessiblePositions = new Set(["is-left", "is-center", "is-right"]);

  class SectionRotator {
    constructor(root) {
      this.root = root;
      this.stage = root.querySelector(".section-rotator__stage");
      this.cards = Array.from(root.querySelectorAll("[data-rotator-card]"));
      this.status = root.querySelector("[data-rotator-status]");
      this.centerIndex = this.cards.findIndex(
        (card) => card.dataset.rotatorCard === root.dataset.startCenter,
      );
      this.busy = false;

      if (this.centerIndex < 0 || this.cards.length < 3) {
        throw new Error(
          "[section-rotator] The carousel needs a valid center card and at least three cards.",
        );
      }

      this.stage.addEventListener("click", (event) => {
        const card = event.target.closest("[data-rotator-card]");
        if (!card || card.getAttribute("aria-disabled") === "true") return;

        if (card.dataset.position === "is-left") {
          this.shift(-1);
        } else if (card.dataset.position === "is-right") {
          this.shift(1);
        }
      });

      this.render();
    }

    render() {
      this.cards.forEach((card, index) => {
        const rawOffset =
          (index - this.centerIndex + this.cards.length) % this.cards.length;
        const offset =
          rawOffset > this.cards.length / 2
            ? rawOffset - this.cards.length
            : rawOffset;
        const position =
          offset === -2
            ? "is-before"
            : offset === -1
              ? "is-left"
              : offset === 0
                ? "is-center"
                : offset === 1
                  ? "is-right"
                  : offset === 2
                    ? "is-after"
                    : "is-hidden";
        const isVisible = accessiblePositions.has(position);

        card.classList.remove(...positionClasses);
        card.classList.add(position);
        card.dataset.position = position;
        card.setAttribute("aria-hidden", String(!isVisible));
        card.setAttribute("tabindex", isVisible ? "0" : "-1");

        const canShift = position === "is-left" || position === "is-right";
        card.setAttribute("aria-disabled", String(this.busy || !canShift));

        if (position === "is-left") {
          card.setAttribute(
            "aria-label",
            `Карточка ${card.dataset.rotatorCard}, слева. Показать предыдущие карточки.`,
          );
        } else if (position === "is-center") {
          card.setAttribute(
            "aria-label",
            `Карточка ${card.dataset.rotatorCard}, в центре.`,
          );
        } else if (position === "is-right") {
          card.setAttribute(
            "aria-label",
            `Карточка ${card.dataset.rotatorCard}, справа. Показать следующие карточки.`,
          );
        }
      });

      this.stage.setAttribute("aria-busy", String(this.busy));
    }

    shift(direction) {
      if (this.busy) return;

      this.centerIndex =
        (this.centerIndex + direction + this.cards.length) % this.cards.length;
      this.busy = true;
      this.render();

      if (this.status) {
        const count = this.cards.length;
        const visibleCards = [
          this.cards[(this.centerIndex - 1 + count) % count].dataset.rotatorCard,
          this.cards[this.centerIndex].dataset.rotatorCard,
          this.cards[(this.centerIndex + 1) % count].dataset.rotatorCard,
        ];
        this.status.textContent = `Показаны карточки ${visibleCards[0]}, ${visibleCards[1]} и ${visibleCards[2]} из 1–6.`;
      }

      const duration = Number.parseFloat(
        window.getComputedStyle(this.root).getPropertyValue("--rotator-duration"),
      ) || 0;

      window.setTimeout(() => {
        this.busy = false;
        this.render();
      }, duration);
    }
  }

  document.querySelectorAll("[data-section-rotator]").forEach((root) => {
    new SectionRotator(root);
  });
})();
