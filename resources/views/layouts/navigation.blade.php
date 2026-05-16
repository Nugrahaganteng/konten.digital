{{-- resources/views/layouts/navigation.blade.php --}}
{{-- Versi: sesuai style neubrutalism app.blade.php --}}
{{-- Dipakai jika perlu navbar terpisah (misal di layout dashboard user) --}}

<nav id="main-nav">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-purple-950 border-[3px] border-black rounded-xl
                            flex items-center justify-center
                            group-hover:rotate-6 transition-transform">
                    <img src="images/hikeandpeak.png" style="width: 36px; height: 36px; object-fit: contain;" alt="Logo">
                </div>
                <div class="leading-none">
                    <p class="font-black text-base uppercase tracking-tight text-[#1a1a2e]"
                       style="font-family:'Unbounded',sans-serif">HNP Communications</p>
                    <p class="text-[0.6rem] font-bold text-red-500 uppercase tracking-[0.15em]">
                        Your Strategic PR and Digital Partner
                    </p>
                </div>
            </a>

            {{-- Menu Desktop --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"     class="nav-link-pop">Home</a>
                <a href="#about"                  class="nav-link-pop">About Us</a>
                <a href="{{ route('services') }}" class="nav-link-pop">Services</a>
                <a href="#blog"                   class="nav-link-pop">Blog</a>
                <a href="#career"                 class="nav-link-pop">Career</a>
                <a href="#contact"                class="nav-link-pop">Contact</a>
            </div>

            {{-- Kanan: User dropdown + Burger --}}
            <div class="flex items-center gap-3">

                {{-- User Dropdown (jika sudah login) --}}
                @auth
                <div class="relative" id="user-dropdown-wrap">
                    <button id="user-dropdown-btn"
                            class="flex items-center gap-2 border-[3px] border-black rounded-xl
                                   px-3 py-1.5 bg-white font-black text-sm uppercase tracking-wide
                                   shadow-neo-sm hover:translate-y-[2px] hover:shadow-none transition-all">
                        {{ Auth::user()->name }}
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div id="user-dropdown-menu"
                         class="hidden absolute right-0 mt-2 w-48 bg-white border-4 border-black
                                rounded-xl shadow-neo z-50 overflow-hidden">
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-3 font-bold text-sm uppercase tracking-wide
                                  hover:bg-yellow-400 transition-colors">
                            Profile
                        </a>
                        <div class="border-t-2 border-black"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-3 font-bold text-sm uppercase
                                           tracking-wide text-red-500 hover:bg-red-500 hover:text-white
                                           transition-colors">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
                @else
                {{-- Belum login: tombol Login --}}
                <a href="{{ route('login') }}" class="btn-pop">Masuk</a>
                @endauth

                {{-- Burger Mobile --}}
                <button id="burger" class="md:hidden text-black" aria-label="Toggle menu">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="burger-open"  stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 8h16M4 16h16"/>
                        <path id="burger-close" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                              d="M6 18L18 6M6 6l12 12" class="hidden"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu">
        <a href="{{ route('home') }}">Home</a>
        <a href="#about">About Us</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="#portfolio">Portfolio</a>
        <a href="#career">Career</a>
        <a href="#contact">Contact Us</a>
        @auth
        <a href="{{ route('profile.edit') }}">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="font-black text-xl uppercase text-red-600">
                Log Out
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn-pop text-center">Masuk</a>
        @endauth
    </div>
</nav>

<script>
    // Navbar scroll
    const nav = document.getElementById('main-nav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 60);
    });

    // Burger
    const burger     = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen   = document.getElementById('burger-open');
    const iconClose  = document.getElementById('burger-close');
    burger?.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('open');
        iconOpen.classList.toggle('hidden', isOpen);
        iconClose.classList.toggle('hidden', !isOpen);
    });

    // User dropdown
    const dropBtn  = document.getElementById('user-dropdown-btn');
    const dropMenu = document.getElementById('user-dropdown-menu');
    dropBtn?.addEventListener('click', () => dropMenu.classList.toggle('hidden'));
    document.addEventListener('click', (e) => {
        if (!document.getElementById('user-dropdown-wrap')?.contains(e.target)) {
            dropMenu?.classList.add('hidden');
        }
    });
</script>