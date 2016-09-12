<?php

namespace App;

/**
* Clase para enviar correos 
* 
* @package cloud_manager
* @author Luis Penagos <luispenagos91@gmail.com> 
*/


class Supermail {

    private $subject;

    private $recipient;
   
    private $sender_mail;

    private $encabezado = [];

    private $body = [];


    
    private function set($atributo,$contenido)
    {
      $this->$atributo = $contenido;
    }

    private function get_recipient()
    {
      if (!empty($this->recipient))
      {
        return $this->recipient;
      } 
      else 
      {
        exit('No hay destinatario');
      }      
    }

    private function get_sender()
    {
        if (empty($this->sender_mail))
        {
          $this->sender_mail = "noreply@server3.metin2renacer.com";
        }
        return $this->sender_mail;
    }    

    private function get_header()
    {
      
      if (!empty($this->subject))
      {
        $this->encabezado[] = 'MIME-Version: 1.0';
        $this->encabezado[] = 'Content-type: text/html; charset=UTF-8';
        $this->encabezado[] = 'From: No Reply <'. $this->get_sender() .'>';      
        $this->encabezado[] = 'Reply-To: Recipient Name <'.$this->get_recipient().'>';
        $this->encabezado[] = 'Subject: {'.$this->subject.'}';
        $this->encabezado[] = 'X-Mailer: PHP/'.phpversion();
      } 
      else 
      {
        exit('No se ha establecido un tema');
      }

      return $this->encabezado;
            
    }

    private function get_body($tipo)
    {
        
        switch ($tipo) {
          case 'registro':
            $this->body[] = '<!DOCTYPE html>';
            $this->body[] = '<html lang="es">';
            $this->body[] = '<head>';
            $this->body[] = '  <meta charset="UTF-8">';
            $this->body[] = '  <title>Document</title>';
            $this->body[] = '</head>';
            $this->body[] = '<body>';
            $this->body[] = '';
            $this->body[] = '</body>';
            $this->body[] = '</html>'; 
            break;
          case 'password':
            $this->body[] = '<!DOCTYPE html>';
            $this->body[] = '<html lang="es">';
            $this->body[] = '<head>';
            $this->body[] = '  <meta charset="UTF-8">';
            $this->body[] = '  <title>Document</title>';
            $this->body[] = '</head>';
            $this->body[] = '<body>';
            $this->body[] = '';
            $this->body[] = '</body>';
            $this->body[] = '</html>'; 
            break;
          case 'value':
            $this->body[] = '<!DOCTYPE html>';
            $this->body[] = '<html lang="es">';
            $this->body[] = '<head>';
            $this->body[] = '  <meta charset="UTF-8">';
            $this->body[] = '  <title>Document</title>';
            $this->body[] = '</head>';
            $this->body[] = '<body>';
            $this->body[] = '';
            $this->body[] = '</body>';
            $this->body[] = '</html>'; 
            break;
          default:            
            $this->body[] = '<!DOCTYPE html>';
            $this->body[] = '<html lang="es">';
            $this->body[] = '<head>';
            $this->body[] = '  <meta charset="UTF-8">';
            $this->body[] = '  <title>Document</title>';
            $this->body[] = '</head>';
            $this->body[] = '<body>';
            $this->body[] = '';
            $this->body[] = '</body>';
            $this->body[] = '</html>';             
            break;
        }

        return $this->body;
        
    }

    public function trust_email($recipient,$subject,$sender_mail=null,$tipo=null)
    {
        $this->set('recipient',$recipient);
        $this->set('subject',$subject);
        $this->set('sender_mail',$sender_mail);

        if ($tipo)
        {
          mail ($this->get_recipient(),$this->subject, implode("\r\n", $this->get_body($tipo) ), implode("\r\n", $this->get_header()));            
        }
        
    }

}
