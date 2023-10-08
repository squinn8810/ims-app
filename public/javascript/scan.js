var results = {}


// Square QR box with edge size = 70% of the smaller edge of the viewfinder.
let qrboxFunction = function (viewfinderWidth, viewfinderHeight) {
    let minEdgePercentage = 0.7; // 70%
    let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
    let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
    return {
        width: qrboxSize,
        height: qrboxSize
    };
}

/**
 * 
 * @param {*} fn 
 */
function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

/**
 * 
 */
docReady(function () {
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: qrboxFunction });

    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            console.log(`Scan result = ${decodedText}`, decodedResult);

            resultContainer.innerHTML += `<div>Scan Successful! One moment...</div>`;

            results[countResults] = decodedText;

            postResults();
            // Optional: To close the QR code scannign after the result is found
            html5QrcodeScanner.clear();
            //Un-comment below to scan a list all at once. 
            //document.getElementById("post-btn").onclick = function() {postResults()};

        }
    }

    // Optional callback for error, can be ignored.
    function onScanError(qrCodeError) {
        // This callback would be called in case of qr code scan error or setup error.
        // You can avoid this callback completely, as it can be very verbose in nature.
    }

    html5QrcodeScanner.render(onScanSuccess, onScanError);
});

/**
 * A function to post results when scanning has been finished. Called on button click.
 */
function postResults() {

    let url = '/scan';
    let scanAgain = false; 


    let requestData = {
        scanData: results,
        scanAgain: scanAgain
    };

    fetch(url, {
        method: "POST",
        body: JSON.stringify(requestData),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).then(response => {
        if (response.redirected) {
            window.location.href = response.url;
        }
    })
}


/**
 * Function to retrieve CSRF Cookie
 * @param {*} name 
 * @returns 
 */
function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = cookie.substring(name.length + 1);
                break;
            }
        }
    }
    return cookieValue;
}


