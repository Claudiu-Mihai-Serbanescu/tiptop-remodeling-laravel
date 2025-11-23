// resources/js/app.js

import "./bootstrap";

/* =========================================================================
   Helpers
   ========================================================================= */
const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));
const clamp = (n, min, max) => Math.max(min, Math.min(max, n));

/* =========================================================================
   1) Services: View more / View less (card-uri servicii)
   ========================================================================= */
function initServiceToggles() {
    document.addEventListener("click", (e) => {
        const btn = e.target.closest("[data-toggle]");
        if (!btn) return;

        const card = btn.closest("[data-service]");
        if (!card) return;

        const more = card.querySelector("[data-more]");
        if (!more) return;

        const isOpen = btn.getAttribute("aria-expanded") === "true";
        more.hidden = isOpen;
        btn.setAttribute("aria-expanded", String(!isOpen));
        btn.textContent = isOpen ? "View more" : "View less";
    });
}

/* =========================================================================
   2) Reveal on scroll (pentru .seo-item, .ba-card, [data-animate])
   ========================================================================= */
function initRevealOnScroll() {
    const targets = $$(".seo-item, .ba-card, [data-animate]");
    if (!targets.length) return;

    const io = new IntersectionObserver(
        (ents) => {
            for (const ent of ents) {
                if (ent.isIntersecting) {
                    ent.target.classList.add("revealed");
                    io.unobserve(ent.target);
                }
            }
        },
        { threshold: 0.12 }
    );

    targets.forEach((el) => io.observe(el));
}

/* =========================================================================
   3) Before/After comparators (drag + range)
   Markup necesar:
   <div class="ba-wrap" data-ba>
     <img class="ba-before" ...>
     <img class="ba-after" ...>
     <div class="ba-handle"><span class="ba-knob"></span></div>
     <input class="ba-range" type="range" value="50" ...>
   </div>
   ========================================================================= */
function initBeforeAfter() {
    $$(".ba-wrap[data-ba]").forEach((wrap) => {
        if (wrap.dataset.inited === "1") return;
        const after = wrap.querySelector(".ba-after");
        const handle = wrap.querySelector(".ba-handle");
        const range = wrap.querySelector(".ba-range");
        if (!after || !handle || !range) return;

        const setFromPercent = (pct) => {
            pct = clamp(pct, 0, 100);
            after.style.clipPath = `inset(0 0 0 ${pct}%)`;
            handle.style.setProperty("--pos", `${pct}%`);
            range.value = String(pct);
        };

        const clientX = (e) =>
            e.touches && e.touches[0] ? e.touches[0].clientX : e.clientX;

        const posToPercent = (x) => {
            const r = wrap.getBoundingClientRect();
            const rel = (x - r.left) / r.width;
            return rel * 100;
        };

        // init
        setFromPercent(parseFloat(range.value || "50"));

        // range control (instant)
        range.addEventListener("input", (e) => {
            setFromPercent(parseFloat(e.target.value));
        });

        // drag pe imagine (1:1)
        let dragging = false;
        const onMove = (e) => {
            if (!dragging) return;
            setFromPercent(posToPercent(clientX(e)));
            e.preventDefault();
        };
        const start = (e) => {
            dragging = true;
            wrap.classList.add("is-dragging");
            onMove(e);
            window.addEventListener("mousemove", onMove);
            window.addEventListener("touchmove", onMove, { passive: false });
            window.addEventListener("mouseup", end);
            window.addEventListener("touchend", end);
        };
        const end = () => {
            dragging = false;
            wrap.classList.remove("is-dragging");
            window.removeEventListener("mousemove", onMove);
            window.removeEventListener("touchmove", onMove);
            window.removeEventListener("mouseup", end);
            window.removeEventListener("touchend", end);
        };

        wrap.addEventListener("mousedown", start);
        wrap.addEventListener("touchstart", start, { passive: false });

        wrap.dataset.inited = "1";
    });
}

