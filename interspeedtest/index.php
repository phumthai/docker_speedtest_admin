<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Internet Speedtest login</title>
    <link rel="stylesheet" href="index2.css" />
  </head>
  <body>
    <div class="container">
      <button type="submit" class="btn" onclick="openPopup()">Login with CMU IT Account</button>
      <div class="popup" id="popup">
        <h2>ข้อกำหนดและเงื่อนไข</h2>
        <p>สำนักบริการเทคโนโลยีสารสนเทศให้ความสำคัญกับความเป็นส่วนตัวของท่าน จึงขอความยินยอมในการเก็บข้อมูล</p>
        <dl>
          <dt>CMU Account</dt>
          <dt>IP Address</dt>
          <dt>MAC Address</dt>
        </dl>
        <p>เพื่อใช้ประกอบการวิเคราะห์ หาสาเหตุ ปรับปรุง พัฒนาระบบเครือข่ายของมหาวิทยาลัยเชียงใหม่ต่อไป</p>
        <button class="no-btn" onclick="closePopup()">ไม่ยอมรับ</button>
        <a href="callback.php"><button>ยอมรับและเข้าสู่ระบบ</button></a>
      </div>
    </div>
    <script>
      let popup = document.getElementById("popup");
      function openPopup(){
        popup.classList.add("open-popup");
      }
      function closePopup(){
        popup.classList.remove("open-popup");
      }
    </script>
  </body>
</html>