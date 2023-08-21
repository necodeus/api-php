<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class AccountCreationValidator
{
    private array $errors = [];

    private ConstraintViolationListInterface $validation;

    public function __construct(string $email, string $name, string $phone)
    {
        $validator = Validation::createValidator();

        $this->validation = $validator->validate($email, [
            new Constraints\NotBlank(null, 'This field is required'),
            new Constraints\Email(null, 'This field is not a valid email address'),
        ]);

        if (count($this->validation) > 0) {
            $this->errors['email'] = $this->validation->get(0)->getMessage();
        }

        $this->validation = $validator->validate($name, [
            new Constraints\NotBlank(null, 'This field is required'),
            new Constraints\Regex("/^[a-zA-Z\ ]+$/", 'This field is not a valid name. Valid names contain only letters and spaces'),
            new Constraints\Length([
                'min' => 3,
                'max' => 255,
                'minMessage' => 'This field is not a valid name. Valid names are at least {{ limit }} characters long',
                'maxMessage' => 'This field is not a valid name. Valid names are at most {{ limit }} characters long',
            ]),
        ]);

        if (count($this->validation) > 0) {
            $this->errors['name'] = $this->validation->get(0)->getMessage();
        }

        $this->validation = $validator->validate($phone, [
            new Constraints\NotBlank(null, 'This field is required'),
            new Constraints\Regex("/^\\+?[^\n][1-9][0-9]{7,14}$/", 'This field is not a valid phone number'),
        ]);

        if (count($this->validation) > 0) {
            $this->errors['phone'] = $this->validation->get(0)->getMessage();
        }
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrorMessages(): array
    {
        return $this->errors;
    }
}