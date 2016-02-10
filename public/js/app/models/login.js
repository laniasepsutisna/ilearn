define([
	'underscore',
	'backbone'
], function(_, Backbone){
	var ProjectModel = Backbone.Model.extend({
		defaults: {
			'success' : '',
			'msg' : '',
			'user' : ''
		}

		urlRoot: 'http://ilearn.app/auth/login'
	});

	return ProjectModel;
});