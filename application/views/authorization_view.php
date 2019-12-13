<?php if ( !isset( $data['error']) ): ?>
<form class="w-25 mx-auto pt-5 authorization__form" method="POST" action="/authorization/enter/" id="authorization__form" >
    <div class="form-group">
        <label for="authorization__login" class=" col-form-label">Login:</label>
        <input type="text" class="form-control" id="authorization__login" name="authorization__login" placeholder="Login" required autofocus>
    </div>
    <div class="form-group">
        <label for="authorization__password" class=" col-form-label">Password:</label>
        <input type="password" class="form-control" id="authorization__password" name="authorization__password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">Sign in</button>
    </div>
</form>
<div class="alert authorization__message" role="alert" >
  <h4 class="alert-heading authorization__title"></h4>
  <p class="authorization__description"></p>
  <hr>
  <a href="/" type="button" class="btn btn-light mx-1 btn-sm">Вернуться к заметкам</a>
</div>
<script src="assets/js/authorization.js" defer></script>
<? else: ?>
<? foreach( $data['error'] as $message) {
    echo "<p>$message</p>";
} ?>
<? endif; ?>