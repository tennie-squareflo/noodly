"use strict";var KClipboardDemo={init:function(){new Clipboard("[data-clipboard=true]").on("success",function(e){e.clearSelection(),alert("Copied!")})}};jQuery(document).ready(function(){KClipboardDemo.init()});