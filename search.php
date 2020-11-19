<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FP LBE NCC Kel 4</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
        .gacha {
            height: 50vh;
            width: 90vw;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
    <a class="navbar-brand">Pokemon</a>
    <form class="form-inline" action="search.php">
        <input class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search" required>
        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search">
    </form>
    </nav>
    <?php
        include('simple_html_dom.php');
        
        $url = "https://pokemondb.net";
        $wiki = $url."/pokedex/all";
        $html = file_get_html($wiki);

        $table = $html->find('table[class=data-table block-wide]',0);
        $tableBody= $table->find('tbody',0);
    ?>

    <div class="container mx-auto">
        <table class='table table-striped table-dark '>
            <thead class='thead-dark'>
                <tr>
                    <th style="width:15%">National №</th>
                    <th style="width:15%">Images</th>
                    <th style="width:20%">Name</th>
                    <th style="width:20%">Type</th>
                </tr>
            </thead>
            <!-- <tbody> kelompok 4 zul-->
            <?php
                $i=0;
                $coba = "ok";
                $type = "type.php?type=";
                foreach (array_slice($tableBody->find('tr'),0) as $rowChar) {
                    $i = $i+1;
                    $name1 = str_replace(" ","",$rowChar->children(1)->children(0)->plaintext);
                    if($rowChar->children(1)->children(2)){
                        $name2 = $rowChar->children(1)->children(2)->plaintext;
                    }
                    else{
                        $name2 = "";
                    }
                    $natinalNo = str_replace(" ","",$rowChar->children(0)->children(1)->plaintext);
                    $imagesUrl = $rowChar->children(0)->children(0)->children(0);
                    $imagesUrlEXP = explode("\"",$imagesUrl);
                    $imagesUrl = "\"".$imagesUrlEXP[3]."\"";
                    $tipe1 = $rowChar->children(2)->children(0)->plaintext;
                    if($rowChar->children(2)->children(2)){
                        $tipe2 = "<br>".$rowChar->children(2)->children(2)->plaintext;
                    }
                    else{
                        $tipe2 = " ";
                    }
                    echo "<tr>";
                        echo "<td>".$natinalNo."</td>";
                        echo "<td><img src=$imagesUrl></img></td>";
                        echo "<td><a href='$type$name1'>$name1</a><br>$name2</td>";
                        echo "<td>".$tipe1.$tipe2."</td>";
                }
            ?>
        </table>
        <a href="index.php" class="btn btn-danger" role="button">Back</a>
    </div>
</body>

</html>