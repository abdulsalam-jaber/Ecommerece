$(function ()
{
    'use script';

     $('[placeholder]').focus(function()
     {
        $(this).attr('data-text' , $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
     }).blur(function(){
        $(this).attr('placeholder', $(this).attr('data-text'));
     });

     $('input').each(function(){
      if($(this).attr('required')==='required')
      {
         $(this).after('<span class="asterisk">*</span>');
      }
   });

   var passFaild = $('.password');
   $('.show-pass').hover(function(){
      passFaild.attr('type','text');
   },function(){
      passFaild.attr('type','password');
   });
});

