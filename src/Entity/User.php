<?php

namespace App\Entity;

use App\State\UserProcessor;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table("users")]
#[GetCollection(normalizationContext: ['groups' => ["user_read"]])]
#[Get(normalizationContext: ['groups' => ["user_read"]])]
#[Post(processor: UserProcessor::class, denormalizationContext: ['groups' => ["user_add"]])]
#[Delete]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("user_read")]
    private ?int $id = null;

    /**
     * Prénom de l'utilisateur
     */

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner un prénom", allowNull: false, normalizer: 'trim')]
    #[Assert\Length(
    min: 2,
    max: 255,
    minMessage: "Le prénom doit contenir {{ limit }} caractères minimum",
    maxMessage: "Le prénom doit contenir {{ limit }} caractères maximum"
    )]
    #[Groups(["user_read", "user_add"])]
    private string $firstname;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner un nom", allowNull: false, normalizer: 'trim')]
    #[Assert\Length(
    min: 2,
    max: 255,
    minMessage: "Le nom doit contenir {{ limit }} caractères minimum",
    maxMessage: "Le nom doit contenir {{ limit }} caractères maximum"
    )]
    #[Groups(["user_read", "user_add"])]
    private string $lastname;

    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Groups("user_read")]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Client $client;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}