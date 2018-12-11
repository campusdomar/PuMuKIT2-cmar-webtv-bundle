<?php

namespace Pumukit\Cmar\WebTVBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pumukit\WebTVBundle\Controller\MultimediaObjectController as Base;
use Pumukit\SchemaBundle\Document\MultimediaObject;

class MultimediaObjectController extends Base
{
    /**
     * @param MultimediaObject $multimediaObject
     * @param Request          $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/video/magic/{secret}", name="pumukit_webtv_multimediaobject_magicindex", defaults={"show_hide": true, "track": false})
     * @Template("PumukitWebTVBundle:MultimediaObject:index.html.twig")
     */
    public function magicIndexAction(MultimediaObject $multimediaObject, Request $request)
    {
        return parent::magicIndexAction($multimediaObject, $request);
    }

    public function preExecute(MultimediaObject $multimediaObject, Request $request, $secret = false)
    {
        return null;
    }
}
