<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mparaiso\User\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

/**
 * Controller managing the user profile
 *
 * @author MParaiso <mparaiso@online.fr>
 */
class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function show()
    {
        $user = $this->app['security.context']->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->app['templating']->renderResponse('FOSUserBundle:Profile:show.html.'.$this->app['fos_user.template.engine'], array('user' => $user));
    }

    /**
     * Edit the user
     */
    public function edit()
    {
        $user = $this->app['security.context']->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->app['fos_user.profile.form'];
        $formHandler = $this->app['fos_user.profile.form.handler'];

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->getRedirectionUrl($user));
        }

        return $this->app['templating']->renderResponse(
            'FOSUserBundle:Profile:edit.html.'.$this->app['fos_user.template.engine'],
            array('form' => $form->createView())
        );
    }

    /**
     * Generate the redirection url when editing is completed.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getRedirectionUrl(UserInterface $user)
    {
        return $this->app['router']->generate('fos_user_profile_show');
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->app['session']->setFlash($action, $value);
    }
}
