@extends('layout')


@section('main')

<div id="home-app">
	<div class="grid-container push-down-percent-5">
		<div class="grid-x grid-padding-x centered-cells">
			<div class="cell small-9 centered-flex">
				<h1>What do you want to do, @{{username}}</h1>
			</div>
		</div>
	</div>

	<div class="grid-container margin-bottom-md push-down-percent-5">
		<div class="grid-x grid-padding-x centered-cells">
			<div class="cell small-6 centered-flex">
				<a class="button primary jumbo" href="/ideas">View and Vote on Ideas</a>
			</div>
		</div>
	</div>

	<div class="grid-container margin-bottom-md">
		<div class="grid-x grid-padding-x centered-cells">
			<div class="cell small-6 centered-flex">
				<a class="button primary jumbo" href="/new-idea">Submit an Idea</a>
			</div>
		</div>
	</div>

	<div class="grid-container margin-bottom-md">
		<div class="grid-x grid-padding-x centered-cells">
			<div class="cell small-6 centered-flex">
				<a class="button primary jumbo" href="/status">Check Status</a>
			</div>
		</div>
	</div>
</div>

<script>
var HomeApp = {};

document.addEventListener("DOMContentLoaded", function () {
	HomeApp.vue = new Vue({
		el: "#home-app",
		data: {
			'username': username
		}
	});
});
</script>

@endsection


