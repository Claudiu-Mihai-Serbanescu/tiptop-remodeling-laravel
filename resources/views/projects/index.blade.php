@extends('layouts.app')

{{-- ===== SEO dinamic pentru pagina Projects ===== --}}
@section('title', 'Remodeling Projects — TipTop')
@section('meta_description', 'See our remodeling work: kitchens, bathrooms, flooring, painting and more. Real before & after transformations, quality finishes, on-time delivery.')
@section('canonical', route('projects.index'))
@section('og_image', asset('img/hero.jpg'))

@section('content')
<style>
    /* ===== Secțiuni projects ===== */
    .section-title {
        font-size: clamp(1.6rem, 3.4vw, 2.3rem);
        font-weight: 900;
        margin: 0 0 .8rem;
    }

    /* Case studies grid */
    .case-grid {
        display: grid;
        gap: clamp(.9rem, 2vw, 1.2rem);
        grid-template-columns: 1fr;
    }

    @media (min-width: 720px) {
        .case-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 1200px) {
        .case-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    .case-card {
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-2);
        transform: translateY(12px);
        opacity: 0;
        transition: transform .6s ease, opacity .6s ease, box-shadow .25s ease;
    }

    .case-card:hover {
        box-shadow: 0 22px 60px rgba(0, 0, 0, .12);
        transform: translateY(8px);
    }

    .case-card[data-animate].revealed {
        transform: none;
        opacity: 1;
    }

    .case-cover {
        display: block;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #f6f7f8;
    }

    .case-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease;
        display: block;
    }

    .case-card:hover .case-cover img {
        transform: scale(1.03);
    }

    .case-body {
        padding: clamp(1rem, 1.6vw, 1.25rem);
    }

    .case-tags {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        margin-bottom: .5rem;
    }

    .tag {
        font-size: .78rem;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        padding: .18rem .55rem;
        color: #374151;
        background: #fff;
    }

    .case-title {
        margin: .1rem 0 .35rem;
        font-weight: 900;
        font-size: clamp(1.05rem, 1.4vw, 1.25rem);
    }

    .case-title a {
        color: inherit;
        text-decoration: none;
    }

    .case-title a:hover {
        text-decoration: underline;
    }

    .case-excerpt {
        margin: 0 0 .65rem;
        color: #4b5563;
    }

    .case-link {
        font-weight: 700;
        text-decoration: none;
        color: var(--brand);
    }

    .case-link:hover {
        text-decoration: underline;
    }

    /* Photo mosaic (completed photos) */
    .mosaic {
        display: grid;
        gap: clamp(6px, 1vw, 10px);
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    @media (min-width: 980px) {
        .mosaic {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    .mosaic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        border-radius: 14px;
        border: 1px solid #eee;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
    }

    /* Mic polish pentru secțiuni full-bleed */
    .section-title+p {
        margin-top: 0;
        color: #374151;
    }

    /* (opțional) animație generică pentru [data-animate] dacă nu exista deja */
    [data-animate] {
        transform: translateY(10px);
        opacity: 0;
        transition: transform .6s, opacity .6s;
    }

    [data-animate].revealed {
        transform: none;
        opacity: 1;
    }
</style>
{{-- ===== HERO (full-bleed) ===== --}}
<section class="hero full-bleed" style="--hero-img: url('{{ asset('img/hero.jpg') }}')">
    <div class="container hero-wrap">
        <div class="hero-content">
            <div class="hero-kicker">Our Work</div>
            <h1 class="hero-title">Projects that <span style="background:linear-gradient(90deg,var(--brand),var(--brand-2));-webkit-background-clip:text;background-clip:text;color:transparent;">speak for themselves</span></h1>
            <p class="hero-sub">
                From concept to clean-up—kitchens, bathrooms, basements and more. Explore real client transformations.
            </p>
            <div class="hero-cta">
                <a href="{{ route('contact') }}" class="btn btn-primary">Get a Free Estimate</a>
                <a href="{{ route('services.index') }}" class="btn btn-ghost">See Services</a>
            </div>
        </div>
    </div>
</section>

{{-- ===== Intro (light) ===== --}}
<section class="seo-block is-light full-bleed" id="intro">
    <div class="container">
        <h2 class="seo-title">Crafting Spaces With Purpose</h2>
        <p class="seo-lead">
            At <strong>Tip Top Remodeling LLC</strong>, we transform ordinary rooms into exceptional living spaces.
            With <strong>senior designers</strong> and <strong>master craftsmen</strong>, we blend <strong>function</strong>, <strong>aesthetics</strong> and <strong>durability</strong>—tailored to your home.
        </p>

        <ul class="seo-list">
            <li class="seo-item" data-animate>
                <h3>Innovative Design Solutions</h3>
                <p>We reimagine <strong>layouts</strong>, optimize <strong>flow</strong>, and leverage <strong>natural light</strong> to make rooms feel larger, brighter, and more welcoming.</p>
            </li>
            <li class="seo-item" data-animate>
                <h3>Attention to Detail</h3>
                <p>From <strong>cabinet lines</strong> and <strong>tile patterns</strong> to <strong>trim profiles</strong> and <strong>lighting layers</strong>—every element serves harmony and performance.</p>
            </li>
            <li class="seo-item" data-animate>
                <h3>Sustainable Practices</h3>
                <p><strong>Low-VOC finishes</strong>, <strong>high-efficiency windows</strong>, and <strong>responsible materials</strong> that elevate comfort while reducing utility costs.</p>
            </li>
        </ul>
    </div>
</section>

{{-- ===== BEFORE / AFTER (sliders) ===== --}}
<section class="full-bleed" id="before-after">
    <div class="container">
        <h2 class="section-title">Before &amp; After Transformations</h2>

        <div class="ba-grid">
            {{-- Kitchen --}}
            <figure class="ba-card" data-animate>
                <figcaption>
                    <strong>Kitchen Remodel</strong>
                    <span>Storage optimization • Lighting • Surfaces</span>
                </figcaption>

                <div class="ba-wrap" data-ba>
                    {{-- before (kitchen) --}}
                    <img class="ba-before"
                        src="https://images.pexels.com/photos/18957835/pexels-photo-18957835.jpeg?auto=compress&cs=tinysrgb&w=1600"
                        alt="Kitchen — before remodel (dated cabinetry)">
                    {{-- after (kitchen) --}}
                    <img class="ba-after"
                        src="https://images.pexels.com/photos/8186505/pexels-photo-8186505.jpeg?cs=srgb&dl=pexels-curtis-adams-1694007-8186505.jpg&fm=jpg"
                        alt="Kitchen — after remodel (bright modern with island)">
                    <div class="ba-handle" aria-hidden="true"><span class="ba-knob"></span></div>
                    <input class="ba-range" type="range" min="0" max="100" value="50" aria-label="Compare before and after">
                </div>
            </figure>

            {{-- Bathroom --}}
            <figure class="ba-card" data-animate>
                <figcaption>
                    <strong>Bathroom Upgrade</strong>
                    <span>Tilework • Fixtures • Spa ambience</span>
                </figcaption>

                <div class="ba-wrap" data-ba>
                    {{-- before (bathroom) --}}
                    <img class="ba-before"
                        src="https://www.thespruce.com/thmb/7QaLLRDVfP84DHM4Zo7cmrvJez4=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Capture-fa883df240184c34a633d6f26d882ed8.JPG"
                        alt="Bathroom — before upgrade (worn, dated)">
                    {{-- after (bathroom) --}}
                    <img class="ba-after"
                        src="https://www.thespruce.com/thmb/7uJLaCRZeGv9wy5DRYjGGG1xleM=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Capture-12102e85af5c4fbf8e10ede459b505c8.JPG"
                        alt="Bathroom — after upgrade (modern minimalist)">
                    <div class="ba-handle" aria-hidden="true"><span class="ba-knob"></span></div>
                    <input class="ba-range" type="range" min="0" max="100" value="55" aria-label="Compare before and after">
                </div>
            </figure>
        </div>
    </div>
</section>

{{-- ===== CASE STUDIES (cards) ===== --}}
<section class="full-bleed" id="case-studies">
    <div class="container">
        <h2 class="section-title">Case Studies</h2>

        <div class="case-grid">
            {{-- Card 1 --}}
            <article class="case-card" data-animate>
                <a class="case-cover" href="#">
                    <img src="https://images.pexels.com/photos/8186505/pexels-photo-8186505.jpeg?cs=srgb&dl=pexels-curtis-adams-1694007-8186505.jpg&fm=jpg"
                        alt="Modern Kitchen — Georgetown">
                </a>
                <div class="case-body">
                    <div class="case-tags"><span class="tag">Kitchen</span><span class="tag">Lighting</span><span class="tag">Quartz</span></div>
                    <h3 class="case-title"><a href="#">Modern Kitchen — Georgetown</a></h3>
                    <p class="case-excerpt">Reconfigured layout, pantry wall, layered task & ambient lighting, durable surfaces.</p>
                    <a class="case-link" href="#">View case study →</a>
                </div>
            </article>

            {{-- Card 2 --}}
            <article class="case-card" data-animate>
                <a class="case-cover" href="#">
                    <img src="https://images.pexels.com/photos/29252363/pexels-photo-29252363.jpeg?auto=compress&cs=tinysrgb&w=1600"
                        alt="Spa Bathroom — Arlington">
                </a>
                <div class="case-body">
                    <div class="case-tags"><span class="tag">Bathroom</span><span class="tag">Tile</span><span class="tag">Walk-in</span></div>
                    <h3 class="case-title"><a href="#">Spa Bathroom — Arlington</a></h3>
                    <p class="case-excerpt">Large-format tile, frameless glass, rain shower, warm LED accents for spa ambience.</p>
                    <a class="case-link" href="#">View case study →</a>
                </div>
            </article>

            {{-- Card 3 --}}
            <article class="case-card" data-animate>
                <a class="case-cover" href="#">
                    <img src="https://4feldcoimages.feldcosales.com/4Feldco-Articles/finishing-a-basement/finishing-a-basement-1.jpg"
                        alt="Basement Finish — Bethesda (completed)">
                </a>
                <div class="case-body">
                    <div class="case-tags"><span class="tag">Basement</span><span class="tag">Insulation</span><span class="tag">LVP</span></div>
                    <h3 class="case-title"><a href="#">Basement Finish — Bethesda</a></h3>
                    <p class="case-excerpt">Moisture control, acoustic insulation, LVP floors, media wall with integrated storage.</p>
                    <a class="case-link" href="#">View case study →</a>
                </div>
            </article>
        </div>
    </div>
</section>

{{-- ===== COMPLETED PHOTOS (mosaic) ===== --}}
<section class="full-bleed" id="gallery">
    <div class="container">
        <h2 class="section-title">Completed Photos</h2>
        <div class="mosaic">
            <img src="https://images.pexels.com/photos/8186505/pexels-photo-8186505.jpeg?cs=srgb&dl=pexels-curtis-adams-1694007-8186505.jpg&fm=jpg"
                alt="Kitchen — completed 1" loading="lazy" decoding="async">
            <img src="https://images.pexels.com/photos/18957835/pexels-photo-18957835.jpeg?auto=compress&cs=tinysrgb&w=1600"
                alt="Kitchen — completed 2" loading="lazy" decoding="async">
            <img src="https://images.pexels.com/photos/29252363/pexels-photo-29252363.jpeg?auto=compress&cs=tinysrgb&w=1600"
                alt="Bathroom — completed 1" loading="lazy" decoding="async">

        </div>
    </div>
</section>



@endsection

@push('scripts')
<script>
    /* ===== Before/After slider logic (drag + input range) ===== */
    document.querySelectorAll('[data-ba]').forEach(function(wrap) {
        const after = wrap.querySelector('.ba-after');
        const range = wrap.querySelector('.ba-range');
        let dragging = false;

        function setPos(pct) {
            pct = Math.max(0, Math.min(100, pct));
            after.style.clipPath = `inset(0 0 0 ${pct}%)`;
            wrap.style.setProperty('--pos', pct + '%');
            if (range) range.value = pct;
        }

        function fromEvent(e) {
            const rect = wrap.getBoundingClientRect();
            const x = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
            return (x / rect.width) * 100;
        }

        wrap.addEventListener('pointerdown', e => {
            dragging = true;
            wrap.classList.add('is-dragging');
            setPos(fromEvent(e));
        });
        window.addEventListener('pointermove', e => {
            if (dragging) setPos(fromEvent(e));
        });
        window.addEventListener('pointerup', () => {
            dragging = false;
            wrap.classList.remove('is-dragging');
        });

        if (range) {
            range.addEventListener('input', e => setPos(e.target.value));
        }
        setPos(range ? range.value : 50);
    });
</script>
@endpush