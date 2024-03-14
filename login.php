<?php
include "header.php";
?>
<div class="container">
  <h2>Login</h2>
  <form id="loginForm" method="post" action="login_proses.php">
    <input type="text" id="username" name="username" required placeholder="username">
    <input type="password" id="password" name="password" required placeholder="password">

    <label for="role">Login Sebagai:</label>
    <select id="role" name="role">
      <option value="kurir">Kurir</option>
      <option value="admin_bumdes">Admin BUMDes</option>
      <option value="admin_pemdes_ekspres">Admin Pemdes Ekspres</option>
    </select>

    <button type="submit">Login</button>
  </form>
</div>

<?php
include "footer.php";
?>