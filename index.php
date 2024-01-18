<!DOCTYPE html>
<html>
<body>

<h2>Broken URL Checker</h2>
<form id="uploadForm" enctype="multipart/form-data">
    Select CSV file with URLs:
    <input type="file" name="file" id="file" accept=".csv">
    <input type="button" value="Check URLs" onclick="uploadFile()">
</form>

<div id="result"></div>

<script>
function uploadFile() {
    var file = document.getElementById('file').files[0];
    var reader = new FileReader();
    reader.readAsText(file);

    reader.onload = function(event) {
        var urls = event.target.result.split(/\r\n|\n/);
        processBatch(urls, 0);
    };
}

function processBatch(urls, index) {
    var batchSize = 10; // Number of URLs to process at once
    var batch = urls.slice(index, index + batchSize);
    var formData = new FormData();
    formData.append('urls', JSON.stringify(batch));

    fetch('process_urls.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(brokenUrl => {
            document.getElementById('result').innerHTML += 'Broken URL: ' + brokenUrl.url + ' - Status Code: ' + brokenUrl.status + '<br>';
        });

        if (index + batchSize < urls.length) {
            processBatch(urls, index + batchSize); // Process the next batch
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

</body>
</html>
