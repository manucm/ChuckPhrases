const jokeServices = require('../services/jokes');
const modal = require('../plugins/modal');

if ($('#table-component').length) {

  
  $('#table-component').dataTable();
  jokeServices.getJokeAll().then(function({jokeList, count}) {
    const table = $('#table-component').DataTable();
    const list = jokeList.map( joke => mapJokeFromDBToTable(joke) );
    table.rows.add( list ).draw();
    
  });

  $('#table-component').on( 'click', '.show-info', function() { 
    const text = $(this).data('text');
    modal.openModal('Palabra de Chuck Norris!', text);
  })

  $('#table-component').on( 'click', '.show-delete', function() { 
    const url = $(this).data('url'); 
    modal.openDeleteModal(deleteJoke, url, $(this).closest('tr'));
  })
}

const deleteJoke = (url, row) => {
  return jokeServices.deleteJoke(url).then(function(response) {
    if (response.status == 'OK') {
      const table = $('#table-component').DataTable();
      table.row(row).remove().draw();
    }
    return 'OK';
  })
} 


const mapJokeFromDBToTable = joke => {
  return [
    joke.value.substring(0, 40),
    normalizeUser(joke.user),
    apariciones(joke.isVisited),
    buttons(joke)
  ];
}

const normalizeUser = (user) => {
  if (user.username != 'System')
    return `${joke.user.username} ${joke.user.lastname}`;
  else 
    return 'System';
}

const apariciones = (visitas) => {
  return (`<button class="btn btn-primary" type="button">
            Apariciones <span class="badge">${visitas}</span>
          </button> `)
                  ;
}

const buttons = (joke) => {
  return (`
  <a href="#" class="show-info" data-text="${joke.value}">
          <button class="btn btn-success btn-sm" type="button">
            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
          </button></a>

  <a href="/jokes/${joke.slug}">
          <button class="btn btn-info btn-sm" type="button">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </button></a>
          <a class="show-delete" data-url="/api/jokes/${joke.slug}">
          <button class="btn btn-warning btn-sm" type="button">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </button></a> `)
                  ;
}

