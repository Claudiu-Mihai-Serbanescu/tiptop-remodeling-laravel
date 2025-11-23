<section class="contact-cta full-bleed contact-cta--light" id="contact-cta"
    style="--cta-img: url('{{ asset('img/cta-bg.jpg') }}')">
    <div class="container cta-wrap" data-animate>
        <div class="cta-card">
            <div class="cta-head">
                <span class="cta-kicker">Design • Build • Remodel</span>
                <h2 class="cta-title">Ready to Start?</h2>
                <p class="cta-sub">
                    Book a free in-home estimate. We’ll review options, timelines, and a clear, itemized quote.
                </p>
            </div>

            <div class="cta-actions">
                <a class="btn btn-primary" href="tel:+15551234567">
                    <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                        <path fill="currentColor"
                            d="M6.6 10.8a15 15 0 006.6 6.6l2.2-2.2a1 1 0 011-.25 11 11 0 003.4.54 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11 11 0 00.54 3.4 1 1 0 01-.25 1L6.6 10.8z" />
                    </svg>
                    Call (555) 123-4567
                </a>
                <a class="btn btn-ghost" href="{{ route('contact') }}">Request Estimate</a>
            </div>
        </div>
    </div>

    <!-- accente soft, gri -->
    <i class="cta-bubble b1"></i>
    <i class="cta-bubble b2"></i>
    <i class="cta-bubble b3"></i>
</section>

<style>
    /* ===== CONTACT CTA — Light / Grey 2025 ===== */
    .contact-cta--light {
        --ink-800: #1f2937;
        --ink-600: #4b5563;
        --ink-500: #6b7280;
        --bg-0: #f6f7fb;
        /* fundal principal foarte deschis */
        --bg-1: #eef1f6;
        /* nuanță secundară pentru gradient */
        --bg-2: #e7ebf2;
        /* ușor mai saturată pentru accente */
    }

    .contact-cta--light {
        position: relative;
        color: var(--ink-800);
        overflow: hidden;
        border-top: 1px solid #e8ebf1;
        background:
            radial-gradient(1200px 700px at 120% -10%, rgba(231, 235, 242, .8), transparent 60%),
            radial-gradient(900px 520px at -10% 120%, rgba(238, 241, 246, .85), transparent 60%),
            var(--bg-0);
    }

    .contact-cta--light::before {
        /* imagine pe fundal, foarte subtilă, desaturată */
        content: "";
        position: absolute;
        inset: 0;
        z-index: 0;
        background: var(--cta-img) center/cover no-repeat;
        opacity: .14;
        filter: grayscale(60%) contrast(1.02) brightness(.96);
        transform: translateZ(0);
    }

    .contact-cta--light::after {
        /* voal albicios pt. text clar peste imagine */
        content: "";
        position: absolute;
        inset: 0;
        z-index: 1;
        background:
            radial-gradient(70% 50% at 50% 20%, rgba(255, 255, 255, .65), rgba(255, 255, 255, .35) 55%, rgba(255, 255, 255, .0) 90%),
            linear-gradient(180deg, rgba(255, 255, 255, .35), rgba(255, 255, 255, .15));
    }

    /* bule/accente animate discrete în gri */
    .cta-bubble {
        position: absolute;
        z-index: 2;
        pointer-events: none;
        background: radial-gradient(circle at 30% 30%, #ffffff 0%, #f0f3f9 60%, #e8edf6 100%);
        border: 1px solid #e9edf5;
        box-shadow: 0 20px 60px rgba(31, 41, 55, .08);
        filter: blur(.2px);
        border-radius: 24px;
        animation: floaty 12s ease-in-out infinite alternate;
    }

    .cta-bubble.b1 {
        width: 420px;
        height: 180px;
        top: 6%;
        left: -8%;
        transform: rotate(-6deg);
    }

    .cta-bubble.b2 {
        width: 360px;
        height: 160px;
        bottom: 8%;
        right: -6%;
        transform: rotate(8deg);
        animation-duration: 14s;
    }

    .cta-bubble.b3 {
        width: 240px;
        height: 120px;
        top: 50%;
        left: 62%;
        transform: rotate(-3deg);
        animation-duration: 16s;
        opacity: .9;
    }

    @keyframes floaty {
        0% {
            transform: translateY(0) rotate(var(--rot, 0deg));
        }

        100% {
            transform: translateY(-8px) rotate(calc(var(--rot, 0deg) + 2deg));
        }
    }

    /* conținut */
    .contact-cta--light .cta-wrap {
        position: relative;
        z-index: 3;
        display: grid;
        place-items: center;
        padding: clamp(2rem, 6vw, 5rem) 1rem;
        min-height: clamp(340px, 42vh, 520px);
    }

    .contact-cta--light .cta-card {
        width: min(1100px, 96%);
        background: linear-gradient(180deg, rgba(255, 255, 255, .82), rgba(255, 255, 255, .72));
        border: 1px solid #e7ebf2;
        border-radius: 22px;
        padding: clamp(1.25rem, 3.5vw, 2rem);
        box-shadow:
            0 24px 80px rgba(31, 41, 55, .12),
            inset 0 1px 0 rgba(255, 255, 255, .75);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }

    .contact-cta--light .cta-head {
        text-align: center;
        margin-bottom: clamp(1rem, 2.6vw, 1.5rem);
    }

    .contact-cta--light .cta-kicker {
        display: inline-block;
        letter-spacing: .18em;
        text-transform: uppercase;
        font-size: .82rem;
        color: var(--ink-500);
    }

    .contact-cta--light .cta-title {
        margin: .35rem 0 .4rem;
        font-size: clamp(1.8rem, 4.2vw, 2.6rem);
        line-height: 1.08;
        font-weight: 900;
        color: var(--ink-800);
    }

    .contact-cta--light .cta-sub {
        margin: 0 auto;
        max-width: 70ch;
        color: var(--ink-600);
        font-size: clamp(1rem, 1.2vw, 1.12rem);
    }

    .contact-cta--light .cta-actions {
        margin-top: clamp(.9rem, 2.2vw, 1.25rem);
        display: flex;
        gap: .75rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Butoane: folosim stilurile globale .btn / .btn-primary / .btn-ghost;
     doar ajustăm mic detalii ca să se potrivească pe fundalul deschis */
    .contact-cta--light .btn {
        box-shadow: 0 10px 24px rgba(31, 41, 55, .10);
    }

    .contact-cta--light .btn-ghost {
        border: 1px solid #e2e8f0;
        background: linear-gradient(180deg, #ffffff, #f7f9fc);
        color: var(--ink-800);
    }

    .contact-cta--light .btn-ghost:hover {
        filter: brightness(1.03);
    }

    /* Reveal helper (reutilizat în site) */
    [data-animate] {
        transform: translateY(10px);
        opacity: 0;
        transition: transform .6s ease, opacity .6s ease;
    }

    [data-animate].revealed {
        transform: translateY(0);
        opacity: 1;
    }

    @media (prefers-reduced-motion: reduce) {
        .cta-bubble {
            animation: none !important;
        }

        .cta-card {
            transition: none !important;
        }
    }
</style>