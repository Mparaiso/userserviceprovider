<?php

use Silex\ServiceProviderInterface;
use Silex\Application;

/**
 * UserServiceProvider
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class UserServiceProvider implements ServiceProviderInterface
{
        
   /**
    * {@inheritDoc}
    *  
    */
    public function boot(Application $app){
        
    }

        
   /**
    * {@inheritDoc}
    *  
    */
    public function register(Application $app){
        
    

    /**
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    $app['fos_user.change_password.form'] = function(Application $app){
                            return  $app['form.factory']->createNamed($app['fos_user.change_password.form.name'], $app['fos_user.change_password.form.type'], NULL, array('validation_groups' => $app['fos_user.change_password.form.validation_groups']));
    		};

    /**
     * @return FOS\UserBundle\Form\Handler\ChangePasswordFormHandler A FOS\UserBundle\Form\Handler\ChangePasswordFormHandler instance.
     */
    $app['fos_user.change_password.form.handler.default'] = function(Application $app){
                            if (!isset($app['request'])) {
            throw new \Exception("Service not Found fos_user.change_password.form.handler.default , request");
        }

        return  $app['request']['fos_user.change_password.form.handler.default'] = new \FOS\UserBundle\Form\Handler\ChangePasswordFormHandler($app['fos_user.change_password.form'], $app['request'], $app['fos_user.user_manager']);
    		};

    /**
     * @return FOS\UserBundle\Form\Type\ChangePasswordFormType A FOS\UserBundle\Form\Type\ChangePasswordFormType instance.
     */
    $app['fos_user.change_password.form.type'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\Type\ChangePasswordFormType();
    		};

    /**
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    $app['fos_user.group.form'] = function(Application $app){
                            return  $app['form.factory']->createNamed($app['fos_user.group.form.name'], $app['fos_user.group.form.type'], NULL, array('validation_groups' => $app['fos_user.group.form.validation_groups']));
    		};

    /**
     * @return FOS\UserBundle\Form\Type\GroupFormType A FOS\UserBundle\Form\Type\GroupFormType instance.
     */
    $app['fos_user.group.form.type'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\Type\GroupFormType($app['fos_user.model.group.class']);
    		};

    /**
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    $app['fos_user.profile.form'] = function(Application $app){
                            return  $app['form.factory']->createNamed($app['fos_user.profile.form.name'], $app['fos_user.profile.form.type'], NULL, array('validation_groups' => $app['fos_user.profile.form.validation_groups']));
    		};

    /**
     * @return FOS\UserBundle\Form\Type\ProfileFormType A FOS\UserBundle\Form\Type\ProfileFormType instance.
     */
    $app['fos_user.profile.form.type'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\Type\ProfileFormType($app['fos_user.model.user.class']);
    		};

    /**
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    $app['fos_user.registration.form'] = function(Application $app){
                            return  $app['form.factory']->createNamed($app['fos_user.registration.form.name'], $app['fos_user.registration.form.type'], NULL, array('validation_groups' => $app['fos_user.registration.form.validation_groups']));
    		};

    /**
     * @return FOS\UserBundle\Form\Type\RegistrationFormType A FOS\UserBundle\Form\Type\RegistrationFormType instance.
     */
    $app['fos_user.registration.form.type'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\Type\RegistrationFormType($app['fos_user.model.user.class']);
    		};

    /**
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    $app['fos_user.resetting.form'] = function(Application $app){
                            return  $app['form.factory']->createNamed($app['fos_user.resetting.form.name'], $app['fos_user.resetting.form.type'], NULL, array('validation_groups' => $app['fos_user.resetting.form.validation_groups']));
    		};

    /**
     * @return FOS\UserBundle\Form\Type\ResettingFormType A FOS\UserBundle\Form\Type\ResettingFormType instance.
     */
    $app['fos_user.resetting.form.type'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\Type\ResettingFormType();
    		};

    /**
     * @return Object A %fos_user.security.interactive_login_listener.class% instance.
     */
    $app['fos_user.security.interactive_login_listener'] = function(Application $app){
                            $class = $app['fos_user.security.interactive_login_listener.class'];

        return  new $class($app['fos_user.user_manager']);
    		};

    /**
     * @return Object A %fos_user.security.login_manager.class% instance.
     */
    $app['fos_user.security.login_manager'] = function(Application $app){
                            $class = $app['fos_user.security.login_manager.class'];

        return  new $class($app['security.context'], $app['security.user_checker'], $app['security.authentication.session_strategy'], $this);
    		};

    /**
     * @return FOS\UserBundle\Form\Type\UsernameFormType A FOS\UserBundle\Form\Type\UsernameFormType instance.
     */
    $app['fos_user.username_form_type'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\Type\UsernameFormType($app['fos_user.user_to_username_transformer']);
    		};

    /**
     * @return FOS\UserBundle\Util\UserManipulator A FOS\UserBundle\Util\UserManipulator instance.
     */
    $app['fos_user.util.user_manipulator'] = function(Application $app){
                            return  new \FOS\UserBundle\Util\UserManipulator($app['fos_user.user_manager']);
    		};

    /**
     * @return Doctrine\ODM\MongoDB\DocumentManager A Doctrine\ODM\MongoDB\DocumentManager instance.
     */
    $app['fos_user.document_manager'] = function(Application $app){
                            return  $app['doctrine_mongodb']->getManager($app['fos_user.model_manager_name']);
    		};

    /**
     * @return Doctrine\ORM\EntityManager A Doctrine\ORM\EntityManager instance.
     */
    $app['fos_user.entity_manager'] = function(Application $app){
                            return  $app['doctrine']->getManager($app['fos_user.model_manager_name']);
    		};

    /**
     * @return FOS\UserBundle\Form\Handler\GroupFormHandler A FOS\UserBundle\Form\Handler\GroupFormHandler instance.
     */
    $app['fos_user.group.form.handler.default'] = function(Application $app){
                            if (!isset($app['request'])) {
            throw new \Exception("Service not Found fos_user.group.form.handler.default , request");
        }

        return  $app['request']['fos_user.group.form.handler.default'] = new \FOS\UserBundle\Form\Handler\GroupFormHandler($app['fos_user.group.form'], $app['request'], $app['fos_user.group_manager']);
    		};

    /**
     * @return Object A %fos_user.group_manager.class% instance.
     */
    $app['fos_user.group_manager.default'] = function(Application $app){
                            $class = $app['fos_user.group_manager.class'];

        return  new $class($app['fos_user.model.group.class']);
    		};

    /**
     * @return FOS\UserBundle\Mailer\Mailer A FOS\UserBundle\Mailer\Mailer instance.
     */
    $app['fos_user.mailer.default'] = function(Application $app){
                            return  new \FOS\UserBundle\Mailer\Mailer($app['mailer'], $app['router'], $app['templating'], array('confirmation.template' => $app['fos_user.registration.confirmation.template'], 'resetting.template' => $app['fos_user.resetting.email.template'], 'from_email' => array('confirmation' => $app['fos_user.registration.confirmation.from_email'], 'resetting' => $app['fos_user.resetting.email.from_email'])));
    		};

    /**
     * @return FOS\UserBundle\Mailer\NoopMailer A FOS\UserBundle\Mailer\NoopMailer instance.
     */
    $app['fos_user.mailer.noop'] = function(Application $app){
                            return  new \FOS\UserBundle\Mailer\NoopMailer();
    		};

    /**
     * @return FOS\UserBundle\Mailer\TwigSwiftMailer A FOS\UserBundle\Mailer\TwigSwiftMailer instance.
     */
    $app['fos_user.mailer.twig_swift'] = function(Application $app){
                            return  new \FOS\UserBundle\Mailer\TwigSwiftMailer($app['mailer'], $app['router'], $app['twig'], array('template' => array('confirmation' => $app['fos_user.registration.confirmation.template'], 'resetting' => $app['fos_user.resetting.email.template']), 'from_email' => array('confirmation' => $app['fos_user.registration.confirmation.from_email'], 'resetting' => $app['fos_user.resetting.email.from_email'])));
    		};

    /**
     * @return FOS\UserBundle\Form\Handler\ProfileFormHandler A FOS\UserBundle\Form\Handler\ProfileFormHandler instance.
     */
    $app['fos_user.profile.form.handler.default'] = function(Application $app){
                            if (!isset($app['request'])) {
            throw new \Exception("Service not Found fos_user.profile.form.handler.default , request");
        }

        return  $app['request']['fos_user.profile.form.handler.default'] = new \FOS\UserBundle\Form\Handler\ProfileFormHandler($app['fos_user.profile.form'], $app['request'], $app['fos_user.user_manager']);
    		};

    /**
     * @return FOS\UserBundle\Form\Handler\RegistrationFormHandler A FOS\UserBundle\Form\Handler\RegistrationFormHandler instance.
     */
    $app['fos_user.registration.form.handler.default'] = function(Application $app){
                            if (!isset($app['request'])) {
            throw new \Exception("Service not Found fos_user.registration.form.handler.default , request");
        }

        return  $app['request']['fos_user.registration.form.handler.default'] = new \FOS\UserBundle\Form\Handler\RegistrationFormHandler($app['fos_user.registration.form'], $app['request'], $app['fos_user.user_manager'], $app['fos_user.mailer'], $app['fos_user.util.token_generator']);
    		};

    /**
     * @return FOS\UserBundle\Form\Handler\ResettingFormHandler A FOS\UserBundle\Form\Handler\ResettingFormHandler instance.
     */
    $app['fos_user.resetting.form.handler.default'] = function(Application $app){
                            if (!isset($app['request'])) {
            throw new \Exception("Service not Found fos_user.resetting.form.handler.default , request");
        }

        return  $app['request']['fos_user.resetting.form.handler.default'] = new \FOS\UserBundle\Form\Handler\ResettingFormHandler($app['fos_user.resetting.form'], $app['request'], $app['fos_user.user_manager']);
    		};

    /**
     * @return FOS\UserBundle\Entity\UserListener A FOS\UserBundle\Entity\UserListener instance.
     */
    $app['fos_user.user_listener'] = function(Application $app){
                            return  new \FOS\UserBundle\Entity\UserListener($this);
    		};

    /**
     * @return FOS\UserBundle\Propel\UserManager A FOS\UserBundle\Propel\UserManager instance.
     */
    $app['fos_user.user_manager.default'] = function(Application $app){
                            return  new \FOS\UserBundle\Propel\UserManager($app['security.encoder_factory'], $app['fos_user.util.username_canonicalizer'], $app['fos_user.util.email_canonicalizer'], $app['fos_user.model.user.class']);
    		};

    /**
     * @return FOS\UserBundle\Security\UserProvider A FOS\UserBundle\Security\UserProvider instance.
     */
    $app['fos_user.user_provider.username'] = function(Application $app){
                            return  new \FOS\UserBundle\Security\UserProvider($app['fos_user.user_manager']);
    		};

    /**
     * @return FOS\UserBundle\Security\EmailUserProvider A FOS\UserBundle\Security\EmailUserProvider instance.
     */
    $app['fos_user.user_provider.username_email'] = function(Application $app){
                            return  new \FOS\UserBundle\Security\EmailUserProvider($app['fos_user.user_manager']);
    		};

    /**
     * @return FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer A FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer instance.
     */
    $app['fos_user.user_to_username_transformer'] = function(Application $app){
                            return  new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($app['fos_user.user_manager']);
    		};

    /**
     * @return FOS\UserBundle\Util\Canonicalizer A FOS\UserBundle\Util\Canonicalizer instance.
     */
    $app['fos_user.util.canonicalizer.default'] = function(Application $app){
                            return  new \FOS\UserBundle\Util\Canonicalizer();
    		};

    /**
     * @return FOS\UserBundle\Util\TokenGenerator A FOS\UserBundle\Util\TokenGenerator instance.
     */
    $app['fos_user.util.token_generator.default'] = function(Application $app){
                            return  new \FOS\UserBundle\Util\TokenGenerator($app['logger']);
    		};

    /**
     * @return FOS\UserBundle\Validator\Initializer A FOS\UserBundle\Validator\Initializer instance.
     */
    $app['fos_user.validator.initializer'] = function(Application $app){
                            return  new \FOS\UserBundle\Validator\Initializer($app['fos_user.user_manager']);
    		};

$app['fos_user.user_manager.class'] = 'FOS\\UserBundle\\Doctrine\\UserManager';
$app['fos_user.group_manager.class'] = 'FOS\\UserBundle\\Propel\\GroupManager';
$app['fos_user.resetting.email.template'] = 'FOSUserBundle:Resetting:email.txt.twig';
$app['fos_user.registration.confirmation.template'] = 'FOSUserBundle:Registration:email.txt.twig';
$app['fos_user.security.interactive_login_listener.class'] = 'FOS\\UserBundle\\Security\\InteractiveLoginListener';
$app['fos_user.security.login_manager.class'] = 'FOS\\UserBundle\\Security\\LoginManager';
$app['fos_user.validator.password.class'] = 'FOS\\UserBundle\\Validator\\PasswordValidator';
$app['fos_user.validator.unique.class'] = 'FOS\\UserBundle\\Validator\\UniqueValidator';
        
    }        
            }
