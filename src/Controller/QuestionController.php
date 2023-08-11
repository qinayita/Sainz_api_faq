<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuestionController extends AbstractController
{
    #[Route('/api/up/{question}', name: 'app_question_up', methods: ['PATCH'])]
    public function score_up(Question $question, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $question->setScore($question->getScore() + 1);
        $em->persist($question);
        $em->flush();

        return $this->json(json_decode($serializer->serialize($question, 'json')));
    }

    #[Route('/api/down/{question}', name: 'app_question_down', methods: ['PATCH'])]
    public function score_down(Question $question, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $question->setScore($question->getScore() - 1);
        $em->persist($question);
        $em->flush();

        return $this->json(json_decode($serializer->serialize($question, 'json')));
    }
}
