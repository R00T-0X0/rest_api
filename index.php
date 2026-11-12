
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API Tester</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <h1>REST API Tester</h1>
        <p>Test HTTP Methods using PHP REST API</p>

        <div class="form">

            <label for="authorization">Authorization Header</label>
            <input
                type="text"
                id="authorization"
                placeholder="Bearer test123"
                value="Bearer test123"
            >

            <label for="body">JSON Request Body</label>
            <textarea id="body" rows="7">{
    "name": "Bashar",
    "email": "bashar@example.com"
}</textarea>

        </div>

        <h3>HTTP Methods</h3>

        <div class="buttons">
            <button class="get" onclick="sendRequest('GET')">GET</button>
            <button class="post" onclick="sendRequest('POST')">POST</button>
            <button class="put" onclick="sendRequest('PUT')">PUT</button>
            <button class="delete" onclick="sendRequest('DELETE')">DELETE</button>
        </div>

        <div class="response">

            <h2>API Response</h2>

            <div id="status">Status: Waiting...</div>

            <pre id="result">Response will appear here...</pre>

        </div>

    </div>

    <script src="script.js"></script>

</body>
</html>
