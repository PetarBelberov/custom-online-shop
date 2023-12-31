<?php
namespace Helpers;

class FlashMessageHelper
{
    public static function setFlashMessage(string $type, string $message): void
    {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    public static function getFlashMessageType(): string
    {
        return $_SESSION['flash_message']['type'] ?? '';
    }
}