@extends('layouts.app')

{{-- === SEO (Contact) === --}}
@section('title','Contact TipTop Remodeling — Get a Free Estimate')
@section('meta_description','Get in touch with TipTop Remodeling for your next kitchen, bathroom, or home renovation project. Licensed & insured, serving the local area with pride.')
@section('canonical', route('contact'))
@section('og_image','https://picsum.photos/id/1070/1600/900')

@section('content')
<style>
    .section {
        padding: clamp(2rem, 5vw, 4rem) 0;
    }

    .section--lg {
        padding: clamp(3rem, 6vw, 5rem) 0;
    }

    .stack>*+* {
        margin-top: clamp(.6rem, 1.6vw, 1rem);
    }

    .grid {
        display: grid;
        gap: clamp(1.4rem, 3vw, 2rem);
    }

    @media (min-width:900px) {
        .grid--2 {
            grid-template-columns: 1fr 1fr;
        }
    }

    form.card {
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 18px;
        box-shadow: var(--shadow-2);
        padding: clamp(1.5rem, 4vw, 2.5rem);
        width: 100%;
    }

    label span {
        font-weight: 700;
        display: inline-block;
        margin-bottom: .35rem;
    }

    input,
    textarea {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: .75rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        resize: vertical;
    }

    button.submit {
        display: inline-block;
        margin-top: .8rem;
        background: var(--brand);
        color: #fff;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        padding: .75rem 1.5rem;
        cursor: pointer;
        transition: .2s;
    }

    button.submit:hover {
        opacity: .9;
    }

    .info-block {
        background: #fafafa;
        border: 1px solid #eee;
        border-radius: 18px;
        padding: clamp(1.5rem, 4vw, 2.2rem);
        box-shadow: var(--shadow-1);
    }

    .info-item strong {
        display: block;
        font-weight: 800;
        margin-bottom: .2rem;
    }

    .info-item p {
        margin: 0;
        color: #4b5563;
    }
</style>

{{-- ===== HERO ===== --}}
<section class="hero full-bleed" style="--hero-img:url('https://picsum.photos/id/1070/1600/900')">
    <div class="container hero-wrap">
        <div class="hero-content stack">
            <div class="hero-kicker">Get in Touch</div>
            <h1 class="hero-title">Let’s bring your renovation idea to life</h1>
            <p class="hero-sub">
                Whether you’re planning a new kitchen, bathroom, or full home remodel,
                we’d love to hear your vision. Send us your project details and we’ll
                respond within one business day.
            </p>
        </div>
    </div>
</section>

{{-- ===== CONTACT SECTION ===== --}}
<section class="section section--lg full-bleed">
    <div class="container grid grid--2">
        {{-- === FORM === --}}
        <div>
            <h2 style="font-size:1.6rem;font-weight:900;margin-bottom:.8rem;">Send us a message</h2>
            <form method="POST" action="{{ route('contact.send') }}" class="card">
                @csrf
                <label><span>Name</span><input name="name" type="text" placeholder="Your full name" required></label>
                <label><span>Email</span><input name="email" type="email" placeholder="you@example.com" required></label>
                <label><span>Phone</span><input name="phone" type="tel" placeholder="+1 (555) 123-4567"></label>
                <label><span>Message</span><textarea name="message" rows="5" placeholder="Tell us about your project..." required></textarea></label>
                <button type="submit" class="submit">Send Message</button>
            </form>
        </div>

        {{-- === INFO SIDEBAR === --}}
        <div class="info-block stack">
            <h2 style="font-size:1.6rem;font-weight:900;margin-bottom:.5rem;">Contact Details</h2>
            <div class="info-item">
                <strong>Phone</strong>
                <p><a href="tel:+12023862748">+1 (202) 386-2748</a></p>
            </div>
            <div class="info-item">
                <strong>Email</strong>
                <p><a href="mailto:info@tiptopremodeling.com">info@tiptopremodeling.com</a></p>
            </div>
            <div class="info-item">
                <strong>Office</strong>
                <p>Washington D.C. Metro Area, United States</p>
            </div>
            <div class="info-item">
                <strong>Working Hours</strong>
                <p>Mon–Fri: 8:00 AM – 6:00 PM<br>Sat: 9:00 AM – 2:00 PM</p>
            </div>
            <p style="margin-top:1rem;color:#6b7280;">We respond to all inquiries within 24 hours.</p>
        </div>
    </div>
</section>

{{-- ===== MAP or VISUAL ===== --}}
<section class="section is-light full-bleed">
    <div class="container stack" style="text-align:center;">
        <h2 style="font-weight:900;font-size:1.6rem;">Our Service Area</h2>
        <p class="lead">Serving homeowners throughout the Washington D.C. metropolitan area — Maryland, Virginia, and nearby communities.</p>
        <img src="https://res.cloudinary.com/dv0jqjrc3/image/fetch/w_768,c_fill,f_auto,q_auto,w_768/https://www.pulte.com/-/media/static-picturepark-assets/uncategorized/2024/07/17/17/49/612025-1--efkn92jpg.jpg" alt="Service area map" style="width:100%;border-radius:18px;object-fit:cover;margin-top:1rem;">
    </div>
</section>


@endsection