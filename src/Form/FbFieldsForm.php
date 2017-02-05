<?php
/**
     * @file
     * Contains \Drupal\example_form_api\Form\FbFieldsForm.
     */
    namespace Drupal\example_form_api\Form;

    use Drupal\Core\Form\FormBase;
    use Drupal\Core\Form\FormStateInterface;

    /**
     * Contribute form.
     */
    class FbFieldsForm extends FormBase {
      /**
       * {@inheritdoc}
       */
      public function getFormId() {
	return 'fb_example_form_api';
      }
      /**
       * {@inheritdoc}
       */
    public function buildForm(array $form, FormStateInterface $form_state) {
        
    $form['fb_field_description'] = array(
        '#type' => 'item', 
        '#title' => t('A form with additional attributes'), 
        '#description' => t('This one adds #default_value and #description'),
    );
    //fieldset
      $form['fb_field_fieldset1'] = array(
        '#type' => 'fieldset', 
        '#title' => t('Fieldset label 1'),
        '#collapsible' => TRUE, 
        '#collapsed' => FALSE,
      );
	  $form['fb_field_fieldset2'] = array(
        '#type' => 'fieldset', 
        '#title' => t('Fieldset label 2'),
        '#collapsible' => TRUE, 
        '#collapsed' => FALSE,
      );
	 $form['fb_field_fieldset3'] = array(
        '#type' => 'fieldset', 
        '#title' => t('Fieldset label 3'),
        '#collapsible' => TRUE, 
        '#collapsed' => FALSE,
      );
	//**************************************************begin fieldset 1 ************************/
    $form['fb_field_fieldset1']['fb_field_textfield'] = array(
      '#type' => 'textfield',
      '#title' => t('textfield'),
      '#default_value' => "default value here", // added default value. 
      '#description' => "Please enter your value.", // added description 
      '#size' => 20, // added 
      '#maxlength' => 20, // added
      '#required' => TRUE,
    );
	//textarea
    $form['fb_field_fieldset1']['fb_field_fieldset']['text'] = array(
        '#type' => 'textarea',
        '#title' => $this->t('Text'),
      );
    //password
    $form['fb_field_fieldset1']['pass'] = array(
        '#type' => 'password',
        '#title' => $this->t('Password'),
        '#size' => 25,
      );    //select
    $form['fb_field_fieldset2']['fb_field_select'] = array (
      '#type' => 'select',
      '#title' => ('list'),
      '#options' => array(
        'Female' => t('a'),
        'male' => t('b'),
      ),
    );
	
    //email
   $form['fb_field_fieldset1']['fb_field_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email'),
      '#required' => TRUE,
    );
    //telphone
    $form['fb_field_fieldset1']['fb_field_tel'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile'),
    );
    //integer
    $form['fb_field_fieldset1']['fb_field_integer'] = array(
	    '#type' => 'number',
	    '#title' => t('Some integer'),
	    // The increment or decrement amount
	    '#step' => 1,
	    // Miminum allowed value
	    '#min' => 0,
	    // Maxmimum allowed value
	    '#max' => 100,
     );

    //website
    $form['fb_field_fieldset1']['fb_field_website'] = array(
        '#type' => 'url',
        '#title' => t('Website'),
    );
    //search
    $form['fb_field_fieldset1']['fb_field_search'] = array(
        '#type' => 'search',
        '#title' => t('Search'),
        '#autocomplete_route_name' => FALSE,
    );
	//**************************************************End fieldset 1 ************************/
	//**************************************************begin fieldset 2************************/
	//date
    $form['fb_field_fieldset2']['fb_field_date'] = array (
      '#type' => 'date',
      '#title' => t('date'),
      //'#required' => TRUE,
      '#date_date_format' => 'Y-m-d',
    );

    //range
    $form['fb_field_fieldset2']['fb_field_range'] = array(
        '#type' => 'range',
        '#title' => t('Range'),
        '#min' => 0,
        '#max' => 100,
        '#step' => 1,
    );
	//**************************************************End fieldset 2 ************************/
	//**************************************************Begin fieldset 3 ************************/
    //radios
   $form['fb_field_fieldset3']['fb_field_radios'] = array (
      '#type' => 'radios',
      '#title' => ('your choice'),
      '#options' => array(
        'Yes' =>t('Yes'),
        'No' =>t('No')
      ),
    );
    //checkbox
    $form['fb_field_fieldset3']['fb_field_checkbox'] = array(
      '#type' => 'checkbox',
      '#title' => t('test checkbox'),
    );
    //checkboxes
    $form['fb_field_fieldset3']['fb_field_checkboxes']['test'] = array(
      '#type' => 'checkboxes',
      '#options' => array('Q' => $this->t('Q'), 'W' => $this->t('W')),
      '#title' => $this->t('test checkboxes?'),
      );
    //tableselect
    $header = [
      'first_name' => $this->t('First Name'),
      'last_name' => $this->t('Last Name'),
    ];
    $options = [
      1 => ['first_name' => 'Indy', 'last_name' => 'Jones'],
      2 => ['first_name' => 'Darth', 'last_name' => 'Vader'],
      3 => ['first_name' => 'Super', 'last_name' => 'Man'],
    ];

    $form['fb_field_fieldset3']['fb_field_table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No users found'),
    );
	//**************************************************End fieldset 3 ************************/
    //button  
    $form['actions']['preview'] = array(
      '#type' => 'button',
      '#value' => $this->t('Preview'),
    );
    //action  
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('fb_field_tel')) < 10) {
        $form_state->setErrorByName('fb_field_tel', $this->t('Mobile number is too short.'));
      }
    }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
   }
}