"use strict";var DefaultDatatableDemo={init:function(){var t;t=$(".k_datatable").KDatatable({data:{type:"remote",source:{read:{url:"https://keenthemes.com/keen/themes/themes/keen/dist/preview/inc/api/datatables/demos/default.php"}},pageSize:10,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{theme:"default",class:"",scroll:!0,height:350,footer:!1},sortable:!0,filterable:!1,pagination:!0,search:{input:$("#generalSearch")},columns:[{field:"id",title:"#",sortable:"asc",width:40,type:"number",selector:!1,textAlign:"center"},{field:"employee_id",title:"Employee ID"},{field:"name",title:"Name",template:function(t,e,a){return t.first_name+" "+t.last_name}},{field:"email",width:150,title:"Email"},{field:"phone",title:"Phone"},{field:"hire_date",title:"Hire Date",type:"date",format:"MM/DD/YYYY"},{field:"gender",title:"Gender"},{field:"notes",title:"Notes",width:300},{field:"status",title:"Status",template:function(t){var e={1:{title:"Pending",class:"k-badge--brand"},2:{title:"Delivered",class:" k-badge--metal"},3:{title:"Canceled",class:" k-badge--primary"},4:{title:"Success",class:" k-badge--success"},5:{title:"Info",class:" k-badge--info"},6:{title:"Danger",class:" k-badge--danger"},7:{title:"Warning",class:" k-badge--warning"}};return'<span class="k-badge '+e[t.status].class+' k-badge--inline k-badge--pill">'+e[t.status].title+"</span>"}},{field:"type",title:"Type",template:function(t){var e={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"accent"}};return'<span class="k-badge k-badge--'+e[t.type].state+' k-badge--dot"></span>&nbsp;<span class="k-font-bold k-font-'+e[t.type].state+'">'+e[t.type].title+"</span>"}},{field:"Actions",title:"Actions",sortable:!1,width:130,overflow:"visible",textAlign:"center",template:function(t,e,a){return'\t\t\t\t\t\t<div class="dropdown '+(a.getPageSize()-e<=4?"dropup":"")+'">\t\t\t\t\t\t\t<a href="#" class="btn btn-hover-brand btn-icon btn-pill" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-left">\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="#" class="btn btn-hover-brand btn-icon btn-pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="btn btn-hover-danger btn-icon btn-pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'}}]}),$("#k_form_status").on("change",function(){t.search($(this).val().toLowerCase(),"status")}),$("#k_form_type").on("change",function(){t.search($(this).val().toLowerCase(),"type")}),$("#k_form_status,#k_form_type").selectpicker()}};jQuery(document).ready(function(){DefaultDatatableDemo.init()});