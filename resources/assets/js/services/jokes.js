export const getRandomJoke = () => {
  return axios.get('/api/random').then(function(response) {
    return response.data;
  });
}

export const markJokeAsVisited = (slug, isVisited) => {
  axios.post('/api/joke/markAsVisited', {
    slug,
    isVisited
  });
}

export const getJokeAll = () => {
  return axios.get('/api/jokes').then( response => {
    return response.data;
  });
}

export const deleteJoke = (url) => {
  console.log(url);
  return axios({
    method: 'delete',
    url: `${url}`,
    }).then(response => {
      console.log(response);
      return response.data;
    });;
}