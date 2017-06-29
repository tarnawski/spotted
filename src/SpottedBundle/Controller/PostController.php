<?php

namespace SpottedBundle\Controller;

use SpottedBundle\Entity\Post;
use SpottedBundle\Entity\Wall;
use SpottedBundle\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class PostController
 */
class PostController extends BaseController
{

    /**
     * @param Request $request
     * @param Wall $wall
     * @return mixed|Response
     * @ParamConverter("wall", class="SpottedBundle\Entity\Wall", options={"mapping":{"wall" = "name"}})
     */
    public function createAction(Request $request, Wall $wall = null)
    {
        if($wall == null) {
            return $this->error([
                'status' => 'Error',
                'message' => 'Wall not found!'
            ], Response::HTTP_BAD_REQUEST);
        }

        $form = $this->createForm(PostType::class);
        $submittedData = json_decode($request->getContent(), true);
        $form->submit($submittedData);

        if (!$form->isValid()) {
            return $this->error($this->getFormErrorsAsArray($form));
        }

        /** @var Post $post */
        $post = $form->getData();
        $post->setWall($wall);
        $post->setCreatedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->success($post, 'post', Response::HTTP_CREATED, [
            'POST_DETAILS'
        ]);
    }
}
