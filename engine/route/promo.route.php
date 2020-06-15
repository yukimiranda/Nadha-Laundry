<?php

class promo extends Route{

    public function index()
    {
        $this -> bind('dasbor/promo/promo');
    }

    public function getDataPromo()
    {
        $dbdata = array();
        $data['dataPromo'] = $this -> state('promoData') -> dataPromo();
        foreach($data['dataPromo'] as $dp){
            $arrTemp['kdPromo'] = $dp['kd_promo'];
            $arrTemp['deks'] = $dp['deks'];
            $arrTemp['diskon'] = $dp['disc'];
            $arrTemp['aktif'] = $dp['aktif'];
            $dbdata[] = $arrTemp;
        }
        $this -> toJson($dbdata);
    }

    public function prosesTambahPromo()
    {
        $kdPromo = $this -> inp('kdPromo');
        $deks = $this -> inp('deks');
        $diskon = $this -> inp('diskon');
        //cek apakah kd promo sudah ada 
        $jlhKode = $this -> state('promoData') -> cekKodePromo($kdPromo);
        if($jlhKode == 1){
            $data['status'] = 'exist';
        }else{
            $this -> state('promoData') -> prosesTambahPromo($kdPromo,$deks,$diskon);
            $data['status'] = 'success';
        }
        $this -> toJson($data);
    }
  

}