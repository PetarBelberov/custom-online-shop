<?php
$type = \Helpers\FlashMessageHelper::getFlashMessageType();
$message = $_SESSION['flash_message']['message'] ?? '';

if (isset($_SESSION['flash_message'])): ?>
    <div class="flash-message <?php echo $_SESSION['flash_message']['type']; ?>">
        <?php echo $_SESSION['flash_message']['message']; ?>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
    <script src="/assets/js/flash-message.js"></script>
<?php endif; ?>