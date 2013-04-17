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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * RESTful controller managing group CRUD
 *
 * @author MParaiso <mparaiso@online.fr>
 */
class GroupController extends BaseController
{
    /**
     * Show all groups
     */
    public function index()
    {
        $groups = $this->app['fos_user.group_manager']->findGroups();

        return $this->app['templating']->renderResponse('FOSUserBundle:Group:list.html.'.$this->getEngine(), array('groups' => $groups));
    }

    /**
     * Show one group
     */
    public function show($groupname)
    {
        $group = $this->findGroupBy('name', $groupname);

        return $this->app['templating']->renderResponse('FOSUserBundle:Group:show.html.'.$this->getEngine(), array('group' => $group));
    }

    /**
     * Edit one group, show the edit form
     */
    public function edit($groupname)
    {
        $group = $this->findGroupBy('name', $groupname);
        $form = $this->app['fos_user.group.form'];
        $formHandler = $this->app['fos_user.group.form.handler'];

        $process = $formHandler->process($group);
        if ($process) {
            $this->setFlash('fos_user_success', 'group.flash.updated');
            $groupUrl =  $this->app['router']->generate('fos_user_group_show', array('groupname' => $group->getName()));

            return new RedirectResponse($groupUrl);
        }

        return $this->app['templating']->renderResponse('FOSUserBundle:Group:edit.html.'.$this->getEngine(), array(
            'form'      => $form->createview(),
            'groupname'  => $group->getName(),
        ));
    }

    /**
     * Show the new form
     */
    public function new_()
    {
        $form = $this->app['fos_user.group.form'];
        $formHandler = $this->app['fos_user.group.form.handler'];

        $process = $formHandler->process();
        if ($process) {
            $this->setFlash('fos_user_success', 'group.flash.created');
            $parameters = array('groupname' => $form->getData('group')->getName());
            $url = $this->app['router']->generate('fos_user_group_show', $parameters);

            return new RedirectResponse($url);
        }

        return $this->app['templating']->renderResponse('FOSUserBundle:Group:new.html.'.$this->getEngine(), array(
            'form' => $form->createview(),
        ));
    }

    /**
     * Delete one group
     */
    public function delete($groupname)
    {
        $group = $this->findGroupBy('name', $groupname);
        $this->app['fos_user.group_manager']->deleteGroup($group);
        $this->setFlash('fos_user_success', 'group.flash.deleted');

        return new RedirectResponse($this->app['router']->generate('fos_user_group_list'));
    }

    /**
     * Find a group by a specific property
     *
     * @param string $key   property name
     * @param mixed  $value property value
     *
     * @throws NotFoundException                    if user does not exist
     * @return \FOS\UserBundle\Model\GroupInterface
     */
    protected function findGroupBy($key, $value)
    {
        if (!empty($value)) {
            $group = $this->app['fos_user.group_manager']->{'findGroupBy'.ucfirst($key)}($value);
        }

        if (empty($group)) {
            throw new NotFoundHttpException(sprintf('The group with "%s" does not exist for value "%s"', $key, $value));
        }

        return $group;
    }

    protected function getEngine()
    {
        return $this->app['fos_user.template.engine'];
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
