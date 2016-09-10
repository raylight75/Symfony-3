<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use AppBundle\Entity\Orders;
use AppBundle\Form\OrdersType;

use AppBundle\Form\OrdersFilterType;

/**
 * Orders controller.
 *
 * @Route("admin/orders")
 */
class OrdersController extends Controller
{
    /**
     * Lists all Orders entities.
     *
     * @Route("/", name="orders")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Orders')->createQueryBuilder('e');
        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);

        list($orders, $pagerHtml) = $this->paginator($queryBuilder, $request);
        
        return $this->render('orders/index.html.twig', array(
            'orders' => $orders,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),

        ));
    }

    
    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter($queryBuilder, $request)
    {
        $session = $request->getSession();
        $filterForm = $this->createForm('AppBundle\Form\OrdersFilterType');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('OrdersControllerFilter');
        }

        // Filter action
        if ($request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->submit($request->query->get($filterForm->getName()));

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('OrdersControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('OrdersControllerFilter')) {
                $filterData = $session->get('OrdersControllerFilter');
                $filterForm = $this->createForm('AppBundle\Form\OrdersFilterType', $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder, $request)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $request->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('orders', array('page' => $page));
        };

        // Paginator - view
        $view = new TwitterBootstrap3View();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => 'previous',
            'next_message' => 'next',
        ));

        return array($entities, $pagerHtml);
    }
    
    

    /**
     * Displays a form to create a new Orders entity.
     *
     * @Route("/new", name="orders_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
    
        $order = new Orders();
        $form   = $this->createForm('AppBundle\Form\OrdersType', $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            return $this->redirectToRoute('orders_show', array('id' => $order->getId()));
        }
        return $this->render('orders/new.html.twig', array(
            'order' => $order,
            'form'   => $form->createView(),
        ));
    }
    
    

    
    /**
     * Finds and displays a Orders entity.
     *
     * @Route("/{id}", name="orders_show")
     * @Method("GET")
     */
    public function showAction(Orders $order)
    {
        $deleteForm = $this->createDeleteForm($order);
        return $this->render('orders/show.html.twig', array(
            'order' => $order,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Displays a form to edit an existing Orders entity.
     *
     * @Route("/{id}/edit", name="orders_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Orders $order)
    {
        $deleteForm = $this->createDeleteForm($order);
        $editForm = $this->createForm('AppBundle\Form\OrdersType', $order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('orders_edit', array('id' => $order->getId()));
        }
        return $this->render('orders/edit.html.twig', array(
            'order' => $order,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Deletes a Orders entity.
     *
     * @Route("/{id}", name="orders_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Orders $order)
    {
    
        $form = $this->createDeleteForm($order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }
        
        return $this->redirectToRoute('orders');
    }
    
    /**
     * Creates a form to delete a Orders entity.
     *
     * @param Orders $order The Orders entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Orders $order)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orders_delete', array('id' => $order->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Delete Orders by id
     *
     * @param mixed $id The entity id
     * @Route("/delete/{id}", name="orders_by_id_delete")
     * @Method("GET")
     */
    public function deleteById($id){

        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:Orders')->find($id);
        
        if (!$order) {
            throw $this->createNotFoundException('Unable to find Orders entity.');
        }
        
        try {
            $em->remove($order);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } catch (Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('orders'));

    }
    
    
    
    /**
    * Bulk Action
    * @Route("/bulk-action/", name="orders_bulk_action")
    * @Method("POST")
    */
    public function bulkAction(Request $request)
    {
        $ids = $request->get("ids", array());
        $action = $request->get("bulk_action", "delete");

        if ($action == "delete") {
            try {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AppBundle:Orders');

                foreach ($ids as $id) {
                    $order = $repository->find($id);
                    $em->remove($order);
                    $em->flush();
                }

                $this->get('session')->getFlashBag()->add('success', 'orders was deleted successfully!');

            } catch (Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the orders ');
            }
        }

        return $this->redirect($this->generateUrl('orders'));
    }
    
    
}
