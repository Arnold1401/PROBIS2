<?php
    session_start();
    
    if (isset($_SESSION["nama"])) {
        echo "nama belakang ".$_SESSION["nama"];
    }else{
        echo "nama belakang tidak ada";
    }
 
?>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

    <input type="text" id="tuser" >
    <input type="text" id="tpass" >
    <button onclick="submit()" type="button" >Kirim</button>
</body>
<script>
    function submit() {
        $.post("ajaxlogin.php",
        {
            jenis:"terima",
            us:$("#tuser").val(),
            // p:$("#tpass").val(),
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    }

</script>
</html>