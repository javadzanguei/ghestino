<?php

namespace App\Http\Controllers;

use App\Models\CustomerMessage;
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
        'WelcomeCustomer' => "149376",
        'LoginCode' => "83969",
        'AddServiceCase' => "167763",
        'AddLevel' => "88325",
        'SetResult' => "145552",
        'SetNegativeResult' => "145564",
        'Diagnosis' => "109899",
        'InstallmentRequestAlert' => "111703",
        'InstallmentRequestRegister' => "112328",
    ];
    private $statement_patterns = [
        'WelcomeCustomer' => "(0) عزیز، به جمع مشتریان بارسلون خوش آمدید.",
        'LoginCode' => "مرکز فنی بارسلون\n\r" . "(0) عزیز، کد ورود شما (1) است.",
        'AddServiceCase' => "مرکز فنی بارسلون\n\r" . "مشتری عزیز، (0)، درخواست شما با شماره رسید (1) برای کالای (2) ثبت شد.",
        'AddLevel' => "مرکز فنی بارسلون\n\r" . "(0) عزیز، رسید شماره (1) نیاز به تأیید هزینه دارد.\n\r" . "لطفا جهت تأیید، به سامانه مراجعه نمایید.",
        'SetResult' => "مرکز فنی بارسلون\n\r" . "(0) عزیز، کالای شما با شماره درخواست (1) آماده تحویل می‌باشد.\n\r" . "هزینه انجام سرویس (2) تومان شده است. (ارائه قبض جهت تحویل کالا الزامی است)",
        'SetNegativeResult' => "مرکز فنی بارسلون\n\r" . "(0) عزیز، متأسفانه کالای شما با شماره درخواست (1) غیر قابل تعمیر بوده و آماده تحویل می‌باشد.\n\r" . "(ارائه قبض جهت تحویل کالا الزامی است)\n\r",
        'Diagnosis' => "مرکز فنی بارسلون\n\r" . "(0) عزیز، کالای شما با شماره درخواست (1) در حال بررسی فنی و عیب‌یابی می‌باشد.\n\r" . "\n\rاز صبر و شکیبایی شما سپاسگزاریم.",
        'InstallmentRequestRegister' => "سامانه اعتبارسنجی بارسلون\n\r" . "(0) عزیز، درخواست اعتبارسنجی شما ثبت گردید. پس از بررسی، نتیجه آن به اطلاع شما خواهد رسید.\n\r",
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
            if ( $this->pattern === 'AddLevel' ||
                 $this->pattern === 'SetResult' ||
                 $this->pattern === 'SetNegativeResult' ||
                 $this->pattern === 'AddServiceCase' ||
                 $this->pattern === 'Diagnosis' ) {
                $replaceCount = count($this->variables);
                $patterns = [];
                for ($i = 0; $i < $replaceCount; $i++)
                    $patterns[] = '/\(' . $i . '\)/';
                $body = preg_replace($patterns, $this->variables, $this->statement_patterns[$this->pattern]);
                try {
                    CustomerMessage::create([
                        'service_case_id' => $this->case_id,
                        'customer_id' => $this->customer_id,
                        'returned_id' => $sms_result,
                        'text' => $body
                    ]);
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }

        return $sms_result;
    }
}
