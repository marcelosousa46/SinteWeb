<?php
namespace App\Classes;

/**
* Classe Destinatário da NFe
*/
class NfeDestinatario
{
	Private $CNPJ
	Private $CPF
	Private $idEstrangeiro
	Private $xNome
	Private $indIEDest
	Private $IE
	Private $ISUF
	Private $IM
	Private $email

	public function getCNPJ()
	{
	    return $this->CNPJ;
	}
	 
	public function setCNPJ($CNPJ)
	{
	    $this->CNPJ = $CNPJ;
	    return $this;
	}

	public function getCPF()
	{
	    return $this->CPF;
	}
	 
	public function setCPF($CPF)
	{
	    $this->CPF = $CPF;
	    return $this;
	}

	public function getIdEstrangeiro()
	{
	    return $this->idEstrangeiro;
	}
	 
	public function setIdEstrangeiro($idEstrangeiro)
	{
	    $this->idEstrangeiro = $idEstrangeiro;
	    return $this;
	}

	public function getXNome()
	{
	    return $this->xNome;
	}
	 
	public function setXNome($xNome)
	{
	    $this->xNome = $xNome;
	    return $this;
	}

	public function getIndIEDest()
	{
	    return $this->indIEDest;
	}
	 
	public function setIndIEDest($indIEDest)
	{
	    $this->indIEDest = $indIEDest;
	    return $this;
	}

	public function getIE()
	{
	    return $this->IE;
	}
	 
	public function setIE($IE)
	{
	    $this->IE = $IE;
	    return $this;
	}

	public function getISUF()
	{
	    return $this->ISUF;
	}
	 
	public function setISUF($ISUF)
	{
	    $this->ISUF = $ISUF;
	    return $this;
	}

	public function getIM()
	{
	    return $this->IM;
	}
	 
	public function setIM($IM)
	{
	    $this->IM = $IM;
	    return $this;
	}

	public function getEmail()
	{
	    return $this->email;
	}
	 
	public function setEmail($email)
	{
	    $this->email = $email;
	    return $this;
	}

}