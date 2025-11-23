@php
$faqs = [
['q'=>'How long does a typical kitchen remodel take?',
'a'=>'Most kitchens take 4–8 weeks depending on scope, lead times, and inspections. We provide a clear timeline before we start.'],
['q'=>'Do you handle permits and inspections?',
'a'=>'Yes. We prepare drawings as needed, submit permits, and coordinate all inspections with your city.'],
['q'=>'Can you work within my budget?',
'a'=>'Absolutely. We value-engineer finishes and suggest alternatives that preserve the design while keeping costs in line.'],
['q'=>'Is your work covered by warranty?',
'a'=>'Yes. We stand behind our workmanship and manufacturer warranties on installed products.'],
];
@endphp

<section class="faq-2025 full-bleed is-light" id="faq">
    <header class="container faq-head">
        <h2 class="faq-title">Frequently Asked Questions</h2>
        <p class="faq-sub">
            Clear, honest answers about <strong>timelines</strong>, <strong>permits</strong>, and <strong>budgets</strong> — so you know exactly what to expect.
        </p>
    </header>
    <div class="container faq-grid">

        <!-- Col stânga: vizual + headline -->
        <div class="faq-visual" data-animate>

            <figure class="faq-figure">
                <img
                    src="{{ asset('img/hero.jpg') }}"
                    alt="Remodeling process – Q&A"
                    class="faq-img"
                    loading="lazy" />
                <figcaption class="faq-chip">
                    <span class="dot"></span> Ask us anything — we’re here to help
                </figcaption>
            </figure>

        </div>

        <!-- Col dreapta: acordeon -->
        <div class="faq-list" data-animate>
            @foreach($faqs as $i => $f)
            <details class="faq-item" {{ $i===0 ? 'open' : '' }}>
                <summary class="faq-q">
                    <span>{{ $f['q'] }}</span>
                    <svg class="chev" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                        <path d="M12 15.5 4.5 8l1.4-1.4L12 12.7l6.1-6.1L19.5 8z" fill="currentColor" />
                    </svg>
                    <i class="underline"></i>
                </summary>
                <div class="faq-a">
                    {{ $f['a'] }}
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>