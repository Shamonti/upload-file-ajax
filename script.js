uploadButton = document.getElementById('upload-button');
fileUpload = document.getElementById('file');

uploadButton.onclick = function () {
  let formdata = new FormData();
  let selectedFile = file.files[0];
  formdata.append('file', selectedFile);

  let params = {
    method: 'POST',
    headers: {},
    body: formdata,
  };

  fetch('scripts.php', params)
    .then(response => response.text())
    .then(data => console.log(data));
};
