<?php require_once 'header.php';



if (isset($_SESSION['userkullanici_mail'])) {
    /*  if ($post)
        $degisken = $_POST['bilgi'];
    $degisken2 = $_POST['diger'];
    echo $degisken." ".$degisken2;
*/

    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  order by  etkinlik_tarih DESC");
    $etkinliksor->execute();


?>
    <div class="inner-banner-area mt-3">
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
                </p>
            </div>
        </div>
    </div>

    <div class="category-product-list bg-secondary section-space-bottom mt-3">
        <div class="container">
            <div class="inner-page-main-body"><br>
                <div class="page-controls">

                    <div class="tab-content">


                        <div class="product-list-view-style2 mt-3">

                            <div class="single-item-list">
                                <div class="item-img">
                                    <img src="img\logo.png" alt="product" width="181" height="147" class="img-responsive"><?php echo "profil yada etkinlik foto"; ?>
                                </div>
                                <div class="item-content">
                                    <div class="item-info">
                                        <div class="item-title ">
                                            <div class="row ">
                                                <h3><a href="#"><?php echo "etkinlik başlık"; ?></a></h3>

                                                <span><?php echo "etkinlik tarih"; ?></span>
                                            </div>

                                            <div class="item-description">
                                                <p><?php echo 'etkinlik_aciklama'; ?></p>
                                                <p><b>Etkinlik açıklama</b><br>
                                                    Lorem Ipsum Nedir?
                                                    Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum,
                                                    adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı
                                                    galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler
                                                    olarak kullanılmıştır. Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı
                                                    zamanda pek değişmeden elektronik dizgiye de sıçramıştır. 1960'larda Lorem
                                                    Ipsum pasajları da içeren Letraset yapraklarının yayınlanması ile ve yakın
                                                    zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri içeren masaüstü yayıncılık
                                                    yazılımları ile popüler olmuştur.</p>
                                            </div>
                                        </div>
                                        <div class="item-sale-info">
                                            <div class="price mt-3">
                                                <?php

                                                echo '<h5><b>Etkinlik  şehir il ilçe</b></h5>';
                                                ?>
                                            </div>
                                            <!-- <div class="sale-qty" >Katılımcı Sayısı</div>-->
                                            <div class="sale-qty " name="katilimci" id="katilimci">
                                                <span><?php

                                                        echo '<h7> katılımcı sayısı</h7><br>';
                                                        ?>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-profile-list">
                                        <div class="profile-title">
                                           
                                                <div class="img-wrapper "><img src="img\profile\nesprofil.jpg" alt="profile" class="img-responsive img-circle"></div>
                                                <span><?php

                                                        echo '<h7> etkinlik düzenleyen adı </h7><br>';
                                                        ?>
                                                </span>
                                         
                                        </div>


                                    </div>
                                    <br><br>
                                    <div>
                                        <a href="#"> <button name="katil" class="btn btn-success btn-lg btn-block" onclick="katil();"> Katıl</button></a><br>
                                        <a href="#"> <button name="geri" class="btn btn-primary btn-lg btn-block" onclick="katil();"> İptal</button></a>
                                    </div>
                                </div>
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