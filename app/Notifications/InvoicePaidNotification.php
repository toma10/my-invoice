<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Notifications\Messages\MailMessage;

class InvoicePaidNotification extends Notification
{
    use OptOutable;

    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject(sprintf('Invoice %s paid', $this->invoice->variable_symbol))
            ->line(sprintf('Invoice %s was marked as paid.', $this->invoice->variable_symbol))
            ->action('See Invoice', route('invoices.show', $this->invoice));
    }

    protected function settingsKeyName(): string
    {
        return 'invoice_paid';
    }
}
