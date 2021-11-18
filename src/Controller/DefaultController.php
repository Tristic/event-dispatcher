<?php

namespace App\Controller;

use App\Event\ArticlePublicationCreated;
use App\Event\ArticlePublicationUpdated;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(EventDispatcherInterface $dispatcher): Response
    {

        $dispatcher->dispatch(
            new ArticlePublicationCreated([],'publicationCreated', 'hal-9000'),
            ArticlePublicationCreated::NAME
        );

        $dispatcher->dispatch(
            new ArticlePublicationUpdated([],'publicationUpdated', 'hal-9000'),
            ArticlePublicationUpdated::NAME
        );

        return new Response('Hello world');

    }

}