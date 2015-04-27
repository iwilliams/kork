import DS from 'ember-data';

import Post from './post.js';

var postComment = Post.extend({
  rootPost: DS.belongsTo('postRoot'),
  embed: DS.belongsTo('embed', {async: true}),
  content: DS.attr('string')
});

postComment.reopenClass({
  FIXTURES: [
    {
      id: "comment-aaa",
      rootPost: "post-aaa",
      embed: "embed-bbb",
      content: "This is a commment on post 2",
      createdAt: new Date()
    },
    {
      id: "comment-bbb",
      rootPost: "post-aaa",
      embed: "embed-ccc",
      content: "This is a comment on post 1",
      createdAt: new Date()
    },
    {
      id: "comment-ccc",
      rootPost: "post-bbb",
      embed: "embed-ddd",
      content: "This is a comment on post 2",
      createdAt: new Date()
    },
    {
      id: "comment-ddd",
      rootPost: "post-bbb",
      embed: "embed-eee",
      content: "This is a comment on Post 2 also",
      createdAt: new Date()
    }
  ]
});
export default postComment;
