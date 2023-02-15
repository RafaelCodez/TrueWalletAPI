<?php 
    /**
     * 
     * @link https://www.lft-plus.com/
     * @author RafaelCodez (Rafael LifeStyle Plus)
     */
    $apikey = '';   /*  API KEY ที่ได้รับจาก https://wallet.lft-plus.com/  */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>LifeStyle+ Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
  <!-- stylesheet -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
  <link rel="stylesheet" href="https://wallet.lft-plus.com/assets/css/adminlte.min.css">
  <link rel="stylesheet" href="https://wallet.lft-plus.com/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="https://wallet.lft-plus.com/assets/css/style.css">
</head>
<body>
<header class="bg"></header>
<section class="d-flex align-items-center min-vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <section class="col-lg-6">
        <div class="card shadow p-3 p-md-4">
          <h1 class="text-center text-primary font-weight-bold">LifeStyle+</h1>
          <h4 class="text-center">Wallet API</h4> 
          <div class="card-body">
            <!-- HTML Form Login --> 
            <form id="formGift">
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div style="width: 120px;" class="input-group-text px-3">ลิงค์อั่งเปา</div>
                  </div>
                  <input type="hidden" class="form-control" name="token" id="token" value="<?php echo $apikey ?>">
                  <input type="text" class="form-control" name="voucher" id="voucher" placeholder="กรอกลิงค์อั่งเปา">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block"> ยืนยัน</button>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>

<!-- script -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://wallet.lft-plus.com/plugins/jquery/jquery.min.js"></script>
<script src="https://wallet.lft-plus.com/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://wallet.lft-plus.com/plugins/toastr/toastr.min.js"></script>
<script>
  $(function() {
    /** Ajax Submit Login */
    $("#formGift").submit(function(e){
      e.preventDefault()
      Swal.fire({
        title: "กรุณารอซักครู่!",
        showCancelButton: !1,
        showLoaderOnConfirm: !1,
        allowOutsideClick: !1,
        allowEscapeKey: !1
      }), Swal.showLoading();

      $.ajax({
        type: "POST",
        url: "https://wallet.lft-plus.com/service/auth/walletapi.php",
        data: $(this).serialize(),
        success: function(data) { 
          if(data.code == 200) {
                setTimeout(function () {
                    Swal.fire({
                        title: 'เติมเงินสำเร็จ',
                        text: data.msg,
                        icon: 'success'
                    });
                }, 2000);
            } else {
                setTimeout(function () {
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: data.msg,
                        icon: data.status
                    });
                }, 2000);
            }
        }
      })
    })
  })
</script>
</body>
</html>
