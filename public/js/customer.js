// function associate_errors(errs, $form) {
//     //remove existing error classes and error messages from form groups
//     $form.find('.form-group').removeClass('has-errors').find('.help-block').text('');
//     errs.foreach(function (value, index) {
//         //find each form group, which is given a unique id based on the form field's name
//         var $group = $form.find('#' + index + '-group');

//         //add the error class and set the error text
//         $group.addClass('has-errors').find('.help-text').text(value);
//     });
// }
