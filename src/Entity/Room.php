<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Teacher>
     */
    #[ORM\ManyToMany(targetEntity: Teacher::class, mappedBy: 'classes')]
    private Collection $teachers;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'room', orphanRemoval: true)]
    private Collection $students;

    /**
     * @var Collection<int, TeachingAssignment>
     */
    #[ORM\OneToMany(targetEntity: TeachingAssignment::class, mappedBy: 'room')]
    private Collection $teachingAssignments;

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->teachingAssignments = new ArrayCollection();
    }

    public function __toString(): string{
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

    /**
     * @return Collection<int, Teacher>
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): static
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers->add($teacher);
            $teacher->addClass($this);
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): static
    {
        if ($this->teachers->removeElement($teacher)) {
            $teacher->removeClass($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): static
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setRoom($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getRoom() === $this) {
                $student->setRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TeachingAssignment>
     */
    public function getTeachingAssignments(): Collection
    {
        return $this->teachingAssignments;
    }

    public function addTeachingAssignment(TeachingAssignment $teachingAssignment): static
    {
        if (!$this->teachingAssignments->contains($teachingAssignment)) {
            $this->teachingAssignments->add($teachingAssignment);
            $teachingAssignment->setRoom($this);
        }

        return $this;
    }

    public function removeTeachingAssignment(TeachingAssignment $teachingAssignment): static
    {
        if ($this->teachingAssignments->removeElement($teachingAssignment)) {
            // set the owning side to null (unless already changed)
            if ($teachingAssignment->getRoom() === $this) {
                $teachingAssignment->setRoom(null);
            }
        }

        return $this;
    }
}
