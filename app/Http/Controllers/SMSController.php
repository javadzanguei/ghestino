<?php

namespace App\Http\Controllers;

use Melipayamak;

class SMSController extends Controller
{
    private $to;
    private $variables;
    private $pattern;
    private $sms;
    private $case_id;
    private $customer_id;
    private $patterns = [
        'LoginCode' => "183892",
        'InstallmentRequestAlert' => "183902",
        'InstallmentRequestRegister' => "183900",
    ];

    public function __construct(string $pattern, string $to, array $variables, int $case_id = 0, int $customer_id = 0)
    {
        $this->pattern = $pattern;
        $this->to = $to;
        $this->variables = $variables;
        $this->sms = Melipayamak::sms('soap');
        $this->case_id = $case_id;
        $this->customer_id = $customer_id;
    }

    public function send()
    {
        try {
            $sms_result = $this->sms->sendByBaseNumber($this->variables, $this->to, $this->patterns[$this->pattern]);
            if ( !intval($sms_result) ) {
                $sms_result = 'خطا در ارسال پیامک';
                return false;
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }

        return $sms_result;
    }
}
