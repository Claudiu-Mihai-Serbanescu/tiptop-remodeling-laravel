@props(['biz'=>null,'reviews'=>[]])
@if($biz && !empty($reviews))
@php
$slider = array_slice($reviews, 0, 6); // în slider (se văd 3 pe desktop)
$more = array_slice($reviews, 6); // restul sub slider
@endphp
<style>

</style>

<section class="t2 full-bleed" id="testimonials-v2">
    <div class="t2-container">
        <header class="t2-head">
            <h2>TESTIMONIALS</h2>
            <p>Real homeowners. Real results.</p>
            <div class="t2-seo">Trusted home renovation & remodeling reviews — kitchens, bathrooms, and full-house projects.</div>
        </header>

        <div class="t2-grid">
            {{-- Biz card (fix) --}}
            <article class="t2-biz">
                <div class="t2-biz-top">
                    @if(!empty($biz['photo']))<img class="t2-biz-photo" src="{{ $biz['photo'] }}" alt="{{ $biz['name'] ?? 'Business' }}" referrerpolicy="no-referrer">@endif
                </div>
                @if(!empty($biz['name']))<h3 class="t2-biz-name">{{ $biz['name'] }}</h3>@endif
                @if(!empty($biz['rating']))
                @php $full=(int)round($biz['rating']); @endphp
                <div class="t2-biz-rating">
                    <div class="t2-biz-score">{{ number_format((float)$biz['rating'],1) }}</div>
                    <div class="t2-stars" aria-label="rating {{ $biz['rating'] }} out of 5">@for($i=1;$i<=5;$i++)<span class="t2-star {{ $i<=$full ? 'is-full':'' }}">★</span>@endfor</div>
                </div>
                @endif
                @if(!empty($biz['count']))<div class="t2-biz-meta">Based on {{ (int)$biz['count'] }} reviews</div>@endif
                @php $ctaHref=$biz['write_url'] ?? $biz['gmap'] ?? null; @endphp

                <div class="t2-biz-foot"><a class="t2-biz-cta" href="{{ $ctaHref }}" target="_blank" rel="noopener">review us on <span class="t2-g">Google</span></a></div>
            </article>

            {{-- Slider (3 vizibile pe desktop, autoplay + butoane) --}}
            <div class="t2-slider" data-t2slider>
                <button class="t2-nav t2-prev" type="button" aria-label="Previous">‹</button>
                <div class="t2-track" data-t2track>
                    @foreach($slider as $r)
                    @php
                    $author=$r['author_name']??'User';
                    $photo=$r['profile_photo_url']??null;
                    $rating=(int)($r['rating']??5);
                    $date=$r['relative_time_description']??'';
                    $text=trim($r['text']??'');
                    $alink=$r['author_url']??($biz['gmap']??'#');
                    $initial=strtoupper(mb_substr($author,0,1));
                    @endphp
                    <article class="t2-card">
                        <div class="t2-user">
                            @if($photo)<img src="{{ $photo }}" alt="{{ $author }}" class="t2-avatar" referrerpolicy="no-referrer">@else<div class="t2-avatar" aria-hidden="true">{{ $initial }}</div>@endif
                            <div>
                                <div class="t2-name">{{ $author }}</div>
                                <div class="t2-stars-line" aria-label="{{ $rating }} of 5 stars">@for($i=1;$i<=5;$i++)<span class="t2-star {{ $i <= $rating ? 'is-full':'' }}">★</span>@endfor</div>
                            </div>
                        </div>
                        @if($text!=='')
                        <p class="t2-text" data-short>“{{ $text }}”</p>
                        <p class="t2-text" data-full hidden>“{{ $text }}”</p>
                        @if(strlen($text)>150)<button class="t2-readmore" type="button" data-t2readmore aria-expanded="false">Read more</button>@endif
                        @endif
                        <div class="t2-meta">
                            <a class="t2-link" href="{{ $alink }}" target="_blank" rel="noopener">View on Google</a>
                            @if($date)<span class="t2-date">{{ $date }}</span>@endif
                        </div>
                    </article>
                    @endforeach
                </div>
                <button class="t2-nav t2-next" type="button" aria-label="Next">›</button>

                {{-- Restul review-urilor sub slider --}}
                @if(!empty($more))
                <div class="t2-more">
                    @foreach($more as $r)
                    @php
                    $author=$r['author_name']??'User';
                    $photo=$r['profile_photo_url']??null;
                    $rating=(int)($r['rating']??5);
                    $date=$r['relative_time_description']??'';
                    $text=trim($r['text']??'');
                    $alink=$r['author_url']??($biz['gmap']??'#');
                    $initial=strtoupper(mb_substr($author,0,1));
                    @endphp
                    <article class="t2-card">
                        <div class="t2-user">
                            @if($photo)<img src="{{ $photo }}" alt="{{ $author }}" class="t2-avatar" referrerpolicy="no-referrer">@else<div class="t2-avatar" aria-hidden="true">{{ $initial }}</div>@endif
                            <div>
                                <div class="t2-name">{{ $author }}</div>
                                <div class="t2-stars-line" aria-label="{{ $rating }} of 5 stars">@for($i=1;$i<=5;$i++)<span class="t2-star {{ $i <= $rating ? 'is-full':'' }}">★</span>@endfor</div>
                            </div>
                        </div>
                        @if($text!=='')<p class="t2-text">“{{ $text }}”</p>@endif
                        <div class="t2-meta"><a class="t2-link" href="{{ $alink }}" target="_blank" rel="noopener">View on Google</a>@if($date)<span class="t2-date">{{ $date }}</span>@endif</div>
                    </article>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    (() => {
        const wrap = document.querySelector('[data-t2slider]');
        if (!wrap) return;
        const track = wrap.querySelector('[data-t2track]'),
            prev = wrap.querySelector('.t2-prev'),
            next = wrap.querySelector('.t2-next');
        const gap = 12;
        const step = () => {
            const first = track.querySelector('.t2-card');
            return first ? first.getBoundingClientRect().width + gap : track.clientWidth * .9
        };
        const go = (dir = 1) => track.scrollBy({
            left: dir * step(),
            behavior: 'smooth'
        });
        prev.addEventListener('click', () => go(-1));
        next.addEventListener('click', () => go(1));
        // autoplay cu pauză la hover/touch
        let timer;
        const start = () => {
            timer = setInterval(() => {
                const atEnd = Math.ceil(track.scrollLeft + track.clientWidth) >= track.scrollWidth - 1;
                if (atEnd) {
                    track.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    })
                } else {
                    go(1)
                }
            }, 3500)
        };
        const stop = () => clearInterval(timer);
        wrap.addEventListener('mouseenter', stop);
        wrap.addEventListener('mouseleave', start);
        wrap.addEventListener('touchstart', stop, {
            passive: true
        });
        wrap.addEventListener('touchend', start, {
            passive: true
        });
        start();
        // readmore
        wrap.querySelectorAll('[data-t2readmore]').forEach(btn => btn.addEventListener('click', () => {
            const c = btn.closest('.t2-card'),
                sh = c.querySelector('[data-short]'),
                fu = c.querySelector('[data-full]'),
                x = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!x));
            if (x) {
                fu.hidden = true;
                sh.hidden = false;
                btn.textContent = 'Read more'
            } else {
                sh.hidden = true;
                fu.hidden = false;
                btn.textContent = 'Show less'
            }
        }));
    })();
</script>
@endif