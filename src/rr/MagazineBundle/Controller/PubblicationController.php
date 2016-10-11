<?php

namespace rr\MagazineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use rr\MagazineBundle\Entity\Pubblication;
use rr\MagazineBundle\Form\PubblicationType;

/**
 * Pubblication controller.
 *
 * @Route("/publication")
 */
class PubblicationController extends Controller
{

    /**
     * Lists all Pubblication entities.
     *
     * @Route("/", name="publication")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('rrMagazineBundle:Pubblication')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pubblication entity.
     *
     * @Route("/", name="publication_create")
     * @Method("POST")
     * @Template("rrMagazineBundle:Pubblication:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pubblication();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('publication_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pubblication entity.
     *
     * @param Pubblication $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pubblication $entity)
    {
        $form = $this->createForm(new PubblicationType(), $entity, array(
            'action' => $this->generateUrl('publication_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pubblication entity.
     *
     * @Route("/new", name="publication_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pubblication();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pubblication entity.
     *
     * @Route("/{id}", name="publication_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('rrMagazineBundle:Pubblication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pubblication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pubblication entity.
     *
     * @Route("/{id}/edit", name="publication_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('rrMagazineBundle:Pubblication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pubblication entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Pubblication entity.
    *
    * @param Pubblication $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pubblication $entity)
    {
        $form = $this->createForm(new PubblicationType(), $entity, array(
            'action' => $this->generateUrl('publication_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pubblication entity.
     *
     * @Route("/{id}", name="publication_update")
     * @Method("PUT")
     * @Template("rrMagazineBundle:Pubblication:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('rrMagazineBundle:Pubblication')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pubblication entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('publication_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pubblication entity.
     *
     * @Route("/{id}", name="publication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('rrMagazineBundle:Pubblication')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pubblication entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('publication'));
    }

    /**
     * Creates a form to delete a Pubblication entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publication_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
