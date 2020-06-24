<?php

        //Parsing PARAMETRI
         global $CFG, $DB;
        /*$codcorso                     = $_SERVER['HTTP_shib_codcorsostudiostud'];
        if(strlen($codcorso)==0)
                $codcorso               = $_SERVER['shib_codcorsostudiostud'];
        /*$tax                          = $_SERVER['HTTP_SHIB_TAX'];
        if(strlen($tax)==0)
                $tax                    = $_SERVER['SHIB_TAX'];
        $password                       = $_SERVER['HTTP_SHIB_PERSON_PASSWORD'];
        if(strlen($password)==0)
                $password                       = $_SERVER['SHIB_PERSON_PASSWORD'];
        $statoiscrizione        = $_SERVER['HTTP_SHIB_TIPODIISCRIZIONE'];
        if(strlen($statoiscrizione)==0)
                $statoiscrizione        = $_SERVER['SHIB_TIPODIISCRIZIONE'];*/
        //$email                                = $_SERVER['HTTP_shib_id'];
        //if(strlen($email)==0)

                $email                          = $_SERVER['shib_id'];
                if($DB->get_field('user','id',array('username'=>$email)))
                $userid =  $DB->get_field('user','username',array('username'=>$email));
                else {
                        $userid =$_SERVER['shib_id'];
                }
        if (strpos($_SERVER['shib_id'], "unipd.it")>-1){
        //$matricola                    = $_SERVER['HTTP_shib_matricolastud'];
        //if(strlen($matricola)==0)
        //      $matricola                      = $_SERVER['shib_matricolastud'];
        //$matricoladip       = $_SERVER['HTTP_shib_matricoladip'];
        //if(strlen($matricoladip)==0)
        //      $matricoladip           = $_SERVER['shib_matricoladip'];
        //dati per redirect
        /*$firstname                    = $_SERVER['HTTP_shib_givenname'];
        if(strlen($firstname)==0)
                $firstname                      = $_SERVER['shib_givenname'];
        $lastname                       = $_SERVER['HTTP_shib_sn'];
        if(strlen($lastname)==0)
                $lastname                       = $_SERVER['shib_sn'];  */


                //$result['address'] = str_replace(';', '-', $_SERVER['shib_librettostud']);
                //Se è studente  uso matricola altrimenti........
                if (strpos($_SERVER['shib_id'], "studenti")>-1){
                //if($_SERVER['shib_librettostud'])
                //$DB->set_field('user','institution',$_SERVER['shib_librettostud'],array('id'=>$userid));
                if($_SERVER['shib_matricolastud']=="")
                $DB->set_field('user','idnumber',"non presente",array('id'=>$userid));
                else{
                $DB->set_field('user','idnumber',$_SERVER['shib_matricolastud'],array('id'=>$userid));
                //$DB->set_field('user','department',$_SERVER['corsostudiostud'],array('id'=>$userid));
                }
                }
                else{
                if($_SERVER['shib_matricoladip'])
                $DB->set_field('user','idnumber',$_SERVER['shib_matricoladip'],array('id'=>$userid));
                else{
                $DB->set_field('user','idnumber',"non presente",array('id'=>$userid));}
                //$DB->set_field('user','idnumber',$_SERVER['shib_matricolastud'],array('id'=>$userid));

                //$DB->set_field('user','department',"",array('id'=>$userid));
                }
        }
        else
        {
                $DB->set_field('user','firstname',$_SERVER['spid_name'],array('id'=>$userid));
                $DB->set_field('user','lastname',$_SERVER['spid_familyName'],array('id'=>$userid));
                $DB->set_field('user','email',$_SERVER['spid_email'],array('id'=>$userid));
                $DB->set_field('user','idnumber',$_SERVER['spid_fiscalNumber'],array('id'=>$userid));
        }
?>
