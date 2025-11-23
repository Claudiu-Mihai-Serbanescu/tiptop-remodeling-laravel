@extends('layouts.app')

{{-- === SEO (About) === --}}
@section('title','About TipTop Remodeling — Our Story')
@section('meta_description','Romanian-born team crafting high-quality home renovations in the USA. Kitchens, bathrooms, basements — with craftsmanship, integrity, and on-time delivery.')
@section('canonical', route('about'))
@section('og_image','https://picsum.photos/id/1067/1600/900')

@section('content')
<style>

</style>

{{-- ===== HERO (full-bleed) ===== --}}
<section class="hero full-bleed" style="--hero-img:url('https://picsum.photos/id/1067/1600/900')">
    <div class="container hero-wrap">
        <div class="hero-content stack">
            <div class="hero-kicker">Who We Are</div>
            <h1 class="h1">Romanian roots, <span style="background:linear-gradient(90deg,var(--brand),var(--brand-2));-webkit-background-clip:text;background-clip:text;color:transparent;">American craftsmanship</span></h1>
            <p class="hero-sub">
                We’re a Romanian-born team now building in the U.S., known for obsessive detail, honest timelines, and
                durable finishes that look as good on day 1,000 as they do on day 1.
            </p>
            <div class="hero-cta">
                <a href="{{ route('projects.index') }}" class="btn btn-primary">See Our Projects</a>
                <a href="{{ route('contact') }}" class="btn btn-ghost">Get a Free Estimate</a>
            </div>
        </div>
    </div>
</section>

{{-- ===== OUR STORY ===== --}}
<section class="section section--lg is-light full-bleed">
    <div class="container stack">
        <h2 class="h2">Our Story</h2>
        <p class="lead">
            TipTop began as a small crew in Romania, learning the hard way that great remodeling means clear plans,
            careful prep, and showing up every day. We brought that discipline to the U.S., along with a promise:
            <em>do it right, or don’t do it at all</em>.
        </p>

        <div class="grid grid--3">
            <article class="card" data-animate>
                <img class="card__img" src="https://picsum.photos/id/1011/1200/800" alt="Team planning on site">
                <div class="card__body">
                    <h3 class="h3">Foundation in craft</h3>
                    <p class="muted">Years of residential sites taught us that clean lines and long-lasting joins
                        start with protection, layout, and sequencing done with intention.</p>
                </div>
            </article>
            <article class="card" data-animate>
                <img class="card__img" src="https://picsum.photos/id/1005/1200/800" alt="Engineers on construction site">
                <div class="card__body">
                    <h3 class="h3">Relocating to the U.S.</h3>
                    <p class="muted">We brought European attention to detail to American homes—kitchens, baths,
                        basements, exterior updates—while keeping communication fast and transparent.</p>
                </div>
            </article>
            <article class="card" data-animate>
                <img class="card__img" src="https://picsum.photos/id/1044/1200/800" alt="Reviewing plans and finishes">
                <div class="card__body">
                    <h3 class="h3">Trust over trends</h3>
                    <p class="muted">We design for longevity. Thoughtful materials, proper substrates, and tidy
                        job sites—so the “after” still feels new years later.</p>
                </div>
            </article>
        </div>
    </div>
</section>



{{-- ===== WHAT CLIENTS VALUE (dark) ===== --}}
<section class="section section--lg is-dark full-bleed">
    <div class="container stack">
        <div>
            <h2 class="h2">What Clients Value</h2>
            <p class="lead" style="color:#cfd3d6">On-site respect • Clean work • Clear timelines • Daily updates • Licensed & insured</p>
        </div>
        <ul class="grid grid--4" style="list-style:none; padding:0; margin:0;">
            <li class="card" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12)">
                <div class="card__body">
                    <span class="pill">✓ Transparency</span>
                    <p class="muted" style="color:#e5e7eb;margin-top:.6rem">Detailed proposals, realistic allowances, and no-surprise change orders.</p>
                </div>
            </li>
            <li class="card" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12)">
                <div class="card__body">
                    <span class="pill">✓ Protection</span>
                    <p class="muted" style="color:#e5e7eb;margin-top:.6rem">Dust control, floor/door protection, and respectful crews in your home.</p>
                </div>
            </li>
            <li class="card" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12)">
                <div class="card__body">
                    <span class="pill">✓ Durability</span>
                    <p class="muted" style="color:#e5e7eb;margin-top:.6rem">Substrates, fasteners, and sealants selected for the climate and use.</p>
                </div>
            </li>
            <li class="card" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12)">
                <div class="card__body">
                    <span class="pill">✓ Stewardship</span>
                    <p class="muted" style="color:#e5e7eb;margin-top:.6rem">Responsible disposal & material recycling wherever possible.</p>
                </div>
            </li>
        </ul>
    </div>
</section>




@endsection