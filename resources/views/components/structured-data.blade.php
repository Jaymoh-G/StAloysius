@props(['type' => 'organization', 'data' => []]) @php $seoService =
app(\App\Services\SeoService::class); $structuredData =
$seoService->generateStructuredData($type, $data); @endphp @if($structuredData)
<script type="application/ld+json">
    {!! json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
@endif
