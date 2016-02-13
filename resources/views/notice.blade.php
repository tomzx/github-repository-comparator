<div class="alert alert-{{ $type !== 'error' ? $type : 'danger' }}">
	@if ( is_array($message) )
		<ul>
			@foreach ($message as $line)
				<li>{!! $line !!}</li>
			@endforeach
		</ul>
	@else
		{!! $message !!}
	@endif
</div>
