@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel' || trim($slot) === config('app.name'))
<img src="{{ asset('assets/logo.png') }}" class="logo" alt="Nibras Logo" style="height: 50px; width: auto; object-fit: contain;">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
