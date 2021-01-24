@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    <strong class="m-r-1">CATÁLOGO DE JOGOS</strong>
    <span>&#xA9; {{date('Y')}}. By CONTROLE DE PLATINA</span>
@endcomponent
@endslot
@endcomponent
