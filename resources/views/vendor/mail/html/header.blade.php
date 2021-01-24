<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <a href="http://controledeplatina.com.br"><img src="http://controledeplatina.com.br/img/logo5.png" class="logo" alt="Controle de Platina"></a>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
