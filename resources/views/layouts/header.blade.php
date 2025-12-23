<header>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @php
        $locale = app()->getLocale();
        $localePrefix = $locale ? '/'.$locale : '';
    @endphp

    <a href="{{ url($localePrefix . '/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>

    {{-- expose available locales and current locale to client-side scripts and include footer language script --}}
    <script>
        window.__available_locales = @json(config('app.available_locales'));
        window.__current_locale = '{{ app()->getLocale() }}';
        window.__labels = {
            choose_language: {!! json_encode(__('Choose language')) !!},
            language: {!! json_encode(__('Language')) !!},
            use_english: {!! json_encode(__('Use English')) !!},
            add_to_collection: {!! json_encode(__('Add to MyCollection')) !!},
            remove_from_collection: {!! json_encode(__('Remove from MyCollection')) !!},
            added: {!! json_encode(__('Added')) !!},
            my_account: {!! json_encode(__('MyAccount')) !!},
            name: {!! json_encode(__('Name')) !!},
            email: {!! json_encode(__('Email')) !!},
            role_label: {!! json_encode(__('Role')) !!},
            registered: {!! json_encode(__('Registered')) !!},
            edit_account: {!! json_encode(__('Edit Account')) !!},
            your_stats: {!! json_encode(__('Your Stats')) !!},
            games_in_collection: {!! json_encode(__('Games in collection')) !!},
            go_to_my_collection: {!! json_encode(__('Go to My Collection')) !!},
            user: {!! json_encode(__('User')) !!}
        };
    </script>
    <script src="{{ asset('js/language-footer.js') }}"></script>
    <script src="{{ asset('js/localize-anchors.js') }}"></script>
    <a href="{{ url($localePrefix . '/library') }}"><h1>{{ __('MyGamebrowser') }}</h1></a>
    <a href="{{ url($localePrefix . '/newsletter') }}"><h1>{{ __('MyNewsletter') }}</h1></a>
    <a href="{{ url($localePrefix . '/collection') }}"><h1>{{ __('MyCollection') }}</h1></a>
    @if(auth()->check())
        <a href="{{ route('myaccount', ['locale' => $locale]) }}"><button class="MyAccount-button">{{ __('MyAccount') }}</button></a>
    @endif
    @if(auth()->check() || session('role') === 'admin')
        @if(session('role') === 'admin')
            <span class="adminMessage">
                {{ __('Logged in as Admin') }}
            </span>
        @endif
        
        <form method="POST" action="{{ route('logout', ['locale' => $locale]) }}" style="display:inline;">
            @csrf
            <button type="submit" class="MyAccount-button">{{ __('Logout') }}</button>
        </form>
    @else
        <a href="{{ route('register', ['locale' => $locale]) }}"><button class="MyAccount-button">{{ __('Register') }}</button></a>
        <a href="{{ route('login', ['locale' => $locale, 'redirect' => url()->current()]) }}"><button class="MyAccount-button">{{ __('Login') }}</button></a>
    @endif

    {{-- Header language chooser (far right) --}}
    <div style="display:inline-block;margin-left:12px;vertical-align:middle;">
        <label for="header-locale-select" class="sr-only">{{ __('Language') }}</label>
        <select id="header-locale-select" aria-label="{{ __('Choose language') }}">
            @foreach(config('app.available_locales') as $code => $name)
                <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <script>
        (function(){
            var select = document.getElementById('header-locale-select');
            if(!select) return;
            select.addEventListener('change', function(e){
                var locale = e.target.value || 'en';
                document.cookie = 'locale=' + encodeURIComponent(locale) + ';path=/;max-age=' + (60*60*24*365);
                try{ localStorage.setItem('languageChosen','1'); } catch(e){}

                // Build localized path (remove existing locale prefix if present)
                var codes = Object.keys(window.__available_locales || {});
                var parts = window.location.pathname.split('/').filter(Boolean);
                if(parts.length && codes.indexOf(parts[0]) !== -1){ parts.shift(); }
                parts.unshift(locale);
                var newPath = '/' + parts.join('/');
                window.location.href = newPath + (window.location.search||'') + (window.location.hash||'');
            });
        })();
    </script>
</header>