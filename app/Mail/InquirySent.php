<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Inquiry;

class InquirySent extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $inquiry;
    
    public function __construct($inquiry="test")
    {
        $this->title = "問い合わせ";
        $this->inquiry = $inquiry;
    }

    public function build()
    {
        return $this->view('emails.inquiry_mail')
                ->text('emails.inquiry_mail')
                ->subject($this->title)
                ->with([
                    'inquiry' => $this->inquiry,
                  ]);
        
        //view()メソッドでHTMLメールのビューをセット
        //text()メソッドで平文メールのビューをセット
        //subject()メソッドでメールのタイトルをセット
        //with()メソッドでビューに渡す変数をセット
    }
}
