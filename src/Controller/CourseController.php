<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Course;
use App\Entity\User;
use App\Entity\UserChapter;
use App\Repository\ChapterRepository;
use App\Repository\CourseRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/course', name: 'app_course_')]
class CourseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CourseRepository $courseRepository): Response
    {
        $course = $courseRepository->findAll();

        return $this->render('course/index.html.twig', [
            'course' => $course,
        ]);
    }
    
    #[Route('/{course}', name: 'show_course')]
    public function showCourse(string $course, CourseRepository $courseRepository, ChapterRepository $chapterRepository): Response
    {
        $course = $courseRepository->findOneBy(['title' => ucfirst(str_replace("-", " ", $course))]);
        $chapters = $course->getChapters();

        $nextChapter = $chapterRepository->findNextChapter($chapters[0]->getId());

        return $this->render('course/course.html.twig', [
            'course' => $course,
            'chapters' => $chapters,
            'nextChapter' => $nextChapter,
        ]);
    }
    
    #[Route('/{course}/{chapter}', name: 'show_chapter')]
    public function showChapter(string $course, string $chapter, CourseRepository $courseRepository, ChapterRepository $chapterRepository): Response
    {
        $course = $courseRepository->findOneBy(['title' => ucfirst(str_replace("-", " ", $course))]);
        $chapter = $chapterRepository->findOneBy(['title' => ucfirst(str_replace("-", " ", $chapter))]);
        $chapters = $course->getChapters();

        $previousChapter = $chapterRepository->findPreviousChapter($chapter->getId());
        $nextChapter = $chapterRepository->findNextChapter($chapter->getId());

        return $this->render('course/course.html.twig', [
            'course' => $course,
            'chapter' => $chapter,
            'chapters' => $chapters,
            'previousChapter' => $previousChapter,
            'nextChapter' => $nextChapter,
        ]);
    }
    
    #[Route('/chapter/{chapterId}/{finished}', name: 'validate_chapter')]
    public function validateChapter(string $chapterId, bool $finished, EntityManagerInterface $entityManager, UserRepository $userRepository, CourseRepository $courseRepository, ChapterRepository $chapterRepository): Response
    {
        if(!$this->getUser()) {
            $this->addFlash('danger', 'Vous devez être connecté pour valider un chapitre !');
            return $this->redirectToRoute('app_login');
        }
        $user = $userRepository->findOneBy(["username" => $this->getUser()->getUserIdentifier()]);
        $chapter = $chapterRepository->find($chapterId);

        if($user instanceof User && $chapter instanceof Chapter) {
            $userChapter = new UserChapter();
            $userChapter->setUser($user);
            $userChapter->setChapter($chapter);
            $userChapter->setFinished($finished);
            $entityManager->persist($userChapter);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Chapitre validé avec succès !');
        return $this->redirectToRoute('app_course_show_course', ['course' => strtolower(str_replace(" ", "-", $chapter->getCourse()->getTitle()))]);
    }
}
