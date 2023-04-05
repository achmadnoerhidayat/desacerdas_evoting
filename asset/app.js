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

function isAdmin() {
  var token = JSON.parse(getAccesToken());
  console.log(token);
  if (!token) {
    return location.href = '/';
  }

  if (token.user.role != 'Admin') {
    return location.href = '/';
  }
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
