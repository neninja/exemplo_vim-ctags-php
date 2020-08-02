<?php

require 'Vo.php';

class Pai extends Vo {
    public function paiMethod(int $paiParam){
        echo $paiParam;
    }
}

class Filho extends Pai {
    public function filhoMethod(int $filhoParam){
        echo $filhoParam;
    }
}

