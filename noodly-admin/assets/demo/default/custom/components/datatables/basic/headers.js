"use strict";var DatatablesBasicHeaders={init:function(){$("#k_table_1").DataTable({responsive:!0,columnDefs:[{targets:-1,title:"Actions",orderable:!1,render:function(a,e,t,n){return'\n                        <span class="dropdown">\n                            <a href="#" class="btn btn-hover-brand btn-icon btn-pill" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\n                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\n                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\n                            </div>\n                        </span>\n                        <a href="#" class="btn btn-hover-brand btn-icon btn-pill" title="View">\n                          <i class="la la-edit"></i>\n                        </a>'}},{targets:8,render:function(a,e,t,n){var s={1:{title:"Pending",class:"k-badge--brand"},2:{title:"Delivered",class:" k-badge--metal"},3:{title:"Canceled",class:" k-badge--primary"},4:{title:"Success",class:" k-badge--success"},5:{title:"Info",class:" k-badge--info"},6:{title:"Danger",class:" k-badge--danger"},7:{title:"Warning",class:" k-badge--warning"}};return void 0===s[a]?a:'<span class="k-badge '+s[a].class+' k-badge--inline k-badge--pill">'+s[a].title+"</span>"}},{targets:9,render:function(a,e,t,n){var s={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"accent"}};return void 0===s[a]?a:'<span class="k-badge k-badge--'+s[a].state+' k-badge--dot"></span>&nbsp;<span class="k-font-bold k-font-'+s[a].state+'">'+s[a].title+"</span>"}}]})}};jQuery(document).ready(function(){DatatablesBasicHeaders.init()});