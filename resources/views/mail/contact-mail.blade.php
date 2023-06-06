<x-mail::message>
# Introduction

{{ $data['message'] }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
<br>
{{ $data['time']; }}
</x-mail::message>
