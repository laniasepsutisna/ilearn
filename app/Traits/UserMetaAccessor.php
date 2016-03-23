<?php

namespace App\Traits;

trait UserMetaAccessor 
{	
    public function getNisAttribute()
    {
        return $this->usermeta->nis;
    }

    public function getJurusanAttribute()
    {
        return $this->usermeta->major_id;
    }

    public function getNisnAttribute()
    {
        return $this->usermeta->nisn;
    }

    public function getAgamaAttribute()
    {
        return $this->usermeta->agama;
    }

    public function getTempatLahirAttribute()
    {
        return $this->usermeta->tempatlahir;
    }

    public function getTanggalLahirAttribute()
    {
        return $this->usermeta->tanggallahir;
    }

    public function getTelpAttribute()
    {
        return $this->usermeta->telp;
    }

    public function getAlamatAttribute()
    {
        return $this->usermeta->alamat;
    }

    public function getOrangTuaAttribute()
    {
        return $this->usermeta->orangtua;
    }

    public function getWaliAttribute()
    {
        return $this->usermeta->wali;
    }

    public function getTelpOrangTuaAttribute()
    {
        return $this->usermeta->telp_orangtua;
    }

    public function getPictureAttribute()
    {
        if ($this->usermeta->picture !== '') {
            return url('/uploads/' . $this->usermeta->picture);
        }
    }

    public function getCoverAttribute()
    {
        if ($this->usermeta->cover !== '') {
            return url('/uploads/' . $this->usermeta->cover);
        }
    }

}