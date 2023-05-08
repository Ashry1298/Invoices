<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceUpdate extends Notification
{
    use Queueable;

    protected $invoiceId;
    protected $invoiceNumber;

    public function __construct($invoiceId, $invoiceNumber)
    {
        $this->invoiceId = $invoiceId;
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
 
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'=>' تم تحديث فاتوره رقم  '. $this->invoiceNumber .' بواسطه  ',
            'user' => Auth::user()->name,
            'invoice_id' => $this->invoiceId,
            'invoice_number' => $this->invoiceNumber,
        ];
    }
}
