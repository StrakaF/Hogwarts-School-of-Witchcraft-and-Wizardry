document.getElementById('choose-file').addEventListener('change', function() {
    var fileName = this.files[0].name;
    var fileNameSpan = document.getElementById('file-name');
    fileNameSpan.textContent = "Vybratý súbor: " + fileName;
    fileNameSpan.style.display = 'block';
});