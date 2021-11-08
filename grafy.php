<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: login.php", true, 303);
}

$lines = explode("\n", file_get_contents('csvToPdf/souhrnne_vysledky.csv'));
$data = explode(";", $lines[1]);
$excellent = ["výjimečný", "výborný"];
$exception = "normální";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pdf.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="pdf.js"></script>
    <title>Grafy</title>
</head>

<body>
<a href="form.php">Zpět</a>
    <div>
        <img id="logo" src="assets/logo.jpg" alt="logo společnosti gensport">
        <h2>Výsledek vyšetření genetických predispozic ke sportu</h2>
        <button id="download">Stáhnout výsledky měření</button>
        <form action="prilohy.php?file=<?= $data[0] ?>&name=<?= $data[1] ?>" method="post">
            <input type="submit" name="prilohy" value="Stáhnout přílohy">
        </form>
    </div>
    <div id="hide"></div>
    <main id="main">
        <section id="headerSection">
            <div id="headerRow">
                <p>Výsledek&nbsp;vyšetření&nbsp;genetických predispozic ke sportu</p>
                <img src="assets/logo.jpg" alt="logo společnosti gensport">
            </div>
            <h3 id="name"><?= $data[1] ?></h3>
        </section>
        <?php
        if ($data[2] == "muž") {
        ?>
            <section id="graphSection">
                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="strength"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[11] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <div class="text">
                        <h4>Rychlost a síla</h4>
                        <p class="paragraph">Vaše předpoklady pro rychlost
                            a sílu jsou <?= $data[9] !== $exception ? mb_substr($data[9], 0, -1)."é" : $exception?> <?php if((int)$data[11] < 67) : ?> (lepší než u&nbsp<?=(int)$data[11]?>&nbsp% evropské populace) <?php endif;?></p>
                    </div>
                </div>

                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="endurance"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[15] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <div class="text">
                        <h4>Vytrvalost</h4>
                        <p class="paragraph">Vaše předpoklady pro vytrvalost
                            jsou <?= $data[13] !== $exception ? mb_substr($data[13], 0, -1)."é" : $exception?> <?php if((int)$data[15] < 67) : ?>(lepší než u&nbsp<?=(int)$data[15]?>&nbsp% evropské populace)<?php endif;?></p>
                    </div>
                </div>

                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="regeneration"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[19] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <div class="text">
                        <h4>Rychlost regenerace</h4>
                        <p class="paragraph">Vaše předpokládaná
                            rychlost regenerace je <?= $data[17] !== $exception ? mb_substr($data[17], 0, -1)."á" : $exception?> <?php if((int)$data[19] < 67) : ?> (lepší než u&nbsp<?=(int)$data[19]?>&nbsp% evropské populace)<?php endif;?>
                        </p>
                    </div>
                </div>

                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="vulnereability"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[23] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <div class="text">
                        <h4>Odolnost vůči zranění</h4>
                        <p class="paragraph">Vaše předpokládaná odolnost
                            vůči zranění je <?= $data[21] !== $exception ? mb_substr($data[21], 0, -1)."á" : $exception?> <?php if((int)$data[23] < 67) : ?>(lepší než u&nbsp<?=(int)$data[23]?>&nbsp% evropské populace)<?php endif;?></p>
                    </div>
                </div>
                <div class="graph">
                    <img src="assets/olympijskeKruhy.png" alt="olympijskeKruhy">
                    <p id="percentilArticle">Vaše olympijské předpoklady jsou&nbsp;lepší než u <?=trim($data[25])?>&nbsp;% českých olympijských medailistů</p>
                    <a></a>
                </div>
            </section>
        <?php
        } else {
        ?>
            <section id="graphSection">
                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="strength"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[12] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <h4>Rychlost a síla</h4>
                    <p class="paragraph">Vaše předpoklady pro rychlost
                        a sílu jsou <?= $data[10] !== $exception ? mb_substr($data[10], 0, -1)."é" : $exception?> <?php if((int)$data[12] < 67) : ?>(lepší než u&nbsp<?=(int)$data[12]?>&nbsp% evropské populace)<?php endif;?></p>
                </div>

                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="endurance"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[16] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <h4>Vytrvalost</h4>
                    <p class="paragraph">Vaše předpoklady pro vytrvalost
                        jsou <?= $data[14] !== $exception ? mb_substr($data[14], 0, -1)."é" : $exception?> <?php if((int)$data[16] < 67) : ?> (lepší než u&nbsp<?=(int)$data[16]?>&nbsp% evropské populace)<?php endif;?></p>
                </div>

                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="regeneration"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[20] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <h4>Rychlost regenerace</h4>
                    <p class="paragraph">Vaše předpokládaná
                        rychlost regenerace je <?= $data[18] !== $exception ? mb_substr($data[18], 0, -1)."á" : $exception?> <?php if((int)$data[20] < 67) : ?>(lepší než u&nbsp<?=(int)$data[20]?>&nbsp% evropské populace)<?php endif;?>
                    </p>
                </div>

                <div class="graph">
                    <div class="textAlongPath">
                        <span class="text1-n1">n</span>
                        <span class="text1-o1">o</span>
                        <span class="text1-r1">r</span>
                        <span class="text1-m1">m</span>
                        <span class="text1-a1">á</span>
                        <span class="text1-l1">l</span>
                        <span class="text1-n2">n</span>
                        <span class="text1-i1">í</span>

                        <span class="pipe1">|</span>

                        <span class="text2-n1">n</span>
                        <span class="text2-a1">a</span>
                        <span class="text2-d1">d</span>
                        <span class="text2-p1">p</span>
                        <span class="text2-r1">r</span>
                        <span class="text2-u1">ů</span>
                        <span class="text2-m1">m</span>
                        <span class="text2-e1">e</span>
                        <span class="text2-r2">r</span>
                        <span class="text2-n2">n</span>
                        <span class="text2-y1">é</span>

                        <span class="pipe2">|</span>

                        <span class="text3-v1">v</span>
                        <span class="text3-y1">ý</span>
                        <span class="text3-b1">b</span>
                        <span class="text3-o1">o</span>
                        <span class="text3-r1">r</span>
                        <span class="text3-n1">n</span>
                        <span class="text3-y2">é</span>

                        <span class="pipe3">|</span>

                        <span class="text4-v1">v</span>
                        <span class="text4-y1">ý</span>
                        <span class="text4-j1">j</span>
                        <span class="text4-i1">i</span>
                        <span class="text4-m1">m</span>
                        <span class="text4-e1">e</span>
                        <span class="text4-c1">č</span>
                        <span class="text4-n1">n</span>
                        <span class="text4-y2">é</span>

                        <span class="pipe4">|</span>
                    </div>
                    <div class="outer-circle">
                        <div class="inner-circle" id="vulnereability"></div>
                        <div class="center-dot" style="transform: rotate(<?= 270 + (int)$data[24] * 3.6 . "deg" ?>);">
                            <div class="one"></div>
                        </div>
                    </div>
                    <h4>Odolnost vůči zranění</h4>
                    <p class="paragraph">Vaše předpokládaná odolnost
                        vůči zranění je <?= $data[22] !== $exception ? mb_substr($data[22], 0, -1)."á" : $exception?> <?php if((int)$data[24] < 67) : ?>(lepší než u&nbsp<?=(int)$data[24]?>&nbsp% evropské populace)<?php endif;?></p>
                </div>
                <div class="graph">
                    <img src="assets/olympijskeKruhy.png" alt="olympijskeKruhy">
                    <p id="percentilArticle">Vaše olympijské předpoklady jsou lepší než u <?=trim($data[25])?>&nbsp;% českých olympijských medailistů</p>
                </div>
            </section>
        <?php
        }
        ?>
        <section id="footerSection">
            <div>Výsledky vytvořil: Genvia</div>
            <div class="foot">
                <div id="date">Datum:&nbsp;</div>
                <div id="link">www.testovanigenu.cz</div>
            </div>
        </section>
    </main>
    <div id="id"><?=$data[0]?></div>
</body>

</html>