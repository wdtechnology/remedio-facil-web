<?php
namespace Models;

use Core\Model;
use Exception;
use stdClass;
use PHPMailer\PHPMailer\PHPMailer;

class Suporte extends Model
{
    /** @var PHPMailer */
    private $email;

    /** @var stdClass */
    private $subject;
    private $body;
    private $from_name;
    private $from_email;
    private $my_email;
    private $my_name;

    /** @var Exception */
    private $error;

    public function __construct()
    {
        $this->email = new PHPMailer(true);
        $this->email->isSMTP();
        $this->email->CharSet = "utf-8";
        $this->email->setLanguage("br");
        $this->email->Host = MAIL['host'];
        $this->email->SMTPAuth = true;
        $this->email->Username = MAIL['username'];
        $this->email->Password = MAIL['password'];
        $this->email->SMTPSecure = 'ssl';
        $this->email->Port = MAIL['port'];
        $this->email->isHTML(true);
        $this->my_email = MAIL['my_email'];
        $this->my_name = MAIL['my_name'];
    }

    public function adicionar(string $subject, string $body, string $from_name, string $from_email)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->from_name = $from_name;
        $this->from_email = $from_email;
        return $this;
    }

    public function reset(string $subject, string $body, string $from_email)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->from_email = $from_email;
        return $this;
    }

    public function send(): bool
    {
        try {
            $this->email->Subject = $this->subject;
            $this->email->msgHTML($this->body);
            $this->email->addAddress($this->from_email, $this->from_name);
            $this->email->setFrom($this->my_email, $this->my_name);

            $this->email->send();
            return true;
        } catch(Exception $exception) {
            $this->error = $exception;
            return false;
        }
    }
}