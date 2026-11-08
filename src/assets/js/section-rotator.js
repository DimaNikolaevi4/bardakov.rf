(function () {
  "use strict";

  const positionClasses = ["is-left", "is-center", "is-right"];
  const positionLabels = ["слева", "в центре", "справа"];

  class SectionRotator {
    constructor(root) {
      this.root = root;
      this.stage = root.querySelector(".section-rotator__stage");
      this.cards = Array.from(root.querySelectorAll("[data-rotator-card]"));
      this.status = root.querySelector("[data-rotator-status]");
      this.order = ["4", "5", "6"];
      this.busy = false;

      this.stage.addEventListener("click", (event) => {
        const card = event.target.closest("[data-rotator-card]");
        if (!card || card.getAttribute("aria-disabled") === "true") return;
        this.rotateForward();
      });

      this.render();
    }

    render() {
      this.cards.forEach((card) => {
        const positionIndex = this.order.indexOf(card.dataset.rotatorCard);
        const position = positionLabels[positionIndex];

        card.classList.remove(...positionClasses);
        card.classList.add(positionClasses[positionIndex]);
        card.setAttribute(
          "aria-label",
          positionIndex === 1
            ? `Карточка ${card.dataset.rotatorCard}, ${position}. Нажмите на боковую карточку, чтобы повернуть.`
            : `Карточка ${card.dataset.rotatorCard}, ${position}. Нажмите, чтобы повернуть карточки.`,
        );
        card.setAttribute(
          "aria-disabled",
          String(this.busy || positionIndex === 1),
        );
      });

      this.stage.setAttribute("aria-busy", String(this.busy));
    }

    rotateForward() {
      if (this.busy) return;

      const [left, center, right] = this.order;
      this.order = [right, left, center];
      this.busy = true;
      this.render();

      if (this.status) {
        this.status.textContent = `В центре карточка ${this.order[1]}.`;
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
