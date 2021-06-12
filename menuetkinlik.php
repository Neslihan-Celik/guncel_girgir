<?php
require_once 'header.php';

//islemkontrol();
if (!isset($_SESSION['userkullanici_mail'])) {
    header("Location:login");
    exit;
}
$etkinliksor = $db->prepare("SELECT * FROM etkinlik WHERE kullanici_id=:kullanici_id order by  etkinlik_tarih DESC");
$etkinliksor->execute(array(
    'kullanici_id' => $_SESSION['userkullanici_id']
));
$etkinliksor2 = $db->prepare("SELECT count(*) AS toplam FROM etkinlik WHERE kullanici_id=:kullanici_id");
$etkinliksor2->execute(array(
    'kullanici_id' => $_SESSION['userkullanici_id']
));
$say2 = $etkinliksor2->fetch(PDO::FETCH_ASSOC);
$say = $say2['toplam'];

?>
<!-- Header Area End Here -->

<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->

<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">

        <div class="row settings-wrapper">
          

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

                <?php
                if (@$_GET['durum'] == "hata") { ?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Etkinlik Kaldırılamadı.
                    </div>
                <?php } elseif (@$_GET['durum'] == "ok") { ?>

                    <div class="alert alert-success">
                        <strong>Bilgi! </strong> Etkinlik Kaldırıldı.
                    </div>
                <?php }
                ?>
                <form action="nedmin/netting/kullanici.php" method="POST" name="etkinlik_sil" class="form-horizontal" id="personal-info-form">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Etkinliklerim</h2>





                            
                            <div class="personal-info inner-page-padding">
                                <?php
                                if ($say > 0) {
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Etkinlik Adı</th>
                                            <th scope="col">Etkinlik Tarihi</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php

                                        $say3 = 0;
                                        while ($etkinlikcek = $etkinliksor->fetch(PDO::FETCH_ASSOC)) {
                                            $say3++ ?>



                                            <tr>
                                                <th scope="row"><?php echo $say3 ?></th>
                                                <td><?php echo $etkinlikcek['etkinlik_baslik'] ?></td>
                                                <td><?php echo $etkinlikcek['etkinlik_tarih'] ?></td>
                                                <td><input type="hidden" name="etkinlik_id" value="<?php echo $etkinlikcek['etkinlik_id'] ?>">

                                                    <button class="btn btn-danger btn-md" name="etkinlik_sil">Kaldır</button>
                                                  
                                                    
                                                    <button class="btn btn-primary btn-md" type="submit" name="gonder" id="gonder " > incele</button>
                                                </form>



                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } elseif ($say <= 0) { ?>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">İnfo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Etkinliğiniz bulunmamaktadır. <a href="etkinlikkur">Yeni bir etkinlik kur <</a></td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php }  ?>
                            </div>
                        </div>


                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<!-- Footer Area Start Here -->
<?php require_once 'footer.php'; ?>
<script>
        function incele() {
            var etkinlik = $("input[name=etkinlik_id]").val();
           var etkinlik_id= Number(etkinlik);
            $.ajax({
                type: "POST",
                url: "etkinlikIncele.php",
                data: {
                    post_etkinlik_ik: etkinlik_id,

                },
                success: function(sonuc) {
                    var newHTML = "<div style='color: green;'> *Üyeliğiniz kaydedildi </div>";
                    document.getElementById("uyari").innerHTML = newHTML;

                }
            })
        }
    </script>