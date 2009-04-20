<?php

/*========================*\

 * s_TS
 * Written by: AS
 * Mialto: as@twoja-strona.net
 * Date: 2007-09-07
 *
 * Text To Speech
 * The class reading the text with a human voice.
 * Used: demo synthetizer Ivona.
 * http://www.expressivo.com/ivonaonline.html
 *
 * Version: 2.0 
 * Licencia: Lesser General Public License (LGPL)   
 * 
 * Copyright (C) 2007 Jacek Wloka
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.  

\*========================*/


class s_TS
{

    var $txt = '';
    var $bufor = '';
    var $error = 0;

    /* error file.mp3 */
    var $error_file = 'error.audio';

    /* version old 1 and new 2 */
    var $ver = 2;     

    function s_TS ($text, $language="eng", $limit=390, $max_str_limit=true)
    {

        /******************************/

         /* maxlimit of signs (true or false) I recommend to turn on */ 
         if ($max_str_limit) { 
             $limit = ($limit > 390) ? 390 : $limit;
         }
         $this->txt = @substr(trim(strip_tags($text)), 0, $limit);
         $this->txt .= ' ';

        /*****************************/

        switch ($this->ver) 
        {
            case 1:
             switch ($language)
             {
                 case 'eng':
                  $lang = 'Angielski';
                 break;
                 case 'pl':
                  $lang = 'Polski';
                 break; 
                 default:
                  $lang = 'Angielski';
                 break;
             }
            break;

            default:
             switch ($language)
             {
                 case 'pl_jacek':
                  $lang = 1;
                 break;
                 case 'pl_ewa':
                  $lang = 2;
                 break;
                 case 'eng':
                  $lang = 3;
                 break;
                 case 'rum':
                  $lang = 4;
                 break; 
                 default:
                  $lang = 3;
                 break;
             }
            break; 
        }

        for ($c=0; $c<strlen($this->txt); $c+=0)
        {
             $zajawka = &$this->zajawka($this->txt, $c);
             $num_z = strlen($zajawka);
             if ($num_z == 0)
             {
                 break;
                 if ($c == 0)
                 {
                     $this->error = 1;
                 }
             }   
   
             switch ($this->ver) 
             {
                 case 1:
                  for ($i=0; $i < 2; $i++) 
                  { 
                       $kod = &$this->codeweb ('http://www.expressivo.com/pl/ivonaonline.html',
                                               array("\n", "\r", "\t"), 
                                               array("", "", ""),
                                               "P",
                                               "flashdet=&allowScriptAccess=sameDomain&tresc=".urlencode($zajawka)."&znak=200&IVONA_odczytaj=1&glos=".$lang
                                              );
                  }
                  @preg_match_all('/<a.*?href="http:\/\/www.expressivo.com\/pl\/media\/ivonaonline\/([a-zA-Z0-9]+).mp3".*?>(.*?)<\/a>/i', $kod, $linki);
                  @usleep(300000);
                 break;

                 default:
                  
                       $kod = &$this->codeweb ('http://say.expressivo.com/xivonaonline.php',
                                               array("\n", "\r", "\t"), 
                                               array("", "", ""),
                                               "P",
                                               "xajax=generateVoice&xajaxr=".time()."&xajaxargs[]=pl&xajaxargs[]=".urlencode($zajawka)."&xajaxargs[]=".$lang."&xajaxargs[]=true&xajaxargs[]=1"
                                              );
                  
                  @preg_match_all('/<a(.*?)href="(.*?)".*?>.*?<\/a>/i', $kod, $linki);
                  @usleep(300000);
                 break;
             }

             if ($linki[2][0] == '')
             { 
                 $this->error = 1;
                 break;   
             }
              else
             {
                 $file_mp3[] = $linki[2][0];
             } 
             $c += $num_z;
        }

        if (@is_array($file_mp3))
        {
            foreach ($file_mp3 as $url)
            {                 
                if ($s = @fopen($url, "rb"))
                {
                    while (!feof($s)) 
                    {   
                        $this->bufor .= @fread($s,1024);
                    }
                    @fclose($s);
                } 
                 else 
                {
                    $this->error = 1;
                } 
            } 
        }
         else 
        {
            $this->error = 1;
        }
    }

    function print_bufor ()
    {
        /***/  
        if ($this->error == 1)
        {
            if ($s = @fopen($this->error_file, "rb"))
            {
                while (!feof($s)) 
                {   
                   $this->bufor .= @fread($s,1024);
                }
                @fclose($s);
            } 
        }
        return $this->bufor;            
        /***/ 
    }

    function codeweb ($url, $tag1="", $tag2="", $tryb="GET", $post="") 
    {
        /***/ 
        $ch = @curl_init();
        if ($tryb != "GET") 
        {
            @curl_setopt($ch, CURLOPT_POST, 1);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_HEADER, 0);
        @curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = @curl_exec($ch);
        if (@is_array($tag1) && @is_array($tag2))
        {  
            $data = str_replace($tag1, $tag2, $data);
        }
        if ($data == '') {return false;}  
        return $data; 
        /***/ 
    }

    function zajawka ($t, $o=0, $l=200)
    {
        /***/ 
        if (strlen($t) > $l)
        {
            $t = preg_replace("/\s+(\S+)?$/", "", substr($t, $o, $l));
        }
        return $t;
        /***/ 
    }

}

?>