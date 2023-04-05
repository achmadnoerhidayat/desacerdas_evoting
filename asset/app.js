function getAccesToken() {
  const token = localStorage.getItem("acces_token");
  if (!token) {
    return null;
  }
  return token;
}

function getToken() {
  const token = localStorage.getItem("acces_token");
  if (!token) {
    return null;
  }
  let obj = JSON.parse(token);
  return obj.token;
}

// var url = "http://localhost/api/"; // dev
var url = "https://evoting.desacerdas.com/api/"; //prod
function http() {
  return axios.create({
    baseURL: url,
    headers: {
      Authorization: "Bearer " + getToken(),
    },
  });
}
function httpFile() {
  return axios.create({
    baseURL: url,
    headers: {
      Authorization: "Bearer " + getToken(),
      "Content-type": "multipart/form-data",
    },
  });
}
