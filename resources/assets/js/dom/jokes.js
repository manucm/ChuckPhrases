const jokeServices = require('../services/jokes');

jokeServices.getRandomJoke().then(function({joke, joke_image, owner}) {

  $('#random-joke').html(joke);
  $('#random-data').find('img').eq(0).attr('src', joke_image);
  $('#random-data').find('span').eq(0).html(owner);
});