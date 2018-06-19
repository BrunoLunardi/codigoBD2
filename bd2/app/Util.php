<?php

namespace App;

class Util
{
    //funcao de passToArray
  	public function passToArray($row,$attributesArray){
  		$arrayRow = array();

  		foreach ($attributesArray as $aux) {
  			//Reconhece acentuacao e coloca o elemento no final do array
  			array_push($arrayRow,utf8_decode($row[$aux]));
  		}

  		return $arrayRow;
  	}

    //Funcao de exportacao para csv
  	public function exportToCSV($array, $nomeColunas, $fileName, $attributesArray){
  		if(count($array) == 0) return null;//Retorna erro caso array vazio

  		$util = new Util();
  		$output = fopen('php://memory','w');//Cria arquivo

  		fputcsv($output,$nomeColunas,";");//Coloca o nome formatado das colunas

      //Percorre o array imprimindo cada tupla no arquivo
  		foreach($array as $row){
  			fputcsv($output,$util->passToArray($row,$attributesArray),";");
  		}

  		fseek($output,0);//Retorna para o inicio do arquivo

  		header('Content-Type: text/csv; charset=utf-8');//Seta o tipo do arquivo para text/csv e o tipo de formatacao para UTF-8
  		header('Content-Disposition: attachment; filename="'.$fileName.'";');//Seta o arquivo para Download e seta o nome dele

  		fpassthru($output);//Fecha o arquivo
  	}
}

?>
