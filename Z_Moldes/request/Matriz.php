<?php

class Matriz
{

    //Retorna a posição onde o valor passado está
    public static function indice_na_matriz($procura, array $array): int
    {
        //pega tamanho do array
        $tamanho_array = count($array);

        $posicao = false; //Armazena a posição da rota a ser chamada dentro array
        ///Percorrer posições do array
        for ($i = 0; $i <  $tamanho_array; $i++) {

            //verificar se valor existe dentro do array e retorna a posição
            if (in_array($procura, $array[$i])) {

                $posicao = $i; //posição em que o valor foi encontrado dentro do array
            }
        }

        return $posicao;
    }

    //Transforma array unidimensional(vetor) em uma string
    public function transformar_in_string(array $array): string
    {
        $string = "";

        //Concatena cada posição do array até formar a string
        for ($i = 0; $i < count($array); $i++) {
            $string =  $string . $array[$i];
        }
        return $string;
    }
}
