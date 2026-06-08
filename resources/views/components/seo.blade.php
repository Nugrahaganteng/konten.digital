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