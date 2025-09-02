<?php if (isset($_SESSION['flashmessage'])): ?>
    <?php foreach ($_SESSION['flashmessage'] as $key => $message): ?>
        <div class="flash-message <?= $key ?>">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flashmessage']); ?>
<?php endif; ?>
