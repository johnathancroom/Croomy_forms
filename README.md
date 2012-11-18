#Form Builder
Form builder is a super duper set of functions that make building forms in CodeIgniter way more fun.

#Installation
Don't be unintelligent and just put the files where they belong.

#Usage!
Of course you want to use this thing. So let's get started!

##build_form($array)
You're going to want to create a super-duper array like this and then pass it to the `build_form` function.
```php
<?
$fields = array(
  array(
    'type' => 'label',
    'attributes' => array(
      'value' => 'Name'
      'for' => 'name'
    )
  ),
  array(
  	'type' => 'input',
  	'attributes' = array(
  	  'name' => 'name',
  	  'value' => 'Put yer name here.'
  	)
  ),
  array(
    'type' => 'label',
    'attributes' => array(
      'value' => 'Biography',
      'for' => 'biography'
    )
  ),
  array(
    'type' => 'textarea',
    'attributes' => array(
      'name' => 'biography',
      'value' => 'Put yer biography here.'
    ),
    'prefix' => '<div>',
    'suffix' => '</div>'
  ),
  array(
    'type' => 'submit',
    'attributes' => array(
      'value' => 'Submit'
    )
  )
);
?>

<?= form_open($this->uri->uri_string()) ?>
  <?= build_form($fields) ?>
<?= form_close() ?>
```
The output is as follows:
```html
<form action="http://website.dev/path/" method="post" accept-charset="utf-8">
  <label for="name">Name</label>
  <input type="text" name="name" value="Put yer name here."  />
  
  <label for="biography">Biography</label>
  
  <div>
  	<textarea name="biography" cols="40" rows="10" id="biography" >Put yer biography here.</textarea>
  </div>
  
  <input type="submit" name="" value="Submit"  />
</form>
```

##Other functions
Needs documentation.

##Building your Form Builder array
Details on building every form element you can possibly imagine (pull request the missing ones, yo).
###Input (text)
Text inputs use the following array keys: `type`, `attributes`, `prefix`, `suffix`. The `attributes` key should contain an array and that array will be used to determine the HTML attributes of your `<input type="text">` element. The `prefix` and `suffix` keys are used to surround an element with extra HTML and should be strings.
```php
array(
  'type' => 'input',
  'attributes' => array(
    'name' => 'email',
    'value' => 'existing@user.com',
    'placeholder' => 'Your Email'
  ),
  'prefix' => '<div>',
  'suffix' => '</div>'
)
```