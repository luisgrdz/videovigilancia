<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cambiar Contraseña</title>
<style>
body {
  background:#0e1117; color:white; font-family:Poppins; display:flex;
  flex-direction:column; align-items:center; justify-content:center; height:100vh;
}
input {padding:0.5rem; border:none; border-radius:6px; margin:0.3rem;}
button {padding:0.6rem 1rem; border:none; border-radius:6px; background:#1f8ef1; color:white;}
</style>
</head>
<body>
<h2>Cambia tu contraseña</h2>
<input id="newpass" type="password" placeholder="Nueva contraseña"><br>
<input id="confpass" type="password" placeholder="Confirmar contraseña"><br>
<button onclick="change()">Guardar</button>
<p id="msg"></p>
<script>
function change(){
  const np = newpass.value, cf = confpass.value;
  if(np !== cf){ msg.textContent="Las contraseñas no coinciden"; return; }

  const user = localStorage.getItem('currentUser');
  const users = JSON.parse(localStorage.getItem('users'));
  const idx = users.findIndex(x=>x.user===user);
  users[idx].pass = np;
  users[idx].mustChange = false;
  localStorage.setItem('users', JSON.stringify(users));
  alert("Contraseña actualizada");
  location.href='admin.html';
}
</script>
</body>
</html>
