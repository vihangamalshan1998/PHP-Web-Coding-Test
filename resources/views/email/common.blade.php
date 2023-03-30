@component('mail::message')
<style>
    div { color: black;
    align-content: center;
background: #D3D3D3;
margin-left:20px }
</style>
<center>
<img  src="https://www.creativefabrica.com/wp-content/uploads/2020/08/27/Monogram-JR-Logo-V2-Graphics-5156861-1-1-580x386.jpg" alt="Logo" alt="Company logo" style="width: 60px; height:60px;vertical-align: text-bottom">
<h1 style="text-align: center;justify-content: center">{{ config('app.name') }}</h1>
</center>
<hr>

<div>
    <br>
<p style="font-size:16px;text-align: center;">{{$body}}</p>

@component('mail::button', ['url' => $url])
View Now
@endcomponent
<br>
</div>
{{-- Thanks,<br> --}}
@endcomponent
