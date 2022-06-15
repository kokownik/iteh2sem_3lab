<?php
include "conn.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <input class="form_block" placeholder="Vendor:" type="text" id="vendor">
    <input class="search_block" type="submit" value="Search" onclick="html()"><br>
<br>
    <input class="form_block" placeholder="Category:"type="text" id="category">
    <input class="search_block" type="submit" value="Search" onclick="xml()"><br> 
<br>
    <input class="form_block" placeholder="Min price:" type="text" id="min_price">
    <input class="form_block" placeholder="Max price:" type="text" id="max_price">
    <input class="search_block" type="submit" value="Search" onclick="json()"><br>
    

<div id="result"></div>
<script>
    let ajax = new XMLHttpRequest();
    function html() {
        ajax.onreadystatechange = function() {
            if (ajax.readyState === 4) {
                if (ajax.status === 200) {
                    document.getElementById("result").innerHTML = ajax.response;
                }
            }
        }
        let vendor = document.getElementById("vendor").value;
        ajax.open("get", "vendor.php?vendor=" + vendor);
        ajax.send();
    }

 function xml() {
    let category = document.getElementById("category").value;
    ajax.open("get","category.php?category=" + category);
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                let rows = ajax.responseXML.firstChild.children;
                let result = "<div>";
                for(var i = 0; i < rows.length; i++){
                    result += "<p>" + rows[i].children[0].firstChild.nodeValue + "<br>price: " +
                    rows[i].children[1].firstChild.nodeValue + "<br>quantity: " +
                    rows[i].children[2].firstChild.nodeValue + "</p><hr>";
                }
                result += "</div>";
                document.getElementById("result").innerHTML = result;
            }
        }
    }   
    ajax.send();
 }

    function json() {
    ajax.onreadystatechange = function(){
    let rows = JSON.parse(ajax.responseText);
    if (ajax.readyState === 4) {
        if (ajax.status === 200) {
            let result = "<div>";
            for (var i = 0; i < rows.length; i++) {
                result += "<p>Name: " + rows[i].name + "<br>price: " + rows[i].price + "<br>quality: "+ rows[i].quality +
				"<br>quantity: " + rows[i].quantity + "</p><hr>";
            }
            result = result + "</div>";
            document.getElementById("result").innerHTML = result;
        }
    }
    };
    let minPrice = document.getElementById("min_price").value;
    let maxPrice = document.getElementById("max_price").value;
    ajax.open("get", "price.php?min_price=" + minPrice + "&max_price=" + maxPrice);
    ajax.send();
}
</script>
</body>
</html>