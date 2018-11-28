<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace 
Censanet\GetnetBundle\Getnet;

/**
 * Description of MapperJson
 *
 * @author tjamancio
 */
class Json {

    public function mapperJson($json) {

        array_walk_recursive($json, function ($value, $key) {

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        });

        $this->setResponseJSON($json);

        return $this;
    }
    
    public function toJSON() {

        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
    }

}
