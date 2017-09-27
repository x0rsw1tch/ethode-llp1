var IdeasApp = {};


Vue.component('ideas-pager', {
    template: "#ideas-pager",
    props: ['ideaCount'],
    data: function() {
        return {
            currentPage: 0
        }
    },
    methods: {
        getIdeas: function(page) {
            this.currentPage = page;
            this.$parent.getPage(page);
        },
        prevPage: function() {
            this.currentPage = Number(this.currentPage - 1);
            this.$parent.getPage((this.currentPage));
        },
        nextPage: function() {
            this.currentPage = Number(this.currentPage + 1);
            this.$parent.getPage((this.currentPage));
        },
        lastPage: function() {
            this.currentPage = Number(this.pages.length - 1);
            this.$parent.getPage((this.currentPage));
        },
    },
    computed: {
        pages: function() {
            var pageArr = new Array(Number(Math.ceil(this.ideaCount / 25)));
            for (var i = 0; i < pageArr.length; i++) {
                pageArr[i] = i;
            }
            return pageArr;
        },
        isFirstPage: function() {
            return this.currentPage === 0;
        },
        isLastPage: function() {
            return this.currentPage === (this.pages.length - 1);
        }
    }
});


Vue.component('idea-list', {
    template: "#ideas",
    props: ['ideaCount'],
    data: function() {
        return {
            ideas: null
        }
    },
    methods: {
        updateList: function() {
            console.log('its vorking !');
        },
        getPage: function(page) {
            var vm = this;
            $.ajax({
                url: '/api/ideas/get/' + (page * 25),
                success: function(data) {
                    vm.ideas = data;
                }
            });
        },
        getData: function() {
            var vm = this;
            $.ajax({
                url: '/api/ideas/get/0',
                success: function(data) {
                    vm.ideas = data;
                }
            });
        },
		truncatedIdea: function(idea) {
			return idea.substring(0, 256);
		}
	},
    mounted: function() {
        this.getData();
    }
});


IdeasApp.vue = new Vue({
    el: '#ideas-app',
    data: {
        //ideas: null,
        ideaCount: 0
    },
    methods: {
        getIdeaCount: function() {
            var vm = this;
            $.ajax({
                url: '/api/ideas/count',
                success: function(data) {
                    if (Object.prototype.toString.call(data) === '[object Array]' && data.length === 1) {
                        vm.ideaCount = data[0];
                    }
                }
            });
        },
        getIdeasByOffset: function(offset) {
            console.log('ROOT: getIdeasByOffset()');
        },
        updateList: function() {
            console.log('its vorking !');
        }
    },
    created: function() {
        this.getIdeaCount();
    },
});