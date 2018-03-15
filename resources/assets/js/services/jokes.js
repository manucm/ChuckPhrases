export const getRandomJoke = () => {
  return axios.get('/api/random').then(function(response) {
    console.log(response.data)
    return response.data;
  });
}