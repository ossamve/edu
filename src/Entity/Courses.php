<?php

namespace App\Entity;

use App\Repository\CoursesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
/*#[Broadcast]*/
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Assignment>
     */
    #[ORM\OneToMany(targetEntity: Assignment::class, mappedBy: 'course', orphanRemoval: true)]
    private Collection $assignments;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\OneToMany(targetEntity: Ressource::class, mappedBy: 'course')]
    private Collection $ressources;

    /**
     * @var Collection<int, Teacher>
     */
    #[ORM\ManyToMany(targetEntity: Teacher::class, mappedBy: 'courses')]
    private Collection $teachers;

    /**
     * @var Collection<int, TeachingAssignment>
     */
    #[ORM\OneToMany(targetEntity: TeachingAssignment::class, mappedBy: 'cours')]
    private Collection $teachingAssignments;

    public function __construct()
    {
        $this->assignments = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->teachers = new ArrayCollection();
        $this->teachingAssignments = new ArrayCollection();
    }

    public function __toString(): string{
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Assignment>
     */
    public function getAssignments(): Collection
    {
        return $this->assignments;
    }

    public function addAssignment(Assignment $assignment): static
    {
        if (!$this->assignments->contains($assignment)) {
            $this->assignments->add($assignment);
            $assignment->setCourse($this);
        }

        return $this;
    }

    public function removeAssignment(Assignment $assignment): static
    {
        if ($this->assignments->removeElement($assignment)) {
            // set the owning side to null (unless already changed)
            if ($assignment->getCourse() === $this) {
                $assignment->setCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
            $ressource->setCourse($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getCourse() === $this) {
                $ressource->setCourse(null);
            }
        }

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
            $teacher->addCourse($this);
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): static
    {
        if ($this->teachers->removeElement($teacher)) {
            $teacher->removeCourse($this);
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
            $teachingAssignment->setCours($this);
        }

        return $this;
    }

    public function removeTeachingAssignment(TeachingAssignment $teachingAssignment): static
    {
        if ($this->teachingAssignments->removeElement($teachingAssignment)) {
            // set the owning side to null (unless already changed)
            if ($teachingAssignment->getCours() === $this) {
                $teachingAssignment->setCours(null);
            }
        }

        return $this;
    }
    
}
