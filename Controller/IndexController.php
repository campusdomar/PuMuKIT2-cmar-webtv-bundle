<?php

namespace Pumukit\Cmar\WebTVBundle\Controller;

use Pumukit\Legacy\WebTVBundle\Controller\IndexController as Base;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Base
{
    /**
     * @Route("/", name="pumukit_webtv_index_index")
     * @Template()
     */
    public function indexAction()
    {
        $dm = $this->get('doctrine_mongodb.odm.document_manager');
        $eventRepo = $dm->getRepository('PumukitLiveBundle:Event');
        $event = $eventRepo->findOneByHoursEvent(3);

        $this->get('pumukit_web_tv.breadcrumbs')->reset();
        return array('event' => $event);
    }


    /**
     * @Template("PumukitWebTVBundle:Index:mostviewed.html.twig")
     */
    public function mostviewedlastmonthAction()
    {
        $apcuKey = 'cmar-lastmonth';
        $apcuTTL = 3 * 60 * 60;

        if (extension_loaded('apcu')) {
            $ids = apcu_fetch($apcuKey);
            $dm = $this->get('doctrine_mongodb.odm.document_manager');
            $repo = $dm->getRepository('PumukitSchemaBundle:MultimediaObject');

            $multimediaObjectsSortedByNumview = $repo->findBy(array('_id' => array('$in' => $ids)));

            if ($multimediaObjectsSortedByNumview) {
                return array('multimediaObjectsSortedByNumview' => $multimediaObjectsSortedByNumview);
            }
        }

        $multimediaObjectsSortedByNumview = $this->get('pumukit_stats.stats')->getMostViewedUsingFilters(30, 3);

        if (extension_loaded('apcu')) {
            $ids = array();
            foreach ($multimediaObjectsSortedByNumview as $mm) {
                $ids[] = $mm->getId();
            }

            apcu_store($apcuKey, $ids, $apcuTTL);
        }

        return array('multimediaObjectsSortedByNumview' => $multimediaObjectsSortedByNumview);
    }
}
