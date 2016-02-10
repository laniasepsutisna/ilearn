define([
  'jquery',
  'underscore',
  'backbone',
  'views/projects/list',
  'views/users/list'
], function($, _, Backbone){
  var AppRouter = Backbone.Router.extend({
    
    }
  });

  var initialize = function(){
    
    Backbone.history.start();
  };
  return {
    initialize: initialize
  };
});