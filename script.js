
async function sendRequest(method) {

    const authorization = document.getElementById("authorization").value;

    const body = document.getElementById("body").value;

    const result = document.getElementById("result");

    const status = document.getElementById("status");

    const options = {
        method: method,
        headers: {
            "Authorization": authorization
        }
    };

    // Add JSON body for POST and PUT
    if (method === "POST" || method === "PUT") {

        options.headers["Content-Type"] = "application/json";

        options.body = body;
    }

    try {

        result.textContent = "Sending request...";

        status.textContent = "Status: Loading...";

        const response = await fetch("api.php", options);

        const data = await response.json();

        status.textContent =
            "HTTP Status: " + response.status +
            " | Method: " + method;

        result.textContent = JSON.stringify(data, null, 4);

    } catch (error) {

        status.textContent = "Request Failed";

        result.textContent = error.message;

    }
}
