document.addEventListener('DOMContentLoaded', () => {
  const uploadButton = document.getElementById('upload-button');
  const fileUpload = document.getElementById('file');

  uploadButton.addEventListener('click', () => {
    const formData = new FormData();
    const selectedFile = fileUpload.files[0];

    formData.append('file', selectedFile);

    fetch('./script.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.text())
      // .then(data => console.log(data))
      .catch(error => console.error(error))
      .finally(() => {
        fileUpload.value = null;
      });
  });
});
