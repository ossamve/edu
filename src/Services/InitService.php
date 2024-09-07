<?php

namespace App\Services;

use App\Entity\Courses;
use App\Entity\Room;
use App\Entity\TypeAssignment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class InitService implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onKernelRequest(KernelEvent $event): void
    {
        $this->init();

    }

    private function init(): void
    {
        $this->initRoom();
        $this->initTypeAssignment();
        $this->initCourses();
    }

    private function initRoom(): void
    {
        $classes = ['6 eme', '5 eme', '4 eme', '3 eme', '2 nde', '1 ere', 'Tle'];

        foreach ($classes as $classe) {
            $existingClass = $this->entityManager->getRepository(Room::class)
                ->findOneBy(['name' => $classe]);

            if (!$existingClass) {
                $newClass = new Room();
                $newClass->setName($classe);
                $this->entityManager->persist($newClass);
            }
        }

    }

    private function initTypeAssignment(): void
    {
        $typeAssignments = ["Cours", "Devoir", "Travaux Diriges", "Travaux Pratiques"];

        foreach ($typeAssignments as $type) {
            $existingType = $this->entityManager->getRepository(TypeAssignment::class)
                ->findOneBy(['name' => $type]);

            if (!$existingType) {
                $newType = new TypeAssignment();
                $newType->setName($type);
                $this->entityManager->persist($newType);
            }
        }

    }

    private function initCourses(): void
    {
        $courses = ['Mathematique', 'Sc. Physiques', 'Francais', 'Anglais', 'SVT', 'Allemand', 'Droit'];

        foreach ($courses as $course) {
            $existingCourse = $this->entityManager->getRepository(Courses::class)
                ->findOneBy(['title' => $course]);

            if (!$existingCourse) {
                $newCourse = new Courses();
                $newCourse->setTitle($course);
                $this->entityManager->persist($newCourse);
            }
        }

    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
