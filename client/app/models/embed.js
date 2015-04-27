import DS from 'ember-data';

var belongsTo = DS.belongsTo;

var embed = DS.Model.extend({
  type: DS.attr('string'),
  post: belongsTo('post', {aysnc: true}),
  createdAt: Date(),
  image: DS.attr('string')
});

embed.reopenClass({
  FIXTURES: [
    {
      id: "embed-aaa",
      post: "post-aaa",
      type: "image",
      createdAt: new Date(),
      image: "images/flcl_avatar.jpg"
    },
    {
      id: "embed-bbb",
      post: "comment-aaa",
      type: "image",
      createdAt: new Date(),
      image: "images/1361137274.86376956.jpg"
    },
    {
      id: "embed-ccc",
      post: "comment-bbb",
      type: "image",
      createdAt: new Date(),
      image: "images/flcl_avatar.jpg"
    },
    {
      id: "embed-ddd",
      post: "comment-aaa",
      type: "image",
      createdAt: new Date(),
      image: "images/1361137274.86376956.jpg"
    },
    {
      id: "embed-eee",
      post: "comment-bbb",
      type: "image",
      createdAt: new Date(),
      image: "images/flcl_avatar.jpg"
    },
    {
      id: "embed-fff",
      post: "comment-bbb",
      type: "image",
      createdAt: new Date(),
      image: "images/flcl_avatar.jpg"
    }
  ]
});

export default embed;
