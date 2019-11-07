<?php
/**
  * @file
  * Contains\Drupal\Node Generator\Form\Form
  */
namespace Drupal\node_generator\Form;

//use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;
/**
  * Provides an Node Generator form
  */
class NodeGeneratorForm extends FormBase {
  /**
    * (@inheritdoc)
    */
  public function getFormId() {
    return 'node_generatorform';
  }	
  /**
    * (@inheritdoc)
    */
  public function buildForm(array $form, FormStateInterface $form_state){
    $node_types = \Drupal\node\Entity\NodeType::loadMultiple();
    foreach ($node_types as $node_type) {
  $options[$node_type->id()] = $node_type->label();
}

  	$form['content_type'] = [
	  '#title' =>  $this->t('SELECT'),
	  '#type' => 'select',
	  '#description' => 'A select list with  all the available content types',
	  '#options' => $options,
  ];

  	$form['no_of_nodes'] = [
  '#title' => $this->t('no_of_Nodes'),
  '#type' => 'number',
  '#min' => '2',
  '#max' => '10',
  '#description' => 'A select list with  all the available content types'
];
  
  $form['submit'] = [
    '#type' => 'submit',
    '#value' => $this->t('Submit')
  ];
  return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
    }
  public function submitForm(array &$form,FormStateInterface $form_state){
  	 $value = $form_state->getValue('no_of_nodes');
     $value1 = $form_state->getValue('content_type');

     for ($x = 1; $x <= $value; $x++){
     	$nodeObj = Node::create([
      'type' => $value1,
      'title' => 'Programatically created Article',
      ]);
     	$nodeObj->save(); // Saving the Node object.
 
     }

  }
}