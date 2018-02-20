<?php

namespace Store\Toys;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;

class Robots extends Model
{
    public function validation()
    {
        // Year cannot be less than zero
        if ($this->year < 0) {
            $this->appendMessage(
                new Message('The year cannot be less than zero')
            );
        }

        // Check if any messages have been produced
        if ($this->validationHasFailed() === true) {
            return false;
        }


        $validation = new \Phalcon\Validation();
        $validation->add('type', new \Phalcon\Validation\Validator\InclusionIn([
            'domain' => [
                'droid',
                'mechanical',
                'virtual',
            ]
        ]));

        $validation->add('name', new \Phalcon\Validation\Validator\Uniqueness([
            'message' => "The robot name must be unique"
        ]));


        return $this->validate($validation);
    }
}