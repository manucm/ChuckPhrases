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
  return axios.get('/api/jokes').then(function(response) {
    console.log(response);
    return response.data;
  });
}