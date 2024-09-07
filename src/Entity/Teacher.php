<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher extends User
{
    /**
     * @var Collection<int, Courses>
     */
    #[ORM\ManyToMany(targetEntity: Courses::class, inversedBy: 'teachers')]
    private Courses $course;

    /**
     * @var Collection<int, Room>
     */
    #[ORM\ManyToMany(targetEntity: Room::class, inversedBy: 'teachers')]
    private Collection $classes;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    #[ORM\ManyToMany(targetEntity: TeachingAssignment::class, inversedBy: 'teacher')]
    private Collection $assignments;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    /**
     * @return Collection<int, courses>
     */
    public function getCourse(): Collection
    {
        return $this->course;
    }

    public function removeCourse(Courses $course): static
    {
        $this->courses->removeElement($course);

        return $this;
    }

    public function addAssignment(TeachingAssignment $assignment): static
    {
        if (!$this->assignments->contains($assignment)) {
            $this->assignments->add($assignment);
            $assignment->setTeacher($this);
        }

        return $this;
    }

    public function removeAssignement(TeachingAssignment $assignment): static
    {
        if ($this->assignments->removeElement($assignment)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getTeacher() === $this) {
                $teacher->setTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Room $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
        }

        return $this;
    }

    public function removeClass(Room $class): static
    {
        $this->classes->removeElement($class);

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getTeachingAssignment(): ?TeachingAssignment
    {
        return $this->teachingAssignment;
    }

    public function setTeachingAssignment(?TeachingAssignment $teachingAssignment): static
    {
        $this->teachingAssignment = $teachingAssignment;

        return $this;
    }
}
