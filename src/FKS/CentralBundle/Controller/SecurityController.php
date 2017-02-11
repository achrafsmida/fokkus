<?php

namespace FKS\CentralBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\OptionsResolver\Exception\AccessException;

class SecurityController extends BaseController
{
      /**
     * 
     *
     * @Route("admin/login", name="admin_login")
     *
     */
    public function loginAction(Request $request)
    {
        return parent::loginAction($request);
    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
        return $this->render('Security/login.html.twig', $data);
    }
    
     /**
     * 
     *
     * @Route("admin/login-check", name="admin_login_check")
     *
     */
       public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

     /**
     * 
     *
     * @Route("/logout", name="admin_logout")
     *
     */
    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }


}
