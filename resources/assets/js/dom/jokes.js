const jokeServices = require('../services/jokes');

jokeServices.getRandomJoke().then(function(data) {
  console.log(data);
});