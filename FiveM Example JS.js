var token = ''; // ใส่ Token ของคุณ https://wallet.lft-plus.com/

$('[role="form2"]').submit(function () {

  const input = document.getElementById("wallet").value;
  var detail = "voucher=" + input + "&token=" + token;

  $.ajax({
    type: "POST",
    data: detail,
    url: "https://wallet.lft-plus.com/service/auth/walletapi.php",
    success: function(data) {
      if(data.code != 200) {
        setTimeout(function () {
          Swal.fire({
            title: 'Wallet API Topup',
            text: data.msg,
            icon: data.status,
          });
        }, 2000);
      } else {
        setTimeout(function () {
          Swal.fire({
            title: 'Wallet API Topup',
            text: data.msg,
            icon: data.status,
          });

          $.post('โพสฟั่งชั่นไปยัง Client Function', JSON.stringify({
            money: parseInt(data.amount)
          }));
        }, 2000);
      }
    }
  })
})