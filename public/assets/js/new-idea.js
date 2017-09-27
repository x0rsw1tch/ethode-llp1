

var IdeaSubmitApp = new Vue({
    el: '#idea-submit-app',
    data: {
    	idea: null,
    	submitResponse: null
    },
    methods: {
    	submitIdea: function () {	
    		var vm = this;
    		if (vm.idea && vm.idea.length > 0) {
	    		$.ajax({
	    			url: '/ideas',
	    			method: 'POST',
	    			data: $('#form-submit-new-idea').serialize(),
	    			success: function (data) {
	    				if (data.success && data.idea && data.idea.length > 0) {
	    					vm.idea = '';
	    					vm.submitResponse = 'Your idea has been submitted.' + '(' + data.idea + ')';
	    				}
	    			},
	    			error: function (status, xhr, error) {
	    				console.error('Failed '+ error);
	    			}
	    		});
    		} else {
    			vm.submitResponse = 'No idea submitted. Please enter an idea';
    		}
    	}
    }
});
