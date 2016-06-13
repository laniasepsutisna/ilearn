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

    public function getBioAttribute()
    {
        return $this->usermeta->bio;
    }

    public function getPictureSmAttribute()
    {
        if ($this->usermeta->picture !== '') {
            return url('/uploads/45x45-' . $this->usermeta->picture);
        }
    }

    public function getPictureMdAttribute()
    {
        if ($this->usermeta->picture !== '') {
            return url('/uploads/120x120-' . $this->usermeta->picture);
        }
    }

    public function getCoverAttribute()
    {
        if ($this->usermeta->cover !== '') {
            return url('/uploads/' . $this->usermeta->cover);
        }
    }

    public function getCoverSmAttribute()
    {
        if ($this->usermeta->cover !== '') {
            return url('/uploads/253x190-' . $this->usermeta->cover);
        }
    }

}