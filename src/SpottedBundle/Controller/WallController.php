<?php

namespace SpottedBundle\Controller;

use SpottedBundle\Entity\Wall;
use SpottedBundle\Form\Type\WallType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Class WallController
 */
class WallController extends BaseController
{

    /**
     * @param $wall
     * @return Response
     * @ParamConverter("wall", class="SpottedBundle\Entity\Wall", options={"mapping":{"wall" = "name"}})
     */
    public function indexAction(Wall $wall = null)
    {
        if($wall == null) {
            return $this->error([
                'status' => 'Error',
                'message' => 'Wall not found!'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->success($wall, 'wall', Response::HTTP_OK, [
            'WALL_DETAILS',
            'POST_DETAILS'
        ]);
    }

    /**
     * @param Request $request
     * @return mixed|Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(WallType::class);
        $submittedData = json_decode($request->getContent(), true);
        $form->submit($submittedData);

        if (!$form->isValid()) {
            return $this->error($this->getFormErrorsAsArray($form));
        }

        /** @var Wall $wall */
        $wall = $form->getData();
        $wall->setCreatedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($wall);
        $em->flush();

        return $this->success($wall, 'wall', Response::HTTP_CREATED, [
            'WALL_DETAILS',
            'POST_DETAILS'
        ]);
    }
}
