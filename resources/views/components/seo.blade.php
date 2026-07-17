{{-- ============================================================
     resources/views/components/seo.blade.php
     Komponen SEO reusable — dipanggil dari layouts/app.blade.php
     ============================================================ --}}
@props([
    'title'       => 'HNP Communications',
    'description' => 'HNP Communications — Jasa PR, Press Release, Backlink, dan Digital Marketing terpercaya di Indonesia. Tingkatkan eksposur brand Anda bersama kami.',
    'keywords'    => 'jasa PR, press release, backlink, digital marketing, buzzer Indonesia, HNP Communications',
    'image'       => null,
    'type'        => 'website',
    'noindex'     => false,
    'breadcrumbs' => null,
    'faqs'        => null,
])

@php
    $siteName  = 'HNP Communications';
    $siteUrl   = rtrim(config('app.url'), '/');
    $fullTitle = ($title && $title !== $siteName)
                    ? $title . ' — ' . $siteName
                    : $siteName . ' | Jasa PR & Digital Marketing Indonesia';
    $ogImage   = $image ?? asset('images/hikeandpeak.png');
    $canonical = url()->current();

    $jsonLd = json_encode([
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type' => 'Organization',
                '@id'   => $siteUrl . '/#organization',
                'name'  => $siteName,
                'url'   => $siteUrl,
                'logo'  => [
                    '@type'  => 'ImageObject',
                    'url'    => asset('images/hikeandpeak.png'),
                    'width'  => 200,
                    'height' => 200,
                ],
                'contactPoint' => [
                    '@type'             => 'ContactPoint',
                    'telephone'         => '+62-838-7132-5422',
                    'contactType'       => 'customer service',
                    'availableLanguage' => 'Indonesian',
                ],
                'sameAs' => ['https://wa.me/6283871325422'],
            ],
            [
                '@type'       => 'WebSite',
                '@id'         => $siteUrl . '/#website',
                'url'         => $siteUrl,
                'name'        => $siteName,
                'description' => $description,
                'publisher'   => ['@id' => $siteUrl . '/#organization'],
                'inLanguage'  => 'id-ID',
                'potentialAction' => [
                    '@type'  => 'SearchAction',
                    'target' => [
                        '@type'       => 'EntryPoint',
                        'urlTemplate' => $siteUrl . '/artikel?search={search_term_string}',
                    ],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@type'       => 'WebPage',
                '@id'         => $canonical . '/#webpage',
                'url'         => $canonical,
                'name'        => $fullTitle,
                'description' => $description,
                'image'       => $ogImage,
                'isPartOf'    => ['@id' => $siteUrl . '/#website'],
                'about'       => ['@id' => $siteUrl . '/#organization'],
                'inLanguage'  => 'id-ID',
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
@endphp

{{-- PRIMARY META --}}
<title>{{ $fullTitle }}</title>
<meta name="description"   content="{{ $description }}">
<meta name="keywords"      content="{{ $keywords }}">
<meta name="author"        content="{{ $siteName }}">
<meta name="robots"        content="{{ $noindex ? 'noindex, nofollow' : 'index, follow' }}">
<meta name="theme-color"   content="#facc15">
<meta name="geo.region"    content="ID">
<meta name="geo.placename" content="Indonesia">
<meta name="language"      content="Indonesian">

{{-- FAVICONS — All platforms --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="16x16"   href="{{ asset('favicons/favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32"   href="{{ asset('favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96"   href="{{ asset('favicons/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-chrome-192x192.png') }}">
<link rel="apple-touch-icon" sizes="180x180"       href="{{ asset('favicons/apple-touch-icon.png') }}">
<link rel="manifest"                                href="{{ asset('site.webmanifest') }}">
<meta name="msapplication-TileColor"  content="#2d0a4e">
<meta name="msapplication-TileImage"  content="{{ asset('favicons/mstile-150x150.png') }}">
<meta name="msapplication-config"     content="{{ asset('browserconfig.xml') }}">
<meta name="apple-mobile-web-app-title"   content="{{ $siteName }}">
<meta name="application-name"             content="{{ $siteName }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<link rel="canonical"      href="{{ $canonical }}">

{{-- OPEN GRAPH --}}
<meta property="og:type"         content="{{ $type }}">
<meta property="og:title"        content="{{ $fullTitle }}">
<meta property="og:description"  content="{{ $description }}">
<meta property="og:url"          content="{{ $canonical }}">
<meta property="og:image"        content="{{ $ogImage }}">
<meta property="og:image:alt"    content="{{ $fullTitle }}">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name"    content="{{ $siteName }}">
<meta property="og:locale"       content="id_ID">

{{-- TWITTER CARD --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image"       content="{{ $ogImage }}">

{{-- SCHEMA.ORG JSON-LD --}}
<script type="application/ld+json">{!! $jsonLd !!}</script>

{{-- BREADCRUMB JSON-LD (auto-generated from URL path) --}}
@php
    $breadcrumbItems = [];
    if ($breadcrumbs) {
        $breadcrumbItems = $breadcrumbs;
    } else {
        // Auto-generate breadcrumbs from URL segments
        $segments = array_filter(explode('/', trim(parse_url($canonical, PHP_URL_PATH), '/')));
        $breadcrumbItems[] = ['name' => 'Home', 'url' => $siteUrl];
        $buildUrl = $siteUrl;
        $segmentLabels = [
            'layanan' => 'Layanan',
            'artikel' => 'Blog',
            'about' => 'Tentang Kami',
            'kontak' => 'Hubungi Kami',
            'cara-order' => 'Cara Order',
            'syarat-ketentuan' => 'Syarat & Ketentuan',
            'press-release' => 'Press Release',
            'backlink' => 'Backlink',
            'press-conference' => 'Press Conference',
            'penulisan-artikel' => 'Penulisan Artikel',
            'buzzer' => 'Buzzer',
            'pelatihan-konten' => 'Pelatihan Konten',
        ];
        foreach ($segments as $segment) {
            $buildUrl .= '/' . $segment;
            $breadcrumbItems[] = [
                'name' => $segmentLabels[$segment] ?? ucwords(str_replace('-', ' ', $segment)),
                'url'  => $buildUrl,
            ];
        }
    }

    if (count($breadcrumbItems) > 1) {
        $bcList = [];
        foreach ($breadcrumbItems as $i => $bc) {
            $bcList[] = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $bc['name'],
                'item'     => $bc['url'],
            ];
        }
        $breadcrumbJsonLd = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $bcList,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
@endphp
@if(isset($breadcrumbJsonLd))
<script type="application/ld+json">{!! $breadcrumbJsonLd !!}</script>
@endif

{{-- FAQ PAGE JSON-LD (rendered when $faqs is passed) --}}
@if($faqs && count($faqs) > 0)
@php
    $faqEntries = [];
    foreach ($faqs as $faq) {
        $q = is_object($faq) ? $faq->question : ($faq['question'] ?? $faq['q'] ?? '');
        $a = is_object($faq) ? $faq->answer   : ($faq['answer']   ?? $faq['a'] ?? '');
        if ($q && $a) {
            $faqEntries[] = [
                '@type'          => 'Question',
                'name'           => $q,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => strip_tags($a),
                ],
            ];
        }
    }
    $faqJsonLd = json_encode([
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faqEntries,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp
<script type="application/ld+json">{!! $faqJsonLd !!}</script>
@endif