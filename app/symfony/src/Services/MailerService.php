<?php

namespace App\Services;

use App\Entity\Letter;
use App\Entity\User;
use App\Manager\LetterManager;
use Doctrine\ORM\EntityManagerInterface;

class MailerService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var LetterManager
     */
    private $letterManager;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param LetterManager $letterManager
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        LetterManager $letterManager,
        \Swift_Mailer $mailer
    ) {
        $this->em = $entityManager;
        $this->letterManager = $letterManager;
        $this->mailer = $mailer;
    }

    /**
     * @param string $code
     * @param User $user
     * @param array $bindings
     */
    public function send(string $code, User $user, array $bindings): void
    {
        $letter = $this->letterManager->loadByCode($code);

        if (!$letter instanceof Letter) {
            return;
        }

        $message = new \Swift_Message();

        $message
            ->setSubject($letter->getSubject())
            ->setFrom(['contact@plusdepoint.fr' => 'PLUS DE POINT'])
            ->setTo($user->getUsername())
            ->setBody($this->setBinding($letter->getContent(), $bindings), 'text/html')
        ;

        if ($this->mailer->send($message)) {
            // @TODO: add delivery
        }
    }

    /**
     * @param string $content
     * @param array $bindings
     * @return string
     */
    private function setBinding(string $content, array $bindings): string
    {
        return \str_replace(
            array_map(function ($binding) {
                return '%' . $binding . '%';
            }, array_keys($bindings)),
            array_values($bindings),
            $content
        );
    }
}
