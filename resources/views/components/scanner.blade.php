<script src="{{ asset('javascript/scan.js') }}"></script>
<script src="{{ asset('javascript/jquery.js') }}"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="qrcontainer" id="qr-reader"></div>
            <div id="qr-reader-results"></div>
        </div>
    </div>
</div>

<style media="screen">

    #html5-qrcode-button-camera-permission {
        color: white;
    }

    #html5-qrcode-button-camera-start {
        color: white;
    }

    #html5-qrcode-button-camera-stop {
        color: white;
    }

    #html5-qrcode-anchor-scan-type-change {
        color: white;
    }

    #qr-reader-results {
        color:white;
    }

</style>
