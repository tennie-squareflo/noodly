"use strict";var KBootstrapDatepicker=function(){var t;t=KUtil.isRTL()?{leftArrow:'<i class="la la-angle-right"></i>',rightArrow:'<i class="la la-angle-left"></i>'}:{leftArrow:'<i class="la la-angle-left"></i>',rightArrow:'<i class="la la-angle-right"></i>'};return{init:function(){$("#k_datepicker_1, #k_datepicker_1_validate").datepicker({rtl:KUtil.isRTL(),todayHighlight:!0,orientation:"bottom left",templates:t}),$("#k_datepicker_1_modal").datepicker({rtl:KUtil.isRTL(),todayHighlight:!0,orientation:"bottom left",templates:t}),$("#k_datepicker_2, #k_datepicker_2_validate").datepicker({rtl:KUtil.isRTL(),todayHighlight:!0,orientation:"bottom left",templates:t}),$("#k_datepicker_2_modal").datepicker({rtl:KUtil.isRTL(),todayHighlight:!0,orientation:"bottom left",templates:t}),$("#k_datepicker_3, #k_datepicker_3_validate").datepicker({rtl:KUtil.isRTL(),todayBtn:"linked",clearBtn:!0,todayHighlight:!0,templates:t}),$("#k_datepicker_3_modal").datepicker({rtl:KUtil.isRTL(),todayBtn:"linked",clearBtn:!0,todayHighlight:!0,templates:t}),$("#k_datepicker_4_1").datepicker({rtl:KUtil.isRTL(),orientation:"top left",todayHighlight:!0,templates:t}),$("#k_datepicker_4_2").datepicker({rtl:KUtil.isRTL(),orientation:"top right",todayHighlight:!0,templates:t}),$("#k_datepicker_4_3").datepicker({rtl:KUtil.isRTL(),orientation:"bottom left",todayHighlight:!0,templates:t}),$("#k_datepicker_4_4").datepicker({rtl:KUtil.isRTL(),orientation:"bottom right",todayHighlight:!0,templates:t}),$("#k_datepicker_5").datepicker({rtl:KUtil.isRTL(),todayHighlight:!0,templates:t}),$("#k_datepicker_6").datepicker({rtl:KUtil.isRTL(),todayHighlight:!0,templates:t})}}}();jQuery(document).ready(function(){KBootstrapDatepicker.init()});