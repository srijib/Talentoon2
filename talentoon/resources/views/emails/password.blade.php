<!-- Click here to reset your password: {{ url('/password/mina/'.$token) }}

Click here to reset your password: <a href="{{ $link = url('password/minaaaaaa', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a> -->

<!-- {{ trans('backpack::base.click_here_to_reset') }}: <a href="{{ $link = url(config('backpack.base.route_prefix', 'admin').'/password/anasa7', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a> -->


	<h2>Password Reset</h2>

	<div>
		To reset your password, complete this form: {{ url('password/BASSANNNTTT',
		[$token]) }}.<br /> This link will expire in {{
		config('auth.reminder.expire', 60) }} minutes.
	</div>
