var jade = require('jade');
var socket = require('socket.io');
var restify = require('restify');
var http = require('http');
var Faker = require('Faker');

var server = restify.createServer();

var data = [];

for (var i = 0; i < 100; i++) {
  var obj = {};
  obj.name = Faker.Name.findName();
  data.push( obj);
}

server.get('/:page/:name', function(req, res, next) {
  return next();
});

server.get('/:page', function(req, res) {
 
  jade.renderFile('views/index.jade', {"title" : req.params.page, "users" : data}, function(err, html){
    if(err) throw err;
    res.end(html);
  });

});

server.listen(1337);
