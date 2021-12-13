<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use Doctrine\Common\Persistance\ObjectManager1;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\FootEquipement;
use App\DataFixtures\FootFixtures;
use App\Repository\FootEquipementRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LuckyController extends AbstractController
{
 /**
    * @Route("/equipement/", name="blog_show")   
    */
    public function create(Request $request):Response {

        $nom= "oumy"; 

        $footEquipement = new FootEquipement();
        

        $form = $this->createFormBuilder($footEquipement)
            ->add('name', TextType::class, )
            ->add('Marque', TextType::class,)
            ->add('Prix', TextType::class,)
            ->add('Description', TextareaType::class, )
            ->add('quantite', TextType::class,)
            ->add('Enregistrer', SubmitType::class, )
            ->getForm();

            $form->handleRequest($request);
           // dump ( $footEquipement);
            if($form->isSubmitted() && $form->isValid()){
                

                $footEquipement = $form->getData();
              

              $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($footEquipement);
             $entityManager->flush();
            return $this->redirectToRoute('page_daccueil',['id'=>$footEquipement->getId()]);
            
            }
           
            
            return $this->render('lucky/formulaire.html.twig', ['nom' =>$nom
            , 'formequipement' => $form->createView()
              ]);

      
        }
    
        
            

    /**
     * @Route("/homepage", name="page_daccueil") 
     */ 
   public function homepage(): Response
   {
    

    $foot= $this->getDoctrine()
    ->getRepository(FootEquipement::class)
    ->findAll();

    if (!$foot) {
        throw $this->createNotFoundException(
            'Aucune etudiant en BDD: '
        );
    }

    return $this->render('lucky/equipementier.html.twig', ['foot' =>$foot
        ,
          ]);
   }

    /**
     * @Route("/footAll/{id}", name="nom_equipement-all")
     */
      
    public function showAll($id) : Response
    {
        $footId= $this->getDoctrine()->getRepository(FootEquipement::class);

       $footEquipement =$footId->find($id);
    

        
   

    
        return $this->render('lucky/recapulatif.html.twig', [
  'footEquipement'=>$footEquipement
        ]);
    

    }
}

