<section class="contact-map full-bleed" id="contact-map" style="--map-img: url('{{ asset('img/map-fallback.jpg') }}')">
    <div class="container cm-grid">
        {{-- Col stânga: Hartă --}}
        <div class="cm-map" data-animate>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3100.6524364831776!2d-77.37439092281245!3d39.00042804061643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b6375a29053a3b%3A0x396d02eae27f2241!2sTip%20Top%20Remodeling%20LLC!5e0!3m2!1sro!2sro!4v1762438836327!5m2!1sro!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        {{-- Col dreapta: Formular --}}
        <div class="cm-card" data-animate>
            <header class="cm-head">
                <span class="cm-kicker">Get in touch</span>
                <h2 class="cm-title">Request a Free Estimate</h2>
                <p class="cm-sub">Tell us about your project and we’ll get back with timelines & a clear, itemized quote.</p>
            </header>

            <form class="cm-form" method="POST" action="{{ route('contact.send') }}">
                @csrf
                <div class="cm-row">
                    <div class="cm-field">
                        <label for="name">Full name</label>
                        <input id="name" name="name" type="text" required placeholder="Jane Doe" value="{{ old('name') }}">
                        @error('name')<small class="cm-err">{{ $message }}</small>@enderror
                    </div>
                    <div class="cm-field">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" required placeholder="(555) 123-4567" value="{{ old('phone') }}">
                        @error('phone')<small class="cm-err">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="cm-row">
                    <div class="cm-field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" required placeholder="you@email.com" value="{{ old('email') }}">
                        @error('email')<small class="cm-err">{{ $message }}</small>@enderror
                    </div>
                    <div class="cm-field">
                        <label for="service">Service</label>
                        <select id="service" name="service">
                            <option value="">Select a service</option>
                            <option>Kitchen Remodel</option>
                            <option>Bathroom Remodel</option>
                            <option>Basement Finish</option>
                            <option>Flooring & Tile</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <div class="cm-field">
                    <label for="message">Project details</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Rooms, size, timing, budget ideas…">{{ old('message') }}</textarea>
                    @error('message')<small class="cm-err">{{ $message }}</small>@enderror
                </div>

                {{-- Honeypot anti-spam --}}
                <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-5000px;opacity:0">

                <div class="cm-actions">
                    <button class="btn btn-primary" type="submit">Send Request</button>
                    <a class="btn btn-ghost" href="tel:+15551234567">Call (555) 123-4567</a>
                </div>

                @if(session('status'))
                <div class="cm-status">{{ session('status') }}</div>
                @endif
            </form>
        </div>
    </div>

    <i class="cm-stripe s1"></i>
    <i class="cm-stripe s2"></i>
</section>