const jokeServices = require('../services/jokes');
$('#table-component').dataTable();
jokeServices.getJokeAll().then(function({jokeList, count}) {
  const table = $('#table-component').DataTable();
  const list = jokeList.map( joke => mapJokeFromDBToTable(joke) );
  table.rows.add( list ).draw();
  
});

const mapJokeFromDBToTable = joke => {
  console.log(apariciones(joke.isVisited));
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
  <a href="/jokes/${joke.slug}">
          <button class="btn btn-info btn-sm" type="button">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </button></a>
          <a href="/jokes/delete/${joke.slug}">
          <button class="btn btn-warning btn-sm" type="button">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </button></a> `)
                  ;
}

