<?php

namespace App\Services\SmsSenders;

use App\Exceptions\PHONESException;
use App\Exceptions\SMSRUConnectException;
use Illuminate\Support\Facades\Http;

class SMSRUSender implements SmsSenderInterface
{
    private string $apiKey;
    private string $baseUrl = 'https://sms.ru/sms/send';
    private array $phones;
    private string $message;

    public function __construct()
    {
        $this->apiKey = config('custom.smsru_api_key');
    }

    public function setPhones(array $phones): void
    {
        $this->phones = $phones;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @throws PHONESException
     * @throws SMSRUConnectException
     */
    public function send(): void
    {
        $response = Http::get($this->baseUrl, [
            'api_id' => $this->apiKey,
            'to' => $this->phones,
            'msg' => $this->message,
            'json' => 1
        ]);
        $this->checkResponse($response);
    }

    /**
     * @throws PHONESException
     * @throws SMSRUConnectException
     */
    private function checkResponse($response)
    {
        if ($response->status() != 200) {
            throw new SMSRUConnectException('Ошибка соединения с сервером отправки сообщений');
        }
        $jsonResponse = (object)$response->json();
        if ($jsonResponse->status_code != 100) {
            throw new SMSRUConnectException($jsonResponse->status_text);
        }
        $phoneErrors = [];
        foreach ($jsonResponse->sms as $number => $body) {
            $body = (object)$body;
            if ($body->status_code != 100) {
                $phoneErrors[$number] = $body->status_text;
            }
        }
        if ($phoneErrors != []) {
            throw new PHONESException($phoneErrors);
        }
    }
}
