var KWizardDemo=function(){var e,r,i;return{init:function(){var n;KUtil.get("k_wizard_v2"),e=$("#k_form"),(i=new KWizard("k_wizard_v2",{startStep:1})).on("beforeNext",function(e){!0!==r.form()&&e.stop()}),i.on("change",function(e){KUtil.scrollTop()}),r=e.validate({ignore:":hidden",rules:{username:{required:!0},email:{required:!0,email:!0},password:{required:!0},address1:{required:!0},address2:{required:!0},city:{required:!0},zip:{required:!0},state:{required:!0},country:{required:!0},company_name:{required:!0},company_id:{required:!0},company_email:{required:!0},company_tel:{required:!0},"account_communication[]":{required:!0},billing_card_name:{required:!0},billing_card_number:{required:!0,creditcard:!0},billing_card_exp_month:{required:!0},billing_card_exp_year:{required:!0},billing_card_cvv:{required:!0,minlength:2,maxlength:3},accept:{required:!0}},messages:{"account_communication[]":{required:"You must select at least one communication option"},accept:{required:"You must accept the Terms and Conditions agreement!"}},invalidHandler:function(e,r){KUtil.scrollTop(),swal({title:"",text:"There are some errors in your submission. Please correct them.",type:"error",confirmButtonClass:"btn btn-secondary m-btn m-btn--wide"})},submitHandler:function(e){}}),(n=e.find('[data-kwizard-action="action-submit"]')).on("click",function(i){i.preventDefault(),r.form()&&(mApp.progress(n),e.ajaxSubmit({success:function(){mApp.unprogress(n),swal({title:"",text:"The application has been successfully submitted!",type:"success",confirmButtonClass:"btn btn-secondary"})}}))})}}}();jQuery(document).ready(function(){KWizardDemo.init()});