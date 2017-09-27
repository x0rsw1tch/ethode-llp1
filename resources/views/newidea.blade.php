@extends('layout')

@push('scripts')
<script src="/assets/js/new-idea.js"></script>
@endpush

@section('main')

<div id="idea-submit-app">

	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="small-10 cell">
				<!-- Left Column -->
				<h1>New Idea</h1>
			</div>
		</div>
				
		<form method="POST" action="/ideas" id="form-submit-new-idea">
			{{ csrf_field() }}
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="small-10 cell">
						<label for="idea">Please enter an idea.
							<input class="middle-label" type="text" id="idea" name="idea" v-model="idea" placeholder="Idea">
						</label>
					</div>
				</div>
			</div>
			
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="small-3 cell">
						<input class="middle-label button primary" type="submit" id="submit" name="submit" value="Submit Idea" @click.prevent="submitIdea()">
					</div>
				</div>
			</div>
		</form>


		<p>@{{ submitResponse }}</p>


		<div class="grid-x grid-margin-x">
			<div class="small-10 cell">
				<h2></h2>
			</div>
		</div>

	</div>

</div>


@endsection