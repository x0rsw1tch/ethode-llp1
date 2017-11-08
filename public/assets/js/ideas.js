var IdeasApp = {};

IdeasApp.vueMixins = {
    methods: {
        userHasVoted: function () {
            if (this.idea.voters && this.idea.voters.indexOf(localStorage.username.toLowerCase()) > -1) {
                return true;
            } else {
                return false;
            }
        }
    }
}

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
    props: ['ideaCount', 'filters'],
    data: function() {
        return {
            ideas: null
        }
    },
    methods: {
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
        }
	},
    mounted: function() {
        this.getData();
    }
});

Vue.component('idea', {
    template: "#idea",
    props: ['idea', 'filters'],
    methods: {
		truncatedIdea: function(idea) {
			return idea.substring(0, 256);
        },
        presented: function (idea, status) {
            var vm = this;
            var voteData = {
                "_token": document.getElementById('_token').value,
                "id": idea.id,
                "presented": status
            };
            if (username) {
                $.ajax({
                    url: '/api/ideas/presented',
                    method: 'POST',
                    data: jQuery.param(voteData),
                    success: function (data) {
                        if (data) {
                            var ideaList = vm.$parent.ideas;
                            for (i = 0; i < ideaList.length; i++) {
                                if (ideaList[i].id == data.id) {
                                    vm.$set(vm.$parent.ideas, i, data);
                                    //vm.$parent.$parent.getData();
                                }
                            }
                        } else {
                            alert ('There was an error. Check console');
                            console.log(data);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert ('There was an error. Check console');
                        console.log(xhr, stats, error);
                    }
                });
            }
        }
    }
});


Vue.component('idea-votes', {
    template: "#idea-votes",
    props: ['idea'],
    mixins: [IdeasApp.vueMixins],
    computed: {
        votes: function() {
            if (this.idea.voters && this.idea.voters.length > 0) {
                return this.idea.voters.split(',').length;
            } else {
                return 0;
            }
        }
    }
});


Vue.component('idea-vote-button', {
    template: '#idea-vote-button',
    props: ['idea'],
    mixins: [IdeasApp.vueMixins],
    methods: {
        sendVote: function (idea) {
            var vm = this;
            var voteData = {
                "_token": document.getElementById('_token').value,
                "id": idea.id,
                "voter": localStorage.username.toLowerCase()
            };
            if (username) {
                $.ajax({
                    url: '/api/ideas/vote',
                    method: 'POST',
                    data: jQuery.param(voteData),
                    success: function (data) {
                        if (data) {
                            // Locate proper index to update
                            var ideaList = vm.$parent.$parent.ideas;
                            for (i = 0; i < ideaList.length; i++) {
                                if (ideaList[i].id == data.id) {
                                    vm.$set(vm.$parent.$parent.ideas, i, data);
                                    //vm.$parent.$parent.getData();
                                }
                            }
                        } else {
                            alert ('There was an error. Check console');
                            console.log(xhr, stats, error);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert ('There was an error. Check console');
                        console.log(xhr, stats, error);
                    }
                });
            }
        },
    },
    computed: {
        voteButtonText: function () {
            if (this.idea.voters && this.idea.voters.indexOf(localStorage.username.toLowerCase()) > -1) {
                return 'Unvote';
            } else {
                return 'Vote';
            }
        }
    }
});



IdeasApp.vue = new Vue({
    el: '#ideas-app',
    data: {
        ideaCount: 0,
        ideasFilters: {
            showPresented: true,
            showUnpresented: true
        }
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
        }
    },
    created: function() {
        this.getIdeaCount();
    },
});