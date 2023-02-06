

  @component('mail::message')

  <h3>{{"Hello : ". $user->name}} &#128151;</h3>
  <br>
  <e>This is a review about your account. </e>
  <hr>

  <b> Your Email :  {{ $user->email}}</b>  <hr>
  <b>{{"Your Name : " . $user->name}}</b>	<hr>
  <b>{{"Your Account Creation : " . $user->created_at->diffForHumans()}}</b> <hr>
  <b>{{"You Have : " . count($user->posts) . " Posts & ".
	   count($user->comments) ." Comments  & ".
	   count($user->replies)."  Replies & ". 
	   count($user->loves)." Loves"}}</b>

  <center><i>{{"Enjoy With US."}}&#128515;</i></center>
   
  
  @component('mail::button', ['url' => 'https://web.facebook.com/hossam.shawky.39'])
  Contact With Author &#128516;
  @endcomponent 
 
 
  @endcomponent
   
  
   