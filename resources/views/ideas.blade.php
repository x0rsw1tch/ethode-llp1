@extends('layout') @push('scripts')
<script src="/assets/js/ideas.js"></script>
@endpush @section('main')

<main id="ideas-app">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="small-offset-1 small-6 cell no-gutter-right">
				<h1>Active Ideas</h1>
				<p>Total ideas: @{{ ideaCount }}</p>
				<hr>
			</div>
			<div class="small-offset-1 small-4 cell no-gutter-right">
				<h4>Options</h4>
				<ul class="options-list">
					<li>
						<div class="switch tiny">
							<input class="switch-input" id="presentedFilter" type="checkbox" v-model="ideasFilters.showPresented" name="presentedFilter">
							<label class="switch-paddle" for="presentedFilter">
								<span class="show-for-sr">Show Presented?</span>
								<span class="switch-active" aria-hidden="true">Show Presented</span>
								<span class="switch-inactive" aria-hidden="true">Hide Presented</span>
							</label>
						</div>
					</li>
					<li>
						<div class="switch tiny">
							<input class="switch-input" id="unpresentedFilter" type="checkbox" v-model="ideasFilters.showUnpresented" name="unpresentedFilter">
							<label class="switch-paddle" for="unpresentedFilter">
								<span class="show-for-sr">Show Unpresented?</span>
								<span class="switch-active" aria-hidden="true">Show Unpresented</span>
								<span class="switch-inactive" aria-hidden="true">Hide Unpresented</span>
							</label>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="small-10 small-offset-1 cell">
				<idea-list :idea-count="ideaCount" :filters="ideasFilters"></idea-list>
			</div>
		</div>
	</div>
</main>


<script type="text/x-template" id="ideas">
	<div v-if="ideas && ideas.length > 0 && ideaCount > 25">
		<ul class="idea-list no-gutter">
			<idea v-for="idea in ideas" :key="idea.id" :filters="filters" :idea="idea"></idea>
		</ul>
		<ideas-pager :idea-count="ideaCount" :filters="filters"></ideas-pager>
	</div>
	<h3 v-else>
		No Ideas submitted
		<button type="button" class="button rounded tiny" @click="getData()">Refresh</button>
	</h3>
</script>


<script type="text/x-template" id="idea">
	<li v-show="idea.presented == 0 && filters.showUnpresented || idea.presented == 1 && filters.showPresented" class="grid-x">
		<div class="medium-9 cell align-top">
			<span class="idea" v-if="idea.idea.length < 257" v-bind:class="{'idea-presented': idea.presented == 1 }">@{{ idea.idea }}</span>
			<span class="idea" v-if="idea.idea.length > 256" v-bind:class="{'idea-presented': idea.presented == 1 }">@{{ truncatedIdea(idea.idea) }}...</span>
			<br>
			<sub v-if="idea.presented == 1" v-bind:class="{'idea-presented': idea.presented == 1 }">
				<button type="button" @click="presented(idea, 0)" class="button rounded tiny extra-tiny presented presented-unmark-btn">Mark Unpresented</button>
				This idea has been presented. &nbsp;
			</sub>
			<sub v-if="idea.presented == 0">
				<button type="button" @click="presented(idea, 1)" class="button rounded tiny extra-tiny unpresented presented-mark-btn">Mark Presented</button>
			</sub>
			<idea-votes :idea="idea"></idea-votes>
		</div>

		<div class="medium-1 medium-offset-1 cell vote-button-container">

			<idea-vote-button :idea="idea"></idea-vote-button>
		</div>
	</li>
</script>

<script type="text/x-template" id="idea-votes">
	<sub v-if="idea.voters" v-bind:class="{'idea-presented': idea.presented == 1 }">
		<em v-if="userHasVoted()">Voters (
			<strong>@{{ votes }}</strong>): @{{ idea.voters }}</em>
		<em v-else>Voters (@{{ votes }}): @{{ idea.voters }}</em>
	</sub>
	<sub v-else  v-bind:class="{'idea-presented': idea.presented == 1 }">
		<em>Votes: 0</em>
	</sub>
</script>

<script type="text/x-template" id="idea-vote-button">

	<button v-if="idea.presented == 0" type="button" @click="sendVote(idea)" v-bind:class="{'vote-btn--inactive': userHasVoted() }" class="button rounded tiny vote-btn">@{{ voteButtonText}}</button>
	<button v-else type="button" class="button rounded tiny disabled">Presented</button>
</script>


<script type="text/x-template" id="ideas-pager">
	<div v-if="ideaCount && ideaCount > 0">
		<ul class="pagination">
			<li>
				<button class="button small" :disabled="isFirstPage" @click="getIdeas(0)">&lt;&lt; First</button>
			</li>
			<li>
				<button class="button small" :disabled="isFirstPage" @click="prevPage()">&lt; Previous</button>
			</li>
			<li v-for="page in pages" @click="getIdeas(page)">
				<button class="button small">@{{ (page+1) }}</button>
			</li>
			<li>
				<button class="button small" :disabled="isLastPage" @click="nextPage()">Next &gt;</button>
			</li>
			<li>
				<button class="button small" :disabled="isLastPage" @click="lastPage()">Last &gt;&gt;</button>
			</li>
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

	a.button.rounded,
	button.button.rounded {
		border-radius: 5px;
	}

	ul.idea-list>li {
		margin-bottom: 1rem;
	}

	ul.idea-list .idea-presented {
		opacity: 0.7;
	}

	button.tiny.extra-tiny {
		padding: 0.33em 1em;
		margin: 0;
		font-size: 0.7rem;
	}

	.vote-button-container {
		display: flex;
		justify-content: flex-end;
	}

	.vote-button-container button.vote-btn, .vote-button-container button.disabled {
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

	div.grid-padding-x>div.cell.no-gutter-right {
		padding-right: 0;
	}

	button.vote-btn.vote-btn--inactive {
		opacity: 0.7;
	}
</style>
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> {{--@foreach ($ideas as $idea) {{$idea->idea}}
<br> @endforeach--}} @endsection