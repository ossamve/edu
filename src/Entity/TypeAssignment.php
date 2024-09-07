<?php

namespace App\Entity;

use App\Repository\TypeAssignmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: TypeAssignmentRepository::class)]
#[Broadcast]
class TypeAssignment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, assignment>
     */
    #[ORM\OneToMany(targetEntity: Assignment::class, mappedBy: 'typeAssignment')]
    private Collection $assignment;

    public function __construct()
    {
        $this->assignment = new ArrayCollection();
    }

    public function __toString(){
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, assignment>
     */
    public function getAssignment(): Collection
    {
        return $this->assignment;
    }

    public function addAssignment(Assignment $assignment): static
    {
        if (!$this->assignment->contains($assignment)) {
            $this->assignment->add($assignment);
            $assignment->setTypeAssignment($this);
        }

        return $this;
    }

    public function removeAssignment(Assignment $assignment): static
    {
        if ($this->assignment->removeElement($assignment)) {
            // set the owning side to null (unless already changed)
            if ($assignment->getTypeAssignment() === $this) {
                $assignment->setTypeAssignment(null);
            }
        }

        return $this;
    }
}
