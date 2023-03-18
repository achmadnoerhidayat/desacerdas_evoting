function getAccesToken() {
  const token = localStorage.getItem('acces_token');
  if (!token) {
      return null;
  }
  return token;

}

function http() {
  return axios.create({
    baseURL: "http://localhost/api/",
  });
}
function httpFile() {
  return axios.create({
    baseURL: "http://localhost/api/",
    headers: {
      Authorization: "Bearer " + getAccesToken(),
      "Content-type": "multipart/form-data",
    },
  });
}
