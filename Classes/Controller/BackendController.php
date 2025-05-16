<?php
namespace Skynettechnologies\Allinoneaccessibility\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Security\Context;
use Neos\Neos\Domain\Model\User;
use Neos\Neos\Domain\Repository\UserRepository;

class BackendController extends ActionController
{
    /**
     * @Flow\Inject
     */
    protected \Neos\Flow\Security\Context $securityContext;

    /**
     * @Flow\Inject
     * @var UserRepository
     */
    protected \Neos\Neos\Domain\Repository\UserRepository $userRepository;

    public function indexAction(): void
    {
        $username = '';
        $email = '';

        $account = $this->securityContext->getAccount();
        if ($account !== null) {
            $username = $account->getAccountIdentifier();
            $user = $this->userRepository->findOneByPrimaryAccount($account);
            if ($user !== null) {
                $email = $user->getEmailAddress();
            }
        }
        $this->view->assignMultiple([
            'username' => $username,
            'email' => $email,
        ]);
    }
}


