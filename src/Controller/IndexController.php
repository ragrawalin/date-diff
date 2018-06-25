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
     * @Route("/", name="datediff_index")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {

        $form = $this->buildForm($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See https://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $dd = new DateDifference();

            echo $dd->getDateDifference($data['fromDate'], $data['toDate']);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView()
            ]);
    }

    /**
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
                'attr' => ['class' => 'js-datepicker', 'autocomplete' => 'off']
            ))
            ->add('toDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker', 'autocomplete' => 'off']
            ))
            ->getForm();

        $form->handleRequest($request);

        return $form;
    }

}