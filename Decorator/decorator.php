<?php
// Decorator Pattern
interface Notifier {
    public function send(string $message): string;
}

class EmailNotifier implements Notifier {
    public function send(string $message): string {
        return "Email: $message";
    }
}

class SmsDecorator implements Notifier {
    public function __construct(private Notifier $notifier) {}

    public function send(string $message): string {
        return $this->notifier->send($message) . " + SMS";
    }
}