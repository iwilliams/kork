var Faker = require('Faker');

exports.list = function(req, res) {
  
  posts = [];
  for(var i = 0; i < 10; i++) {
    obj = {"title": "Post " + i, "text": Faker.Lorem.paragraph()};
    posts.push(obj);
  }
  
  res.render('posts',
    {
      "title": "Posts",
      "posts": posts
    });
}
