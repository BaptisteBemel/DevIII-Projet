<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 * @UniqueEntity("email", message="Cette adresse mail est déjà utilisée !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="3", max="30", minMessage="Votre nom est trop court => {{ limit }} lettres.", maxMessage="Votre nom est trop long => {{ limit }} lettres.")
     * @Assert\Regex(pattern="/\d/", match=false, message="Votre prénom ne peut contenir de chiffre !")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/\d/", match=false, message="Votre prénom ne peut contenir de chiffre !")
     * @Assert\Length(min="3", max="30", minMessage="Votre nom est trop court {{ limit }} lettres.", maxMessage="Votre nom est trop long => {{ limit }} lettres.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/\w/", message="Votre adresse n'est pas valide !")
     * @Assert\Regex(pattern="/\d/", message="Votre adresse n'est pas valide !")
     * @Assert\Length(min="3", max="30", minMessage="Votre nom est trop court => {{ limit }} lettres.", maxMessage="Votre nom est trop long => {{ limit }} lettres.")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/^\d/", message="Votre numéro ne peut contenir que des chiffres !")
     * @Assert\Regex(pattern="/\d$/", message="Votre numéro ne peut contenir que des chiffres !")
     * @Assert\Length(min="10", minMessage="Votre numéro doit comporter 10 numéros !")
     */
    private $numero_tel;

    /**
     * @ORM\Column(type="text")
     */
    private $situation_scolaire;

    /**
     * @ORM\Column(type="simple_array", length=255)
     */
    private $roles = ['ROLE_USER'];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Veuillez entrer un mot de passe d'au moins 8 caractères !")
     */
    private $password;

    /**
     * 
     *
     * @Assert\EqualTo(propertyPath="password", message="Vos mots de passe ne sont pas identiques !")
     */
    public $confirm_password;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumeroTel(): ?string
    {
        return $this->numero_tel;
    }

    public function setNumeroTel(string $numero_tel): self
    {
        $this->numero_tel = $numero_tel;

        return $this;
    }

    public function getSituationScolaire(): ?string
    {
        return $this->situation_scolaire;
    }

    public function setSituationScolaire(string $situation_scolaire): self
    {
        $this->situation_scolaire = $situation_scolaire;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {   
        
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        


        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    
}
