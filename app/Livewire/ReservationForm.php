<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReservationForm extends Component
{
    use WithFileUploads;

    public $name = '';
    public $phone = '';
    public $address = '';
    public $message = '';
    public $preferred_date = '';
    public $images = [];

    protected $rules = [
        'name' => 'required|string|min:2',
        'phone' => 'required|string|min:10',
        'address' => 'required|string|min:5',
        'message' => 'nullable|string|max:500',
        'preferred_date' => 'nullable|date|after_or_equal:today',
        'images' => 'nullable|array|max:5',
        'images.*' => 'image|max:5120',
    ];

    protected function messages()
    {
        return [
            'name.required' => __('messages.err_name'),
            'name.min' => __('messages.err_name'),
            'phone.required' => __('messages.err_phone'),
            'phone.min' => __('messages.err_phone'),
            'address.required' => __('messages.err_address'),
            'address.min' => __('messages.err_address'),
            'message.max' => __('messages.err_message'),
            'preferred_date.date' => __('messages.err_date'),
            'preferred_date.after_or_equal' => __('messages.err_date'),
            'images.max' => __('messages.err_images_max'),
            'images.*.image' => __('messages.err_image_type'),
            'images.*.max' => __('messages.err_image_size'),
        ];
    }

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images);
        }
    }

    public function submit()
    {
        $this->validate();

        $reservation = Reservation::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'message' => $this->message,
            'preferred_date' => $this->preferred_date ?: null,
        ]);

        $imagePaths = [];
        if ($this->images) {
            foreach ($this->images as $image) {
                $path = $image->store('reservations/' . $reservation->id, 'public');
                $imagePaths[] = $path;
            }
        }

        // Заявката вече е запазена; проблем с пощата не бива да губи или да блокира клиента.
        try {
            $this->sendStyledEmail($reservation, $imagePaths);
        } catch (\Throwable $e) {
            Log::error('Reservation email failed', ['reservation_id' => $reservation->id, 'error' => $e->getMessage()]);
        }

        $this->reset();
        session()->flash('success', __('messages.form_success'));
        $this->dispatch('reservation-success');
    }

    private function sendStyledEmail($reservation, $imagePaths)
    {
        $toEmail = config('mail.reservation_to');
        $subject = 'Нова заявка за оферта - ' . $reservation->name;
        $htmlContent = $this->buildStyledEmailHtml($reservation);

        Mail::send([], [], function ($message) use ($toEmail, $subject, $htmlContent, $imagePaths) {
            $message->to($toEmail)
                    ->subject($subject)
                    ->html($htmlContent);

            foreach ($imagePaths as $path) {
                $fullPath = Storage::disk('public')->path($path);
                if (file_exists($fullPath)) {
                    $message->attach($fullPath);
                }
            }
        });
    }

    private function buildStyledEmailHtml($reservation)
    {
        $date = $reservation->preferred_date
            ? Carbon::parse($reservation->preferred_date)->locale('bg')->isoFormat('D MMMM YYYY')
            : 'Не е посочена';
        $submitted = $reservation->created_at->copy()->setTimezone('Europe/Sofia')->locale('bg')->isoFormat('D MMMM YYYY, HH:mm');
        $imageCount = count($this->images);

        return '<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нова заявка - Lase Pro</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #0c4a6e 0%, #0891b2 100%); margin: 0; padding: 20px; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .header { background: linear-gradient(135deg, #0c4a6e 0%, #0891b2 100%); padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; letter-spacing: 2px; }
        .header .subtitle { color: #22d3ee; margin-top: 8px; font-size: 14px; text-transform: uppercase; letter-spacing: 3px; }
        .content { padding: 30px; }
        .info-section { background: #f0f9ff; border-radius: 12px; padding: 20px; margin-bottom: 20px; border-left: 4px solid #22d3ee; }
        .info-section h3 { color: #0c4a6e; margin: 0 0 15px 0; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; }
        .info-row { display: flex; margin-bottom: 12px; align-items: flex-start; }
        .info-label { font-weight: 600; color: #0891b2; min-width: 120px; font-size: 14px; }
        .info-value { color: #333; flex: 1; font-size: 14px; }
        .message-box { background: #f8fafc; border-radius: 8px; padding: 15px; margin-top: 10px; border: 1px solid #e2e8f0; }
        .message-box p { margin: 0; color: #475569; line-height: 1.6; }
        .footer { background: #0c4a6e; padding: 20px; text-align: center; }
        .footer p { color: #94a3b8; margin: 0; font-size: 12px; }
        .footer .brand { color: #22d3ee; font-weight: 700; font-size: 16px; }
        @media only screen and (max-width: 600px) { .content { padding: 20px; } .info-row { flex-direction: column; } .info-label { margin-bottom: 4px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LASE PRO</h1>
            <div class="subtitle">Нова заявка за оферта</div>
        </div>
        <div class="content">
            <div class="info-section">
                <h3>Данни за клиента</h3>
                <div class="info-row"><span class="info-label">Име:</span><span class="info-value" style="font-weight:700;">' . htmlspecialchars($reservation->name) . '</span></div>
                <div class="info-row"><span class="info-label">Телефон:</span><span class="info-value">' . htmlspecialchars($reservation->phone) . '</span></div>
                <div class="info-row"><span class="info-label">Адрес:</span><span class="info-value">' . htmlspecialchars($reservation->address) . '</span></div>
            </div>
            <div class="info-section">
                <h3>Срок</h3>
                <div class="info-row"><span class="info-label">Желана дата:</span><span class="info-value">' . $date . '</span></div>
                <div class="info-row"><span class="info-label">Изпратена на:</span><span class="info-value">' . $submitted . '</span></div>
            </div>
            <div class="info-section">
                <h3>Описание на проекта</h3>
                <div class="message-box"><p>' . ($reservation->message ? nl2br(htmlspecialchars($reservation->message)) : 'Няма добавено описание.') . '</p></div>
            </div>
            <div class="info-section" style="border-left-color: #f59e0b;">
                <h3 style="color: #d97706;">Прикачени файлове</h3>
                <div class="info-value">' . ($imageCount > 0 ? 'Снимки към заявката: ' . $imageCount . ' (прикачени към това писмо).' : 'Не са качени снимки.') . '</div>
            </div>
        </div>
        <div class="footer">
            <div class="brand">LASE PRO</div>
            <p>Прецизно лазерно почистване | Варна, България</p>
            <p style="margin-top: 8px;">lase.pro.bg@gmail.com | +359 886 548 030</p>
        </div>
    </div>
</body>
</html>';
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
