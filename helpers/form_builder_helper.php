<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function month_select_options() {
  return array(
    '1' => 'January',
    '2' => 'February',
    '3' => 'March',
    '4' => 'April',
    '5' => 'May',
    '6' => 'June',
    '7' => 'July',
    '8' => 'August',
    '9' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
  );
}

function year_select_options($start = NULL, $end = NULL) {
  if(!isset($start)) $start = date("Y");
  if(!isset($end)) $end = $start + 10;

  $years = array();
  for($i = 0; $i <= ($end-$start); $i++)
  {
    $years[$start+$i] = $start+$i;
  }

  return $years;
}

function day_select_options() {
  $days = array();
  for($i = 1; $i <= 31; $i++)
  {
    $days[$i] = (strlen($i) == 1) ? '0'.$i : $i;
  }

  return $days;
}

function build_form($array) {
  foreach($array as $field)
  {
    # Creating missing attributes array
    if(!isset($field['attributes'])) $field['attributes'] = array();

    # Echo prefix
    if(isset($field['prefix']))
    {
      echo $field['prefix'];
    }

    if($field['type'] == 'label')
    {
      # Defaults
      if(!isset($field['attributes']['for'])) $field['attributes']['for'] = NULL;
      if(!isset($field['attributes']['value'])) $field['attributes']['value'] = NULL;

      $options = build_form_remove_defaults($field['attributes'], array('for', 'value'));

      echo form_label($field['attributes']['value'], $field['attributes']['for'], $options);
    }
    elseif($field['type'] == 'input')
    {
      echo form_input($field['attributes']);
    }
    elseif($field['type'] == 'hidden')
    {
      echo form_hidden($field['attributes']);
    }
    elseif($field['type'] == 'textarea')
    {
      # Defaults
      if(!isset($field['attributes']['id'])) $field['attributes']['id'] = $field['attributes']['name'];

      echo form_textarea($field['attributes']);
    }
    elseif($field['type'] == 'dropdown')
    {
      # Defaults
      if(!isset($field['attributes']['name'])) $field['attributes']['name'] = NULL;
      if(!isset($field['options'])) $field['options'] = array();
      if(!isset($field['attributes']['value'])) $field['attributes']['value'] = NULL;

      $options = build_form_remove_defaults($field['attributes'], array('name', 'value'));

      $options_html = convert_attributes_array_to_html($options);

      echo form_dropdown($field['attributes']['name'], $field['options'], $field['attributes']['value'], $options_html);
    }
    elseif($field['type'] == 'submit')
    {
      echo form_submit($field['attributes']);
    }

    # Echo suffix
    if(isset($field['suffix']))
    {
      echo $field['suffix'];
    }
  }
}

function build_form_remove_defaults($options, $defaults) {
  foreach($options as $key => $option)
  {
    if(in_array($key, $defaults))
    {
      unset($options[$key]);
    }
  }

  return $options;
}

function convert_attributes_array_to_html($attributes) {
  $string = '';

  foreach($attributes as $key => $value)
  {
    $string .= $key . '="' . $value . '" ';
  }

  return $string;
}