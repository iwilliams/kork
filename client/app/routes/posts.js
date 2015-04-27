import Ember from 'ember';

export default Ember.Route.extend({
  model: function(){
    return this.store.find('postRoot');
  }
  //afterModel: function(model, transition) {
    //console.log(model)
    //return Ember.RSVP.hash({
      //"comments": model.getEach('comments'),
      //"embed": model.getEach('embed')
    //});
  //}
});
