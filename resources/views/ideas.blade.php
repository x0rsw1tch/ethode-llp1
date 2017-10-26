@extends('layout') @push('scripts')
<script src="/assets/js/ideas.js"></script>
@endpush @section('main')

<main id="ideas-app">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="small-offset-1 small-9 cell no-gutter-right">
				<h1>Active Ideas</h1>
				<p>Total ideas: @{{ ideaCount }}</p>
				<hr>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="small-10 small-offset-1 cell">
				<idea-list :idea-count="ideaCount"></idea-list>
			</div>
		</div>
	</div>
</main>


<script type="text/x-template" id="ideas">
	<div v-if="ideas && ideas.length > 0 && ideaCount > 25">
		<ul class="idea-list no-gutter">
			<idea v-for="idea in ideas" :key="idea.id" :idea="idea"></idea>
		</ul>
		<ideas-pager :idea-count="ideaCount"></ideas-pager>
	</div>
	<h3 v-else>
		No Ideas submitted
		<button type="button" class="button rounded tiny" @click="getData()">Refresh</button>
	</h3>
</script>


<script type="text/x-template" id="idea">
	<li class="grid-x">
		<div class="medium-9 cell align-top">
			<span class="idea" v-if="idea.idea.length < 257">@{{ idea.idea }}</span>
			<span class="idea" v-if="idea.idea.length > 256">@{{ truncatedIdea(idea.idea) }}...</span><br>
			<idea-votes :idea="idea"></idea-votes>
		</div>

		<div class="medium-1 medium-offset-1 cell vote-button-container">
			<idea-vote-button :idea="idea"></idea-vote-button>
		</div>
	</li>
</script>

<script type="text/x-template" id="idea-votes">
	<sub v-if="idea.voters">
		<em v-if="userHasVoted()">Voters (<strong>@{{ votes }}</strong>): @{{ idea.voters }}</em>
		<em v-else>Voters (@{{ votes }}): @{{ idea.voters }}</em>
	</sub>
	<sub v-else><em>Votes: 0</em></sub>
</script>

<script type="text/x-template" id="idea-vote-button">
	<button type="button" @click="sendVote(idea)" v-bind:class="{'vote-btn--inactive': userHasVoted() }" class="button rounded tiny vote-btn">@{{ voteButtonText}}</button>
</script>


<script type="text/x-template" id="ideas-pager">
	<div v-if="ideaCount && ideaCount > 0">
		<ul class="pagination" >
			<li><button class="button small" :disabled="isFirstPage" @click="getIdeas(0)">&lt;&lt; First</button></li>
			<li><button class="button small" :disabled="isFirstPage" @click="prevPage()">&lt; Previous</button></li>
			<li v-for="page in pages" @click="getIdeas(page)"><button class="button small">@{{ (page+1) }}</button></li>
			<li><button class="button small" :disabled="isLastPage" @click="nextPage()">Next &gt;</button></li>
			<li><button class="button small" :disabled="isLastPage" @click="lastPage()">Last &gt;&gt;</button></li>
		</ul>
	</div>
</script>

<style type="text/css">
	ul[class*=no-gutter] {
		margin-left: 0;
	}

	ul.idea-list {
		list-style-type: none;
	}

	a.button.rounded, button.button.rounded {
		border-radius: 5px;
	}

	ul.idea-list > li {
	margin-bottom: 1rem;
	}


	.vote-button-container {
		display: flex;
		justify-content: flex-end;
	}

	.vote-button-container button.vote-btn {
		font-size: 0.9rem;
	}

	@media (max-width: 40em) {
		.vote-button-container {
			justify-content: center;
			align-items: stretch;
		}

		.vote-button-container button {
			width: 100%;
			margin: 0.33rem 0 1.25rem;
		}

	}

	div.grid-padding-x > div.cell.no-gutter-right {
		padding-right: 0;
	}

	button.vote-btn.vote-btn--inactive {
		opacity: 0.7;
	}

</style>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">


{{--@foreach ($ideas as $idea) {{$idea->idea}}
<br> @endforeach--}} @endsection