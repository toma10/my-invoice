<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceDeniedNotification extends Notification
{
    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject(sprintf('Invoice %s denied', $this->invoice->variable_symbol))
            ->line(sprintf('Invoice %s was denied.', $this->invoice->variable_symbol))
            ->action('See Invoice', route('invoices.show', $this->invoice));
    }
}
