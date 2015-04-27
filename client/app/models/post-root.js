import DS from 'ember-data';

import Post from './post.js';

var postRoot = Post.extend({
  title: DS.attr('title'),
  comments: DS.hasMany('postComment', {async:true})
});

postRoot.reopenClass({
  FIXTURES: [
    {
      id: "post-aaa",
      title: "Post 1",
      createdAt: new Date(),
      embed: "embed-aaa",
      comments: [
        "comment-aaa",
        "comment-bbb"
      ]
    },
    {
      id: "post-bbb",
      title: "Post 2",
      createdAt: new Date(),
      embed: "embed-fff",
      comments: [
        "comment-ccc",
        "comment-ddd"
      ]
    }
  ]
});

export default postRoot;
