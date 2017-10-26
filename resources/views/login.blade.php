@extends('layout')	
@push('scripts')
<script src="/assets/js/login.js"></script>
@endpush @section('main')


@section('main')


	<div class="grid-container push-down-percent-15">
		<div class="grid-x grid-padding-x centered-cells">
			<div class="cell small-4">

				<div class="card-basic">
					<div class="card-basic-content card-section centered-text">
						<h4>Please Login</h4>
					</div>
					<div class="card-basic-content card-section">
						<p class="card-basic-body">What is your name?</p>
						<input type="text" class="big username" name="username" id="username">
						<a id="username-input-message" class="hide"></a>
					</div>
					<div class="card-section">
						<button class="button card-basic-button primary login-btn" onclick="loginUser()">Login</button>
					</div>
				</div>

			</div>
		</div>
	</div>



@endsection