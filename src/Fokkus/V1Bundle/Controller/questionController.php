<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\question;
use Fokkus\V1Bundle\Entity\response;
use Fokkus\V1Bundle\Entity\scores;
use Fokkus\V1Bundle\Entity\timeline;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as Res;


/**
 * Question controller.
 *
 */
class questionController extends Controller
{
    /**
     * Lists all question entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        
        
        $questions = $em->getRepository('FokkusV1Bundle:question')->findAll();
        $response= [] ;
foreach($questions as $row){
    
    
    array_push($response , $em->getRepository('FokkusV1Bundle:response')->findby(array('question'=>$row)) ) ;
//$row['response'] = $row->getResponse() ;
  // echo var_dump($row->getResponse()) ;
}
        return $this->render('question/index.html.twig', array(
            'res'=>$response ,
            'questions' => $questions,
        ));
        
        
    }
public function visualitationAction(){
    
    $em = $this->getDoctrine()->getManager();

    
    
                   		$user =  $this->getUser();;
        $score = $em->getRepository('FokkusV1Bundle:scores')->findby(array('user'=>$user));
        if(count($score)>0){
            
           $timelineCommercial = $em->getRepository('FokkusV1Bundle:timeline')->findOneBy(array("user"=>$user , "type" =>1));
           $timelineCommunication = $em->getRepository('FokkusV1Bundle:timeline')->findOneBy(array("user"=>$user , "type" =>2));
           $timelineFinancial = $em->getRepository('FokkusV1Bundle:timeline')->findOneBy(array("user"=>$user , "type" =>3));

            
            
            
           return $this->render('question/dashboard.html.twig', array(
             'Commercialtimeline'=> $timelineCommercial , 'Communicationtimeline'=> $timelineCommunication, 'Financialtimeline'=> $timelineFinancial
        ));  
        }
        else{
    
    
        $questions = $em->getRepository('FokkusV1Bundle:question')->findAll();
        $response= [] ;
foreach($questions as $row){
    
    
    array_push($response , $em->getRepository('FokkusV1Bundle:response')->findby(array('question'=>$row)) ) ;
//$row['response'] = $row->getResponse() ;
  // echo var_dump($row->getResponse()) ;
}
        return $this->render('question/visualitation.html.twig', array(
            'res'=>$response ,
            'questions' => $questions,
        ));
        }
}
    /**
     * Creates a new question entity.
     *
     */
public function addscoresAction(){
    
      $request = $this->get('request_stack')->getCurrentRequest()
;
		$Commercialscore = $request->request->get('Commercialscore');
                $Communicationscore = $request->request->get('Communicationscore');
                $Financialscore = $request->request->get('Financialscore');
                
                
		 $em = $this->getDoctrine()->getManager();
     $Scores = new scores();
           $Scores->setScore($Commercialscore) ;
           $user =  $this->getUser();;
            $Scores->setUser($user) ;
            $Scores->setType(1) ;
           $em->persist($Scores);
            $em->flush($Scores); 
            
            $Scores = new scores();
           $Scores->setScore($Communicationscore) ;
           $user =  $this->getUser();;
            $Scores->setUser($user) ;
             $Scores->setType(2) ;
           $em->persist($Scores);
            $em->flush($Scores); 
            
            $Scores = new scores();
           $Scores->setScore($Financialscore) ;
           $user =  $this->getUser();;
              $Scores->setType(3) ;
            $Scores->setUser($user) ;
           $em->persist($Scores);
            $em->flush($Scores); 
            
            
          //  $groups = 
          $steps = $em->getRepository('FokkusV1Bundle:step')->findByType(1);

          
          $timeline = new timeline();
          $i = 0 ;
            foreach( $steps as $step){
               //   echo $step->getPoints();
              if($step->getPoints() > $Commercialscore  or $i ==  count($steps ) -1 ) 
                  
              {
                                $currectstep = $steps[$i] ;

                if($i>1)  $currectstep = $steps[$i -1] ; 
                  $timeline->setStep($currectstep) ;
                  $soussteps = $em->getRepository('FokkusV1Bundle:sousstep')->findOneBy(array('step'=>$currectstep));
                    $timeline->setSousstep( $soussteps ) ;
                           $timeline->SetUser($user) ;
                            $timeline->SetType(1) ;

                           $em->persist($timeline);
                            $em->flush($timeline); 
                            break;
              }
              
                $i++ ;
            }
            
             $steps = $em->getRepository('FokkusV1Bundle:step')->findByType(2);

          
          $timeline = new timeline();
                    $i = 0 ;

             foreach( $steps as $step){
               //   echo $step->getPoints();
              if($step->getPoints() > $Communicationscore  or $i ==  count($steps ) -1 ) 
                  
              {
                                $currectstep = $steps[$i] ;

                if($i>1)  $currectstep = $steps[$i -1] ; 
                  $timeline->setStep($currectstep) ;
                  $soussteps = $em->getRepository('FokkusV1Bundle:sousstep')->findOneBy(array('step'=>$currectstep));
                    $timeline->setSousstep( $soussteps ) ;
                           $timeline->SetUser($user) ;
                           $em->persist($timeline);
                                                       $timeline->SetType(2) ;

                            $em->flush($timeline); 
                            break;
              }
              
                $i++ ;
            }
            
              $steps = $em->getRepository('FokkusV1Bundle:step')->findByType(3);

          
          $timeline = new timeline();
                      $i = 0 ;

             foreach( $steps as $step){
               //   echo $step->getPoints();
              if($step->getPoints() > $Financialscore  or $i ==  count($steps ) -1 ) 
                  
              {
                $currectstep = $steps[$i] ;
             if($i>1)     $currectstep = $steps[$i -1] ; 
                  $timeline->setStep($currectstep) ;
                  $soussteps = $em->getRepository('FokkusV1Bundle:sousstep')->findOneBy(array('step'=>$currectstep));
                    $timeline->setSousstep( $soussteps ) ;
                           $timeline->SetUser($user) ;
                            $timeline->SetType(3) ;
                           $em->persist($timeline);
                            $em->flush($timeline); 
                            break;
              }
              
                $i++ ;
            }
            
            
            
            
            
             $response = new Res(json_encode(array('result'=>1)));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
    
}
    public function add_questionAction(){
        
                $request = $this->get('request_stack')->getCurrentRequest()
;
		$questions = $request->request->get('questions');
		 $em = $this->getDoctrine()->getManager();
          foreach($questions as $row) {
              
           $question = new Question();
           $question->setQuestion($row['question']) ;
            $question->setTypeofquestions($row['type']) ;
           $em->persist($question);
            $em->flush($question);
            foreach($row['proposals'] as $data){
                
                $response = new Response();
           $response->setResponse($data['proposal']) ;
           $response->setQuestion($question) ;
           $response->setpoints($data['point']) ;
           $em->persist($response);
            $em->flush($response); 
                
            }
              
          }      
                $response = new Res(json_encode(array('result'=>1)));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
        
    }
    public function newAction(Request $request)
    {
        $question = new Question();
        $form = $this->createForm('Fokkus\V1Bundle\Form\questionType', $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush($question);

            return $this->redirectToRoute('question_show', array('id' => $question->getId()));
        }

        return $this->render('question/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     */
    public function showAction(question $question)
    {
        $deleteForm = $this->createDeleteForm($question);

        return $this->render('question/show.html.twig', array(
            'question' => $question,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     */
    public function editAction(Request $request, question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\questionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('question_edit', array('id' => $question->getId()));
        }

        return $this->render('question/edit.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a question entity.
     *
     */
    public function deleteAction(Request $request, question $question)
    {
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush($question);
        }

        return $this->redirectToRoute('question_index');
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
