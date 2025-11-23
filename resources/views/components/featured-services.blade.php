@props(['services'])

@php
$isHome = request()->routeIs('home');
$all = $services instanceof \Illuminate\Support\Collection ? $services : collect($services);
$first = $isHome ? $all->take(6) : $all;
$rest = $isHome ? $all->slice(6) : collect();

/* util: găsește prima imagine existentă pentru slug cu extensii comune */
$img = function (string $slug) {
foreach (['jpg','jpeg','png','webp'] as $ext) {
$path = "img/{$slug}.{$ext}";
if (file_exists(public_path($path))) return asset($path);
}
return asset('img/placeholder.jpg');
};
@endphp

<section class="services-full full-bleed">
    <div class="container services-head">
        <h2 class="services-title">Services</h2>
        <p class="services-sub">Design • Permits • Build • Finish — warm, modern remodels that lift comfort, value and curb appeal.</p>
        <br>
    </div>

    {{-- primele 6 sau toate (pe /services) --}}
    <div class="tiles">
        @foreach($first as $s)
        <article class="tile" style="--bg:url('{{ $img($s->slug) }}')">
            <div class="tile-overlay">
                <div>
                    <h3>{{ $s->name }}</h3>
                    <p>{{ $s->excerpt }}</p>
                    <a href="{{ route('services.show',$s->slug) }}" class="tile-btn">Take the first step</a>
                </div>
            </div>
            <a class="tile-link" href="{{ route('services.show',$s->slug) }}" aria-label="{{ $s->name }}"></a>
        </article>
        @endforeach
    </div>

    {{-- restul + buton doar pe homepage --}}
    @if($isHome && $rest->count())
    <div id="more-services" class="tiles" style="display:none;">
        @foreach($rest as $s)
        <article class="tile" style="--bg:url('{{ $img($s->slug) }}')">
            <div class="tile-overlay">
                <div>
                    <h3>{{ $s->name }}</h3>
                    <p>{{ $s->excerpt }}</p>
                    <a href="{{ route('services.show',$s->slug) }}" class="tile-btn">Take the first step</a>
                </div>
            </div>
            <a class="tile-link" href="{{ route('services.show',$s->slug) }}" aria-label="{{ $s->name }}"></a>
        </article>
        @endforeach
    </div>

    <div class="container" style="text-align:center; margin-top:1rem;">
        <button id="seeMoreBtn" class="tile-btn mb-5" type="button" aria-expanded="false" aria-controls="more-services">See more</button>
        <noscript>
            <p style="margin-top:.75rem;"><a class="tile-btn" href="{{ route('services.index') }}">View all services</a></p>
        </noscript>
    </div>

    <script>
        (() => {
            const btn = document.getElementById('seeMoreBtn'),
                more = document.getElementById('more-services');
            if (!btn || !more) return;
            btn.addEventListener('click', () => {
                const hidden = more.style.display === 'none';
                more.style.display = hidden ? '' : 'none';
                btn.setAttribute('aria-expanded', String(hidden));
                btn.textContent = hidden ? 'See less' : 'See more';
            });
        })();
    </script>
    @endif
</section>