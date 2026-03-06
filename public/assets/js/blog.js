document.addEventListener("DOMContentLoaded", () => {
    const menuButtons = document.querySelectorAll("[data-menu-toggle]");

    menuButtons.forEach((button) => {
        const targetId = button.getAttribute("aria-controls");
        if (!targetId) return;

        const panel = document.getElementById(targetId);
        if (!panel) return;

        button.addEventListener("click", () => {
            const expanded = button.getAttribute("aria-expanded") === "true";
            button.setAttribute("aria-expanded", String(!expanded));
            panel.hidden = expanded;
        });
    });

    document.querySelectorAll("[data-year]").forEach((node) => {
        node.textContent = String(new Date().getFullYear());
    });

    const searchInput = document.querySelector("[data-blog-search]");
    const cards = Array.from(document.querySelectorAll("[data-article-card]"));
    const filterButtons = Array.from(document.querySelectorAll("[data-tag-filter]"));
    const resultCounter = document.querySelector("[data-results-count]");
    const emptyState = document.querySelector("[data-empty-state]");

    if (cards.length > 0 && searchInput) {
        let activeTag = "all";

        const applyFilters = () => {
            const query = searchInput.value.trim().toLowerCase();
            let visibleCount = 0;

            cards.forEach((card) => {
                const searchText = (card.getAttribute("data-search-text") || "").toLowerCase();
                const tags = (card.getAttribute("data-tags") || "").toLowerCase().split(",");
                const matchesQuery = query === "" || searchText.includes(query);
                const matchesTag = activeTag === "all" || tags.includes(activeTag);
                const visible = matchesQuery && matchesTag;

                card.hidden = !visible;
                if (visible) visibleCount += 1;
            });

            if (resultCounter) {
                resultCounter.textContent = visibleCount <= 1 ? `${visibleCount} article` : `${visibleCount} articles`;
            }

            if (emptyState) {
                emptyState.hidden = visibleCount !== 0;
            }
        };

        searchInput.addEventListener("input", applyFilters);

        filterButtons.forEach((button) => {
            button.addEventListener("click", () => {
                activeTag = button.getAttribute("data-tag-filter") || "all";

                filterButtons.forEach((otherButton) => {
                    otherButton.classList.toggle("is-active", otherButton === button);
                    otherButton.setAttribute("aria-pressed", String(otherButton === button));
                });

                applyFilters();
            });
        });

        applyFilters();
    }

    const tocRoot = document.querySelector("[data-article-body]");
    const tocTarget = document.querySelector("[data-toc]");

    if (tocRoot && tocTarget) {
        const headings = Array.from(tocRoot.querySelectorAll("h2"));

        if (headings.length === 0) {
            tocTarget.closest("[data-toc-card]")?.setAttribute("hidden", "");
            return;
        }

        headings.forEach((heading, index) => {
            if (!heading.id) {
                heading.id = `section-${index + 1}`;
            }

            const link = document.createElement("a");
            link.href = `#${heading.id}`;
            link.textContent = heading.textContent || `Section ${index + 1}`;
            tocTarget.appendChild(link);
        });
    }
});
