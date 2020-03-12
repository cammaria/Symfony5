<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $newsletter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }
	
	public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('lastName', new Assert\Length([
            'min' => 2,
            'max' => 50,
			'minMessage' => 'taille.lastName.min',
            'maxMessage' => 'taille.lastName.max'
        ]));
		
		$metadata->addPropertyConstraint('firstName', new Assert\Length([
            'min' => 2,
            'max' => 50,
			'minMessage' => 'Il faut au minimum 2 caractères',
            'maxMessage' => 'Le maximum est de 50 caractères'
        ]));
		
		$metadata->addPropertyConstraint('email', new Assert\Email([
			'message' => "L'email est incorrecte"
		]));
		
		$metadata->addPropertyConstraint('telephone', new Assert\Length([
            'min' => 10,
            'max' => 13,
			'minMessage' => 'Il faut au minimum 10 caractères',
            'maxMessage' => 'Le maximum est de 13 caractères'
        ]));
		
		/*$metadata->addPropertyConstraint('telephone', new Assert\Regex([
			'pattern' => "#/^\+\(0\)[0-9]*$#",
			'message' => 'Caractères invalides'
		]));*/
    }
}
