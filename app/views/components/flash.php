<?php if (isset($_SESSION['flashmessage'])): ?>
    <?php foreach ($_SESSION['flashmessage'] as $key => $message): ?>
        <div class="flash-message <?= $key ?>">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flashmessage']); ?>
<?php endif; ?>
<script>
  // Espera 3 segundos e depois esconde todas as mensagens
  setTimeout(function() {
    const messages = document.querySelectorAll('.flash-message');
    messages.forEach(function(msg) {
      msg.style.transition = 'opacity 0.5s ease';
      msg.style.opacity = '0';
      setTimeout(() => msg.remove(), 500); // Remove do DOM após o fade-out
    });
  }, 5000);
</script>