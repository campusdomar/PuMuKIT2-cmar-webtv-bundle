<?php

namespace Pumukit\Cmar\WebTVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/utils")
 */
class UtilsController extends Controller
{
    /**
     * @Template()
     *
     * @param bool $opencast
     *
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function userAction($opencast = false)
    {
        $casService = $this->get('pumukit_cmar_web_tv.casservice');
        $casIsAuthenticated = $casService->isAuthenticated();
        $username = '';
        if ($casIsAuthenticated) {
            $username = $casService->getUser();
        }

        $returnedData = array(
            'cas_is_authenticated' => $casIsAuthenticated,
            'cas_username' => $username,
        );

        if ($opencast) {
            return $this->render('PumukitCmarWebTVBundle:Utils:opencast_user.html.twig', $returnedData);
        }

        return $returnedData;
    }

    /**
     * @Route("/login", name="pumukit_cmar_web_tv_utils_login")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function loginAction(Request $request)
    {
        $casService = $this->get('pumukit_cmar_web_tv.casservice');
        $url = $request->server->get('HTTP_REFERER');
        $casService->setFixedServiceURL($url);
        $casService->forceAuthentication();
        if (!in_array($casService->getUser(), array('tv', 'prueba', 'adminmh', 'admin', 'sistemas.uvigo'))) {
            throw $this->createAccessDeniedException('Unable to access this page!');
        }

        return $this->redirect($url);
    }

    /**
     * @Route("/logout", name="pumukit_cmar_web_tv_utils_logout")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logoutAction()
    {
        $casService = $this->get('pumukit_cmar_web_tv.casservice');
        $url = $this->generateUrl('pumukit_webtv_index_index', array(), true);
        $casService->logoutWithRedirectService($url);

        return $this->redirect($url);
    }

    /**
     * @Template("PumukitCmarWebTVBundle::slidebar.html.twig")
     *
     * @return array
     */
    public function menuAction()
    {
        $dm = $this->get('doctrine_mongodb.odm.document_manager');
        $lives = $dm->getRepository('PumukitLiveBundle:Live')->findAll();

        return array('lives' => $lives);
    }
}