/* =========================================================================
   4) Testimonials
   - Trunchiere la N caractere EXPLICIT (nu pe linii)
   - Buton Read more / Show less (delegare UNICĂ)
   - Slider 3/2/1 pe "pagini" (scrollBy lățimea track-ului)
   ========================================================================= */
const MAX_REVIEW_CHARS = 350; // <<< setează cât text scurt vrei

function truncateText(txt, n = MAX_REVIEW_CHARS) {
    if (!txt) return "";
    const clean = txt.trim().replace(/\s+/g, " ");
    return clean.length > n ? clean.slice(0, n).trim() + "…" : clean;
}

function initTestimonials() {
    $$(".t-slider[data-tslider]").forEach((slider) => {
        if (slider.dataset.inited === "1") return;

        const track = slider.querySelector(".t-track");
        const prev = slider.querySelector(".t-prev");
        const next = slider.querySelector(".t-next");
        if (!track) return;

        // 1) Trunchiere pe caractere (nu pe linii)
        $$(".t-card", track).forEach((card) => {
            const shortEl = card.querySelector("[data-short]");
            const fullEl = card.querySelector("[data-full]");
            const btn = card.querySelector("[data-readmore]");
            if (!shortEl || !fullEl) return;

            const fullPlain = (fullEl.textContent || "")
                .replace(/^“|”$/g, "")
                .trim();

            const shortTxt = truncateText(fullPlain, MAX_REVIEW_CHARS);
            shortEl.textContent = `“${shortTxt}”`;

            if (btn) {
                if (fullPlain.length <= MAX_REVIEW_CHARS) {
                    btn.style.display = "none";
                } else {
                    btn.setAttribute("aria-expanded", "false");
                }
            }
        });

        // 2) Read more / Show less (delegare unică)
        track.addEventListener("click", (e) => {
            const btn = e.target.closest("[data-readmore]");
            if (!btn) return;

            const card = btn.closest(".t-card");
            const shortE = card?.querySelector("[data-short]");
            const fullE = card?.querySelector("[data-full]");
            if (!shortE || !fullE) return;

            const expanded = btn.getAttribute("aria-expanded") === "true";
            if (!expanded) {
                fullE.hidden = false;
                shortE.hidden = true;
                btn.textContent = "Show less";
                btn.setAttribute("aria-expanded", "true");
            } else {
                fullE.hidden = true;
                shortE.hidden = false;
                btn.textContent = "Read more";
                btn.setAttribute("aria-expanded", "false");
            }
        });

        // 3) Slider pe „pagini” (3/2/1) – calc corect cu gap
        const getNumber = (v) => parseFloat(String(v).replace("px", "")) || 0;
        const styles = () => getComputedStyle(track);
        const cols = () =>
            Math.max(
                1,
                parseInt(styles().getPropertyValue("--cols").trim() || "3", 10)
            );
        const gapPx = () => getNumber(styles().getPropertyValue("--gap"));
        const firstCard = () => track.querySelector(".t-card");

        // lățimea unui card real (inclusiv gapul dintre carduri)
        const cardWidthWithGap = () => {
            const card = firstCard();
            if (!card) return track.clientWidth; // fallback
            // offsetWidth = lățimea cardului; adăugăm gap-ul (spațiul dintre coloane)
            return card.offsetWidth + gapPx();
        };

        // o „pagină” înseamnă exact câte carduri încap (3/2/1) * (cardWidth + gap)
        const pageSize = () => cardWidthWithGap() * cols();

        function scrollByPage(dir) {
            const delta = dir > 0 ? pageSize() : -pageSize();
            track.scrollBy({ left: delta, behavior: "smooth" });
        }

        prev?.addEventListener("click", () => scrollByPage(-1));
        next?.addEventListener("click", () => scrollByPage(1));

        slider.dataset.inited = "1";
    });
}

/* =========================================================================
   Init global
   ========================================================================= */
document.addEventListener("DOMContentLoaded", () => {
    initServiceToggles();
    initRevealOnScroll();
    initBeforeAfter();
    initTestimonials();
});
