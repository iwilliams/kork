var Faker = require('Faker');

exports.list = function(req, res) {
  
  users = [];
 
  obj = {"name": req.params.name, "details" : Faker.Lorem.paragraph()};
 
  users.push(obj);
  
  
  res.render('users',
    {
      "title": "Users",
      "users": users
    });
}

exports.listAll = function(req, res) {

  users = [];

  for(var i = 0; i < 100; i++){
    obj = {"name": Faker.Name.firstName(), "details" : Faker.Lorem.paragraph()};
    users.push(obj);
  }


  res.render('users',
    {
      "title": "Users",
      "users": users
    });
}
