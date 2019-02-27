<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class GainsVoter extends Voter
{
    const GAINS_VIEW = 'gains_view';
    const GAINS_EDIT = 'gains_edit';

    protected $attributes = [
        self::GAINS_VIEW,
        self::GAINS_EDIT,
    ];

    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authChecker;

    /**
     * @param AuthorizationCheckerInterface $authChecker
     */
    public function __construct(AuthorizationCheckerInterface $authChecker)
    {
        $this->authChecker = $authChecker;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, $this->attributes)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::GAINS_VIEW:
                return $this->canView();
            case self::GAINS_EDIT:
                return $this->canEdit();
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public function canView(): bool
    {
        return $this->authChecker->isGranted('ROLE_USER') || $this->authChecker->isGranted('ROLE_GERANT');
    }

    /**
     * @return bool
     */
    public function canEdit(): bool
    {
        return $this->canView();
    }
}