<?php

namespace Mparaiso\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

/**
 * UserServiceProvider
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class UserServiceProvider implements ServiceProviderInterface {

    /**
     * {@inheritDoc}
     *  
     */
    public function boot(Application $app) {

        // template engine
        $app['fos_user.template.engine'] = function() {
                    return "twig";
                };

        $app['templating'] = $app->share(function($app) {
                    return new \Symfony\Bundle\TwigBundle\TwigEngine($app['twig'], new \Mparaiso\User\Utils\SilexTemplateNameParser(), new \Symfony\Component\Config\FileLocator($app['twig.path']));
                }
        );
        // FR : définition des controllers , EN : Controller definitions
        $app['FOSUserBundle.Security'] = $app->share(function($app) {
                    $service = new \Mparaiso\User\Controller\SecurityController;
                    $service->setApp($app);
                    return $service;
                });
        $app['FOSUserBundle.ChangePassword'] = $app->share(function($app) {
                    $service = new \Mparaiso\User\Controller\ChangePasswordController;
                    $service->setApp($app);
                    return $service;
                });
        $app['FOSUserBundle.Registration'] = $app->share(function($app) {
                    $service = new \Mparaiso\User\Controller\RegistrationController;
                    $service->setApp($app);
                    return $service;
                });
        $app['FOSUserBundle.Profile'] = $app->share(function($app) {
                    $service = new \Mparaiso\User\Controller\ProfileController;
                    $service->setApp($app);
                    return $service;
                });
        /** FR : installation des resources de traduction 
         *  EN : translator resource configuration
         */
        $app['fos_user.translator.resources'] = __DIR__ . '/../User/Resources/translations/';

        $app['translator'] = $app->share($app->extend("translator", function($trans, $app) {
                            $getLocale = function($string) {
                                        /**
                                         * FR : retourne le suffix du locale , ex : pour file.en.yml  , le locale est en 
                                         * EN : returns the file locale given its filename 
                                         */
                                        preg_match("#^\w+\.(?P<locale>\w+)\.\w+$#", $string, $matches);
                                        return $matches['locale'];
                                    };
                            $trans->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());/** add yaml translation loader * */
                            $finder = new \Symfony\Component\Finder\Finder();
                            $finder->files()->name('*.yml')->in($app['fos_user.translator.resources']);/** find yaml files * */
                            /** for each file , if file is a validation resource , add to validation , else add to FOS namespace * */
                            foreach ($finder as $file) {
                                if (preg_match("#validation#", $file->getFilename())) {
                                    $locale = $getLocale($file->getFilename());
                                    $trans->addResource('yaml', $file->getRealPath(), $locale, "validation");
                                } else {
                                    $locale = $getLocale($file->getFilename());
                                    $trans->addResource('yaml', $file->getRealPath(), $locale, "FOSUserBundle");
                                }
                            }
                            return $trans;
                        }
                )
        );
        /** twig * */
        $app['fos_user.template_path'] = __DIR__ . '/../User/Resources/views';
        $app['twig.loader.filesystem'] = $app->extend("twig.loader.filesystem", function($loader, $app) {
                    $loader->addPath($app['fos_user.template_path']); // FR: ajouter le répertoire des templates FOS à TWIG
                    return $loader;
                }
        );
        /* validator */
        $app['fos_user.validaion.resource'] = __DIR__ . '/../User/Resources/config/validation.xml';
    }

    /**
     * {@inheritDoc}
     *  
     */
    public function register(Application $app) {


        /**
         * Service is shared
         * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
         */
        $app['fos_user.change_password.form'] = $app->share(function(Application $app) {
                    return $app['form.factory']->createNamed($app['fos_user.change_password.form.name'], $app['fos_user.change_password.form.type'], NULL, array('validation_groups' => $app['fos_user.change_password.form.validation_groups']));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Handler\ChangePasswordFormHandler A FOS\UserBundle\Form\Handler\ChangePasswordFormHandler instance.
         */
        $app['fos_user.change_password.form.handler.default'] = $app->share(function(Application $app) {
                    if (!isset($app['request'])) {
                        throw new \Exception("Service not Found \"request\" for \"fos_user.change_password.form.handler.default\" ");
                    }

                    return /* $app['request']['fos_user.change_password.form.handler.default'] = */ new \FOS\UserBundle\Form\Handler\ChangePasswordFormHandler($app['fos_user.change_password.form'], $app['request'], $app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Type\ChangePasswordFormType A FOS\UserBundle\Form\Type\ChangePasswordFormType instance.
         */
        $app['fos_user.change_password.form.type'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\Type\ChangePasswordFormType();
                });

        /**
         * Service is shared
         * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
         */
        $app['fos_user.group.form'] = $app->share(function(Application $app) {
                    return $app['form.factory']->createNamed($app['fos_user.group.form.name'], $app['fos_user.group.form.type'], NULL, array('validation_groups' => $app['fos_user.group.form.validation_groups']));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Type\GroupFormType A FOS\UserBundle\Form\Type\GroupFormType instance.
         */
        $app['fos_user.group.form.type'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\Type\GroupFormType($app['fos_user.model.group.class']);
                });

        /**
         * Service is shared
         * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
         */
        $app['fos_user.profile.form'] = $app->share(function(Application $app) {
                    return $app['form.factory']->createNamed($app['fos_user.profile.form.name'], $app['fos_user.profile.form.type'], NULL, array('validation_groups' => $app['fos_user.profile.form.validation_groups']));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Type\ProfileFormType A FOS\UserBundle\Form\Type\ProfileFormType instance.
         */
        $app['fos_user.profile.form.type'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\Type\ProfileFormType($app['fos_user.model.user.class']);
                });

        /**
         * Service is shared
         * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
         */
        $app['fos_user.registration.form'] = $app->share(function(Application $app) {
                    return $app['form.factory']->createNamed($app['fos_user.registration.form.name'], $app['fos_user.registration.form.type'], NULL, array('validation_groups' => $app['fos_user.registration.form.validation_groups']));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Type\RegistrationFormType A FOS\UserBundle\Form\Type\RegistrationFormType instance.
         */
        $app['fos_user.registration.form.type'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\Type\RegistrationFormType($app['fos_user.model.user.class']);
                });

        /**
         * Service is shared
         * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
         */
        $app['fos_user.resetting.form'] = $app->share(function(Application $app) {
                    return $app['form.factory']->createNamed($app['fos_user.resetting.form.name'], $app['fos_user.resetting.form.type'], NULL, array('validation_groups' => $app['fos_user.resetting.form.validation_groups']));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Type\ResettingFormType A FOS\UserBundle\Form\Type\ResettingFormType instance.
         */
        $app['fos_user.resetting.form.type'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\Type\ResettingFormType();
                });

        /**
         * Service is shared
         * @return Object A %fos_user.security.interactive_login_listener.class% instance.
         */
        $app['fos_user.security.interactive_login_listener'] = $app->share(function(Application $app) {
                    $class = $app['fos_user.security.interactive_login_listener.class'];

                    return new $class($app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return Object A %fos_user.security.login_manager.class% instance.
         */
        $app['fos_user.security.login_manager'] = $app->share(function(Application $app) {
                    $class = $app['fos_user.security.login_manager.class'];

                    return new $class($app['security'], $app['security.user_checker'], $app['security.authentication.session_strategy'], $this);
                    // return new $class($app['security.context'], $app['security.user_checker'], $app['security.authentication.session_strategy'], $this);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Type\UsernameFormType A FOS\UserBundle\Form\Type\UsernameFormType instance.
         */
        $app['fos_user.username_form_type'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\Type\UsernameFormType($app['fos_user.user_to_username_transformer']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Util\UserManipulator A FOS\UserBundle\Util\UserManipulator instance.
         */
        $app['fos_user.util.user_manipulator'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Util\UserManipulator($app['fos_user.user_manager.default']);
                });

        /**
         * Gets the fos_user.change_password.form.handler service alias.
         *
         * @return FOS\UserBundle\Form\Handler\ChangePasswordFormHandler An instance of the fos_user.change_password.form.handler.default service
         */
        $app['fos_user.change_password.form.handler'] = function($app) {
                    return $app['fos_user.change_password.form.handler.default'];
                };

        /**
         * Gets the fos_user.mailer service alias.
         *
         * @return FOS\UserBundle\Mailer\Mailer An instance of the fos_user.mailer.default service
         */
        $app['fos_user.mailer'] = function($app) {
                    return $app['fos_user.mailer.default'];
                };

        /**
         * Gets the fos_user.profile.form.handler service alias.
         *
         * @return FOS\UserBundle\Form\Handler\ProfileFormHandler An instance of the fos_user.profile.form.handler.default service
         */
        $app['fos_user.profile.form.handler'] = function($app) {
                    return $app['fos_user.profile.form.handler.default'];
                };

        /**
         * Gets the fos_user.registration.form.handler service alias.
         *
         * @return FOS\UserBundle\Form\Handler\RegistrationFormHandler An instance of the fos_user.registration.form.handler.default service
         */
        $app['fos_user.registration.form.handler'] = function($app) {
                    return $app['fos_user.registration.form.handler.default'];
                };

        /**
         * Gets the fos_user.resetting.form.handler service alias.
         *
         * @return FOS\UserBundle\Form\Handler\ResettingFormHandler An instance of the fos_user.resetting.form.handler.default service
         */
        $app['fos_user.resetting.form.handler'] = function($app) {
                    return $app['fos_user.resetting.form.handler.default'];
                };

        /**
         * Gets the fos_user.user_manager service alias.
         *
         * @return FOS\UserBundle\Doctrine\UserManager An instance of the fos_user.user_manager.default service
         */
        $app['fos_user.user_manager'] = function($app) {
                    return $app['fos_user.user_manager.default'];
                };

        /**
         * Gets the fos_user.util.email_canonicalizer service alias.
         *
         * @return FOS\UserBundle\Util\Canonicalizer An instance of the fos_user.util.canonicalizer.default service
         */
        $app['fos_user.util.email_canonicalizer'] = function($app) {
                    return $app['fos_user.util.canonicalizer.default'];
                };

        /**
         * Gets the fos_user.util.token_generator service alias.
         *
         * @return FOS\UserBundle\Util\TokenGenerator An instance of the fos_user.util.token_generator.default service
         */
        $app['fos_user.util.token_generator'] = function($app) {
                    return $app['fos_user.util.token_generator.default'];
                };

        /**
         * Gets the fos_user.util.username_canonicalizer service alias.
         *
         * @return FOS\UserBundle\Util\Canonicalizer An instance of the fos_user.util.canonicalizer.default service
         */
        $app['fos_user.util.username_canonicalizer'] = function($app) {
                    return $app['fos_user.util.canonicalizer.default'];
                };

        /**
         * Service is shared
         * @return Doctrine\ODM\MongoDB\DocumentManager A Doctrine\ODM\MongoDB\DocumentManager instance.
         */
        $app['fos_user.document_manager'] = $app->share(function(Application $app) {
                    return $app['doctrine_mongodb']->getManager($app['fos_user.model_manager_name']);
                });

        /**
         * Service is shared
         * @return Doctrine\ORM\EntityManager A Doctrine\ORM\EntityManager instance.
         */
        $app['fos_user.entity_manager'] = $app->share(function(Application $app) {
                    return $app['doctrine']->getManager($app['fos_user.model_manager_name']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Handler\GroupFormHandler A FOS\UserBundle\Form\Handler\GroupFormHandler instance.
         */
        $app['fos_user.group.form.handler.default'] = $app->share(function(Application $app) {
                    if (!isset($app['request'])) {
                        throw new \Exception("Service not Found \"request\" for \"fos_user.group.form.handler.default\" ");
                    }

                    return /* $app['request']['fos_user.group.form.handler.default'] = */new \FOS\UserBundle\Form\Handler\GroupFormHandler($app['fos_user.group.form'], $app['request'], $app['fos_user.group_manager']);
                });

        /**
         * Service is shared
         * @return Object A %fos_user.group_manager.class% instance.
         */
        $app['fos_user.group_manager.default'] = $app->share(function(Application $app) {
                    $class = $app['fos_user.group_manager.class'];

                    return new $class($app['fos_user.model.group.class']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Mailer\Mailer A FOS\UserBundle\Mailer\Mailer instance.
         */
        $app['fos_user.mailer.default'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Mailer\Mailer($app['mailer'], $app['router'], $app['templating'], array('confirmation.template' => $app['fos_user.registration.confirmation.template'], 'resetting.template' => $app['fos_user.resetting.email.template'], 'from_email' => array('confirmation' => $app['fos_user.registration.confirmation.from_email'], 'resetting' => $app['fos_user.resetting.email.from_email'])));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Mailer\NoopMailer A FOS\UserBundle\Mailer\NoopMailer instance.
         */
        $app['fos_user.mailer.noop'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Mailer\NoopMailer();
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Mailer\TwigSwiftMailer A FOS\UserBundle\Mailer\TwigSwiftMailer instance.
         */
        $app['fos_user.mailer.twig_swift'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Mailer\TwigSwiftMailer($app['mailer'], $app['router'], $app['twig'], array('template' => array('confirmation' => $app['fos_user.registration.confirmation.template'], 'resetting' => $app['fos_user.resetting.email.template']), 'from_email' => array('confirmation' => $app['fos_user.registration.confirmation.from_email'], 'resetting' => $app['fos_user.resetting.email.from_email'])));
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Handler\ProfileFormHandler A FOS\UserBundle\Form\Handler\ProfileFormHandler instance.
         */
        $app['fos_user.profile.form.handler.default'] = $app->share(function(Application $app) {
                    if (!isset($app['request'])) {
                        throw new \Exception("Service not Found \"request\" for \"fos_user.profile.form.handler.default\" ");
                    }

                    return /* $app['request']['fos_user.profile.form.handler.default'] = */ new \FOS\UserBundle\Form\Handler\ProfileFormHandler($app['fos_user.profile.form'], $app['request'], $app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Handler\RegistrationFormHandler A FOS\UserBundle\Form\Handler\RegistrationFormHandler instance.
         */
        $app['fos_user.registration.form.handler.default'] = $app->share(function(Application $app) {
                    if (!isset($app['request'])) {
                        throw new \Exception("Service not Found \"request\" for \"fos_user.registration.form.handler.default\" ");
                    }

                    return /* $app['request']['fos_user.registration.form.handler.default'] = */new \FOS\UserBundle\Form\Handler\RegistrationFormHandler($app['fos_user.registration.form'], $app['request'], $app['fos_user.user_manager.default'], $app['fos_user.mailer.default'], $app['fos_user.util.token_generator.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\Handler\ResettingFormHandler A FOS\UserBundle\Form\Handler\ResettingFormHandler instance.
         */
        $app['fos_user.resetting.form.handler.default'] = $app->share(function(Application $app) {
                    if (!isset($app['request'])) {
                        throw new \Exception("Service not Found \"request\" for \"fos_user.resetting.form.handler.default\" ");
                    }

                    return /* $app['request']['fos_user.resetting.form.handler.default'] = */ new \FOS\UserBundle\Form\Handler\ResettingFormHandler($app['fos_user.resetting.form'], $app['request'], $app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Entity\UserListener A FOS\UserBundle\Entity\UserListener instance.
         */
        $app['fos_user.user_listener'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Entity\UserListener($this);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Doctrine\UserManager A FOS\UserBundle\Doctrine\UserManager instance.
         */
        $app['fos_user.user_manager.default'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Doctrine\UserManager($app['security.encoder_factory'], $app['fos_user.util.canonicalizer.default'], $app['fos_user.util.canonicalizer.default'], $app['fos_user.entity_manager'], $app['fos_user.model.user.class']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Security\UserProvider A FOS\UserBundle\Security\UserProvider instance.
         */
        $app['fos_user.user_provider.username'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Security\UserProvider($app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Security\EmailUserProvider A FOS\UserBundle\Security\EmailUserProvider instance.
         */
        $app['fos_user.user_provider.username_email'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Security\EmailUserProvider($app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer A FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer instance.
         */
        $app['fos_user.user_to_username_transformer'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($app['fos_user.user_manager.default']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Util\Canonicalizer A FOS\UserBundle\Util\Canonicalizer instance.
         */
        $app['fos_user.util.canonicalizer.default'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Util\Canonicalizer();
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Util\TokenGenerator A FOS\UserBundle\Util\TokenGenerator instance.
         */
        $app['fos_user.util.token_generator.default'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Util\TokenGenerator($app['logger']);
                });

        /**
         * Service is shared
         * @return FOS\UserBundle\Validator\Initializer A FOS\UserBundle\Validator\Initializer instance.
         */
        $app['fos_user.validator.initializer'] = $app->share(function(Application $app) {
                    return new \FOS\UserBundle\Validator\Initializer($app['fos_user.user_manager.default']);
                });

        $app['fos_user.user_manager.class'] = 'FOS\\UserBundle\\Doctrine\\UserManager';
        $app['fos_user.group_manager.class'] = 'FOS\\UserBundle\\Propel\\GroupManager';
        $app['fos_user.resetting.email.template'] = 'FOSUserBundle:Resetting:email.txt.twig';
        $app['fos_user.registration.confirmation.template'] = 'FOSUserBundle:Registration:email.txt.twig';
        $app['fos_user.security.interactive_login_listener.class'] = 'FOS\\UserBundle\\Security\\InteractiveLoginListener';
        $app['fos_user.security.login_manager.class'] = 'FOS\\UserBundle\\Security\\LoginManager';
        $app['fos_user.validator.password.class'] = 'FOS\\UserBundle\\Validator\\PasswordValidator';
        $app['fos_user.validator.unique.class'] = 'FOS\\UserBundle\\Validator\\UniqueValidator';
        $app['fos_user.storage'] = 'orm';
        $app['fos_user.firewall_name'] = 'main';
        $app['fos_user.model_manager_name'] = NULL;
        $app['fos_user.model.user.class'] = 'Acme\\UserBundle\\Entity\\User';
        $app['fos_user.template.engine'] = 'twig';
        //$app['fos_user.profile.form.type'] = 'fos_user_profile';
        $app['fos_user.profile.form.name'] = 'fos_user_profile_form';
        $app['fos_user.profile.form.validation_groups'] = array(
            0 => 'Profile',
            1 => 'Default',
        );
        $app['fos_user.registration.confirmation.from_email'] = array(
            'webmaster@example.com' => 'webmaster',
        );
        $app['fos_user.registration.confirmation.enabled'] = FALSE;
        //$app['fos_user.registration.form.type'] = 'fos_user_registration';
        $app['fos_user.registration.form.name'] = 'fos_user_registration_form';
        $app['fos_user.registration.form.validation_groups'] = array(
            0 => 'Registration',
            1 => 'Default',
        );
        //$app['fos_user.change_password.form.type'] = 'fos_user_change_password';
        $app['fos_user.change_password.form.name'] = 'fos_user_change_password_form';
        $app['fos_user.change_password.form.validation_groups'] = array(
            0 => 'ChangePassword',
            1 => 'Default',
        );
        $app['fos_user.resetting.email.from_email'] = array(
            'webmaster@example.com' => 'webmaster',
        );
        $app['fos_user.resetting.token_ttl'] = 86400;
        //$app['fos_user.resetting.form.type'] = 'fos_user_resetting';
        $app['fos_user.resetting.form.name'] = 'fos_user_resetting_form';
        $app['fos_user.resetting.form.validation_groups'] = array(
            0 => 'ResetPassword',
            1 => 'Default',
        );
    }

}

