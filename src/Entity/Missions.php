<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Collections;



/**
 * @ORM\Entity(repositoryClass=MissionsRepository::class)
 * @UniqueEntity(fields={"title"})
 * @UniqueEntity(fields={"code"})
 */
class Missions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $country;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Assert\Type("DateTimeInterface")
     * @Assert\GreaterThanOrEqual("today UTC")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Assert\Type("DateTimeInterface")
     * @Assert\GreaterThanOrEqual(propertyPath="startDate")
     */
    private $endDate;

    /**
     * @ORM\ManyToMany(targetEntity=Agents::class, inversedBy="missions")
     * @Assert\NotBlank
     * @ORM\JoinColumn(nullable=false)
     * @Collections
     */
    private $agents;

    /**
     * @ORM\ManyToOne(targetEntity=Skills::class, inversedBy="missions")
     * @Assert\NotBlank
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("object")
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity=Hideaway::class, inversedBy="missions")
     * @Assert\NotBlank
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("object")
     */
    private $hideaway;

    /**
     * @ORM\ManyToMany(targetEntity=Contacts::class, inversedBy="missions")
     * @Assert\NotBlank
     * @ORM\JoinColumn(nullable=false)
     * @Collections
     */
    private $contacts;

    /**
     * @ORM\ManyToMany(targetEntity=Targets::class, inversedBy="missions")
     * @Assert\NotBlank
     * @ORM\JoinColumn(nullable=false)
     * @Collections
     */
    private $targets;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->targets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|Agents[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agents $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agents $agent): self
    {
        $this->agents->removeElement($agent);

        return $this;
    }

    public function getSkills(): ?Skills
    {
        return $this->skills;
    }

    public function setSkills(?Skills $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getHideaway(): ?Hideaway
    {
        return $this->hideaway;
    }

    public function setHideaway(?Hideaway $hideaway): self
    {
        $this->hideaway = $hideaway;

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection|Targets[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Targets $target): self
    {

        $this->targets[] = $target;

        return $this;
    }

    public function removeTarget(Targets $target): self
    {
        $this->targets->removeElement($target);

        return $this;
    }
}
