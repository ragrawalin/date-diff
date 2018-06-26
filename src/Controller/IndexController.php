<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 24/06/18
 * Time: 7:08 PM
 */

namespace App\Controller;


use App\Util\DateDifference;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{

    /**
     * Displays a form to calculate difference between 2 dates.
     *
     * @Route("/", name="datediff_index")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $difference = -1;

        $form = $this->buildForm($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $dd = new DateDifference();

            $difference = $dd->getDateDifference($data['fromDate'], $data['toDate']);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'difference' => $difference
            ]);
    }

    /**
     * Builds a form which is used to take dates as an input.
     *
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    private function buildForm(Request $request)
    {
        $defaultData = array();

        $form = $this->createFormBuilder($defaultData)
            ->add('fromDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker form-control input-inline datepicker',
                    'autocomplete' => 'off',
                ]
            ))
            ->add('toDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker form-control input-inline datepicker',
                    'autocomplete' => 'off',
                ]
            ))
            ->getForm();

        $form->handleRequest($request);

        return $form;
    }

}