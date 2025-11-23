@extends('layouts.app')

@php
$slug = $service->slug;

/* — util: returnează asset() pentru primul fișier existent din lista de candidate — */
$firstExisting = function (array $candidates) {
foreach ($candidates as $rel) {
if (file_exists(public_path($rel))) return asset($rel);
}
return null;
};

/* — HERO: {slug}-hero.{ext} > {slug}.{ext} > placeholder — */
$heroFor = function (string $slug) use ($firstExisting) {
$exts = ['jpg','jpeg','png','webp'];
$candidates = [];
foreach (['-hero',''] as $suffix) {
foreach ($exts as $ext) {
$candidates[] = "img/{$slug}{$suffix}.{$ext}";
}
}
return $firstExisting($candidates) ?: asset('img/placeholder.jpg');
};

/* — GALLERY: {slug}-g1..g12.{ext}; dacă nu există, folosește HERO — */
$galleryFor = function (string $slug, string $hero) use ($firstExisting) {
$exts = ['jpg','jpeg','png','webp'];
$out = [];
for ($i = 1; $i <= 12; $i++) {
    $found=$firstExisting(array_map(fn($ext)=> "img/{$slug}-g{$i}.{$ext}", $exts));
    if ($found) $out[] = $found;
    }
    return $out ?: [$hero];
    };

    /* — BEFORE/AFTER: {slug}-before.{ext} și {slug}-after.{ext}; altfel fără secțiune — */
    $baFor = function (string $slug) use ($firstExisting) {
    $exts = ['jpg','jpeg','png','webp'];
    $before = $firstExisting(array_map(fn($ext) => "img/{$slug}-before.{$ext}", $exts));
    $after = $firstExisting(array_map(fn($ext) => "img/{$slug}-after.{$ext}", $exts));
    return ($before && $after) ? [['before' => $before, 'after' => $after]] : [];
    };

    /* — TEXT (poți completa/edita doar textele aici; imaginile sunt locale) — */
    $copy = [
    'kitchen-remodeling' => [
    'intro' => "Our kitchen remodels are planned like a workflow: clear prep zones, ergonomic cooking triangles, and storage that keeps daily life calm...",
    'bullets' => ['Layout reconfiguration & islands','Custom cabinetry with soft-close hardware','Quartz/stone countertops & full-height splash','Task, ambient & accent lighting','Appliance coordination & ventilation','Moisture control & proper waterproofing'],
    ],
    'bathroom-remodeling' => [
    'intro' => "We build spa-like bathrooms that stand up to daily moisture...",
    'bullets' => ['Walk-in showers, niches & benches','Heated floors & mirror defogging','Premium tile setting systems','Quiet ventilation & humidity control','Vanities, storage & lighting layers','Glass enclosures & hardware'],
    ],
    // adaugă aici alte slug-uri după nevoie...
    ];

    $hero = $heroFor($slug);
    $photos = $galleryFor($slug, $hero);
    $baPairs = $baFor($slug);

    $data = [
    'intro' => $copy[$slug]['intro'] ?? ($service->excerpt ?: 'We deliver thoughtful, code-compliant remodeling with clean lines, durable materials and attentive communication.'),
    'bullets' => $copy[$slug]['bullets'] ?? ['Planning & permits','Skilled trades & supervision','Premium materials','Clean work & daily updates','Licensed & insured'],
    'photos' => $photos,
    'ba' => $baPairs,
    ];
    @endphp

    {{-- ---------- SEO dinamic ---------- --}}
    @section('title', $service->name . ' — TipTop Remodeling')
    @section('meta_description', $service->excerpt ?? 'Professional remodeling service by TipTop Remodeling.')
    @section('canonical', route('services.show', $service->slug))
    @section('og_image', $hero)

    @section('content')
    <style>
        .section {
            padding: clamp(2.2rem, 5vw, 4.6rem) 0
        }

        .stack>*+* {
            margin-top: clamp(.7rem, 1.6vw, 1.1rem)
        }

        .lead {
            color: #374151;
            max-width: 80ch
        }

        .content {
            max-width: 1000px;
            margin: auto
        }

        .grid {
            display: grid;
            gap: clamp(12px, 2.2vw, 18px)
        }

        @media(min-width:900px) {
            .grid--2 {
                grid-template-columns: 1.2fr .8fr
            }

            .grid--3 {
                grid-template-columns: repeat(3, 1fr)
            }
        }

        .hero .hero-wrap {
            min-height: clamp(340px, 38vw, 520px)
        }

        .hero .hero-content {
            backdrop-filter: blur(2px)
        }

        .hero .hero-title {
            letter-spacing: .02em
        }

        .checklist {
            display: grid;
            gap: .5rem;
            grid-template-columns: 1fr
        }

        @media(min-width:720px) {
            .checklist {
                grid-template-columns: 1fr 1fr
            }
        }

        .checklist li {
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 12px;
            padding: .65rem .8rem
        }

        .kpi {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(3, 1fr)
        }

        .kpi .card {
            background: #0a0a0a;
            color: #fff;
            border-radius: 16px;
            padding: 1rem .9rem;
            text-align: center
        }

        .kpi .num {
            font-weight: 900;
            font-size: clamp(1.2rem, 3vw, 1.8rem)
        }

        .ba-card {
            max-width: 980px;
            margin: 0 auto
        }

        .ba-wrap {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            user-select: none;
            touch-action: none
        }

        .ba-wrap img {
            display: block;
            width: 100%;
            height: auto
        }

        .ba-after {
            clip-path: inset(0 0 0 50%);
            transition: clip-path .06s linear
        }

        .ba-handle {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background: #e5e7eb;
            box-shadow: 0 0 0 1px #0001
        }

        .ba-knob {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #e5e7eb;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .25)
        }

        .ba-range {
            display: block;
            width: 100%;
            margin-top: .7rem
        }

        .gallery .item {
            width: 100%;
            height: clamp(200px, 28vw, 260px);
            object-fit: cover;
            border-radius: 14px
        }

        .gallery.grid--3 {
            align-items: stretch
        }

        .timeline {
            display: grid;
            gap: 12px
        }

        @media(min-width:860px) {
            .timeline {
                grid-template-columns: repeat(4, 1fr)
            }
        }

        .step {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 1rem
        }

        .step strong {
            display: block;
            margin-bottom: .25rem
        }

        /* hero bg var */
        .hero {
            background: var(--hero-img) center/cover no-repeat;
        }
    </style>

    {{-- ========== HERO ========== --}}
    <section class="hero full-bleed" style="--hero-img:url('{{ $hero }}')">
        <div class="container hero-wrap">
            <div class="hero-content stack">
                <a href="{{ route('services.index') }}" class="btn btn-ghost" style="padding:.45rem .8rem">← Back to Services</a>
                <h1 class="hero-title">{{ $service->name }}</h1>
                <p class="hero-sub">{{ $service->excerpt }}</p>
            </div>
        </div>
    </section>

    {{-- ========== OVERVIEW (rich two-column) ========== --}}
    <section class="section full-bleed">
        <div class="container grid grid--2" style="align-items:start">
            <div class="stack">
                <p class="lead">{{ $data['intro'] }}</p>
                <div>{!! nl2br(e($service->description ?? 'We combine planning, skilled trades and premium materials to deliver a space that looks right, feels right and lasts. Expect transparent proposals, clean jobsites, daily updates and on-time delivery.')) !!}</div>
                @if(!empty($data['bullets']))
                <ul class="checklist">
                    @foreach($data['bullets'] as $b)
                    <li>✓ {{ $b }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="stack">
                <div class="kpi">
                    <div class="card">
                        <div class="num">10–15 yrs</div>
                        <div>Typical finish lifespans</div>
                    </div>
                    <div class="card">
                        <div class="num">98%</div>
                        <div>On-time milestones</div>
                    </div>
                    <div class="card">
                        <div class="num">A+</div>
                        <div>Clean-site rating</div>
                    </div>
                </div>
                <div class="card" style="border:1px solid #eee;border-radius:14px;padding:1rem">
                    <strong>Why clients choose us</strong>
                    <p style="margin:.3rem 0 0;color:#4b5563">Clear scope, realistic timelines, respectful crews and meticulous finishes.
                        We protect floors and adjacent rooms, keep dust under control, and communicate daily so you always know what’s next.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== BEFORE & AFTER (doar dacă există fișierele locale) ========== --}}
    @if(!empty($data['ba']))
    <section class="section is-light full-bleed">
        <div class="container stack">
            <h2 class="section-title" style="font-weight:900">Before &amp; After</h2>
            @foreach($data['ba'] as $pair)
            <figure class="ba-card stack" data-ba>
                <div class="ba-wrap">
                    <img class="ba-before" src="{{ $pair['before'] }}" alt="Before">
                    <img class="ba-after" src="{{ $pair['after']  }}" alt="After">
                    <div class="ba-handle" aria-hidden="true"></div>
                    <span class="ba-knob" aria-hidden="true"></span>
                </div>
                <input class="ba-range" type="range" min="0" max="100" value="50" aria-label="Compare before and after">
            </figure>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ========== GALLERY (poze locale) ========== --}}
    <section class="section full-bleed">
        <div class="container stack">
            <h2 class="section-title" style="font-weight:900">Project Photos</h2>
            <p class="lead">A small selection from recent work. We shoot progress and completion photos so you can see substrate
                prep, waterproofing details and the final finish. Ask us for full case studies relevant to your home.</p>
            <div class="gallery grid grid--3">
                @foreach($data['photos'] as $src)
                <img class="item" src="{{ $src }}" alt="{{ $service->name }} photo">
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== PROCESS ========== --}}
    <section class="section is-light full-bleed">
        <div class="container stack">
            <h2 class="section-title" style="font-weight:900">Our Process</h2>
            <div class="timeline">
                <div class="step"><strong>1) Consultation</strong><span>Walkthrough, goals, budget ranges and timeline windows. We identify constraints early and propose options that fit.</span></div>
                <div class="step"><strong>2) Scope & Quote</strong><span>Written scope with allowances, lead times and payment schedule. You know what’s included and when.</span></div>
                <div class="step"><strong>3) Build</strong><span>Protection, demo, rough-ins, inspections and finish. Daily updates and tidy jobsites so your home stays livable.</span></div>
                <div class="step"><strong>4) Handover</strong><span>Final punch, care guides and warranty. We’re available for maintenance and future upgrades.</span></div>
            </div>
        </div>
    </section>


    @endsection

    @push('scripts')
    <script>
        /* Before/After drag */
        document.querySelectorAll('[data-ba]').forEach((wrapCard) => {
            const wrap = wrapCard.querySelector('.ba-wrap');
            if (!wrap) return;
            const after = wrap.querySelector('.ba-after');
            const handle = wrap.querySelector('.ba-handle');
            const knob = wrap.querySelector('.ba-knob');
            const range = wrapCard.querySelector('.ba-range');
            let dragging = false;

            const setPos = (pct) => {
                pct = Math.max(0, Math.min(100, pct));
                after.style.clipPath = `inset(0 0 0 ${pct}%)`;
                handle.style.left = knob.style.left = pct + '%';
                range.value = pct;
            };

            const pctFromEvent = (e) => {
                const rect = wrap.getBoundingClientRect();
                const x = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
                return (x / rect.width) * 100;
            };

            wrap.addEventListener('pointerdown', (e) => {
                dragging = true;
                wrap.setPointerCapture?.(e.pointerId);
                setPos(pctFromEvent(e));
            });
            wrap.addEventListener('pointermove', (e) => {
                if (dragging) setPos(pctFromEvent(e));
            });
            wrap.addEventListener('pointerup', (e) => {
                dragging = false;
                try {
                    wrap.releasePointerCapture?.(e.pointerId);
                } catch (_) {}
            });
            range?.addEventListener('input', (e) => setPos(parseFloat(e.target.value)));
            setPos(parseFloat(range?.value || 50));
        });
    </script>
    @endpush