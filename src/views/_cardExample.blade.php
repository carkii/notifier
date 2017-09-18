<div class="card">
	<img src="{{asset('/images/exampleImage.jpg')}}" alt="#">
	<div class="card-block">
		<p class="card-text">Notification body text goes here.</p>
		{!! $acknowledgedButton !!}
		<button class="btn btn-default acknowledge-notification" >Ignore!</button>    
	</div>
</div>