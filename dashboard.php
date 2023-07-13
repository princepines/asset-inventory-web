<?php
include 'config.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Asset Management System</title>
    <link rel="stylesheet" href="style.css?v=1.1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="icon" type="image/x-icon" href="white.png">
    <script type="text/javascript">
    // Current Server Time script (SSI or PHP)- By JavaScriptKit.com (http://www.javascriptkit.com)
    // For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
    // This notice must stay intact for use.

    //Depending on whether your page supports SSI (.shtml) or PHP (.php), UNCOMMENT the line below your page supports and COMMENT the one it does not:
    //Default is that SSI method is uncommented, and PHP is commented:

    // var currenttime = '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' //SSI method of getting server date
    var currenttime = '<?php print date("F d, Y H:i:s", time())?>' //PHP method of getting server date

    ///////////Stop editting here/////////////////////////////////

    var montharray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December")
    var serverdate = new Date(currenttime)

    function padlength(what) {
        var output = (what.toString().length == 1) ? "0" + what : what
        return output
    }

    function displaytime() {
        serverdate.setSeconds(serverdate.getSeconds() + 1)
        var datestring = montharray[serverdate.getMonth()] + " " + padlength(serverdate.getDate()) + ", " + serverdate
            .getFullYear()
        var timestring = padlength(serverdate.getHours()) + ":" + padlength(serverdate.getMinutes()) + ":" + padlength(
            serverdate.getSeconds())
        document.getElementById("servertime").innerHTML = datestring + " " + timestring
    }

    window.onload = function() {
        setInterval("displaytime()", 1000)
    }
    </script>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <h1>Dashboard</h1><br>
        <div class="row row-cols-2 row-cols-md-2">
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="min-height:91%; text-align:center;">
                    <div class="card-header">All Assets</div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Primary card title</h3>
                        <h5 class="card-text">All Assets in this building</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="min-height:91%; text-align:center;">
                    <div class="card-header">In Use</div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Primary card title</h3>
                        <h5 class="card-text">In Use Assets in this building</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="min-height:91%; text-align:center;">
                    <div class="card-header">In Storage</div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Primary card title</h3>
                        <h5 class="card-text">In Storage Assets in this building</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="min-height:91%; text-align:center;">
                    <div class="card-header">For Repair</div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Primary card title</h3>
                        <h5 class="card-text">For Repair Assets in this building</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="min-height:91%; text-align:center;">
                    <div class="card-header">For Disposal</div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Primary card title</h3>
                        <h5 class="card-text">For Disposal Assets in this building</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="min-height:91%; text-align:center;">
                    <div class="card-header">Date and Time</div>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">
                            <div id="servertime"></div>
                        </h3>
                        <h5 class="card-text">Today is <?php echo date("l, F j, Y");?></h5>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>