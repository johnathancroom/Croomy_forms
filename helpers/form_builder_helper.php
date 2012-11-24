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
  return _generic_select_options(31);
}

function hour_select_options() {
  return _generic_select_options(12);
}

function minute_select_options() {
  return _generic_select_options(59, 0);
}

function second_select_options() {
  return _generic_select_options(59, 0);
}

function period_select_options() {
  return array(
    1 => 'AM',
    2 => 'PM'
  );
}

function _generic_select_options($max, $start = 1) {
  $numbers = array();

  for($i = $start; $i <= $max; $i++)
  {
    $numbers[$i] = (strlen($i) == 1) ? '0'.$i : $i;
  }

  return $numbers;
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

    # ID auto-set as name
    if(in_array($field['type'], array('input', 'hidden', 'radio', 'checkbox', 'textarea', 'dropdown', 'submit')) && isset($field['attributes']['name']))
    {
      if(!isset($field['attributes']['id'])) $field['attributes']['id'] = $field['attributes']['name'];
    }

    if($field['type'] == 'label')
    {
      # Defaults
      if(!isset($field['attributes']['for'])) $field['attributes']['for'] = NULL;
      if(!isset($field['attributes']['value'])) $field['attributes']['value'] = NULL;

      $options = _build_form_remove_defaults($field['attributes'], array('for', 'value'));

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
    elseif($field['type'] == 'radio')
    {
      echo form_radio($field['attributes']);
    }
    elseif($field['type'] == 'checkbox')
    {
      echo form_checkbox($field['attributes']);
    }
    elseif($field['type'] == 'textarea')
    {
      echo form_textarea($field['attributes']);
    }
    elseif($field['type'] == 'dropdown')
    {
      # Defaults
      if(!isset($field['attributes']['name'])) $field['attributes']['name'] = NULL;
      if(!isset($field['options'])) $field['options'] = array();
      if(!isset($field['attributes']['value'])) $field['attributes']['value'] = NULL;

      $options = _build_form_remove_defaults($field['attributes'], array('name', 'value'));

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

function _build_form_remove_defaults($options, $defaults) {
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