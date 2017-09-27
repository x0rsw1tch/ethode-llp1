@extends('layout') @push('scripts')
<script src="/assets/js/ideas.js"></script>
@endpush @section('main')

<main id="ideas-app">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="medium-6 large-4 cell">
				<h1>Active Ideas</h1>
				<p>Total ideas: @{{ ideaCount }}</p>
			</div>
		</div>
	</div>	

	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell">
				<idea-list :idea-count="ideaCount"></idea-list>
			</div>
		</div>
	</div>	
</main>


<script type="text/x-template" id="ideas">
	<div v-if="ideas && ideas.length > 0 && ideaCount > 25">
		<ul class="idea-list no-gutter" >
			<li v-for="idea in ideas" class="grid-x">
				<div class="medium-8 cell">
					<span class="idea" v-if="idea.idea.length < 257">@{{ idea.idea }}</span>
					<span class="idea" v-if="idea.idea.length > 256">@{{ truncatedIdea(idea.idea) }}...</span>
				</div>
				
				<div class="medium-2 cell">
					<button type="button" @click="sendVote(idea.id)" class="button rounded tiny vote-btn vote-btn--active">Vote</button>
				</div>
			</li>
		</ul>
		<ideas-pager :idea-count="ideaCount"></ideas-pager>
	</div>
	<h3 v-else>
		No Ideas submitted
		<button type="button" class="button rounded tiny" @click="getData()">Refresh</button>
	</h3>
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

	ul.idea-list li {
		align-items: baseline;
	}

	a.button.rounded, button.button.rounded {
		border-radius: 5px;
	}
</style>



{{--@foreach ($ideas as $idea) {{$idea->idea}}
<br> @endforeach--}} @endsection