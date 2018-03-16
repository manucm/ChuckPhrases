const jokeServices = require('../services/jokes');


if ($('#random-component').length) {

  jokeServices.getRandomJoke().then(function({joke, joke_image, owner, slug, isVisited}) {

    $('#random-joke').html(joke);
    $('#random-data').find('img').eq(0).attr('src', joke_image);
    $('#random-data').find('span').eq(0).html(owner);
  
    isVisited++
    
    const classType = (isVisited == 1)? 'panel-success' : 'panel-primary';
    const message = (isVisited == 1)? 'Bravo!! es la primera aparición de este chiste' : `El chiste ha aparecido ${isVisited} veces`;
      
    $('#random-panel').addClass(classType);
    $('.panel-body').eq(0).html(message);
  
    return {slug, isVisited};
  
  }).then(function({slug, isVisited}) {
    jokeServices.markJokeAsVisited(slug, isVisited);
  });
}
