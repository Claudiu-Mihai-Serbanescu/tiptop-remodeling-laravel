@extends('layouts.app')

{{-- ===== SEO dinamic pentru pagina Services ===== --}}
@section('title', 'Remodeling Services — TipTop')
@section('meta_description', 'Explore our full range of remodeling services: kitchens, bathrooms, flooring, painting, roofing and more. Licensed & insured. Free estimates.')
@section('canonical', route('services.index'))
@section('og_image', asset('img/hero.jpg'))

@section('content')

{{-- ===== HERO ===== --}}
<section class="hero  full-bleed" style="--hero-img: url('{{ asset('img/hero.jpg') }}')">
    <div class="container hero-wrap">
        <div class="hero-content">
            <div class="hero-kicker">Our Services</div>
            <h1 class="hero-title">
                Remodeling that
                <span style="background:linear-gradient(90deg,var(--brand),var(--brand-2));-webkit-background-clip:text;background-clip:text;color:transparent;">raises the bar</span>
            </h1>
            <p class="hero-sub">
                Kitchens, bathrooms, flooring, painting, roofing &amp; more — built with care, on time, on budget.
                Licensed &amp; insured. Free estimates.
            </p>
            <div class="hero-cta">
                <a href="{{ route('contact') }}" class="btn btn-primary">Get a Free Estimate</a>
                <a href="{{ route('projects.index') }}" class="btn btn-ghost">See Portfolio</a>
            </div>
            <div class="badges" aria-label="Trust signals">
                <span class="badge">✓ Licensed &amp; insured</span>
                <span class="badge">★ 5-star reviews</span>
                <span class="badge">⏱️ On-time delivery</span>
            </div>
        </div>
    </div>
</section>


{{-- ===== Lista servicii (componenta existentă) ===== --}}
@php($all = \App\Models\Service::orderBy('name')->get())
<x-featured-services :services="$all" />

@endsection