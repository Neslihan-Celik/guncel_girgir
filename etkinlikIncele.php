<?php require_once 'header.php';



if (isset($_SESSION['userkullanici_mail'])) {
    if ($post)
        $degisken = $_POST['bilgi'];
    $degisken2 = $_POST['diger'];



    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  order by  etkinlik_tarih DESC");
    $etkinliksor->execute();


?>
    <div class="inner-banner-area">
        <div class="container">
            <div class="inner-banner-wrapper">
                <h1>GırGır'a Hoşgeldiniz!</h1>
                <p></p>
                <div class="banner-search-area input-group">
                    <input class="form-control" placeholder="anahtar kelimelerinizi arayın . . ." type="text">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                <p>Doğru tercih edilmiş bir etkinlik kur, arkadaşlar edin ve GırGır'la eğlenceye hemen başla!
                    echo $degisken." ".$degisken2;}</p>
            </div>
        </div>
    </div>

    <div class="category-product-list bg-secondary section-space-bottom">
        <div class="container">
            <div class="inner-page-main-body"><br>
                <div class="page-controls">

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view-style2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once 'footer.php' ?>
    <?php

} else {
    header("Location:login");
} ?>