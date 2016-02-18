define([
    'jquery',
    'underscore',
    'backbone',
], function($, _, Backbone){
    var AppRouter = Backbone.Router.extend({
        routes: function() {
            '' : 
        }
    });

  var initialize = function(){

    Backbone.history.start();
  };
  return {
    initialize: initialize
  };
});