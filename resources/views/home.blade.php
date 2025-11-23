@extends('layouts.app')

@section('content')
<section class="hero full-bleed" style="--hero-img: url('{{ asset('img/hero.jpg') }}')">
    <div class="container hero-wrap">
        <div class="hero-content">
            <div class="hero-kicker">Design • Build • Remodel</div>
            <h1 class="hero-title">Remodeling that elevates your home — kitchens, bathrooms, basements and more.</h1>
            <p class="hero-sub">From concept to final walkthrough, we deliver on time, on budget, and with craftsmanship that lasts.</p>
            <div class="hero-cta">
                <a href="{{ route('contact') }}" class="btn btn-primary">Get a Free Estimate</a>
                <a href="{{ route('projects.index') }}" class="btn btn-ghost">View Portfolio</a>
            </div>
            <div class="badges">
                <span class="badge">Licensed & Insured</span>
                <span class="badge">5-Star Reviews</span>
                <span class="badge">Warranty Included</span>
            </div>
        </div>
    </div>
</section>

<x-seo-block />

{{-- IMPORTANT: trecem datele reale în props --}}
<x-testimonials :reviews="$reviews" :biz="$biz" />

@php($all = \App\Models\Service::orderBy('name')->get())
<x-featured-services :services="$all" />

<x-faq />

@endsection