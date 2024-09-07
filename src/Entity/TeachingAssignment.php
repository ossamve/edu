<?php

namespace App\Entity;

use App\Repository\TeachingAssignmentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeachingAssignmentRepository::class)]
class TeachingAssignment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, teacher>
     */
    #[ORM\ManyToOne(inversedBy: 'assignments')]
    private ?Teacher $teacher = null;

    #[ORM\ManyToOne(inversedBy: 'teachingAssignments')]
    private ?Courses $cours = null;

    #[ORM\ManyToOne(inversedBy: 'teachingAssignments')]
    private ?Room $room = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return  teacher
     */
    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): static
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getCours(): ?Courses
    {
        return $this->cours;
    }

    public function setCours(?Courses $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }
}
