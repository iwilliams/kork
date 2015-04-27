import DS from 'ember-data';

var post = DS.Model.extend({
  createdAt: DS.attr('date'),
  embed: DS.belongsTo('embed', {async: true})
});

export default post;
