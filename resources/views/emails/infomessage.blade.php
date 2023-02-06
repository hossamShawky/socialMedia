@component('mail::message')

    <h3>{{$username}}</h3>
  
 	 {{ $profcreat}}
 	   {{$notscount}}

@component('mail::button', ['url' => 'https://google.com'])
Visit Us
@endcomponent

Thanks,<hr>
<!-- {{ config('app.name') }} -->
@endcomponent
 

 