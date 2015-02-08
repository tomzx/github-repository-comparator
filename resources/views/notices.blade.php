@foreach (['success', 'info', 'warning', 'danger', 'error'] as $type)
	<?php $notice_message = isset($notices) ? array_get($notices, $type) : Session::get('notice_' . $type); ?>
	@if ($notice_message)
		@include('notice', [
			'type' => $type,
			'message' => $notice_message,
		])
	@endif
@endforeach
