<?php require_once 'header.php';

if (isset($_SESSION['userkullanici_mail'])) {

    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  order by  etkinlik_tarih DESC");
    $etkinliksor->execute();
?>
    

    <div class="category-product-list bg-secondary section-space-bottom">
        <div class="container">
            <div class="inner-page-main-body"><br>
                <div class="page-controls">

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view-style2">
                                <?php  ($etkinlikler = $etkinliksor->fetch(PDO::FETCH_ASSOC))  ?>
                                    <div class="single-item-list">
                                        <div class="item-img">
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                
                                            </div>
                                            

                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                   <center> <br><br><br><div class="img-wrapper"><img height="275" width="275" src="dimg\gırgır.png" alt="profile" class="img-responsive img-circle" ></div></center>
                                                    <span>
                                                    <br><br><br>  <?php echo "<center><h1>Hakkımızda </h1>  <h4> MERHABALAR! GırGır Ailesine Hoşgeldiniz. <br> Ailemize katıldığınız için teşekkür ederiz. <br>Artık aktivitelerinizi gerçekleştirirken eğlencenizi <br> yeni arkadaşlar ile paylaşabileceksiniz.<br><br><br>  </center><h4>"  ?></span>
                                                </div>
                                            </div>

                                                <br><br><br>
                                            
                                            <br> </br>
                                        </div>
                                    </div>
                                <?php
                                 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once 'footer.php' ?>
    <?php } else {
    header("Location:login");
} ?>