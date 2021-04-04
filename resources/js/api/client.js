import RestClient from 'another-rest-client';

const api = new RestClient();

api.on('request', function(xhr) {
  // Auth?
  xhr.setRequestHeader('Content-Type', 'application/json');
});

api.res(['resources', 'workshops', 'recipes', 'processes',]);

export default api;
