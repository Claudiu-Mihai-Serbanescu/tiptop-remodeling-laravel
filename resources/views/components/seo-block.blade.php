<section class="seo-block is-light full-bleed" id="seo">
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

        {{-- Before / After gallery cu drag pe imagine --}}
        <div class="ba-grid">
            {{-- Kitchen --}}
            <figure class="ba-card" data-animate>
                <figcaption>
                    <strong>Kitchen Remodel</strong>
                    <span>Storage optimization • Lighting • Surfaces</span>
                </figcaption>

                <div class="ba-wrap" data-ba>
                    <img class="ba-before"
                        src="{{ asset('img/12.jpg') }}"
                        alt="Kitchen - before">
                    <img class="ba-after"
                        src="{{ asset('img/13.jpg') }}"
                        alt="Kitchen - after">
                    <div class="ba-handle" aria-hidden="true"><span class="ba-knob"></span></div>
                    <input class="ba-range" type="range" min="0" max="100" value="50"
                        aria-label="Compare before and after">
                </div>
            </figure>

            {{-- Bathroom (exemplu dacă ai alte fișiere) --}}
            <figure class="ba-card" data-animate>
                <figcaption>
                    <strong>Bathroom Upgrade</strong>
                    <span>Tilework • Fixtures • Spa ambience</span>
                </figcaption>

                <div class="ba-wrap" data-ba>
                    <img class="ba-before" src="{{ asset('img/14.jpg') }}" alt="Bathroom - before">
                    <img class="ba-after" src="{{ asset('img/15.jpg')  }}" alt="Bathroom - after">
                    <div class="ba-handle" aria-hidden="true"><span class="ba-knob"></span></div>
                    <input class="ba-range" type="range" min="0" max="100" value="55"
                        aria-label="Compare before and after">
                </div>
            </figure>
        </div>


        <p class="seo-closing">
            We’re known for <strong>innovative solutions</strong> and <strong>concierge-level service</strong>. From first consultation to final reveal,
            you’ll feel the <strong>Tip Top difference</strong> — where <em>your satisfaction</em> is our masterpiece.
        </p>
    </div>
</section>