<?php
/**
 * Created by PhpStorm.
 * User: alejandro.chavez
 * Date: 2/13/2018
 * Time: 9:18 AM
 */

namespace Store\Toys;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;

class Robots extends Model
{

    public function validation()
    {

        //Type must be: droid, mechanical or virtual
        $this->validate(
            new InclusionIn(
                [
                    'field' => 'type',
                    'domain' => [
                        'droid',
                        'mechanical',
                        'virtual'
                    ],
                ]
            )
        );

        //Robot name must be unique
        $this->validate(
            new Uniqueness(
                [
                    'field' => 'name',
                    'message' => 'the robot name must be unique'
                ]
            )
        );

        //Year cannot be less than zero
        if ($this->year < 0) {
            $this->appendMessage(
                new Message('The year cannot be less than zero')
            );

        }

        //Check if any message have been produced
        if ($this->validationHasFailed() === true) {

            return false;

        }


    }

}